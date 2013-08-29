<?php
class userModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("captcha");
	}

	//create captcha
	public function createCaptcha(){
		$atts=array("img_path"=>"./captcha/","img_url"=>"http://localhost/rased/captcha/","word"=>rand());
		return create_captcha($atts);
	}

	public function validate(){
		// grab user input
		$username = $this->security->xss_clean($this->input->post('username'));
		$pass = $this->security->xss_clean($this->input->post('password'));
		// Prep the query
		$this->db->where('username', $username);

		// Run the query
		$query = $this->db->get('users');
		// Let's check if there are any results
		if($query->num_rows == 1)
		{
			// If there is a user, then create session data
			$row = $query->row();
			//get permissions of user
			$query = $this->db->get_where("permissions", array("role" => $row->role));
			$permissions=$query->row();
			if($permissions->admin_login=="1")
				exit("no_permissions");

			$new_pass = crypt($pass,$row->salt);
			if($new_pass == $row->password)
			{
				$role = $this->homemodel->getRole($row->role);
				$data = array(
						'id' => $row->id,
						'name' => $row->name,
						'username' => $row->username,
						'role' => $role->role,
						'validated' => true
				);
				$this->session->set_userdata($data);
				return true;
			}
		}
		// If the previous process did not validate
		// then return false.
		return false;
	}

	//get student by idnum
	public function getStudentByIdnum($idnum){
		$query = $this->db->get_where("students", array("idnum" => $idnum));
		if($query->num_rows()>0)
			return $query->row();
		return $query->num_rows();
	}

	//modify student user
	public function modifyStudentUser($idnum, $username){
		$this->db->where("idnum", $idnum);
		return $this->db->update("students", array("username" => $username));
	}

	//insert new user
	public function insertUser($atts=array()){
		$set = $this->homemodel->getSettings();
		$salt = rand();
		$code = rand();
		$password = crypt($atts["password"],$salt);
		$query = $this->db->insert("users",array(
				"username" => $atts["username"],
				"password" => $password,
				"salt" => $salt,
				"code" => $code,
				"active" => "1",
				"role" => 11,
				"name" => $atts["name"],
				"activated" => ($set->mobileactivate==1)?0:1
		));
		$user_id = $this->db->insert_id();
		$this->db->insert("defaultnumemail", array(
				"username" => $user_id,
				"email1" => $atts["email1"],
				"email2" => $atts["email2"],
				"number1" => $atts["number1"],
				"number2" => $atts["number2"]
		));
		if($set->mobileactivate==1)
			$this->smsmodel->sendSmsNow(array(
					"username" => $set->smsusername,
					"password" => $this->homemodel->dePassword($set->smspassword,$set->smssalt),
					"sender" => $set->sendername,
					"number" => $atts["number1"],
					"message" => $code
			));

		$this->modifyStudentUser($atts["idnum"], $user_id);
		return $query;
	}

	//check mobile code
	public function checkCode($code){
		$query = $this->db->get_where("users",array("id"=>$this->session->userdata("id")));
		$user = $query->row();
		if($user->code!=$code)
			return false;
		return true;
	}

	//activate user by code
	public function activateUser(){
		$this->db->where("id",$this->session->userdata("id"));
		return $this->db->update("users", array("activated"=>1));
	}

	//check user by phone
	public function checkNumber($number){
		$this->db->where("number1",$number);
		$this->db->or_where("number2", $number);
		$query = $this->db->get("defaultnumemail");
		if($query->num_rows()>0){
			$def = $query->row();
			return array("userid" => $def->username, "number" => $def->number1);
		}else{
			return false;
		}
	}

	//check user by username
	public function checkUsername($username){
		$query = $this->db->get_where("users", array("username" => $username));
		if($query->num_rows()>0){
			$user = $query->row();
			$query = $this->db->get_where("defaultnumemail", array("username" => $user->id));
			$def = $query->row();
			return array("userid" => $user->id, "number" => $def->number1);
		}else{
			return false;
		}
	}

	//forget password check
	public function forgetPassword($method, $content){
		$data = array();
		$set = $this->homemodel->getSettings();
		$check;
		if($method=="number"){
			$check = $this->checkNumber($content);
			if(!$check)
				return array("check" => false);
		}elseif($method=="username"){
			$check = $this->checkUsername($content);
			if(!$check)
				return array("check" => false);
		}
		if(isset($check["userid"])){
			$code=rand();
			$this->db->where("id", $check["userid"]);
			$this->db->update("users", array("code" => $code));
			$this->smsmodel->sendSmsNow(array(
					"username" => $set->smsusername,
					"password" => $this->homemodel->dePassword($set->smspassword,$set->smssalt),
					"sender" => $set->sendername,
					"number" => $check["number"],
					"message" => $code
			));
			return array("check" => true, "user" => $check["userid"]);

		}
	}

	//create new password for user and send it to user mobile
	public function newPassword($user,$code){
		$set = $this->homemodel->getSettings();
		$user = $this->homemodel->getUser($user);
		if($user->code==$code){
			$query = $this->db->get_where("defaultnumemail", array("username" => $user->id));
			$salt=rand();
			$pass=rand();
			$password= crypt($pass,$salt);
			$this->db->where("username", $user->username);
			$this->db->update("users", array("password" => $password, "salt" => $salt));
			$msg=lang("username").": ".$user->username."\r\n".lang("password").": ".$pass;
			$def = $query->row();
			$this->smsmodel->sendSmsNow(array(
					"username" => $set->smsusername,
					"password" => $this->homemodel->dePassword($set->smspassword,$set->smssalt),
					"sender" => $set->sendername,
					"number" => $def->number1,
					"message" => $msg
			));
			return true;
		}else return false;

	}

	//public function get form reasons array
	public function getReasons(){
		return array(array("ab",lang("absence")),
				array("per",lang('per')),
				array("id",lang("student_id")),
				array("dis",lang('sa_dis')));
	}

	//get form reason inrespond to key
	public function getReason($key){
		$reasons = $this->getReasons();
		return $reason[$key][1];
	}

	//insert form
	public function insertForm($atts=array()){
		return $this->db->insert("forms",$atts);
	}

	//get form
	public function getForm($id){
		$query = $this->db->get_where("forms", array("id" => $id));
		return $query->row();
	}

	//get all forms
	public function getAllForm(){
		$query = $this->db->get("forms");
		return $query->result();
	}

	//agree form
	public function agreeForm($id){
		$form = $this->getForm($id);
		$this->db->where("id", $id);
		return $this->db->update("forms", array("agreed"=>!$form->agreed));
	}

	//get user students
	public function getUserStudents($user){
		$query = $this->db->get_where("students", array("username" => $user));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//modify user profile
	public function modifyUser($user=array(), $def=array()){
		$this->db->where("id",$this->session->userdata("id"));
		$this->db->update("users",$user);
		$this->db->where("username",$this->session->userdata("id"));
		$this->db->update("defaultnumemail",$def);
	}

	//check username
	public function checkUserExist($username){
		$query = $this->db->get_where("users",array("username" => $username));
		$user1=$this->homemodel->getUser($this->session->userdata("id"));
		if($query->num_rows()>0){
			$user = $query->row();
			if($user->username==$user1->username)
				return true;
			return false;
		}
		return true;
	}

	//get user default numbers and emails
	public function getUserDef(){
		$query = $this->db->get_where("defaultnumemail",
				array("username" => $this->session->userdata("id")));
		return $query->row();
	}

	//check student idnum exist
	public function checkIdnumExist($idnum){
		$this->db->where("idnum",$idnum);
		$query = $this->db->get("students");
		if($query->num_rows()>0){
			$student=$query->row();
			if($student->username!=0)
				return 2;
			return 1;
		}
		return 3;
	}

	//get student notes
	public function getStudentNotes($student_id){
		$query = $this->db->get_where("notes", array("student"=>$student_id));
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	//get class lessons
	public function getClassLessons($class){
		$query = $this->db->get_where("lessons", array("class"=>$class));
		if($query->num_rows()>0){
			return $query->result_array();
		}
		return false;
	}
	
	//get user inbox from admin
	public function getInbox($read=""){
		if($read=="")
		$query = $this->db->get_where("inbox",array("from"=>-1,"username"=>$this->session->userdata("id")));
		elseif($read=="unread")
		$query = $this->db->get_where("inbox", array("from"=>-1,"username"=>$this->session->userdata("id"),"read"=>0));
		if($query->num_rows>0)
			return $query->result();
		return false;	
	}
}