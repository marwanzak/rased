<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load("arabic", "arabic");
		
	}
	public function index()
	{
		$data = array(
				"levels" => $this->homemodel->getAllLevel(),
				"grades" => $this->homemodel->getAllGrade(),
				"classes" => $this->homemodel->getAllClass(),
				"subjects" => $this->homemodel->getAllSubject(),
				"users" => $this->homemodel->getAllUser(),
				"roles" => $this->homemodel->getAllRole()
				);
		$this->load->view('header');
		$this->load->view('body');
		$this->load->view('footer', $data);
		
	}
	
	//

}
