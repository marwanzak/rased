<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('body');
		$this->load->view('footer');
		
	}
	
	//

}
