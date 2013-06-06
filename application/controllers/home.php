<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load("arabic", "arabic");

	}
	public function index($table = "ra_grades")
	{
		$body = array();
		$query = "";
		$this->load->view('header');
		$table_data = $this->tablemodel->getTable($table);
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
		$query = $this->db->get($table);
		$list = $this->db->list_fields($table);
		$this->homemodel->array_print($list);
		$i = 0;
		$fields_array = array();
		foreach($list as $field){
			$fields_array[$i] = $field;
			$i++;
		}
		$this->homemodel->array_print($fields_array);
	}

}
