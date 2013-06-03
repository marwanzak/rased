<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class insert extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
	public function insertLevel(){
		echo $this->homeModel->insertLevel($_POST["level"]);
	}
	public function insertGrade(){
		echo $this->homeModel->insertGrade($_POST["grade"],$_POST["level"]);
	}
	public function insertClass(){
		echo $this->homeModel->insertClass($_POST["grade"],$_POST["class"]);
	}
	public function insertSubject(){
		echo $this->homeModel->insertSubject($_POST["grade"],$_POST["subject"]);
	}
	public function insertUser(){
		echo $this->homeModel->insertUser($_POST["username"], $_POST["password"],
				$_POST["name"],$_POST["role"],
				$_POST["active"]);
	}
	public function insertPermissions(){
		echo $this->homeModel->insertPermissions($_POST["username"],
				$_POST["permissions"]);
	}
	public function insertDef(){
		echo $this->homeModel->insertDef($_POST["username"],
				$_POST["number"],$_POST["email"]);
	}
	public function insertNotify(){
		echo $this->homeModel->insertNotify($_POST["username"],
				$_POST["numbers"],$_POST["emails"],
				$_POST["datetime"], $_POST["message"]);
	}
	public function insertNoteType(){
		echo $this->homeModel->insertNoteType($_POST["type"],$_POST["body"]);
	}
	public function insertReady(){
		echo $this->homeModel->insertDef($_POST["message"]);
	}
	public function insertMorning(){
		echo $this->homeModel->insertMorning($_POST["student"],
				$_POST["datetime"]);
	}
	public function insertStudent(){
		echo $this->homeModel->insertDef($_POST["username"],
				$_POST["fullname"],$_POST["class"], $_POST["idnum"]);
	}
	public function insertRole(){
		echo $this->homeModel->insertRole($_POST["role"]);
	}
	public function insertAction(){
		echo $this->homeModel->insertAction($_POST["usename"],
				$_POST["action"], $_POST["datetime"]);
	}
	public function insertSettings(){
		echo $this->homeModel->insertSettings($_POST["smsusername"],
				$_POST["smspassword"],$_POST["year"], $_POST["semester"]);
	}
	public function insertNote(){
		$set = $this->homemodel->getSettings();
		echo $this->homeModel->insertNote($_POST["type"],$_POST["student"],
				$_POST["subject"], $_POST["note"],
				$_POST["status"],$_POST["datetime"], $set->semester,
				$_POST["sold"],$_POST["agreed"], $_POST["username"],$set->year
		);
	}



}
