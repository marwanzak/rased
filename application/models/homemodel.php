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
	public function modifyPermissions($id,$username,$permissions){
		$this->db->where("id",$id);
		return $this->db->update("permissions", array(
				"username" => $username,
				"permissions" => $permissions
		));
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
	public function getNoteType($id){
		$query = $this->db->get_where("notestypes", array("id"=>$id));
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
	public function getProb($id){
		$query = $this->db->get_where("notesprob", array("id"=>$id));
		return $query->row();
	}
	//get all notes probs.
	public function getAllProb(){
		$query = $this->db->get("notesprob");
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
		$query = $this->db->get_where("morning", array("id"=>$id));
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
		return $this->db->insert("roles", array(
				"role" => $role
		));
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

	//Good array print function!
	public function array_print($array = array()){
		print "<pre>";
		var_dump($array);
		print "</pre>";
	}
}