<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		$this->lang->load("arabic", "arabic");
	}
	public function index(){
		$this->load->view("user");
	}
	
	//check login validation username and password
	private function check_isvalidated(){
		if(! $this->session->userdata('validated')){
			redirect(base_url().'userlogin');
		}
	}
	
	//log out when user name press logout
	public function do_logout(){
		$this->session->sess_destroy();
		redirect(base_url().'userlogin');
	}

}