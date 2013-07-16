<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class insert extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
	public function insertLevel(){
		$query = $this->homemodel->insertLevel($_POST["level"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertGrade(){
		$query = $this->homemodel->insertGrade($_POST["grade"],$_POST["level"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertClass(){
		$query = $this->homemodel->insertClass($_POST["grade"],$_POST["class"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertSubject(){
		$query = $this->homemodel->insertSubject($_POST["grade"],$_POST["subject"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertUser(){
		$query = $this->homemodel->insertUser($_POST["username"], $_POST["password"],
				$_POST["name"],$_POST["role"],
				$_POST["active"], $_POST["classes"], $_POST["subjects"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertPermissions(){
		$query = $this->homemodel->insertPermissions($_POST["username"],
				$_POST["permissions"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertDef(){
		$query = $this->homemodel->insertDef($_POST["username"],
				$_POST["number1"],$_POST["number2"], $_POST["email1"], $_POST["email2"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertNotify(){
		$query = $this->homemodel->insertNotify($_POST["username"],
				$_POST["numbers"],$_POST["emails"],
				$_POST["datetime"], $_POST["message"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertNoteType(){
		$query = $this->homemodel->insertNoteType($_POST["prob"],$_POST["body"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertReady(){
		$query = $this->homemodel->insertReady($_POST["message"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertProb(){
		$query = $this->homemodel->insertProb($_POST["level"],$_POST["prob"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertMorning(){
		$query = $this->homemodel->insertMorning($_POST["student"],
				$_POST["datetime"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertStudent(){
		$query = $this->homemodel->insertStudent($_POST["username"],
				$_POST["fullname"],$_POST["class"], $_POST["idnum"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertRole(){
		$query = $this->homemodel->insertRole($_POST["role"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertAction(){
		$query = $this->homemodel->insertAction($_POST["usename"],
				$_POST["action"], $_POST["type"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertSettings(){
		$query = $this->homemodel->insertSettings($_POST["smsusername"],
				$_POST["smspassword"],$_POST["year"], $_POST["semester"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertNote(){
		$set = $this->homemodel->getSettings();
		$query = $this->homemodel->insertNote($_POST["type"],$_POST["student"],
				$_POST["subject"], $_POST["note"],
				$_POST["status"],$_POST["datetime"], $set->semester,
				$_POST["sold"],$_POST["agreed"], $_POST["username"],$set->year
		);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}



}
