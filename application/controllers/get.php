<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class get extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
	public function getLevel(){
		echo $this->homemodel->getLevel($_POST["id"]);
	}
	public function getAllLevel(){
		echo $this->homemodel->getAllLevel();
	}
	public function getGrade(){
		echo $this->homemodel->getGrade($_POST["id"]);
	}
	public function getAllGrade(){
		echo $this->homemodel->getAllGrade();
	}
	public function getClass(){
		echo $this->homemodel->getClass($_POST["id"]);
	}
	public function getAllClass(){
		echo $this->homemodel->getAllClass();
	}
	public function getSubject(){
		echo $this->homemodel->getSubject($_POST["id"]);
	}
	public function getAllSubject(){
		echo $this->homemodel->getAllSubject();
	}
	public function getUser(){
		echo $this->homemodel->getUser($_POST["id"]);
	}
	public function getAllUser(){
		echo $this->homemodel->getAllUser();
	}
	public function getPermissions(){
		echo $this->homemodel->getPermissions($_POST["id"]);
	}
	public function getAllPermissions(){
		echo $this->homemodel->getAllPermissions();
	}
	public function getDef(){
		echo $this->homemodel->getDef($_POST["id"]);
	}
	public function getAllDef(){
		echo $this->homemodel->getAllDef();
	}
	public function getNotify(){
		echo $this->homemodel->getNotify($_POST["id"]);
	}
	public function getAllNotify(){
		echo $this->homemodel->getAllNotify();
	}
	public function getNoteType(){
		echo $this->homemodel->getNoteType($_POST["id"]);
	}
	public function getAllNoteType(){
		echo $this->homemodel->getAllNoteType();
	}
	public function getReady(){
		echo $this->homemodel->getReady($_POST["id"]);
	}
	public function getAllReady(){
		echo $this->homemodel->getAllReady();
	}
	public function getMorning(){
		echo $this->homemodel->getMorning($_POST["id"]);
	}
	public function getAllMorning(){
		echo $this->homemodel->getAllMorning();
	}
	public function getStudent(){
		echo $this->homemodel->getStudent($_POST["id"]);
	}
	public function getAllStudent(){
		echo $this->homemodel->getAllStudent();
	}
	public function getRole(){
		echo $this->homemodel->getRole($_POST["id"]);
	}
	public function getAllRole(){
		echo $this->homemodel->getAllRole();
	}
	public function getAllAction(){
		echo $this->homemodel->getAllAction();
	}
	public function getSettings(){
		echo $this->homemodel->getSettings();
	}
	public function getNote(){
		echo $this->homemodel->getNote($_POST["id"]);
	}
	public function getAllNote(){
		echo $this->homemodel->getAllNote();
	}
}
