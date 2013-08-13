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
		if(isset($ver->username) && $ver->username!=0){
			$data["msg"] = lang("student_token");
			$data["color"] = "note-danger";
			$this->load->view("userlogin",$data);
		}elseif(!isset($ver->username) && $ver==0){
			$data["msg"] = lang("no_idnum");
			$data["color"] = "note-danger";
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
			if($_POST["number1"]=="") $msg.=lang("enter_number")."</br>";
			$user="";
			if($_POST["username"]=="" || $_POST["password"]=="" || $_POST["name"]=="" || $_POST["number1"]==""){
				$data["idnum"]=$_POST["idnum"];
				$data["message"]=$msg;
				$data["msg"] = "-1";
				$this->load->view("newuser",$data);
			} else{
				$query = $this->homemodel->getUserByUsername($_POST["username"]);
				if($query==0){
					$data["idnum"]=$_POST["idnum"];
					$data["msg"]="-1";
					$msg.=lang("user_exist");
					$data["message"] = $msg;
					$this->load->view("newuser",$data);
				}else{
					$query = $this->usermodel->insertUser(array(
							"username" => $_POST["username"],
							"password" => $_POST["password"],
							"name" => $_POST["name"],
							"email1" => $_POST["email1"],
							"email2" => $_POST["email2"],
							"number1" => $_POST["number1"],
							"number2" => $_POST["number2"],
							"idnum" => $_POST["idnum"]
					));
						
						
					$data["color"]="note-success";
					$data["msg"] = lang("success");
					$this->load->view("userlogin",$data);
				}
			}
		}
	}
	
	//forget password
	public function forgetPassword(){
		$data=array();
		if($_POST){
			$forget = $this->usermodel->forgetPassword($_POST["method"], $_POST["content"]);
			$data["check"] = $forget;
		}
		$this->load->view("forgetpassword", $data);
	}

	//check mobile code and activate user
	public function checkCode(){
		$active = $this->usermodel->checkCode($_POST["code"]);
		if($active){
			$this->usermodel->activateUser();
		}else{
			$this->session->set_userdata(array("msg"=>lang("code_error")));
		}
		redirect(base_url()."userlogin");
	}

	public function insertUser(){

	}
}