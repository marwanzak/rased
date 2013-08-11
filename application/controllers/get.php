<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class get extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
	public function getLevel(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getLevel($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
	}
	public function getAllLevel(){
		echo json_encode($this->homemodel->getAllLevel(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );

	}
	public function getGrade(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getGrade($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;

	}
	public function getAllGrade(){
		echo json_encode($this->homemodel->getAllGrade(), JSON_HEX_TAG | JSON_HEX_APOS |
				JSON_HEX_QUOT | JSON_HEX_AMP );

	}
	public function getClass(){
		if($_POST!=null){
			$query = $this->homemodel->getClass($_POST["id"]);
			$grade = $this->homemodel->getGrade($query->grade);
			$query->level = $grade->level;
			echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;

	}
	public function getAllClass(){
		echo $this->homemodel->getAllClass();
	}
	public function getSubject(){
		if($_POST!=null){
			$query =  $this->homemodel->getSubject($_POST["id"]);
			$grade = $this->homemodel->getGrade($query->grade);
			$query->level = $grade->level;
			echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;

	}
	public function getAllSubject(){
		echo $this->homemodel->getAllSubject();
	}
	public function getUser(){
		if($_POST!=null){
			$query = $this->homemodel->getUser($_POST["id"]);
			unset($query->password);
			unset($query->salt);
			unset($query->code);
			echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}
	public function getAllUser(){
		echo $this->homemodel->getAllUser();
	}
	public function getPermissions(){
		if($_POST!=null)
			echo $this->homemodel->getPermissions($_POST["id"]);
		else echo false;
	}
	public function getAllPermissions(){
		echo $this->homemodel->getAllPermissions();
	}
	public function getDef(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getDef($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
	}
	public function getAllDef(){
		echo $this->homemodel->getAllDef();
	}
	public function getNotify(){
		if($_POST!=null)
			echo $this->homemodel->getNotify($_POST["id"]);
		else echo false;
	}
	public function getAllNotify(){
		echo $this->homemodel->getAllNotify();
	}
	public function getNoteType(){
		if($_POST!=null){
			$query = $this->homemodel->getNoteType($_POST["id"]);
			$prob = $this->homemodel->getProb($query->prob);
			$query->level = $prob->level;
			echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}
	public function getAllNoteType(){
		echo $this->homemodel->getAllNoteType();
	}
	public function getReady(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getReady($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
	}

	public function getProb(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getProb($_POST["id"]), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
	}

	public function getAllReady(){
		echo $this->homemodel->getAllReady();
	}
	public function getMorning(){
		if($_POST!=null)
			echo $this->homemodel->getMorning($_POST["id"]);
		else echo false;
	}
	public function getAllMorning(){
		echo $this->homemodel->getAllMorning();
	}
	public function getStudent(){
		if($_POST!=null){
			$query = $this->homemodel->getStudent($_POST["id"]);
			$class = $this->homemodel->getClass($query->class);
			$grade = $this->homemodel->getGrade($class->grade);
			$query->level = $grade->level;
			$query->grade = $grade->id;
			echo json_encode($query, JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}
	public function getAllStudent(){
		echo $this->homemodel->getAllStudent();
	}
	public function getRole(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getRole($_POST["id"]),
					JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
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
		if($_POST!=null)
			echo json_encode($this->homemodel->getNote($_POST["id"]),
					JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
	}
	public function getAllNote(){
		echo $this->homemodel->getAllNote();

	}
	//get level grades json data type
	public function getLevelGrades(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_grades", array(
					"level"=>$_POST["level"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}
	//get grade classes json data type
	public function getGradeClasses(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_classes", array(
					"grade"=>$_POST["grade"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}
	//get grade subjects json data type
	public function getGradeSubjects(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_subjects", array(
					"grade"=>$_POST["grade"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get class students json data type
	public function getClassStudents(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_students", array(
					"class"=>$_POST["class"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get user students json data type
	public function getUserStudents(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_students", array(
					"username"=>$_POST["username"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get user actions json data type
	public function getUserActions(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_actions", array(
					"username"=>$_POST["username"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get user defaults json data type
	public function getUserDefaults(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_defaultnumemail", array(
					"username"=>$_POST["username"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get user permissions json data type
	public function getUserPermissions(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_permissions", array(
					"username"=>$_POST["username"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get user notes json data type
	public function getUserNotes(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_notes", array(
					"username"=>$_POST["username"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get student notes json data type
	public function getStudentNotes(){
		if($_POST!=null){
			$query = $this->db->get_where("ra_notes", array(
					"student"=>$_POST["student"]
			));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get users for validate inserting username in forms
	public function getUserNames(){
		if($_POST!=null){
			$this->db->select("username");
			$query = $this->db->get_where("ra_users", array("username" => $_POST["username"]));
			echo ($query->num_rows()>0)? "0":"1";
		}else echo false;
	}

	//get users for validate modifying username
	public function getUserModify(){
		if($_POST!=null){
			$this->db->select("username,id");
			$query = $this->db->get_where("ra_users", array("username" => $_POST["username"]));
			$user = $query->row();
			echo ($user->id != $_POST["id"])? "0":"1";
		}else echo false;
	}

	//get students for validate inserting student id number in forms
	public function getStudentId(){
		if($_POST!=null){
			$this->db->select("idnum");
			$query = $this->db->get_where("ra_students", array("idnum" => $_POST["idnum"]));
			echo ($query->num_rows()>0)? "0":"1";
		}else echo false;
	}

	//get level prob to add notetype
	public function getLevelProbs(){
		if($_POST!=null){
			$query = $this->db->get_where("notesprob", array("level" => $_POST["level"]));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get prob types to add note
	public function getProbTypes(){
		if($_POST!=null){
			$query = $this->db->get_where("notestypes", array("prob" => $_POST["prob"]));
			echo json_encode($query->result(), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		}else echo false;
	}

	//get class subjects
	public function getClassSubjects(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getClassSubjects($_POST["class"]), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
	}

	//get user class subjects
	public function getUserClassSubjects(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getUserClassSubjects(
					$this->session->userdata('id'),$_POST["class"]),
					JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
	}

	//get class probs
	public function getClassProbs(){
		if($_POST!=null)
			echo json_encode($this->homemodel->getClassProbs($_POST["class"]), JSON_HEX_TAG | JSON_HEX_APOS |
					JSON_HEX_QUOT | JSON_HEX_AMP );
		else echo false;
	}

}
