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
			case "ar_levels":
			$headings = array("level");
			break;	
			
		}
		foreach($query->result() as $row)
		switch($table){
			case "ar_levels":
				$rows = array($row->level);
				break;
		}
		$this->homemodel->array_print($headings);
		return array("headings" => $headings, "rows" => $rows);
		
	}
	
}