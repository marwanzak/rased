<?php
class tableModel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function getTable($table){
		$headings = array();
		$rows = array();
		$query = $this->db->get($table);
		switch($table){
			case "ra_levels":
				$headings = array("",lang("level"));
				break;
			case "ra_grades":
				$headings = array("",lang("level"),lang("grade"));
				break;
			case "ra_classes":
				$headings = array("",lang("level"),lang("grade"),lang("class"));
				break;
			case "ra_students":
				$headings = array("",lang("username"),lang("fullname"),lang("idnum"),lang("level"),lang("grade"),lang("class"));
				break;
			case "ra_users":
				$headings = array("",lang("username"),lang("fullname"),lang("role"),lang("active"));
				break;
			case "ra_actions":
				$headings = array("",lang("username"),lang("action"),lang("datetime"),lang("type"));
				break;
		}
		$i=0;
		foreach($query->result() as $row)
		{
			switch($table){
				case "ra_levels":
					$rows[$i] = array($i+1,$row->level);
					break;
				case "ra_grades":
					$level = $this->homemodel->getLevel($row->level);
					$rows[$i] = array($i+1,$level->level, $row->grade);
					break;
				case "ra_classes":
					$grade = $this->homemodel->getGrade($row->grade);
					$level = $this->homemodel->getLevel($grade->level);
					$rows[$i] = array($i+1,$level->level, $grade->grade,$row->class);
					break;
				case "ra_students":
					$username = $this->homemodel->getUser($row->username);
					$class = $this->homemodel->getClass($row->class);
					$grade = $this->homemodel->getGrade($class->grade);
					$level = $this->homemodel->getLevel($grade->level);
					$rows[$i] = array($i+1,$username->name,$row->fullname,$row->idnum,$level->level, $grade->grade,$class->class);
					break;
				case "ra_users":
					$role = $this->homemodel->getRole($row->role);
					$active = ($row->active == "1")? "YES": "NO";
					$rows[$i] = array($i+1,$row->username, $row->name,$role->role,$active);
					break;
					case "ra_actions":
						$username = $this->homemodel->getUser($row->username);
						$rows[$i] = array($i+1,$username->username, $row->action,$row->datetime,$row->type);
						break;
			}
			$i++;
		}
		return array("headings" => $headings, "rows" => $rows);

	}

}