<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class newUser extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->lang->load("arabic", "arabic");

	}

	public function index(){

	}

	//check idnum in new user creating
	public function checkIdnum(){
		$ver = $this->usermodel->getStudentByIdnum($_POST["idnum"]);
		if($ver==0){
			$data["msg"] = lang("no_idnum");
			$this->load->view("userlogin",$data);
		}else{
			$data["idnum"]=$_POST["idnum"];
			$data["msg"]="";
			$this->load->view("newuser",$data);
		}
	}


	//create new user
	public function newUser(){
		if($_POST!=null){
			$msg = "";
			if($_POST["username"]=="") $msg.=lang("enter_username")."</br>";
			if($_POST["password"]=="") $msg.=lang("enter_password")."</br>";
			if($_POST["name"]=="") $msg.=lang("enter_name")."</br>";
			$user="";
			if($_POST["username"]!=""){
				$query = $this->homemodel->getUserByUsername($_POST["username"]);
				if($query==0){
					$data["idnum"]=$_POST["idnum"];
					$data["msg"]="-1";
					$msg.=lang("user_exist");
					$data["message"] = $msg;
					$this->load->view("newuser",$data);
				}
			}
			elseif($_POST["username"]=="" || $_POST["password"]=="" || $_POST["name"]==""){
				$data["idnum"]=$_POST["idnum"];
				$data["message"]=$msg;
				$data["msg"] = "-1";
				$this->load->view("newuser",$data);
					
				$query = $this->usermodel->insertUser(array(
						"username" => $_POST["username"],
						"password" => $_POST["password"],
						"name" => $_POST["name"],
						"email1" => $_POST["email1"],
						"email2" => $_POST["email2"],
						"number1" => $_POST["number1"],
						"number2" => $_POST["number2"],
				));
			}
			$data["color"]="note-success";
			$data["msg"] = lang("success");
			$this->load->view("userlogin",$data);
		}
	}
}