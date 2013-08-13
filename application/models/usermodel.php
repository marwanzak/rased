<?php
class userModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
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
		return ($query->num_rows()>0)? true:false;
		if($query->num_rows()>0){

		}else{

		}
	}

	//check user by username
	public function checkUsername($username){
		$query = $this->db->get_where("users", array("username" => $username));
		return ($query->num_rows()>0)?true:false;
	}

	//forget password check
	public function forgetPassword($method, $content){
		$check=0;
		$number=0;
		if($method=="number"){
			$check = $this->checkNumber($content);
			$number=$content;
		}elseif($method=="username"){
			$check = $this->checkUser($content);
			if($check==1){
				$query = $this->db->get_where("users", array("username" => $content));
				$user = $query->row();
				$query = $this->db->get_where("defaultnumemail", array("username" => $user->username));
				$def = $query->row();
				$number = $def->number1;
			}
		}
		if($check==1){
			$code=rand();
			$this->smsmodel->sendSmsNow(array(
					"username" => $set->smsusername,
					"password" => $this->homemodel->dePassword($set->smspassword,$set->smssalt),
					"sender" => $set->sendername,
					"number" => $number,
					"message" => $code
			));
			return true;
		}else{
			return false;
		}

	}

}