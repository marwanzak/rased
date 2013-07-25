<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->lang->load("arabic", "arabic");
	}

	//check login validation username and password
	private function check_isvalidated(){
		if(! $this->session->userdata('validated')){
			redirect(base_url().'login');
		}
	}

	//log out when user name press logout
	public function do_logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}
	public function index($table="")
	{
		$this->session->set_userdata('refered_from', uri_string());

		$table1['table']=$table;
		$this->load->view('header');
		$this->load->view('top-nav');
		$this->load->view('menu-bar', $table1);
		$user_classes = $this->homemodel->getUserClasses(
				$this->session->userdata("id"), "array");
		$user_subjects = $this->homemodel->getUsersubjects(
				$this->session->userdata("id"), "array");


		if($table!="")
			$table_data = $this->getTable($table);
		$table_data["table"] = $table;
		$this->load->view('body',$table_data);
		$prio = $this->homemodel->getPriorities();
		$data = array(
				"levels" 	=> $this->homemodel->getAllLevel(),
				"grades" 	=> $this->homemodel->getAllGrade(),
				"classes" 	=> $this->homemodel->getAllClass(),
				"subjects" 	=> $this->homemodel->getAllSubject(),
				"users" 	=> $this->homemodel->getAllUser(),
				"roles" 	=> $this->homemodel->getAllRole(),
				"user_classes" => $user_classes,
				"user_subjects" => $user_subjects,
				"settings" => $this->homemodel->getSettings(),
				"days" => $this->homemodel->getDays(),
				"monthes" => $this->homemodel->getMonthes(),
				"prios" => $prio
		);
		$this->load->view('insert', $data);
		$this->load->view('modify');
		$this->load->view('footer');
	}

	//show notes to insert
	public function showNotes(){
		$monthes = $this->homemodel->getMonthes();
		$prios = $this->homemodel->getPriorities();
		$days = $this->homemodel->getDays();
		$table1['table']="";
		$this->load->view('header');
		$this->load->view('top-nav');
		$this->load->view('menu-bar', $table1);
		$students = $this->getNotes(array(
				"level" => '',
				"grade" => '',
				"class" => $_POST["class"],
				"student" => $_POST["student"]
		));
		$status = (isset($_POST["status"]))?"checked":"";
		//	$query = $this->db->get_where("grades", array("level" => $_POST['level']));
		//	$grades = $query->result();
		//	$query = $this->db->get_where("classes", array("grade" => $_POST["grade"]));
		//	$classes = $query->result();
		//$subjects = $this->homemodel->getUserClassSubjects($this->session->userdata("id"),$_POST["class"]);

		$types = $this->homemodel->getProbTypes($_POST["prob"]);
		//$query = $this->db->get_where("notestypes", array("prob" => $_POST["prob"]));
		//$types = $query->result();
		$data = array(
				"subject" => $_POST["subject"],
				"status" => $status,
				"month" => $_POST["month"],
				"day" => $_POST["day"],
				"prob" => $_POST["prob"],
				"type" => $_POST["type"],
				"note" => $_POST["note"],
				"days" => $days,
				"monthes" => $monthes,
				//			"level" => $_POST["level"],
				//			"grade" => $_POST["grade"],
				"class" => $_POST["class"],
				"students" => $students,
				//			"grades" => $grades,
				//			"classes" => $classes,
				//"subjects" => $subjects,
				//"probs" => $probs,
				"types" => $types,
				//"levels" 	=> $this->homemodel->getAllLevel(),
				"num" => $_POST["num"],
				"prio" => $_POST["priority"],
				"prios" => $prios
		);
		$this->load->view("notes", $data);
		$this->load->view("footer");

	}

	//get table contents for the BIG SHOW!!
	public function getTable($table){
		$headings = array();
		$rows = array();
		$query = $this->db->get($table);

		switch($table){
			case "ra_levels":
				$headings = array(lang("level", lang("actions")));
				break;
			case "ra_grades":
				$headings = array(lang("level"),lang("grade"), lang("actions"));
				break;
			case "ra_classes":
				$headings = array(lang("level"),lang("grade"),lang("class"), lang("actions"));
				break;
			case "ra_students":
				$headings = array(lang("gaurd"),lang("fullname"),
				lang("idnum"),lang("level"),lang("grade"),lang("class"), lang("actions"));
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
		$i=0;
		foreach($query->result() as $row)
		{
			switch($table){
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
					$rows[$i] = array($row->id,$username->username,$row->fullname,
							$row->idnum,$level->level,
							$grade->grade,$class->class);
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
					$date = $set->date."-الفصل:".$set->semester."-".$row->day."-".$row->month;
					$username = $this->homemodel->getUser($row->username);
					$status = ($row->status==1)?"<div style='color:red; font-weight:bold;'>".lang("continue")."</div>"
							:"<div style='color:green; font-weight:bold;'>".lang("solved")."</div>";
					$rows[$i] = array($row->id, $student->fullname, $class, $subject, $prob, $type,
							$status, $prio,
							$row->note, $row->sold, $username->name, $date,
							($row->agreed==1)?lang("yes"):lang("no"));
					break;
				default:
					echo lang("wrong_request");
					exit();
					break;
			}
			$i++;
		}
		return array("headings" => $headings, "rows" => $rows);
	}

	//delete rows from a table
	public function delete(){
		if(isset($_POST['checks'])){
			$table = $_POST['table'];
			$count =0;
			if(!empty($_POST['checks']))
			{
				foreach($_POST['checks'] as $check)
				{
					$this->db->where("id", $check);
					$delete = $this->db->delete($table);
					if($delete!="1")
						$count++;
				}
			}
			if($count==0){
				$this->session->set_userdata("msg","1");
			}else{
				$this->session->set_userdata("msg","-1");
				$this->session->set_userdata("message", lang("delete_error").": ".$count);
			}
		}else{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message", lang("no_select"));
		}
		redirect($this->session->userdata("refered_from"), 'refresh');
	}


	//get notes as the properities form begin notes form to insert.
	public function getNotes($atts = array()){
		$students = array();
		/*	$newatts = $atts;
		 foreach($atts as $key => $value)
		 {
		if($value == "")
			unset($atts[$key]);
		}*/
		if($atts["student"] == ""){
			if($atts["class"] != ""){
				$query = $this->db->get_where("students", array(
						"class" => $atts["class"]
				));

				if($query->num_rows()>0)
					foreach($query->result() as $student)
					array_push($students, $this->homemodel->getStudentTree($student->id));
			}
			else{
				if($atts["grade"] != ""){
					$query = $this->db->get_where("classes", array(
							"grade" => $atts["grade"]
					));

					if($query->num_rows()>0){
						foreach($query->result() as $class){
							$query = $this->db->get_where("students", array(
									"class" => $class->id
							));
							if($query->num_rows()>0)
								foreach($query->result() as $student){
								array_push($students, $this->homemodel->getStudentTree($student->id));
							}
						}
					}
				}
				else{
					if($atts["level"] != ""){
						$query = $this->db->get_where("grades", array(
								"level" => $atts["level"]
						));
						if($query->num_rows()>0)
							foreach($query->result() as $grade){
							$query = $this->db->get_where("classes", array(
									"grade" => $grade->id
							));
							if($query->num_rows()>0)
								foreach($query->result() as $class){
								$query = $this->db->get_where("students", array(
										"class" => $class->id
								));
								if($query->num_rows()>0)
									foreach($query->result() as $student){
									array_push($students, $this->homemodel->getStudentTree($student->id));
								}
							}
						}

					}
					else{
						$query = $this->homemodel->getAllStudent();
						foreach($query as $student){
							array_push($students, $this->homemodel->getStudentTree($student->id));
						}
					}
				}
			}
		}
		else{
			array_push($students, $this->homemodel->getStudentTree($atts["student"]));
		}
		return $students;
	}


}
