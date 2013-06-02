<?php
class homeModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	//insert level
	public function insertlevel($level){
		return $this->db->insert("levels", array(
				"level" => $level
		));
	}
	//modify level
	public function modifyLevel($id,$level){
		$this->db->where("id",$id);
		return $this->db->update("levels", array(
				"level" => $level
		));
	}
	//get level by id.
	public function getLevel($id){
		$query = $this->db->get("levels", array("id"=>$id));
		return $query->row();
	}
	//get all levels.
	public function getAllLevel(){
		$query = $this->db->get("levels");
		return $query->result();
	}
	//insert grade
	public function insertGrade($grade,$level){
		return $this->db->insert("grades", array(
				"level" => $level,
				"grade" => $grade
		));
	}
	//modify grade.
	public function modifyGrade($id,$grade,$level){
		$this->db->where("id",$id);
		return $this->db->update("grades", array(
				"grade" => $grade,
				"level" => $level
		));
	}
	//get grade by id.
	public function getGrade($id){
		$query = $this->db->get("grades", array("id"=>$id));
		return $query->row();
	}
	//get all grades.
	public function getAllGrade(){
		$query = $this->db->get("grades");
		return $query->result();
	}
	//insert class
	public function insertClass($grade,$class){
		return $this->db->insert("classes", array(
				"class" => $class,
				"grade" => $grade
		));
	}
	//modify class.
	public function modifyClass($id,$grade,$class){
		$this->db->where("id",$id);
		return $this->db->update("classes", array(
				"grade" => $grade,
				"class" => $class
		));
	}
	//get class by id.
	public function getClass($id){
		$query = $this->db->get("classes", array("id"=>$id));
		return $query->row();
	}
	//get all classes.
	public function getAllClass(){
		$query = $this->db->get("classes");
		return $query->result();
	}
	//insert subject
	public function insertSubject($grade,$subject){
		return $this->db->insert("subjects", array(
				"subject" => $subject,
				"grade" => $grade
		));
	}
	//modify subject.
	public function modifySubject($id,$grade,$subject){
		$this->db->where("id",$id);
		return $this->db->update("subjects", array(
				"grade" => $grade,
				"subject" => $subject
		));
	}
	//get subject by id.
	public function getSubject($id){
		$query = $this->db->get("subjects", array("id"=>$id));
		return $query->row();
	}
	//get all subjects.
	public function getAllSubject(){
		$query = $this->db->get("subjects");
		return $query->result();
	}

	//insert user
	public function insertUser($username,$password, $salt, $name, $role, $active, $code){
		return $this->db->insert("users", array(
				"username" => $username,
				"password" => $password,
				"name" => $name,
				"role" => $role,
				"active" => $active,
				"code" => $code,
				"salt" => $salt
		));
	}
	//modify user.
	public function modifyUser($id,$username,$password, $name, $role){
		$this->db->where("id",$id);
		return $this->db->update("users", array(
				"username" => $username,
				"password" => $password,
				"name" => $name,
				"role" => $role
		));
	}
	//get user by id.
	public function getUser($id){
		$query = $this->db->get("users", array("id"=>$id));
		return $query->row();
	}
	//get all users.
	public function getAllUser(){
		$query = $this->db->get("users");
		return $query->result();
	}
	//insert permissions
	public function insertPermissions($username,$permissions){
		return $this->db->insert("permissions", array(
				"username" => $username,
				"permissions" => $permissions
		));
	}
	//modify permissions.
	public function modifyPermissions($id,$username,$permissions){
		$this->db->where("id",$id);
		return $this->db->update("permissions", array(
				"username" => $username,
				"permissions" => $permissions
		));
	}
	//get permissions by id.
	public function getPermissions($id){
		$query = $this->db->get("permissions", array("id"=>$id));
		return $query->row();
	}
	//get all permissions.
	public function getAllPermissions(){
		$query = $this->db->get("permissions");
		return $query->result();
	}
	//insert default numbers and emails
	public function insertDef($username,$number,$email){
		return $this->db->insert("defaultnumemail", array(
				"username" => $username,
				"number" => $number,
				"email" => $email
		));
	}
	//modify default numbers and mails.
	public function modifyDef($id,$username,$number, $email){
		$this->db->where("id",$id);
		return $this->db->update("defaultnumemail", array(
				"username" => $username,
				"number" => $number,
				"email" => $email
		));
	}
	//get defaults by id.
	public function getDef($id){
		$query = $this->db->get("defaultnumemail", array("id"=>$id));
		return $query->row();
	}
	//get all defaults.
	public function getAllDef(){
		$query = $this->db->get("defaultnumemail");
		return $query->result();
	}
	//insert notify report
	public function insertNotify($username,$numbers,$emails,$datetime,$message){
		return $this->db->insert("notifyreport", array(
				"username" => $username,
				"numbers" => $numbers,
				"emails" => $emails,
				"datetime" => $datetime,
				"message" => $message
		));
	}
	//modify notify report.
	public function modifyNotify($id,$username,$numbers, $emails, $datetime, $message){
		$this->db->where("id",$id);
		return $this->db->update("notifyreport", array(
				"username" => $username,
				"numbers" => $numbers,
				"emails" => $emails,
				"datetime" => $datetime,
				"message" => $message
		));
	}
	//get notify report by id.
	public function getNotify($id){
		$query = $this->db->get("notifyreport", array("id"=>$id));
		return $query->row();
	}
	//get all defaults.
	public function getAllNotify(){
		$query = $this->db->get("notifyreport");
		return $query->result();
	}
	//insert notes type
	public function insertNoteType($type,$body){
		return $this->db->insert("notestypes", array(
				"type" => $type,
				"body" => $body
		));
	}
	//modify note type.
	public function modifyNoteType($id,$type, $body){
		$this->db->where("id",$id);
		return $this->db->update("notestypes", array(
				"type" => $type,
				"body" => $body
		));
	}
	//get note type by id.
	public function getNoteType($id){
		$query = $this->db->get("notestypes", array("id"=>$id));
		return $query->row();
	}
	//get all Notes types.
	public function getAllNoteType(){
		$query = $this->db->get("notestypes");
		return $query->result();
	}
	//insert ready message
	public function insertReady($message){
		return $this->db->insert("readymessages", array(
				"message" => $message
		));
	}
	//modify ready message.
	public function modifyReady($id,$message){
		$this->db->where("id",$id);
		return $this->db->update("readymessages", array(
				"message" => $message
		));
	}
	//get ready message by id.
	public function getReady($id){
		$query = $this->db->get("readymessages", array("id"=>$id));
		return $query->row();
	}
	//get all ready messages.
	public function getAllReady(){
		$query = $this->db->get("readymessages");
		return $query->result();
	}
	//insert morning appearance.
	public function insertMorning($student, $datetime){
		return $this->db->insert("morning", array(
				"student" => $student,
				"datetime" => $datetime
		));
	}
	//modify morning appearance.
	public function modifyMorning($id,$student, $datetime){
		$this->db->where("id",$id);
		return $this->db->update("morning", array(
				"student" => $student,
				"datetime" => $datetime
		));
	}
	//get morning appearance by id.
	public function getMorning($id){
		$query = $this->db->get("morning", array("id"=>$id));
		return $query->row();
	}
	//get all morning appearance.
	public function getAllMorning(){
		$query = $this->db->get("morning");
		return $query->result();
	}
	//insert student.
	public function insertStudent($username, $fullname, $class, $idnum){
		return $this->db->insert("students", array(
				"username" => $username,
				"fullname" => $fullname,
				"class" => $class,
				"idnum" => $idnum
		));
	}
	//modify student.
	public function modifyStudent($id, $username, $fullname, $class, $idnum){
		$this->db->where("id",$id);
		return $this->db->update("students", array(
				"username" => $username,
				"fullname" => $fullname,
				"class" => $class,
				"idnum" => $idnum
		));
	}
	//get student by id.
	public function getStudent($id){
		$query = $this->db->get("students", array("id"=>$id));
		return $query->row();
	}
	//get all students.
	public function getAllStudent(){
		$query = $this->db->get("students");
		return $query->result();
	}
	//insert role.
	public function insertRole($role){
		return $this->db->insert("roles", array(
				"role" => $role
		));
	}
	//modify Role.
	public function modifyRole($id, $role){
		$this->db->where("id",$id);
		return $this->db->update("role", array(
				"role" => $role
		));
	}
	//get role by id.
	public function getRole($id){
		$query = $this->db->get("roles", array("id"=>$id));
		return $query->row();
	}
	//get all roles.
	public function getAllRole(){
		$query = $this->db->get("roles");
		return $query->result();
	}
	//insert action.
	public function insertAction($username, $action, $datetime){
		return $this->db->insert("actions", array(
				"username" => $username,
				"action" => $action,
				"datetime" => $datetime
		));
	}
	//get all actions.
	public function getAllAction(){
		$query = $this->db->get("actions");
		return $query->result();
	}

	//insert sitesettings.
	public function insertSettings($smsusername, $smspassword, $year, $semester){
		$salt = rand();
		$password = $this->enPassword($smspassword,$salt);
		return $this->db->insert("sitesettings", array(
				"smsusername" => $smsusername,
				"smspassword" => $password,
				"smssalt" => $salt,
				"year" => $year,
				"semester" => $semester
		));
	}
	//modify sitesettings.
	public function modifySettings($id, $smsusername, $smspassword,
			 $year, $semester){
		$salt = rand();
		$password = $this->enPassword($smspassword,$salt);
		$this->db->where("id",$id);
		return $this->db->update("sitesettings", array(
				"smsusername" => $smsusername,
				"smspassword" => $password,
				"smssalt" => $salt,
				"year" => $year,
				"semester" => $semester
		));
	}
	//get sitesettings by id.
	public function getSettings(){
		$query = $this->db->get("sitesettings");
		return $query->row();
	}
	//insert note.
	public function insertNote($type, $student, $subject, $note, $status,
			 $datetime, $semester, $sold, $agreed, $username, $year){
		return $this->db->insert("notes", array(
				"type" 		=> $type,
				"student" 	=> $sudent,
				"subject" 	=> $subject,
				"note" 		=> $note,
				"status" 	=> $status,
				"datetime" 	=> $datetime,
				"semester" 	=> $semester,
				"sold"		=> $sold,
				"agreed" 	=> $agreed,
				"username" 	=> $username,
				"year" 		=> $year
		));
	}
	//modify note.
	public function modifyNote($id, $type, $student, $subject, $note, $status,
			 $datetime, $semester, $sold, $agreed, $username, $year){
		$this->db->where("id",$id);
		return $this->db->update("role", array(
				"type" 		=> $type,
				"student" 	=> $sudent,
				"subject" 	=> $subject,
				"note" 		=> $note,
				"status" 	=> $status,
				"datetime" 	=> $datetime,
				"semester" 	=> $semester,
				"sold"		=> $sold,
				"agreed" 	=> $agreed,
				"username" 	=> $username,
				"year" 		=> $year
		));
	}
	//get note by id.
	public function getNote($id){
		$query = $this->db->get("notes", array("id"=>$id));
		return $query->row();
	}
	//get all notes.
	public function getAllNote(){
		$query = $this->db->get("notes");
		return $query->result();
	}
	//decode two ways password using pass with salt.
	public function dePassword($password, $salt)
	{
		return rtrim(mcrypt_decrypt(
				MCRYPT_RIJNDAEL_256,
				md5($salt),
				base64_decode($password),
				MCRYPT_MODE_CBC,
				md5(md5($salt))), "\0");
	
	}
	//encode two ways password using pass with salt.
	public function enPassword($password, $salt)
	{
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,
				md5($salt), $password,
				MCRYPT_MODE_CBC, md5(md5($salt))));
	}

	//Good array print function!
	public function array_print($array = array()){
		print "<pre>";
		var_dump($array);
		print "</pre>";
	}
}