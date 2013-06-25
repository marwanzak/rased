<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class get extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
	public function getLevel(){
		echo json_encode($this->homemodel->getLevel($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllLevel(){
		echo json_encode($this->homemodel->getAllLevel(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getGrade(){
		echo json_encode($this->homemodel->getGrade($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllGrade(){
		echo json_encode($this->homemodel->getAllGrade(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getClass(){
		$query = $this->homemodel->getClass($_POST["id"]);
		$grade = $this->homemodel->getGrade($query->grade);
		$query->level = $grade->level;
		echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllClass(){
		echo $this->homemodel->getAllClass();
	}
	public function getSubject(){
		$query =  $this->homemodel->getSubject($_POST["id"]);
		$grade = $this->homemodel->getGrade($query->grade);
		$query->level = $grade->level;
		echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllSubject(){
		echo $this->homemodel->getAllSubject();
	}
	public function getUser(){
		$query = $this->homemodel->getUser($_POST["id"]);
		unset($query->password);
		unset($query->salt);
		unset($query->code);
		echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllUser(){
		echo $this->homemodel->getAllUser();
	}
	public function getPermissions(){
		echo $this->homemodel->getPermissions($_POST["id"]);
	}
	public function getAllPermissions(){
		echo $this->homemodel->getAllPermissions();
	}
	public function getDef(){
		echo json_encode($this->homemodel->getDef($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllDef(){
		echo $this->homemodel->getAllDef();
	}
	public function getNotify(){
		echo $this->homemodel->getNotify($_POST["id"]);
	}
	public function getAllNotify(){
		echo $this->homemodel->getAllNotify();
	}
	public function getNoteType(){
		$query = $this->homemodel->getNoteType($_POST["id"]);
		$prob = $this->homemodel->getProb($query->prob);
		$query->level = $prob->level;
		echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllNoteType(){
		echo $this->homemodel->getAllNoteType();
	}
	public function getReady(){
		echo json_encode($this->homemodel->getReady($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	public function getProb(){
		echo json_encode($this->homemodel->getProb($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	public function getAllReady(){
		echo $this->homemodel->getAllReady();
	}
	public function getMorning(){
		echo $this->homemodel->getMorning($_POST["id"]);
	}
	public function getAllMorning(){
		echo $this->homemodel->getAllMorning();
	}
	public function getStudent(){
		$query = $this->homemodel->getStudent($_POST["id"]);
		$class = $this->homemodel->getClass($query->class);
		$grade = $this->homemodel->getGrade($class->grade);
		$query->level = $grade->level;
		$query->grade = $grade->id;
		echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllStudent(){
		echo $this->homemodel->getAllStudent();
	}
	public function getRole(){
		echo json_encode($this->homemodel->getRole($_POST["id"]),
				JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	public function getAllRole(){
		echo $this->homemodel->getAllRole();
	}
	public function getAllAction(){
		echo $this->homemodel->getAllAction();
	}
	public function getSettings(){
		echo $this->homemodel->getSettings();
	}
	public function getNote(){
		echo $this->homemodel->getNote($_POST["id"]);
	}
	public function getAllNote(){
		echo $this->homemodel->getAllNote();
	}
	//get level grades json data type
	public function getLevelGrades(){
		$query = $this->db->get_where("ra_grades", array(
				"level"=>$_POST["level"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	//get grade classes json data type
	public function getGradeClasses(){
		$query = $this->db->get_where("ra_classes", array(
				"grade"=>$_POST["grade"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	//get grade subjects json data type
	public function getGradeSubjects(){
		$query = $this->db->get_where("ra_subjects", array(
				"grade"=>$_POST["grade"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get class students json data type
	public function getClassStudents(){
		$query = $this->db->get_where("ra_students", array(
				"class"=>$_POST["class"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get user students json data type
	public function getUserStudents(){
		$query = $this->db->get_where("ra_students", array(
				"username"=>$_POST["username"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get user actions json data type
	public function getUserActions(){
		$query = $this->db->get_where("ra_actions", array(
				"username"=>$_POST["username"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get user defaults json data type
	public function getUserDefaults(){
		$query = $this->db->get_where("ra_defaultnumemail", array(
				"username"=>$_POST["username"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get user permissions json data type
	public function getUserPermissions(){
		$query = $this->db->get_where("ra_permissions", array(
				"username"=>$_POST["username"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get user notes json data type
	public function getUserNotes(){
		$query = $this->db->get_where("ra_notes", array(
				"username"=>$_POST["username"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get student notes json data type
	public function getStudentNotes(){
		$query = $this->db->get_where("ra_notes", array(
				"student"=>$_POST["student"]
		));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get users for validate inserting username in forms
	public function getUserNames(){
		$this->db->select("username");
		$query = $this->db->get_where("ra_users", array("username" => $_POST["username"]));
		echo ($query->num_rows()>0)? "0":"1";
	}

	//get users for validate modifying username
	public function getUserModify(){
		$this->db->select("username,id");
		$query = $this->db->get_where("ra_users", array("username" => $_POST["username"]));
		$user = $query->row();
		echo ($user->id != $_POST["id"])? "0":"1";
	}

	//get students for validate inserting student id number in forms
	public function getStudentId(){
		$this->db->select("idnum");
		$query = $this->db->get_where("ra_students", array("idnum" => $_POST["idnum"]));
		echo ($query->num_rows()>0)? "0":"1";
	}

	//get level prob to add notetype
	public function getLevelProbs(){
		$query = $this->db->get_where("notesprob", array("level" => $_POST["level"]));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get prob types to add note
	public function getProbTypes(){
		$query = $this->db->get_where("notestypes", array("prob" => $_POST["prob"]));
		echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

	//get class subjects
	public function getClassSubjects(){
		echo json_encode($this->homemodel->getClassSubjects($_POST["class"]), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}
	
	//get class probs
	public function getClassProbs(){
		echo json_encode($this->homemodel->getClassProbs($_POST["class"]), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );
	}

}
