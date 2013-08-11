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
						'validated' => true,
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
		return $query->num_rows();
	}
	
	//insert new user
	public function insertUser($atts=array()){
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
				"name" => $atts["name"]
				));
		$user_id = $this->db->insert_id();
		$this->db->insert("defaultnumemail", array(
				"username" => $user_id,
				"email1" => $atts["email1"],
				"email2" => $atts["email2"],
				"number1" => $atts["number1"],
				"number2" => $atts["number2"]
				));
		return $query;
	}
}