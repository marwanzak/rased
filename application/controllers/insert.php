<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class insert extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
	public function insertLevel(){
		echo ($this->homeModel->insertLevel($_POST["level"]))?
		"Level inserted successfully":"Error occured";
	}
	public function insertGrade(){
		echo ($this->homeModel->insertGrade($_POST["grade"],$_POST["level"]))?
		"Grade inserted successfully":"Error occured";
	}
	public function insertClass(){
		echo ($this->homeModel->insertClass($_POST["grade"],$_POST["class"]))?
		"Class inserted successfully":"Error occured";
	}
	public function insertSubject(){
		echo ($this->homeModel->insertSubject($_POST["grade"],$_POST["subject"]))?
		"Subject inserted successfully":"Error occured";
	}
	public function insertUser(){
		$salt = rand();
		$code = rand();
		$password = crypt($_POST["password"].$salt);
		echo ($this->homeModel->insertUser($_POST["username"], $password,
				$salt,$_POST["name"],$_POST["role"],
				$_POST["active"],$code))?
				"User inserted successfully":"Error occured";
	}
	public function insertPermissions(){
		echo ($this->homeModel->insertPermissions($_POST["username"],$_POST["permissions"]))?
		"Permissions inserted successfully":"Error occured";
	}
	public function insertDef(){
		echo ($this->homeModel->insertDef($_POST["username"],$_POST["number"],$_POST["email"]))?
		"Defualts inserted successfully":"Error occured";
	}
	public function insertNotify(){
		echo ($this->homeModel->insertNotify($_POST["username"],$_POST["numbers"],$_POST["emails"],$_POST["datetime"], $_POST["message"]))?
		"Notify inserted successfully":"Error occured";
	}
	public function insertNoteType(){
		echo ($this->homeModel->insertNoteType($_POST["type"],$_POST["body"]))?
		"Noty type inserted successfully":"Error occured";
	}
	public function insertReady(){
		echo ($this->homeModel->insertDef($_POST["message"]))?
		"Ready message inserted successfully":"Error occured";
	}
	public function insertMorning(){
		echo ($this->homeModel->insertMorning($_POST["student"],$_POST["datetime"]))?
		"Presence inserted successfully":"Error occured";
	}
	public function insertStudent(){
		echo ($this->homeModel->insertDef($_POST["username"],$_POST["fullname"],$_POST["class"], $_POST["idnum"]))?
		"Student inserted successfully":"Error occured";
	}
	public function insertRole(){
		echo ($this->homeModel->insertRole($_POST["role"]))?
		"Role inserted successfully":"Error occured";
	}
	public function insertSettings(){
		echo ($this->homeModel->insertSettings($_POST["smsusername"],$_POST["smspassword"],$_POST["year"], $_POST["semester"]))?
		"Setting setted successfully":"Error occured";
	}
	public function insertNote(){
		$set = $this->homemodel->getSettings();
		echo ($this->homeModel->insertNote($_POST["type"],$_POST["student"],$_POST["subject"], $_POST["note"]
				,$_POST["status"],$_POST["datetime"], $set->semester,$_POST["sold"],$_POST["agreed"], $_POST["username"],$set->year
				))?
		"Setting setted successfully":"Error occured";
	}
	


}
