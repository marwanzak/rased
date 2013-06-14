<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load("arabic", "arabic");

	}
	public function index($table="")
	{
		if($table == "")
		{
			echo "wrong table";
			exit();
		}
		$this->load->view('header');
		$table_data = $this->getTable($table);
		$table_data["table"] = $table;
		$this->load->view('body',$table_data);
		$data = array(
				"levels" => $this->homemodel->getAllLevel(),
				"grades" => $this->homemodel->getAllGrade(),
				"classes" => $this->homemodel->getAllClass(),
				"subjects" => $this->homemodel->getAllSubject(),
				"users" => $this->homemodel->getAllUser(),
				"roles" => $this->homemodel->getAllRole()
		);
		$this->load->view('insert', $data);
		$this->load->view('modify');
		$this->load->view('footer');

	}

	//get table contents for the BIG SHOW!!
	public function getTable($table){
		$headings = array();
		$rows = array();
		$query = $this->db->get($table);
		
		switch($table){
			case "ra_levels":
				$headings = array(lang("level", lang("modify")));
				break;
			case "ra_grades":
				$headings = array(lang("level"),lang("grade"), lang("modify"));
				break;
			case "ra_classes":
				$headings = array(lang("level"),lang("grade"),lang("class"), lang("modify"));
				break;
			case "ra_students":
				$headings = array(lang("gaurd"),lang("fullname"),
				lang("idnum"),lang("level"),lang("grade"),lang("class"), lang("modify"));
				break;
			case "ra_users":
				$headings = array(lang("username"),lang("fullname"),
				lang("role"),lang("active"), lang("modify"),lang("send_code"));
				break;
			case "ra_actions":
				$headings = array(lang("username"),lang("action"),
				lang("datetime"),lang("type"));
				break;
			case "ra_defaultnumemail":
				$headings = array(lang("username"),lang("email")." 1",
				lang("email")." 2",lang("phone"). " 1", lang("phone"). " 2", lang("modify"));
				break;
			case "ra_notesprob":
				$headings = array(lang("level"),lang("type"), lang("modify"));
				break;
			case "ra_notestypes":
				$headings = array(lang("level"),lang("type"), lang("body"), lang("modify"));
				break;
			case "ra_readymessages":
				$headings = array(lang("message"), lang("modify"));
				break;
			case "ra_roles":
				$headings = array(lang("role"), lang("modify"));
				break;
			case "ra_subjects":
				$headings = array(lang("level"),
				lang("grade"), lang("subject"), lang("modify"));
				break;
			case "ra_notes":
				$headings = array(lang("type"), lang("student"), lang("subject"),
				lang("note"), lang("status"), lang("datetime"),
				lang("sold"), lang("agreed"), lang("username"));
				break;
			default:
				echo "wrong table";
				exit();
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
					$role = $this->homemodel->getRole($row->role);
					$active = ($row->active == "1")? "YES": "NO";
					$rows[$i] = array($row->id,$row->username,
							$row->name,$role->role,$active);
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
					$rows[$i] = array($row->id,$level->level, $row->prob);
					break;
				case "ra_notestypes":
					$type = $this->homemodel->getProb($row->prob);
					$level = $this->homemodel->getLevel($type->level);
					$rows[$i] = array($row->id,$level->level,
							$type->prob, $row->body);
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
				default:
					echo "wrong table";
					exit();
					break;
			}
			$i++;
		}
		return array("headings" => $headings, "rows" => $rows);
	}
	
	//delete rows from a table
	public function delete(){
		
	}


}
