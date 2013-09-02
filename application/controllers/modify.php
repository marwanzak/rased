<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modify extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load("arabic", "arabic");
		$user = $this->session->userdata("id");
		$action = strtolower(str_replace("modify", "", $this->uri->segment(2)));
		$this->homemodel->insertAction(lang($action),lang("modify"));
	}
	public function index()
	{

	}
	public function modifyPassword(){
		$query= $this->homemodel->modifyPassword($_POST["id"], $_POST["password"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyLevel(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('level', lang('choose_level'), 'required|is_unique[levels.level]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query= $this->homemodel->modifyLevel($_POST["id"], $_POST["level"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyGrade(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('grade', lang('choose_grade'), 'required|is_unique[grades.grade]');
		$this->form_validation->set_rules('level', lang('choose_level'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query= $this->homemodel->modifyGrade($_POST["id"], $_POST["grade"],
					$_POST["level"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyClass(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('class', lang('choose_class'), 'required|is_unique[classes.class]');
		$this->form_validation->set_rules('grade', lang('choose_grade'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query= $this->homemodel->modifyClass($_POST["id"], $_POST["grade"],
					$_POST["class"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifySubject(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('subject', lang('choose_subject'), 'required|is_unique[subjects.subject]');
		$this->form_validation->set_rules('grade', lang('choose_grade'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query= $this->homemodel->modifySubject($_POST["id"], $_POST["grade"],
					$_POST["subject"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyUser(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('username', lang('choose_username'), 'required|is_unique[users.username]');
		$this->form_validation->set_rules('role', lang('choose_role'), 'required');
		$this->form_validation->set_rules('password', lang('enter_password'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
		$query= $this->homemodel->modifyUser($_POST["id"], $_POST["username"],
				$_POST["name"],	$_POST["role"], ($_POST["active"]=="active")?1:0,
				$_POST["classes"], $_POST["subjects"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyPermissions(){
		if($_POST!=null){
			$this->form_validation->set_message('required', lang('required')."%s");
			$this->form_validation->set_rules('username', lang('choose_username'), 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata("msg","-1");
				$this->session->set_userdata("message",validation_errors());
				redirect($this->session->userdata("refered_from"),"refresh");
			}
			else
			{
			$role = $_POST["role"];
			unset($_POST["role"]);

			$query= $this->homemodel->modifyPermissions($role,$_POST);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
			}
		}
	}
	public function modifyDef(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_message('valid_email', lang("valid_email"));
		$this->form_validation->set_rules('username', lang('enter_username'), 'required');
		$this->form_validation->set_rules('number1', lang('enter_number'), 'required|is_unique[defaultnumemail.number1]');
		$this->form_validation->set_rules('email1', lang('enter_email'), 'required|is_unique[defaultnumemail.email1]|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
		$query= $this->homemodel->modifyDef($_POST["id"], $_POST["username"],
				$_POST["number1"], $_POST["number2"], $_POST["email1"], $_POST["email2"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyNotify(){
		$query= $this->homemodel->modifyUser($_POST["id"], $_POST["username"],
				$_POST["number"], $_POST["email"],
				$_POST["datetime"], $_POST["message"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyNoteType(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_rules('pbob', lang('enter_prob'), 'required');
		$this->form_validation->set_rules('body', lang('enter_type'), 'required|is_unique[notestypes.body]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
		$query= $this->homemodel->modifyNoteType($_POST["id"], $_POST["prob"],$_POST["sold"],
				$_POST["body"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyReady(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_rules('message', lang('enter_message'), 'required|is_unique[readymessages.message]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
		$query= $this->homemodel->modifyReady($_POST["id"], $_POST["message"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
		}
	}

	public function modifyProb(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_rules('level', lang('choose_level'), 'required');
		$this->form_validation->set_rules('prob', lang('enter_prob'), 'required|is_unique[notesprob.prob]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
		$query= $this->homemodel->modifyProb($_POST["id"], $_POST["level"], $_POST["prob"], $_POST["color"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyMorning(){
		$query= $this->homemodel->modifyMorning($_POST["id"], $_POST["student"],
				$_POST["datetime"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyStudent(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_message('numeric', lang("number")."%s");
		$this->form_validation->set_rules('class', lang('choose_class'), 'required');
		$this->form_validation->set_rules('idnum', lang('enter_idnum'), 'required|is_unique[students.idnum]|numeric');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
		$query= $this->homemodel->modifyStudent($_POST["id"], $_POST["username"],
				$_POST["fullname"], $_POST["class"],
				$_POST["idnum"],$_POST["finger"],$_POST["terminal_id"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyRole(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_rules('role', lang('enter_role'), 'required|is_unique[roles.role]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
		$query= $this->homemodel->modifyRole($_POST["id"], $_POST["role"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifySettings(){
		$query= $this->homemodel->modifySettings($_POST["id"],
				$_POST["smsusername"], $_POST["smspassword"],
				$_POST["year"],	$_POST["semester"],$_POST["morning"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyNote(){
		$query= $this->homemodel->modifyNote($_POST["id"], $_POST["type"],
				$_POST["student"], $_POST["subject"],
				$_POST["note"],isset($_POST["status"])?1:0, $_POST["month"],
				$_POST["day"],$_POST["prob"], $_POST["priority"]
		);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}

	public function modifyAgree(){
		if($_POST!=null){
			echo $this->homemodel->modifyAgree($_POST["id"], $_POST["agree"]);
		}
		else echo false;
	}

	//modify lesson
	public function modifyLesson(){
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('day', lang('day'), 'required');
		$this->form_validation->set_rules('order', lang('order'), 'required');
		$this->form_validation->set_rules('subject', lang('subject'), 'required');
		$this->form_validation->set_rules('class', lang('class'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$this->homemodel->modifyLesson($_POST["id"],array("day"=>$_POST["day"],"class"=>$_POST["class"],
					"subject"=>$_POST["subject"],"order"=>$_POST["order"]
			));
			$this->session->set_userdata("msg","1");
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}

	//modify slider
	public function modifySlider(){
		$data["table"]="ra_slider";
		$this->form_validation->set_message('numeric', lang('order_numeric'));
		$this->form_validation->set_rules('order', lang('order'), 'numeric');
		if ($this->form_validation->run() == FALSE)
		{
			$data["msg"]="-1";
			$data["message"]= validation_errors();
		}
		else
		{
			$slide = $this->homemodel->modifySlider($_POST["id"],array(
					"order"=>$_POST["order"],
					"url"=>$_POST["url"]
			));
			if($slide==1)
				$data["msg"]=1;
			else {
				$data["msg"]="-1";
				$data["message"]=lang("error");
			}
		}
		$data["sliders"] = $this->homemodel->getAllSlider();
		$this->load->view("admin-slider",$data);
	}

	//modify message read status
	public function readMessage(){
		if($_POST!=null){
			echo $this->homemodel->readMessage($_POST["message_id"]);
		}echo false;
	}

}
