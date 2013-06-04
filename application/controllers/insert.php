<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class insert extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
	public function insertLevel(){
		echo $this->homemodel->insertLevel($_POST["level"]);
	}
	public function insertGrade(){
		echo $this->homemodel->insertGrade($_POST["grade"],$_POST["level"]);
	}
	public function insertClass(){
		echo $this->homemodel->insertClass($_POST["grade"],$_POST["class"]);
	}
	public function insertSubject(){
		echo $this->homemodel->insertSubject($_POST["grade"],$_POST["subject"]);
	}
	public function insertUser(){
		echo $this->homemodel->insertUser($_POST["username"], $_POST["password"],
				$_POST["name"],$_POST["role"],
				$_POST["active"]);
	}
	public function insertPermissions(){
		echo $this->homemodel->insertPermissions($_POST["username"],
				$_POST["permissions"]);
	}
	public function insertDef(){
		echo $this->homemodel->insertDef($_POST["username"],
				$_POST["number"],$_POST["email"]);
	}
	public function insertNotify(){
		echo $this->homemodel->insertNotify($_POST["username"],
				$_POST["numbers"],$_POST["emails"],
				$_POST["datetime"], $_POST["message"]);
	}
	public function insertNoteType(){
		echo $this->homemodel->insertNoteType($_POST["type"],$_POST["body"]);
	}
	public function insertReady(){
		echo $this->homemodel->insertDef($_POST["message"]);
	}
	public function insertMorning(){
		echo $this->homemodel->insertMorning($_POST["student"],
				$_POST["datetime"]);
	}
	public function insertStudent(){
		echo $this->homemodel->insertDef($_POST["username"],
				$_POST["fullname"],$_POST["class"], $_POST["idnum"]);
	}
	public function insertRole(){
		echo $this->homemodel->insertRole($_POST["role"]);
	}
	public function insertAction(){
		echo $this->homemodel->insertAction($_POST["usename"],
				$_POST["action"], $_POST["datetime"]);
	}
	public function insertSettings(){
		echo $this->homemodel->insertSettings($_POST["smsusername"],
				$_POST["smspassword"],$_POST["year"], $_POST["semester"]);
	}
	public function insertNote(){
		$set = $this->homemodel->getSettings();
		echo $this->homemodel->insertNote($_POST["type"],$_POST["student"],
				$_POST["subject"], $_POST["note"],
				$_POST["status"],$_POST["datetime"], $set->semester,
				$_POST["sold"],$_POST["agreed"], $_POST["username"],$set->year
		);
	}



}
