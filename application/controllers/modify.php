<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modify extends CI_Controller {
	function __construct(){
		parent::__construct();
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
		$query= $this->homemodel->modifyLevel($_POST["id"], $_POST["level"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyGrade(){
		$query= $this->homemodel->modifyGrade($_POST["id"], $_POST["grade"],
				$_POST["level"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyClass(){
		$query= $this->homemodel->modifyClass($_POST["id"], $_POST["grade"],
				$_POST["class"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifySubject(){
		$query= $this->homemodel->modifySubject($_POST["id"], $_POST["grade"],
				$_POST["subject"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyUser(){
		$query= $this->homemodel->modifyUser($_POST["id"], $_POST["username"],
				$_POST["name"],	$_POST["role"], ($_POST["active"]=="active")?1:0,
				$_POST["classes"], $_POST["subjects"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyPermissions(){
		if($_POST!=null){
			$role = $_POST["role"];
			unset($_POST["role"]);
				
		$query= $this->homemodel->modifyPermissions($role,$_POST);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function modifyDef(){
		$query= $this->homemodel->modifyDef($_POST["id"], $_POST["username"],
				$_POST["number1"], $_POST["number2"], $_POST["email1"], $_POST["email2"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyNotify(){
		$query= $this->homemodel->modifyUser($_POST["id"], $_POST["username"],
				$_POST["number"], $_POST["email"],
				$_POST["datetime"], $_POST["message"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyNoteType(){
		$query= $this->homemodel->modifyNoteType($_POST["id"], $_POST["prob"],$_POST["sold"],
				$_POST["body"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyReady(){
		$query= $this->homemodel->modifyReady($_POST["id"], $_POST["message"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}

	public function modifyProb(){
		$query= $this->homemodel->modifyProb($_POST["id"], $_POST["level"], $_POST["prob"], $_POST["color"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyMorning(){
		$query= $this->homemodel->modifyMorning($_POST["id"], $_POST["student"],
				$_POST["datetime"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyStudent(){
		$query= $this->homemodel->modifyStudent($_POST["id"], $_POST["username"],
				$_POST["fullname"], $_POST["class"],
				$_POST["idnum"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifyRole(){
		$query= $this->homemodel->modifyRole($_POST["id"], $_POST["role"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function modifySettings(){
		$query= $this->homemodel->modifySettings($_POST["id"],
				$_POST["smsusername"], $_POST["smspassword"],
				$_POST["year"],	$_POST["semester"]);
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

}
