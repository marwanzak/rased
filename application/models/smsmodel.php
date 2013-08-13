<?php
class smsModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function index(){
		
	}
	
	//send sms now function
	public function sendSmsNow($atts = array())
	{
		$number = (float)$atts['number'];
		if(substr($number, 0, 2)!="20")
			$number = "20" . $number;
		$postdata = http_build_query(
				array(
	
						"username" => $atts['username'],
						"password" => $atts['password'],
						"sender" => $atts['sender'],
						"numbers" => $number,
						"message" => $atts['message'],
						"return" => "xml"
				)
		);
		$opts = array('http' =>
				array(
						'method' => 'POST',
						'header' => 'Content-type: application/x-www-form-urlencoded',
						'content'=> $postdata
	
				)
	
		);
		$context = stream_context_create($opts);
		$result = file_get_contents("http://www.joudsms.com/api/sendsms.php", false, $context);
		$xml = simplexml_load_string($result);
		return $xml;
	}
	
	
}