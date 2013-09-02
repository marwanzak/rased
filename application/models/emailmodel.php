<?php
class emailModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->library("SMTP/phpmailer");
	}

	public function sendEmail($atts=array()){
		$settings = $this->homemodel->getSettings();
		$mail = new PHPMailer;
		if($settings->email_method=="smtp"){
			$mail->IsSMTP();
			$mail->Host = $settings->email_server;
			$mail->Port = $settings->email_port;
			$mail->SMTPSecure = 'ssl';
			$mail->SMTPAuth = true;

			$mail->Username = $settings->email_username;
			$mail->Password = $settings->email_password;
				
			$mail->From = $settings->email_username;
			$mail->FromName = $settings->sendername;
		}else{
			$mail->setFrom($settings->sendername,$settings->sendername);
		}
		$mail->IsHTML(true);
		$mail->AddAddress($atts["address"]);
		$mail->Subject = $atts["subject"];
		$mail->MsgHTML($atts["message"]);
		if(!$mail->Send()) {
			return $mail->ErrorInfo;
		}
		return true;
			
	}

}