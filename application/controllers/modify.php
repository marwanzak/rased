<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modify extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
	public function modifyLevel(){
		echo $this->homemodel->modifyLevel($_POST["id"], $_POST["level"]);
	}
	public function modifyGrade(){
		echo $this->homemodel->modifyGrade($_POST["id"], $_POST["grade"],
				$_POST["level"]);
	}
	public function modifyClass(){
		echo $this->homemodel->modifyClass($_POST["id"], $_POST["grade"],
				$_POST["class"]);
	}
	public function modifySubject(){
		echo $this->homemodel->modifySubject($_POST["id"], $_POST["grade"],
				$_POST["subject"]);
	}
	public function modifyUser(){
		echo $this->homemodel->modifyUser($_POST["id"], $_POST["username"],
				$_POST["password"], $_POST["name"],
				$_POST["role"], $_POST["active"]);
	}
	public function modifyPermissions(){
		echo $this->homemodel->modifyPermissions($_POST["id"],
				$_POST["username"],	$_POST["permissions"]);
	}
	public function modifyDef(){
		echo $this->homemodel->modifyDef($_POST["id"], $_POST["username"],
				$_POST["number"], $_POST["email"]);
	}
	public function modifyNotify(){
		echo $this->homemodel->modifyUser($_POST["id"], $_POST["username"],
				$_POST["number"], $_POST["email"],
				$_POST["datetime"], $_POST["message"]);
	}
	public function modifyNoteType(){
		echo $this->homemodel->modifyNoteType($_POST["id"], $_POST["type"],
				$_POST["body"]);
	}
	public function modifyReady(){
		echo $this->homemodel->modifyReady($_POST["id"], $_POST["message"]);
	}
	public function modifyMorning(){
		echo $this->homemodel->modifyMorning($_POST["id"], $_POST["student"],
				$_POST["datetime"]);
	}
	public function modifyStudent(){
		echo $this->homemodel->modifyStudent($_POST["id"], $_POST["username"],
				$_POST["fullname"], $_POST["class"],
				$_POST["idnum"]);
	}
	public function modifyRole(){
		echo $this->homemodel->modifyRole($_POST["id"], $_POST["role"]);
	}
	public function modifySettings(){
		echo $this->homemodel->modifySettings($_POST["id"],
				$_POST["smsusername"], $_POST["smspassword"],
				$_POST["year"],	$_POST["semester"]);
	}
	public function modifyNote(){
		echo $this->homemodel->modifyNote($_POST["id"], $_POST["type"],
				$_POST["student"], $_POST["subject"],
				$_POST["note"],$_POST["status"], $_POST["datetime"],
				$_POST["sold"],$_POST["agreed"], $_POST["username"]);
	}




}
