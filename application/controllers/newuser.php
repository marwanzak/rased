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
		$cap=$this->usermodel->createCaptcha();
		$data["captcha_image"]=$cap["image"];
		$data+=array("username"=>"","name"=>"",
				"number1"=>"","number2"=>"",
				"email1"=>"","email2"=>""
		);
		$this->session->set_userdata(array("captcha_word"=>$cap["word"]));
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
		$cap=$this->usermodel->createCaptcha();
		$data["captcha_image"]=$cap["image"];
		$data["idnum"]=$_POST["idnum"];
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('matches', lang("not_match"));
		$this->form_validation->set_message('valid_email', lang("valid_email"));
		$this->form_validation->set_message('min_length', " 5 %s ".lang("min_length"));
		$this->form_validation->set_message('numeric', lang("numeric"));
		$this->form_validation->set_rules('username', lang("enter_username"), 'required|min_length[5]|is_unique[users.username]');
		$this->form_validation->set_rules('password', lang("enter_password"), 'required|matches[repassword]|min_length[5]');
		$this->form_validation->set_rules('repassword', lang("enter_repassword"), 'required');
		$this->form_validation->set_rules('email1', lang('enter_email'), 'required|valid_email|is_unique[defaultnumemail.email1]');
		$this->form_validation->set_rules('number1', lang('enter_number'), 'required|is_unique[defaultnumemail.number1]|numeric');
		$this->form_validation->set_rules('name', lang('enter_name'), 'required');
		$this->form_validation->set_rules('captcha', lang('enter_captcha'), 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$data["msg"]="-1";
			$this->load->view('newuser',$data);
		}
		else
		{
			$this->usermodel->insertUser(array(
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
		/*
		$captcha1=$this->session->userdata("captcha_word");

		$this->session->set_userdata(array("captcha_word"=>$cap["word"]));
		$data["username"]="";
		$data["name"]="";
		$data["number1"]="";
		$data["number2"]="";
		$data["email2"]="";
		$data["email1"]="";
		if($_POST!=null){
			$data["username"]=$_POST["username"];
			$data["name"]=$_POST["name"];
			$data["number1"]=$_POST["number1"];
			$data["number2"]=$_POST["number2"];
			$data["email2"]=$_POST["email2"];
			$data["email1"]=$_POST["email1"];
			$msg = "";
			if($_POST["username"]=="") $msg.=lang("enter_username")."</br>";
			if($_POST["password"]=="") $msg.=lang("enter_password")."</br>";
			if($_POST["name"]=="") $msg.=lang("enter_name")."</br>";
			if($_POST["number1"]=="") $msg.=lang("enter_number")."</br>";
			if($_POST["captcha"]=="") $msg.=lang("enter_captcha")."</br>";
			$user="";
			if($_POST["username"]=="" || $_POST["password"]=="" || $_POST["name"]=="" || $_POST["number1"]==""||$_POST["captcha"]==""){
				$data["idnum"]=$_POST["idnum"];
				$data["message"]=$msg;
				$data["msg"] = "-1";
				$this->load->view("newuser",$data);
			} else{
				$query = $this->homemodel->getUserByUsername($_POST["username"]);
				if($_POST["captcha"]!=$captcha1){
					$data["idnum"]=$_POST["idnum"];
					$msg.=lang('captcha_error');
					$data["message"]=$msg;
					$data["msg"] = "-1";
					$this->load->view("newuser",$data);
				}
				elseif($query==0){
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
		*/
	}

	//forget password
	public function forgetPassword(){
		$data=array();
		if($_POST){
			if($_POST["content"]=="" || $_POST["method"]==""){
				$data["msg"]=lang("choose_entries");
			}else{
				$forget = $this->usermodel->forgetPassword($_POST["method"], $_POST["content"]);
				if($forget["check"]){
					$data["msg"] = lang("enter_code");
					$data["check"] = $forget["check"];
					$data["user"] =  $forget["user"];
					$this->load->view("forgetpassword", $data);
				}else{
					$data["msg"] = lang("invalid_entries");
					$data["check"] = $forget["check"];
					$this->load->view("forgetpassword", $data);
				}
			}
		}else{
			$data["check"] = 0;
			$this->load->view("forgetpassword",$data);
		}

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

	public function newPassword(){
		if($_POST){
			$req = $this->usermodel->newPassword($_POST["user"], $_POST["code"]);
			if($req){
				$data["msg"] = lang("password_changed");
				$data["color"] = "note-success";
				$this->load->view("userlogin",$data);
			}else{
				$data["user"]=$_POST["user"];
				$data["check"] = true;
				$this->load->view("forgetpassword",$data);
			}
		}
	}


	public function test(){
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('myform');
		}
		else
		{
			$this->load->view('formsuccess');
		}
	}
}