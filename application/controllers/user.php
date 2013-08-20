<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->lang->load("arabic", "arabic");
	}
	public function index(){
		$user = $this->homemodel->getUser($this->session->userdata("id"));
		$data["activated"]=$user->activated;
		$data["students"]= $this->usermodel->getUserStudents($this->session->userdata("id"));
		$this->load->view("user",$data);
	}

	//check login validation username and password
	private function check_isvalidated(){
		if(! $this->session->userdata('validated')){
			redirect(base_url().'userlogin');
		}
	}

	//log out when user name press logout
	public function do_logout(){
		$this->session->sess_destroy();
		redirect(base_url().'userlogin');
	}

	//change password
	public function changePassword(){
		$msg="";
		$data=array();
		if($this->session->userdata("id")){
			$user = $this->homemodel->getUser($this->session->userdata("id"));
			$def = $this->usermodel->getUserDef();
			$data["username"] = $user->username;
			$data["name"] = $user->name;
			$data["number1"] = $def->number1;
			$data["number2"] = $def->number2;
			$data["email2"] = $def->email2;
			$data["email1"] = $def->email1;
		}
		if($_POST){
			if($_POST["password"]==""){
				$msg=lang("enter_password");
				$data["msg"]="-1";
				$data["message"]=$msg;
				$this->load->view("user_profile",$data);
			}else{
				$user = $this->session->userdata("id");
				$this->db->where("id",$user);
				$salt=rand();
				$password = crypt($_POST["password"],$salt);
				$this->db->update("users", array("password"=>$password, "salt" => $salt));
				$msg=lang("success");
				$data["msg"]="1";
				$data["message"]=$msg;
				$this->load->view("user_profile",$data);
			}
		}

	}

	//change profile
	public function changeProfile(){
		$data=array("msg" =>"", "message" => "");
		$msg = "";
		if($_POST){
			if($_POST["username"]=="") $msg.=lang("enter_username")."</br>";
			if($_POST["name"]=="") $msg.=lang("enter_name")."</br>";
			if($_POST["number1"]=="") $msg.=lang("enter_number")."</br>";
			if($_POST["username"]=="" || $_POST["name"]=="" || $_POST["number1"]==""){
				$data["message"]=$msg;
				$data["msg"] = "-1";
			}else{
				$query = $this->usermodel->checkUserExist($_POST["username"]);
				if($query==0){
					$data["msg"]="-1";
					$msg.=lang("user_exist");
					$data["message"] = $msg;
				}else{
					$this->usermodel->modifyUser(
							array(
									"username" => $_POST["username"],
									"name" => $_POST["name"]),array(
											"number1" => $_POST["number1"],
											"number2" => $_POST["number2"],
											"email1" => $_POST["email1"],
											"email2" => $_POST["email2"]
									));
					$data["msg"]="1";
					$data["message"]=lang("success");
				}
			}
		}
		$user = $this->homemodel->getUser($this->session->userdata("id"));
		$def = $this->usermodel->getUserDef();
		$data["username"] = $user->username;
		$data["name"] = $user->name;
		$data["number1"] = $def->number1;
		$data["number2"] = $def->number2;
		$data["email2"] = $def->email2;
		$data["email1"] = $def->email1;
		$this->load->view("user_profile",$data);
	}

	//show form for user to submit
	public function showForm(){
		$msg="";
		if($_POST){
			if($_POST["student"]==""){
				$msg.=lang("choose_student")."</br>";
			}else{
				switch($_POST["type"]){
					case "0":
						if($_POST["abreason"]==""){
							$msg.=lang("choose_abreason")."</br>";
						}else{
							$this->usermodel->insertForm(array(
									"type"=>0,
									"student"=>$_POST["student"],
									"abday"=>$_POST["abday"],
									"abreason"=>$_POST["abreason"]
							));
							$msg=lang("success");
						}
						break;
					case "1":
						if($_POST["perreason"]==""){
							$msg.=lang("choose_perreason")."</br>";
						}else{
							$this->usermodel->insertForm(array(
									"type"=>1,
									"student"=>$_POST["student"],
									"abday"=>$_POST["perout"],
									"abreason"=>$_POST["perreason"]
							));
							$msg=lang("success");
						}
						break;
					case "2":
						if($_POST["to"]==""){
							$msg.=lang("choose_to")."</br>";
						}else{
							$this->usermodel->insertForm(array(
									"type"=>2,
									"student"=>$_POST["student"],
									"abday"=>$_POST["iddate"],
									"abreason"=>$_POST["to"]
							));
							$msg=lang("success");
						}
						break;
					case "3":
						$msg.=($_POST["disfrom"]=="")?lang("choose_dis_from")."</br>":"";
						$msg.=($_POST["disto"]=="")?lang("choose_dis_to")."</br>":"";
						if($_POST["disfrom"]!=""&&$_POST["disto"]!=""){
							$this->usermodel->insertForm(array(
									"type"=>3,
									"student"=>$_POST["student"],
									"abday"=>$_POST["disform"],
									"abreason"=>$_POST["disto"]
							));
							$msg=lang("success");
							break;
						}
				}
			}
		}
		$form = $this->usermodel->getReasons();
		$students = $this->usermodel->getUserStudents($this->session->userdata("id"));
		$monthes=$this->homemodel->getMonthes();
		$days=$this->homemodel->getDays();
		$data = array("forms" => $form, "students" => $students, "monthes"=>$monthes, "days"=>$days);
		$data["msg"]=$msg;
		$this->load->view("forms", $data);
	}

	//edit students for user
	public function editStudents(){
		$students = $this->usermodel->getUserStudents($this->session->userdata("id"));
		$this->homemodel->array_print($students);
	}

	//delete user student
	public function deleteUserStudent(){
		if($_POST){
			$this->db->where("id",$_POST["student"]);
			echo $this->db->update("students",array("username"=>0));
		}
		echo false;
	}

	//add user student
	public function addUserStudent(){
		if($_POST!=NULL){
			$this->db->where("idnum",$_POST["idnum"]);
			echo $this->db->update("students", array("username" => $this->session->userdata("id")));
		}
		echo false;
	}

	//check student idnum exist
	public function checkIdnumExist(){
		if($_POST!=null){
			echo $this->usermodel->checkIdnumExist($_POST["idnum"]);
		}
		echo false;
	}

	//get student notes
	public function showStudentNotes(){
		if($_POST!=null){
			$notes = $this->usermodel->getStudentNotes($_POST["student_id"]);
			if($notes!=false)
				$data["notes"] = $notes;
			else
				$data["notes"] = false;
			$this->load->view("student_notes", $data);
		}else return false;
	}

}