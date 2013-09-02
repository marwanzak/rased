<?php
class finger extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}


	//get data from odbc about morning presents of students
	public function getRemoteMorning(){
		$students = array();
		$settings = $this->homemodel->getSettings();
		$time = date("His",strtotime($settings->morning));
		$conn=odbc_connect('UNIS','','unisamho');
		$sql="SELECT * FROM tEnter";
		$rs=odbc_exec($conn,$sql);
		if(odbc_errormsg())
			return odbc_errormsg();
		while (odbc_fetch_row($rs))
		{
			if(odbc_result($rs,"L_UID")!=-1
					&& odbc_result($rs, "C_Date")==date("Ymd")
					&& odbc_result($rs, "C_Time")>$time){
				$student = $this->homemodel->getStudentByFinger(array(
						"terminal_id"=>odbc_result($rs, "L_TID"),
						"fingerprint"=>odbc_result($rs,"L_UID")
				));
				array_push($students,array("student_id"=>$student->id,
				"date"=>odbc_result($rs,"C_Date"),
				"time"=>odbc_result($rs, "C_Time")));
			}
		}
		if($this->checkMorningEntires()==0)
			foreach($students as $student)
			$this->db->insert("morning", array(
					"student"=>$student["student_id"],
					"date"=>$student["date"],
					"time"=>strtotime($student["time"])
			));
		if(count($students)>0)
			return $students;
		return false;
		odbc_close($conn);
	}

	//check if there are entries in database for this day
	public function checkMorningEntires(){
		$query = $this->db->get_where("morning", array("date"=>date("Ymd")));
		if($query->num_rows()>0)
			return 1;
		return 0;
	}
	
	//get morning presents for this day from database
	public function getMornings(){
		$query = $this->db->get_where("morning", array("date"=>date("Ymd")));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	 
	//get all morning presents of a day from database
	public function getDayMornings($date){
		$query = $this->db->get_where("morning", array("date"=>$date));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}


}