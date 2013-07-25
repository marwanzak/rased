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
		$query = $this->homemodel->insertNoteType($_POST["prob"],$_POST["sold"],$_POST["body"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertReady(){
		$query = $this->homemodel->insertReady($_POST["message"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertProb(){
		$query = $this->homemodel->insertProb($_POST["level"],$_POST["prob"], $_POST["color"]);
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
		foreach($_POST["notescheck"] as $key => $check){
			if($check!="0")
			$query = $this->homemodel->insertNote($_POST["types"][$key],$check,
					$_POST["subjects"][$key], $_POST["notes"][$key],
					$_POST["status"][$key],$_POST["day"][$key], $_POST["month"][$key],
					$_POST["probs"][$key], "0", $_POST["priority"][$key]
			);
		}
		if(isset($query))
		$this->session->set_userdata("msg","1");
		else{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message", lang("note_insert_error"));
		}
		redirect($this->session->userdata("refered_from"),"refresh");
	}



}
