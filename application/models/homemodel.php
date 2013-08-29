<?php
class homeModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	//get students tree
	public function getStudentTree($student){
		$user = $this->session->userdata("id");
		$student_query = $this->db->get_where("students" ,array(
				"id" => $student
		));
		$student = $student_query->row();
		$class_query = $this->db->get_where("classes", array(
				"id" => $student->class
		));
		$class = $class_query->row();
		$grade_query = $this->db->get_where("grades", array(
				"id" => $class->grade
		));
		$grade = $grade_query->row();
		$level_query = $this->db->get_where("levels", array(
				"id" => $grade->level
		));
		$level = $level_query->row();
		$probs_query = $this->db->get_where("notesprob", array(
				"level" => $level->id
		));
		$probs = $probs_query->result();
		$subjects = $this->getUserClassSubjects($user, $class->id);
		return array(
				"id" => $student->id,
				"student" => $student->fullname,
				"level" => $level->id,
				"grade" => $grade->id,
				"class" => $class->id,
				"subjects" => $subjects,
				"probs" => $probs

		);

	}

	//get user by username
	public function getUserByUsername($username){
		$query = $this->db->get_where("users", array("username"=>$username));
		if($query->num_rows()>0)
			return false;
		return true;
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
			if($permissions->admin_login!="1")
				exit("no_permissions");

			$new_pass = crypt($pass,$row->salt);
			if($new_pass == $row->password)
			{
				$role = $this->getRole($row->role);
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

	//insert level
	public function insertLevel($level){
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
		$query = $this->db->get_where("levels", array("id"=>$id));
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
		$query = $this->db->get_where("grades", array("id"=>$id));
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
		$query = $this->db->get_where("classes", array("id"=>$id));
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
		$query = $this->db->get_where("subjects", array("id"=>$id));
		return $query->row();
	}
	//get all subjects.
	public function getAllSubject(){
		$query = $this->db->get("subjects");
		return $query->result();
	}

	//insert user
	public function insertUser($username,$pass, $name, $role, $active, $classes, $subjects){
		$salt = rand();
		$code = rand();
		$password = crypt($pass,$salt);
		return $this->db->insert("users", array(
				"username" => $username,
				"password" => $password,
				"name" => $name,
				"role" => $role,
				"active" => $active,
				"salt" => $salt,
				"subjects" => $subjects,
				"classes" => $classes
		));
	}
	//modify password for user.
	public function modifyPassword($id,$pass){
		$salt = rand();
		$password = crypt($pass,$salt);
		$this->db->where("id",$id);
		return $this->db->update("users", array(
				"password" =>$password,
				"salt" => $salt
		));
	}
	//modify user.
	public function modifyUser($id,$username, $name, $role, $active, $classes, $subjects){
		$this->db->where("id",$id);
		return $this->db->update("users", array(
				"username" => $username,
				"name" => $name,
				"role" => $role,
				"active" => $active,
				"classes" => $classes,
				"subjects" => $subjects
		));
	}
	//get user by id.
	public function getUser($id){
		$query = $this->db->get_where("users", array("id"=>$id));
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
	public function modifyPermissions($id, $atts = array()){
		$this->db->where("role",$id);
		return $this->db->update("permissions", $atts);
	}
	//get permissions by id.
	public function getPermissions($id){
		$query = $this->db->get_where("permissions", array("id"=>$id));
		return $query->row();
	}
	//get all permissions.
	public function getAllPermissions(){
		$query = $this->db->get("permissions");
		return $query->result();
	}

	//get user permissions
	public function getUserPermissions($id){
		$query = $this->db->get_where("users", array("id"=>$id));
		$user = $query->row();
		$query = $this->db->get_where("permissions", array("role" => $user->role));
		return $query->row();
	}

	//get sold by id
	public function getSold($id){
		$query = $this->db->get_where("solds", array("id" => $id));
		return $query->row();
	}

	//insert sold to database
	public function insertSold($sold){
		return $this->db->insert("solds", array(
				"sold" => $sold
		));
	}

	//modify sold
	public function modifySold($id, $sold){
		$this->db->where("id",$id);
		return $this->db->update("solds", array(
				"sold" => $sold
		));
	}


	//get all solds
	public function getAllSold(){
		$query = $this->db->get("solds");
		return $query->result();
	}
	//insert default numbers and emails
	public function insertDef($username,$number1,$number2,$email1,$email2){
		return $this->db->insert("defaultnumemail", array(
				"username" => $username,
				"email1" => $email1,
				"email2" => $email2,
				"number1" => $number1,
				"number2" => $number2
		));
	}
	//modify default numbers and mails.
	public function modifyDef($id,$username,$number1,$number2,$email1,$email2){
		$this->db->where("id",$id);
		return $this->db->update("defaultnumemail", array(
				"username" => $username,
				"email1" => $email1,
				"email2" => $email2,
				"number1" => $number1,
				"number2" => $number2
		));
	}
	//get defaults by id.
	public function getDef($id){
		$query = $this->db->get_where("defaultnumemail", array("id"=>$id));
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
		$query = $this->db->get_where("notifyreport", array("id"=>$id));
		return $query->row();
	}
	//get all defaults.
	public function getAllNotify(){
		$query = $this->db->get("notifyreport");
		return $query->result();
	}
	//insert notes type
	public function insertNoteType($prob,$sold,$body){
		return $this->db->insert("notestypes", array(
				"prob" => $prob,
				"body" => $body,
				"sold" => $sold
		));
	}
	//modify note type.
	public function modifyNoteType($id,$prob,$sold, $body){
		$this->db->where("id",$id);
		return $this->db->update("notestypes", array(
				"prob" => $prob,
				"body" => $body,
				"sold" => $sold
		));
	}
	//get note type by id.
	public function getNoteType($id,$name=""){
		$query = $this->db->get_where("notestypes", array("id"=>$id));
		$type = $query->row();
		if($name!="")
			return $type->type;
		else return $query->row();
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
		$query = $this->db->get_where("readymessages", array("id"=>$id));
		return $query->row();
	}
	//get all ready messages.
	public function getAllReady(){
		$query = $this->db->get("readymessages");
		return $query->result();
	}
	//insert note prob message
	public function insertProb($level,$prob,$color){
		return $this->db->insert("notesprob", array(
				"level" => $level,
				"prob" => $prob,
				"color" => $color
		));
	}
	//modify note prob message.
	public function modifyProb($id,$level, $prob, $color){
		$this->db->where("id",$id);
		return $this->db->update("notesprob", array(
				"level" => $level,
				"prob" => $prob,
				"color" => $color
		));
	}
	//get note prob by id.
	public function getProb($id,$name=""){
		if($id!=0){
			$query = $this->db->get_where("notesprob", array("id"=>$id));
			$prob = $query->row();
			if($name!="")
				return $prob->prob;
			else return $query->row();
		}else return false;
	}
	//get all notes probs.
	public function getAllProb(){
		$query = $this->db->get("notesprob");
		return $query->result();
	}
	//insert morning appearance.
	public function insertMorning($student, $time, $date){
		return $this->db->insert("morning", array(
				"student" => $student,
				"date" => $date,
				"time"=>$time
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
		$query = $this->db->get_where("morning", array("id"=>$id));
		return $query->row();
	}
	//get all morning appearance.
	public function getAllMorning(){
		$query = $this->db->get("morning");
		return $query->result();
	}
	//insert student.
	public function insertStudent($username, $fullname, $class, $idnum,$finger){
		return $this->db->insert("students", array(
				"username" => $username,
				"fullname" => $fullname,
				"class" => $class,
				"idnum" => $idnum,
				"fingerprint"=>$finger
		));
	}
	//modify student.
	public function modifyStudent($id, $username, $fullname, $class, $idnum,$finger){
		$this->db->where("id",$id);
		return $this->db->update("students", array(
				"username" => $username,
				"fullname" => $fullname,
				"class" => $class,
				"idnum" => $idnum,
				"fingerprint"=>$finger
		));
	}

	//get student by id.
	public function getStudent($id){
		$query = $this->db->get_where("students", array("id"=>$id));
		return $query->row();
	}
	//get all students.
	public function getAllStudent(){
		$query = $this->db->get("students");
		return $query->result();
	}
	//insert role.
	public function insertRole($role){
		$query = $this->db->insert("roles", array(
				"role" => $role
		));
		return $this->db->insert_id();
	}
	//modify Role.
	public function modifyRole($id, $role){
		$this->db->where("id",$id);
		return $this->db->update("roles", array(
				"role" => $role
		));
	}
	//get role by id.
	public function getRole($id){
		$query = $this->db->get_where("roles", array("id"=>$id));
		return $query->row();
	}
	//get all roles.
	public function getAllRole(){
		$query = $this->db->get("roles");
		return $query->result();
	}
	//insert action.
	public function insertAction($username, $action, $type){
		$datetime = $this->getTimeDate();
		return $this->db->insert("actions", array(
				"username" => $username,
				"action" => $action,
				"datetime" => $datetime,
				"type" => $type
		));
	}
	//get all actions.
	public function getAllAction(){
		$query = $this->db->get("actions");
		return $query->result();
	}

	//insert sitesettings.
	public function insertSettings($smsusername, $smspassword, $year, $semester,$sender,$mobileactivate,$morning,$user_lessons){
		$this->db->empty_table("sitesettings");
		$salt = rand();
		$password = $this->enPassword($smspassword,$salt);
		return $this->db->insert("sitesettings", array(
				"smsusername" => $smsusername,
				"smspassword" => $password,
				"smssalt" => $salt,
				"date" => $year,
				"semester" => $semester,
				"sendername" => $sender,
				"mobileactivate" => $mobileactivate,
				"morning"=>$morning,
				"user_lessons"=>$user_lessons
		));
	}
	//modify sitesettings.
	public function modifySettings($id, $smsusername, $smspassword,
			$year, $semester,$morning){
		$salt = rand();
		$password = $this->enPassword($smspassword,$salt);
		$this->db->where("id",$id);
		return $this->db->update("sitesettings", array(
				"smsusername" => $smsusername,
				"smspassword" => $password,
				"smssalt" => $salt,
				"year" => $year,
				"semester" => $semester,
				"morning"=>$morning
		));
	}
	//get sitesettings
	public function getSettings(){
		$query = $this->db->get("sitesettings");
		if($query->num_rows()>0)
			return $query->row();
		return false;
	}

	//insert note.
	public function insertNote($type, $student, $subject, $note, $status,
			$day,$month,$prob, $agreed, $prio){
		$set = $this->getSettings();
		$type_sold="";
		$student1 = $this->getStudent($student);
		if($type!=""){
			$type_sold = $this->getNoteType($type);
			$type_sold= $type_sold->sold;
		}
		return $this->db->insert("notes", array(
				"type" 		=> $type,
				"student" 	=> $student,
				"subject" 	=> $subject,
				"note" 		=> $note,
				"status" 	=> $status,
				"day" 		=> $day,
				"month" 	=> $month,
				"semester" 	=> $set->semester,
				"sold"		=> $type_sold,
				"agreed" 	=> $agreed,
				"username" 	=> $this->session->userdata("id"),
				"year" 		=> $set->date,
				"prob"		=> $prob,
				"class"		=> $student1->class,
				"priority" 	=> $prio
		));
	}
	//modify note.
	public function modifyNote($id, $type, $student, $subject, $note, $status,
			$month, $day ,$prob, $prio){
		$set = $this->getSettings();
		$type_sold="";
		$student1 = $this->getStudent($student);
		if($type!=""){
			$type_sold = $this->getNoteType($type);
			$type_sold= $type_sold->sold;
		}
		$this->db->where("id",$id);
		return $this->db->update("notes", array(
				"type" 		=> $type,
				"student" 	=> $student,
				"subject" 	=> $subject,
				"note" 		=> $note,
				"status" 	=> $status,
				"month" 	=> $month,
				"day" 		=> $day,
				"semester" 	=> $set->semester,
				"agreed" 	=> "0",
				"year" 		=> $set->date,
				"class" 	=> $student1->class,
				"username" 	=> $this->session->userdata("id"),
				"sold" 		=> $type_sold,
				"prob"		=> $prob,
				"priority" 	=> $prio

		));
	}
	//get note by id.
	public function getNote($id){
		$query = $this->db->get_where("notes", array("id"=>$id));
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
	//replace message with variables passed
	public function replaceMsg($student, $message)
	{
		$student = $this->getStudent($student);
		$query = $this->db->query("SELECT RA_LEVELS.level,RA_CLASSES.class,
				RA_GRADES.grade,RA_USERS.name,RA_STUDENTS.fullname FROM
				RA_STUDENTS LEFT JOIN
				(RA_LEVELS,RA_CLASSES,RA_GRADES,RA_USERS)
				ON (RA_CLASSES.ID = ".$student->class." AND
				RA_GRADES.ID = RA_CLASSES.GRADE AND
				RA_USERS.ID = RA_STUDENTS.USERNAME AND
				RA_LEVELS.ID = RA_GRADES.LEVEL)
				");
		$row = $query->row();
		$vars = array("$$", "&&", "^^", "**", "%%");
		$values = array($row->fullname, $row->name,
				$row->level, $row->grade,
				$row->class
		);
		return $new_msg = str_replace($vars, $values, $message);
	}
	public function getWhere($table_where,$array_where)
	{
		$this->db->from($table_where)->where($array_where);
		return $this->db->get();
	}

	//get now time in Ryadh
	public function getTimeDate(){
		date_default_timezone_set('Asia/Riyadh');
		return date("Y-m-d H:i");
	}

	//delete rows from a table
	public function delete($related , $table, $rows = array()){

		/*
		 if( ! empty ( $rows ) )
		 {
		switch($related){
		case "delete":
		switch($table)
		{
		case "ra_levels":
		break;
		case "ra_grades":
		break;
		case "ra_classes":
		break;
		case "ra_users":
		break;
		case "ra_students":
		break;
		case "ra_notesprob":
		break;
		}
		break;
		case "replace":
		switch($table)
		{
		case "ra_levels":
		break;
		case "ra_grades":
		break;
		case "ra_classes":
		break;
		case "ra_users":
		break;
		case "ra_students":
		break;
		case "ra_notesprob":
		break;
		}
		break;
		case "null":
		switch($table)
		{
		case "ra_levels":
		break;
		case "ra_grades":
		break;
		case "ra_classes":
		break;
		case "ra_users":
		break;
		case "ra_students":
		break;
		case "ra_notesprob":
		break;
		}
		break;

		}
		}
		*/
	}
	//get level grades
	public function getLevelGrades($level){
		$query = $this->db->get_where("ra_grades", array(
				"level"=>$level
		));
		return $query->result();
	}

	//get class level
	public function getClassLevel($class){
		$class_query = $this->db->get_where("classes", array("id" => $class));
		$class = $class_query->row();
		$grade_query = $this->db->get_where("grades", array("id" => $class->grade));
		$grade = $grade_query->row();
		$level_query = $this->db->get_where("levels", array("id" => $grade->level));
		$level = $level_query->row();
		return $level->id;
	}

	//get class probs
	public function getClassProbs($class){
		$level = $this->getClassLevel($class);
		$probs_query = $this->db->get_where("notesprob", array("level" => $level));
		return $probs_query->result();
	}

	//get class subjects
	public function getClassSubjects($class){
		$class_query = $this->db->get_where("classes", array("id" => $class));
		$class = $class_query->row();
		$subjects_query = $this->db->get_where("subjects", array("grade" => $class->grade));
		return $subjects_query->result();
	}

	//get user class subjects
	public function getUserClassSubjects($user, $class, $type=""){
		$subjects_array = $this->getUserSubjects($user, "array");
		$class_query = $this->db->get_where("classes", array("id" => $class));
		$class = $class_query->row();
		$subjects_query = $this->db->get_where("subjects", array("grade" => $class->grade));
		$subjects_out = array();
		foreach($subjects_query->result() as $subject)
			foreach($subjects_array as $user_subject){
			if($user_subject['id']==$subject->id)
				array_push($subjects_out, array("id" => $subject->id, "subject" => $subject->subject));
		}
		if($type=="object")
			return (object)$subjects_out;
		else
			return $subjects_out;
	}

	//get prob types to add note
	public function getProbTypes($prob){
		$query = $this->db->get_where("notestypes", array("prob" => $prob));
		return $query->result();
	}

	//get student class
	public function getStudentClass($student){
		$query = $this->db->get_where("students", array("id" => $student));
		$student = $query->row();
		$query = $this->db->get_where("classes", array("id" => $student->class));
		$class = $query->row();
		return $class->class;
	}

	// get user classes
	public function getUserClasses($user,$return){
		$user = $this->getUser($user);
		$classes = "";
		$full_classes = array();
		if($user->classes!=""){
			$classes_array = explode("--", $user->classes);
			array_shift($classes_array);
			if($return == "array"){
				foreach($classes_array as $class){
					$query = $this->getClass($class);
					array_push($full_classes,array("id" => $query->id, "class" => $query->class));
				}
				return($classes_array!="")? $full_classes:lang("no_permissions");
			}
			foreach($classes_array as $class){
				$class1 = $this->getClass($class);
				$classes = $classes . "--" . $class1->class;
			}
		}
		if($return == "string")
			return ($classes != "")?$classes:lang("no_permissions");
	}

	// get user subjects return string or array
	public function getUserSubjects($user, $return){
		$user = $this->getUser($user);
		$subjects = "";
		$full_subjects = array();
		if($user->subjects!=""){
			$subjects_array = explode("--", $user->subjects);
			array_shift($subjects_array);
			if($return == "array"){
				foreach($subjects_array as $subject){
					$query = $this->getSubject($subject);
					array_push($full_subjects, array("id" => $query->id, "subject" => $query->subject));
				}
				return ($subjects_array!="")?$full_subjects:lang("no_permissions");

			}
			foreach($subjects_array as $subject){
				$subject1 = $this->getSubject($subject);
				$subjects = $subjects . "--" . $subject1->subject;
			}
		}
		if($return =="string")
			return ($subjects!="")?$subjects:lang("no_permissions");
	}
	//get days for hijri date
	public function getDays(){
		$days=array();
		for($i=1;$i<31;$i++){
			array_push($days,$i);
		}
		return $days;
	}

	//get monthes for hijri date
	public function getMonthes(){
		return array(
				lang("moharam"),
				lang("safar"),
				lang("rabie_awal"),
				lang("rabie_thani"),
				lang("jumada_awal"),
				lang("jumada_thani"),
				lang("rajab"),
				lang("shaban"),
				lang("ramadan"),
				lang("shawal"),
				lang("zo_elkida"),
				lang("zo_elhija")
		);
	}

	//get priorities
	public function getPriorities(){
		return array(
				lang("normal"),
				lang("important"),
				lang("very_imp")
		);
	}

	//modify agreement of note
	public function modifyAgree($id, $agree){
		$this->db->where("id", $id);
		return $this->db->update("notes", array("agreed" => $agree));
	}

	//get priority name.
	public function getPriority($id){
		$prio = array(
				lang("normal"),
				lang("important"),
				lang("very_imp")
		);
		return $prio[$id];
	}

	//get user probs
	/*	public function getUserProbs($user){
	 $user = $this->getUser($user);
	$probs = "";
	if($user->classes != ""){
	$classes = $this->getUserClasses($user->classes,"array");
	$grade = $this->getClass($classes[0]);
	}
	}*/

	//check permissions
	public function checkSeePermissions($table){
		$permissions = $this->getUserPermissions($this->session->userdata("id"));
		switch($table){
			case "ra_levels":
				if($permissions->level_see!=1)
					return false;
				break;
			case "ra_grades":
				if($permissions->grade_see!=1)
					return false;
				break;
			case "ra_classes":
				if($permissions->class_see!=1)
					return false;
				break;
			case "ra_subjects":
				if($permissions->subject_see!=1)
					return false;
				break;
			case "ra_users":
				if($permissions->user_see!=1)
					return false;
				break;
			case "ra_students":
				if($permissions->student_see!=1)
					return false;
				break;
			case "ra_roles":
				if($permissions->role_see!=1)
					return false;
				break;
			case "ra_notesprob":
				if($permissions->prob_see!=1)
					return false;
				break;
			case "ra_notestypes":
				if($permissions->type_see!=1)
					return false;
				break;
			case "ra_notes":
				if($permissions->note_see!=1)
					return false;
				break;
			case "ra_readymessages":
				if($permissions->ready_see!=1)
					return false;
				break;
			case "ra_defaultnumemail":
				if($permissions->def_see!=1)
					return false;
				break;
			case "ra_lessons":
				if($permissions->lessons_see!=1)
					return false;
				break;
			case "ra_slider":
				if($permissions->slider_see!=1)
					return false;
				break;
			case "ra_forms":
				if($permissions->forms_see!=1)
					return false;
				break;
			case "ra_actions":
				if($permissions->action_see!=1)
					return false;
				break;
		}
		return true;
	}

	//check delete permissions
	public function checkDeletePermissions($table){
		$permissions = $this->getUserPermissions($this->session->userdata("id"));
		switch($table){
			case "ra_levels":
				if($permissions->level_delete!=1)
					return false;
				break;
			case "ra_grades":
				if($permissions->grade_delete!=1)
					return false;
				break;
			case "ra_classes":
				if($permissions->class_delete!=1)
					return false;
				break;
			case "ra_subjects":
				if($permissions->subject_delete!=1)
					return false;
				break;
			case "ra_users":
				if($permissions->user_delete!=1)
					return false;
				break;
			case "ra_students":
				if($permissions->student_delete!=1)
					return false;
				break;
			case "ra_roles":
				if($permissions->role_delete!=1)
					return false;
				break;
			case "ra_notesprob":
				if($permissions->prob_delete!=1)
					return false;
				break;
			case "ra_notestypes":
				if($permissions->type_delete!=1)
					return false;
				break;
			case "ra_notes":
				if($permissions->note_delete!=1)
					return false;
				break;
			case "ra_readymessages":
				if($permissions->ready_delete!=1)
					return false;
				break;
			case "ra_defaultnumemail":
				if($permissions->def_delete!=1)
					return false;
				break;
			case "ra_slider":
				if($permissions->slider_delete!=1)
					return false;
				break;
			case "ra_forms":
				if($permissions->forms_delete!=1)
					return false;
				break;
			case "ra_actions":
				if($permissions->action_delete!=1)
					return false;
				break;
		}
		return true;
	}

	//check create permissions
	public function checkCreatePermissions($table){
		$permissions = $this->getUserPermissions($this->session->userdata("id"));
		switch($table){
			case "ra_levels":
				if($permissions->level_create!=1)
					return false;
				break;
			case "ra_grades":
				if($permissions->grade_create!=1)
					return false;
				break;
			case "ra_classes":
				if($permissions->class_create!=1)
					return false;
				break;
			case "ra_subjects":
				if($permissions->subject_create!=1)
					return false;
				break;
			case "ra_users":
				if($permissions->user_create!=1)
					return false;
				break;
			case "ra_students":
				if($permissions->student_create!=1)
					return false;
				break;
			case "ra_roles":
				if($permissions->role_create!=1)
					return false;
				break;
			case "ra_notesprob":
				if($permissions->prob_create!=1)
					return false;
				break;
			case "ra_notestypes":
				if($permissions->type_create!=1)
					return false;
				break;
			case "ra_notes":
				if($permissions->note_create!=1)
					return false;
				break;
			case "ra_readymessages":
				if($permissions->ready_create!=1)
					return false;
				break;
			case "ra_slider":
				if($permissions->slider_insert!=1)
					return false;
				break;
			case "ra_defaultnumemail":
				if($permissions->def_create!=1)
					return false;
				break;
		}
		return true;
	}

	//check modify permissions
	public function checkModifyPermissions($table){
		$permissions = $this->getUserPermissions($this->session->userdata("id"));
		switch($table){
			case "ra_levels":
				if($permissions->level_modify!=1)
					return false;
				break;
			case "ra_grades":
				if($permissions->grade_modify!=1)
					return false;
				break;
			case "ra_classes":
				if($permissions->class_modify!=1)
					return false;
				break;
			case "ra_subjects":
				if($permissions->subject_modify!=1)
					return false;
				break;
			case "ra_users":
				if($permissions->user_modify!=1)
					return false;
				break;
			case "ra_students":
				if($permissions->student_modify!=1)
					return false;
				break;
			case "ra_roles":
				if($permissions->role_modify!=1)
					return false;
				break;
			case "ra_notesprob":
				if($permissions->prob_modify!=1)
					return false;
				break;
			case "ra_notestypes":
				if($permissions->type_modify!=1)
					return false;
				break;
			case "ra_notes":
				if($permissions->note_modify!=1)
					return false;
				break;
			case "ra_readymessages":
				if($permissions->ready_modify!=1)
					return false;
				break;
			case "ra_slider":
				if($permissions->slider_modify!=1)
					return false;
				break;
			case "ra_lessons":
				if($permissions->lessons_modify!=1)
					return false;
				break;
			case "ra_defaultnumemail":
				if($permissions->def_modify!=1)
					return false;
				break;
		}
		return true;
	}

	//get table headers
	public function getHeaders($table){
		$headings = array();
		switch($table){
			case "ra_lessons":
				$headings = array(lang("class"),lang("subject"),lang("day"),lang('order'),lang("actions"));
				break;
			case "ra_levels":
				$headings = array(lang("level"), lang("actions"));
				break;
			case "ra_grades":
				$headings = array(lang("level"),lang("grade"), lang("actions"));
				break;
			case "ra_classes":
				$headings = array(lang("level"),lang("grade"),lang("class"), lang("actions"));
				break;
			case "ra_students":
				$headings = array(lang("gaurd"),lang("fullname"),
				lang("idnum"),lang("level"),lang("grade"),lang("class"),lang("finger"), lang("actions"));
				break;
			case "ra_users":
				$headings = array(lang("username"),lang("fullname"),
				lang("role"), lang("active"), lang("user_classes"), lang("user_subjects"), lang("actions"));
				break;
			case "ra_actions":
				$headings = array(lang("username"),lang("action"),
				lang("datetime"),lang("type"));
				break;
			case "ra_defaultnumemail":
				$headings = array(lang("username"),lang("email")." 1",
				lang("email")." 2",lang("phone"). " 1", lang("phone"). " 2", lang("actions"));
				break;
			case "ra_notesprob":
				$headings = array(lang("level"),lang("prob"), lang("color"), lang("actions"));
				break;
			case "ra_notestypes":
				$headings = array(lang("level"),lang("prob"), lang("sold"), lang("body"), lang("actions"));
				break;
			case "ra_readymessages":
				$headings = array(lang("message"), lang("actions"));
				break;
			case "ra_roles":
				$headings = array(lang("role"), lang("actions"));
				break;
			case "ra_subjects":
				$headings = array(lang("level"),
				lang("grade"), lang("subject"), lang("actions"));
				break;
			case "ra_notes":
				$headings = array(lang("student"), lang("class"), lang("subject"), lang("prob"), lang("type"),
				lang("status"), lang("priority"), lang("note"), lang("sold"), lang("username"), lang("date"),
				lang("agreed"), lang('actions'));
				break;
			default:
				break;
		}
		return $headings;
	}

	//get table contents for the BIG SHOW!!
	public function getTable($table,$note="",$atts=array()){
		$rows = array();
		$query = $this->db->get($table);
		if($note!=""){
			$month1 = (isset($atts["month1"]))?$atts["month1"]:"";
			$month2 = (isset($atts["month2"]))?$atts["month2"]:"";
			$day1 = (isset($atts["day1"]))?$atts["day1"]:"";
			$day2 = (isset($atts["day2"]))?$atts["day2"]:"";
			unset($atts["day1"]);
			unset($atts["day2"]);
			unset($atts["month1"]);
			unset($atts["month2"]);
			if($month1!="") $this->db->where("month >=",$month1);
			if($month2!="") $this->db->where("month <=",$month2);
			if($day1!="") $this->db->where("day >=",$day1);
			if($day2!="") $this->db->where("day <=",$day2);
			$this->db->where($atts);
			$query = $this->db->get("ra_notes");
		}
		$i=0;
		foreach($query->result() as $row)
		{
			switch($table){
				case "ra_lessons":
					$class= $this->homemodel->getClass($row->class);
					$subject= $this->homemodel->getSubject($row->subject);
					$day = $this->homemodel->getDay($row->day);
					$order = $this->homemodel->getOrder($row->order);
					$rows[$i] = array($row->id, $class->class, $subject->subject, $day, $order);
					break;
				case "ra_levels":
					$rows[$i] = array($row->id,$row->level);
					break;
				case "ra_grades":
					$level = $this->homemodel->getLevel($row->level);
					$rows[$i] = array($row->id,$level->level, $row->grade);
					break;
				case "ra_classes":
					$grade = $this->homemodel->getGrade($row->grade);
					$level = $this->homemodel->getLevel($grade->level);
					$rows[$i] = array($row->id,$level->level,
							$grade->grade,$row->class);
					break;
				case "ra_students":
					$username = $this->homemodel->getUser($row->username);
					$class = $this->homemodel->getClass($row->class);
					$grade = $this->homemodel->getGrade($class->grade);
					$level = $this->homemodel->getLevel($grade->level);
					$rows[$i] = array($row->id,($row->username=="0")?lang("without"):$username->username,$row->fullname,
							$row->idnum,$level->level,
							$grade->grade,$class->class,$row->fingerprint);
					break;
				case "ra_users":
					$classes = $this->homemodel->getUserClasses($row->id, "string");
					$subjects = $this->homemodel->getUserSubjects($row->id, "string");
					$role = $this->homemodel->getRole($row->role);
					$active = ($row->active == "1")? "YES": "NO";
					$rows[$i] = array($row->id,$row->username,
							$row->name,$role->role,$active,$classes,$subjects);
					break;
				case "ra_actions":
					$username = $this->homemodel->getUser($row->username);
					$rows[$i] = array($row->id,$username->username,
							$row->action,$row->datetime,$row->type);
					break;
				case "ra_defaultnumemail":
					$username = $this->homemodel->getUser($row->username);
					$rows[$i] = array($row->id,$username->username,
							$row->email1,$row->email2,
							$row->number1,$row->number2);
					break;
				case "ra_notesprob":
					$level = $this->homemodel->getLevel($row->level);
					$rows[$i] = array($row->id,$level->level, $row->prob,
							"<div class='color_div' style='background-color:".$row->color."'></div>");
					break;
				case "ra_notestypes":
					$type = $this->homemodel->getProb($row->prob);
					$level = $this->homemodel->getLevel($type->level);
					$rows[$i] = array($row->id,$level->level,
							$type->prob, $row->sold, $row->body);
					break;
				case "ra_readymessages":
					$rows[$i] = array($row->id,$row->message);
					break;
				case "ra_roles":
					$rows[$i] = array($row->id,$row->role);
					break;
				case "ra_subjects":
					$grade = $this->homemodel->getGrade($row->grade);
					$level = $this->homemodel->getLevel($grade->level);
					$rows[$i] = array($row->id,$level->level,
							$grade->grade, $row->subject);
					break;
				case "ra_notes":
					$agreed="";
					$class = $this->homemodel->getStudentClass($row->student);
					$student = $this->homemodel->getStudent($row->student);
					$subject=lang("without");
					if($row->subject!="0"){
						$subject = $this->homemodel->getSubject($row->subject);
						$subject=$subject->subject;
					}
					$type=lang("without");
					if($row->type!="0"){
						$type = $this->homemodel->getNoteType($row->type);
						$type = $type->body;
					}
					$prob =lang("without");
					if($row->prob!="0"){
						$prob = $this->homemodel->getProb($row->prob);
						$prob = $prob->prob;
					}
					$prio = $this->homemodel->getPriority($row->priority);
					$prio = ($row->priority==2)? "<div style='font-weight:bold; color:red;'>".$prio."</div>": $prio;
					$set = $this->homemodel->getSettings();
					$date = $set->date."-الفصل:".$set->semester."-".$row->day."-".$this->getMonth($row->month);
					$username = $this->homemodel->getUser($row->username);
					$perm = $this->homemodel->getUserPermissions($this->session->userdata("id"));
					if($perm->modify_agree==1){
						if($row->agreed==1){
							$agreed='<div><input
									type="button" id="'.$row->id.'"
											class="btn btn-success btnc modify_agree" data-toggle="button"
											value="'.lang("agree").'"/> <input type="checkbox"
													name="" checked="checked" style="display:none;" /></div>
													';
						}else{
							$agreed='<div><input
									type="button" id="'.$row->id.'"
											class="btn btn-success btnc modify_agree active" data-toggle="button"
											value="'.lang("not_agree").'"/> <input type="checkbox"
													name=""  style="display:none;" /></div>
													';
						}
					}else{
						$agreed=($row->agreed==1)?"<div style='color:green; font-weight:bold;'>".lang("agree")."</div>"
								:"<div style='color:red; font-weight:bold;'>".lang("not_agree")."</div>";
					}

					$status = ($row->status==1)?"<div style='color:red; font-weight:bold;'>".lang("continue")."</div>"
							:"<div style='color:green; font-weight:bold;'>".lang("solved")."</div>";
					$rows[$i] = array($row->id, $student->fullname, $class, $subject, $prob, $type,
							$status, $prio,
							$row->note, $row->sold, $username->name, $date,
							$agreed);
					break;
				default:
					echo lang("wrong_request");
					exit();
					break;
			}
			$i++;
		}
		$headings = $this->getHeaders($table);
		return array("headings" => $headings, "rows" => $rows);
	}

	//get disagreed notes
	public function getClassDisagreedNotes($user){
		$notes = array();
		$classes = $this->getUserClasses($user,"array");
		foreach($classes as $class){
			$query = $this->db->get_where("notes", array("class" => $class['id'], "agreed" => 0));
			array_push($notes, $query->result_array());
		}
		return $notes;
	}

	//search notes
	public function searchWord($table,$word){
		$rows = array();
		$query = $this->db->get($table);
		$i=0;
		foreach($query->result() as $row)
		{
			switch($table){
				case "ra_lessons":
					$class= $this->homemodel->getClass($row->class);
					$subject= $this->homemodel->getSubject($row->subject);
					$day = $this->homemodel->getDay($row->day);
					$order = $this->homemodel->getOrder($row->order);
					if($day==$word||$subject==$word||$order==$word||$day==$word)
						$rows[$i] = array($row->id, $class->class, $subject->subject, $day, $order);
				case "ra_levels":
					if($row->level==$word)
						$rows[$i] = array($row->id,$row->level);
					break;
				case "ra_grades":
					$level = $this->homemodel->getLevel($row->level);
					if($level->level == $word || $row->grade == $word)
						$rows[$i] = array($row->id,$level->level, $row->grade);
					break;
				case "ra_classes":
					$grade = $this->homemodel->getGrade($row->grade);
					$level = $this->homemodel->getLevel($grade->level);
					if($level->level==$word||$grade->grade==$word||$row->class==$word)
						$rows[$i] = array($row->id,$level->level,
								$grade->grade,$row->class);
					break;
				case "ra_students":
					$username = $this->homemodel->getUser($row->username);
					$class = $this->homemodel->getClass($row->class);
					$grade = $this->homemodel->getGrade($class->grade);
					$level = $this->homemodel->getLevel($grade->level);
					if($username->username==$word || $row->fullname==$word ||
							$row->idnum==$word || $level->level==$word||
							$grade->grade==$word || $class->class==$word)
						$rows[$i] = array($row->id,$username->username,$row->fullname,
								$row->idnum,$level->level,
								$grade->grade,$class->class,$row->fingerprint);
					break;
				case "ra_users":
					$classes = $this->homemodel->getUserClasses($row->id, "string");
					$subjects = $this->homemodel->getUserSubjects($row->id, "string");
					$role = $this->homemodel->getRole($row->role);
					$active = ($row->active == "1")? "YES": "NO";
					if($row->username==$word||$row->name==$word||
							$role->role==$word||$active==$word||
							strpos($classes,$word)!=false||
							strpos($subjects,$word)!=false)
						$rows[$i] = array($row->id,$row->username,
								$row->name,$role->role,$active,$classes,$subjects);
					break;
				case "ra_actions":
					$username = $this->homemodel->getUser($row->username);
					if($username->username==$word||$row->action==$word||$row->datetime==$word||$row->type==$word)
						$rows[$i] = array($row->id,$username->username,
								$row->action,$row->datetime,$row->type);
					break;
				case "ra_defaultnumemail":
					$username = $this->homemodel->getUser($row->username);
					if($username->username==$word||$row->email1==$word||$row->email2==$word||$row->number1==$word||$row->number2==$word)
						$rows[$i] = array($row->id,$username->username,
								$row->email1,$row->email2,
								$row->number1,$row->number2);
					break;
				case "ra_notesprob":
					$level = $this->homemodel->getLevel($row->level);
					if($level->level==$word||$row->prob==$word)
						$rows[$i] = array($row->id,$level->level, $row->prob,
								"<div class='color_div' style='background-color:".$row->color."'></div>");
					break;
				case "ra_notestypes":
					$type = $this->homemodel->getProb($row->prob);
					$level = $this->homemodel->getLevel($type->level);
					if($level->level==$word||$type->prob==$word||$row->sold==$word||$row->body==$word)
						$rows[$i] = array($row->id,$level->level,
								$type->prob, $row->sold, $row->body);
					break;
				case "ra_readymessages":
					if($row->message==$word)
						$rows[$i] = array($row->id,$row->message);
					break;
				case "ra_roles":
					if($row->role==$word)
						$rows[$i] = array($row->id,$row->role);
					break;
				case "ra_subjects":
					$grade = $this->homemodel->getGrade($row->grade);
					$level = $this->homemodel->getLevel($grade->level);
					if($level->level==$word||$grade->grade==$word||$row->subject==$word)
						$rows[$i] = array($row->id,$level->level,
								$grade->grade, $row->subject);
					break;
				case "ra_notes":
					$agreed="";
					$class = $this->homemodel->getStudentClass($row->student);
					$student = $this->homemodel->getStudent($row->student);
					$subject=lang("without");
					if($row->subject!="0"){
						$subject = $this->homemodel->getSubject($row->subject);
						$subject=$subject->subject;
					}
					$type=lang("without");
					if($row->type!="0"){
						$type = $this->homemodel->getNoteType($row->type);
						$type = $type->body;
					}
					$prob =lang("without");
					if($row->prob!="0"){
						$prob = $this->homemodel->getProb($row->prob);
						$prob = $prob->prob;
					}
					$prio = $this->homemodel->getPriority($row->priority);
					$prio = ($row->priority==2)? "<div style='font-weight:bold; color:red;'>".$prio."</div>":$prio;
					$set = $this->homemodel->getSettings();
					$date = $set->date."-الفصل:".$set->semester."-".$row->day."-".$this->getMonth($row->month);
					$username = $this->homemodel->getUser($row->username);
					$perm = $this->homemodel->getUserPermissions($this->session->userdata("id"));
					if($perm->modify_agree==1){
						if($row->agreed==1){
							$agreed='<div><input
									type="button" id="'.$row->id.'"
											class="btn btn-success btnc modify_agree" data-toggle="button"
											value="'.lang("agree").'"/> <input type="checkbox"
													name="" checked="checked" style="display:none;" /></div>
													';
						}else{
							$agreed='<div><input
									type="button" id="'.$row->id.'"
											class="btn btn-success btnc modify_agree active" data-toggle="button"
											value="'.lang("not_agree").'"/> <input type="checkbox"
													name=""  style="display:none;" /></div>
													';
						}
					}else{
						$agreed=($row->agreed==1)?"<div style='color:green; font-weight:bold;'>".lang("agree")."</div>"
								:"<div style='color:red; font-weight:bold;'>".lang("not_agree")."</div>";
					}

					$status = ($row->status==1)?"<div style='color:red; font-weight:bold;'>".lang("continue")."</div>"
							:"<div style='color:green; font-weight:bold;'>".lang("solved")."</div>";
					if($student->fullname==$word||$class==$word||$subject==$word||
							$prob==$word||$type==$word||$row->note==$word||
							$row->sold==$word||$username->name==$word||
							strpos($prio,$word)!=false||
							strpos($status,$word)!=false||
							$prio==$word||strpos($date,$word)!=false||strpos($agreed,$word)!=false)
						$rows[$i] = array($row->id, $student->fullname, $class, $subject, $prob, $type,
								$status, $prio,
								$row->note, $row->sold, $username->name, $date,
								$agreed);
					break;
				default:
					echo lang("wrong_request");
					exit();
					break;
			}
			$i++;
		}
		$headings = $this->getHeaders($table);
		return array("headings" => $headings, "rows" => $rows);
	}

	//show choosen notes in search notes
	public function showSearchNotes($atts=array()){
		$month1 = ($atts["month1"]!=null)?$atts["month1"]:"";
		$month2 = ($atts["month2"]!=null)?$atts["month2"]:"";
		$day1 = ($atts["day1"]!=null)?$atts["day1"]:"";
		$day2 = ($atts["day2"]!=null)?$atts["day2"]:"";
		unset($atts["day1"]);
		unset($atts["day2"]);
		unset($atts["month1"]);
		unset($atts["month2"]);
		$query = $this->db->get_where("notes", $atts);
		return $query->result();
	}

	//get month name
	public function getMonth($key){
		$monthes = $this->getMonthes();
		return $monthes[$key];
	}


	//Good array print function!
	public function array_print($array = array()){
		print "<pre>";
		var_dump($array);
		print "</pre>";
	}

	//get lessons
	public function getAllLesson(){
		$query = $this->db->get("lessons");
		return $query->result();
	}
	public function getLesson($id){
		$query = $this->db->get_where("lessons", array("id"=>$id));
		return $query->row();
	}

	//insert lesson in db
	public function insertLesson($atts=array()){
		return $this->db->insert("lessons",$atts);
	}

	//modify lesson in db
	public function modifyLesson($atts=array(),$subject){
		$this->db->where($atts);
		return $this->db->update("lessons", array("subject"=>$subject));
	}

	//get days of week
	public function getWeekDays(){
		return array(lang("saturday"),lang("sunday"), lang("monday"),
				lang("tuesday"), lang("wednesday"), lang("thursday"),
				lang("friday"));
	}

	//get day of week
	public function getDay($day){
		$days = $this->getWeekDays();
		return $days[$day];
	}

	//get all orders of lesson
	public function getOrders(){
		return array(lang("first"),lang("second"),lang("third"),lang("fourth"),
				lang("fifth"),lang("sixth"),lang("seventh"),lang("eightth"),lang("ninth"));
	}

	//get order of a lesson
	public function getOrder($order){
		$orders = $this->getOrders();
		return $orders[$order];
	}

	//determine morning time parts
	public function morningParts($time){
		$time_array=explode(":",$time);
		$hour = $time_array[0];
		$minutes=substr($time_array[1],0,2);
		$keeping=substr($time_array[1],-2);
		return array("hour"=>$hour,"minutes"=>$minutes,"keeping"=>$keeping);
	}

	//get data from odbc about morning presents of students
	public function odbcGet(){
		$conn=odbc_connect('UNIS','','unisamho');
		$sql="SELECT * FROM tUser";
		$rs=odbc_exec($conn,$sql);
		if (!$rs)
		{
			exit("Error in SQL");
		}
		while (odbc_fetch_row($rs))
		{
			echo odbc_result($rs,"C_Name");
		}
		odbc_close($conn);
	}

	//insert slider in database
	public function insertSlider($atts=array()){
		return $this->db->insert("slider",$atts);
	}

	//modify slider in database
	public function modifySlider($id, $atts=array()){
		$this->db->where("id",$id);
		return $this->db->update("slider",$atts);
	}

	//get slider from database by id
	public function getSlider($id){
		$query = $this->db->get_where("slider",array("id"=>$id));
		if ($query->num_rows()>0)
			return $query->row();
		return false;
	}

	//get all sliders from database
	public function getAllSlider(){
		$query = $this->db->get("slider");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//get all forms from database
	public function getAllForm(){
		$query = $this->db->get("forms");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//get student forms
	public function getStudentForms($student){
		$query = $this->db->get_where("forms", array("student"=>$student));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//get user messages from inbox
	public function getUserInbox(){
		$query = $this->db->get_where("inbox", array("username"=>$this->session->userdata("id")));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//get unread user messages from inbox
	public function getUserUnreadInbox(){
		$query = $this->db->get_where("inbox", array("username"=>$this->session->userdata("id"),"read"=>0));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//get user messages from a user in inbox
	public function getConversation($user1,$user2,$limit=0){
		$limitation = ($limit==0)?" LIMIT 0,3":"";
		$query = $this->db->query("SELECT * FROM (`ra_inbox`) WHERE (`from` = '".$user1."' AND `username` = '".$user2."') OR (`from` = '".$user2."' AND `username` = '".$user1."') ORDER BY `datetime` desc".$limitation);
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//set message in inbox to be read
	public function readMessage($id){
		$this->db->where("id",$id);
		return $this->db->update("inbox", array("read"=>1));
	}

	//insert message in inbox
	public function insertInbox($from,$username,$message){
		return $this->db->insert("inbox",array(
				"from"=>$from,
				"username"=> $username,
				"message"=>$message,
				"datetime"=>time(),
				"read"=>0
		));
	}

	//delete message from inbox
	public function deleteInbox($id){
		$this->db->where("id", $id);
		return $this->db->delete("inbox");
	}

	//get time deferent between two times given
	public function getTimeDef($time1, $time2){
		$string_def = array(
				array(60, lang("just_now")),
				array(90, '1 '.lang("minute")),                  // 60*1.5
				array(3600, lang("minutes"), 60),             // 60*60, 60
				array(5400, '1 '.lang("hour")),                  // 60*60*1.5
				array(86400, lang("hours"), 3600),            // 60*60*24, 60*60
				array(129600, '1 '.lang("day")),                 // 60*60*24*1.5
				array(604800, lang("days"), 86400),           // 60*60*24*7, 60*60*24
				array(907200, '1 '.lang("week")),                // 60*60*24*7*1.5
				array(2628000, lang("weeks"), 604800),        // 60*60*24*(365/12), 60*60*24*7
				array(3942000, '1 '.lang("month")),              // 60*60*24*(365/12)*1.5
				array(31536000, lang("monthes"), 2628000),     // 60*60*24*365, 60*60*24*(365/12)
				array(47304000, '1 '.lang("year")),              // 60*60*24*365*1.5
				array(3153600000, lang("years"), 31536000),   // 60*60*24*365*100, 60*60*24*365
		);
		$difference = $time1-$time2;
		$message = "";
		foreach($string_def as $format){
			if ($difference < $format[0]) {
				if (count($format) == 2) {
					$message = lang("time_from")." ".$format[1];
					break;
				} else {
					$message = lang("time_from")." ".ceil($difference / $format[2]) . ' ' . $format[1];
					break;
				}
			}
		}
		return $message;
	}

	//get gaurds message to admin
	public function getAdminMessages($read=""){
		if($read=="")
			$query = $this->db->get_where("inbox",array("username"=>-1));
		elseif($read=="unread")
		$query = $this->db->get_where("inbox", array("username"=>-1,"read"=>0));
		if($query->num_rows>0)
			return $query->result();
		return false;
	}

	//export to pdf
	public function exportPdf($body){
		$stylesheet = file_get_contents(base_url().'css/style.css');
		$this->load->library("MPDF56/mpdf.php","UTF-8");
		$this->mpdf->SetDirectionality('rtl');
		$html = $body;
		$html = str_replace("\\\"","\"",$html);
		$this->mpdf->useLang = true;
		$this->mpdf->WriteHTML($stylesheet,1);
		$this->mpdf->WriteHTML($html,2);
		$this->mpdf->Output();
		exit;
	}

	//excel test
	public function testExcel(){
		$excel = $this->load->library("Classes/PHPExcel");
		$excel = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		$excel->save("05featuredemo.xlsx");

	}

	//get table head and body to export to file
	public function getTableForFile($tbody1,$thead1){
		$regex = '/(|\\\\[rntv]{1})/';
		$thead = preg_replace($regex, "", $thead1);
		$tbody = preg_replace($regex, "", $tbody1);
		$thead = str_replace(array("[","]","\""), "",$thead);
		$tbody = str_replace(array("[","]","\""), "",$tbody);
		$thead_array = explode(",",$thead);
		$tbody_array = explode(",",$tbody);
		array_pop($thead_array);
		$divided = count($tbody_array)/count($thead_array);
		$tbody = array();
		for($i=0;$i<$divided;$i++){
			$tbody[$i]=array();
			$tbody[$i]+=array_slice($tbody_array,$i*count($thead_array),count($thead_array));
		}
		return array("thead"=>$thead_array,"tbody"=>$tbody);
	}
}