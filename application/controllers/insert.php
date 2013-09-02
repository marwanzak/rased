<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class insert extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load("arabic", "arabic");
		$user = $this->session->userdata("id");
		$action = strtolower(str_replace("insert", "", $this->uri->segment(2)));
		$this->homemodel->insertAction(lang($action),lang("add"));

	}
	public function index()
	{

	}
	public function insertLevel(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('level', lang('choose_level'), 'required|is_unique[levels.level]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertLevel($_POST["level"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertGrade(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('grade', lang('choose_grade'), 'required|is_unique[grades.grade]');
		$this->form_validation->set_rules('level', lang('choose_level'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertGrade($_POST["grade"],$_POST["level"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertClass(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('class', lang('choose_class'), 'required|is_unique[classes.class]');
		$this->form_validation->set_rules('grade', lang('choose_grade'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertClass($_POST["grade"],$_POST["class"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertSubject(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('subject', lang('choose_subject'), 'required|is_unique[subjects.subject]');
		$this->form_validation->set_rules('grade', lang('choose_grade'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertSubject($_POST["grade"],$_POST["subject"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertUser(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('username', lang('choose_username'), 'required|is_unique[users.username]');
		$this->form_validation->set_rules('role', lang('choose_role'), 'required');
		$this->form_validation->set_rules('password', lang('enter_password'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertUser($_POST["username"], $_POST["password"],
					$_POST["name"],$_POST["role"],
					$_POST["active"], $_POST["classes"], $_POST["subjects"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertPermissions(){
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('username', lang('choose_username'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertPermissions($_POST["username"],
					$_POST["permissions"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertDef(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_message('valid_email', lang("valid_email"));
		$this->form_validation->set_rules('username', lang('enter_username'), 'required');
		$this->form_validation->set_rules('number1', lang('enter_number'), 'required|is_unique[defaultnumemail.number1]');
		$this->form_validation->set_rules('email1', lang('enter_email'), 'required|is_unique[defaultnumemail.email1]|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertDef($_POST["username"],
					$_POST["number1"],$_POST["number2"], $_POST["email1"], $_POST["email2"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertNotify(){
		$query = $this->homemodel->insertNotify($_POST["username"],
				$_POST["numbers"],$_POST["emails"],
				$_POST["datetime"], $_POST["message"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertNoteType(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_rules('pbob', lang('enter_prob'), 'required');
		$this->form_validation->set_rules('body', lang('enter_type'), 'required|is_unique[notestypes.body]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertNoteType($_POST["prob"],$_POST["sold"],$_POST["body"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertReady(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_rules('message', lang('enter_message'), 'required|is_unique[readymessages.message]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertReady($_POST["message"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertProb(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_rules('level', lang('choose_level'), 'required');
		$this->form_validation->set_rules('prob', lang('enter_prob'), 'required|is_unique[notesprob.prob]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertProb($_POST["level"],$_POST["prob"], $_POST["color"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertMorning(){
		$query = $this->homemodel->insertMorning($_POST["student"],
				$_POST["datetime"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertStudent(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_message('numeric', lang("number")."%s");
		$this->form_validation->set_rules('class', lang('choose_class'), 'required');
		$this->form_validation->set_rules('idnum', lang('enter_idnum'), 'required|is_unique[students.idnum]|numeric');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertStudent($_POST["username"],
					$_POST["fullname"],$_POST["class"], $_POST["idnum"],$_POST["finger"],$_POST["terminal_id"]);
			$this->session->set_userdata("msg",$query);
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertRole(){
		$this->form_validation->set_message('is_unique', " %s ".lang("exist"));
		$this->form_validation->set_message('required', "%s");
		$this->form_validation->set_rules('role', lang('enter_role'), 'required|is_unique[roles.role]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$query = $this->homemodel->insertRole($_POST["role"]);
			$this->session->set_userdata("msg",$query);
			$this->db->insert("permissions", array("role" => $query));
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}
	public function insertAction(){
		$query = $this->homemodel->insertAction($_POST["action"], $_POST["type"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertSettings(){
		$query = $this->homemodel->insertSettings($_POST["smsusername"],
				$_POST["smspassword"],$_POST["year"], $_POST["semester"],$_POST["sender"],$_POST["morning"]);
		$this->session->set_userdata("msg",$query);
		redirect($this->session->userdata("refered_from"),"refresh");
	}
	public function insertNote(){
		foreach($_POST["notescheck"] as $key => $check){
			if($check!="0")
				$query = $this->homemodel->insertNote($_POST["types"][$key],$check,
						$_POST["subjects"][$key], $_POST["notes"][$key],
						$_POST["status"][$key],$_POST["day"][$key], $_POST["month"][$key],
						$_POST["probs"][$key], "0", $_POST["priority"][$key]
				);
		}
		if(isset($query))
			$this->session->set_userdata("msg","1");
		else{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message", lang("note_insert_error"));
		}
		redirect($this->session->userdata("refered_from"),"refresh");
	}

	//insert lesson in db
	public function insertLesson(){
		$this->form_validation->set_message('required', lang('required')."%s");
		$this->form_validation->set_rules('day', lang('day'), 'required');
		$this->form_validation->set_rules('order', lang('order'), 'required');
		$this->form_validation->set_rules('subject', lang('subject'), 'required');
		$this->form_validation->set_rules('class', lang('class'), 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata("msg","-1");
			$this->session->set_userdata("message",validation_errors());
			redirect($this->session->userdata("refered_from"),"refresh");
		}
		else
		{
			$this->homemodel->insertLesson(array("day"=>$_POST["day"],"class"=>$_POST["class"],
					"subject"=>$_POST["subject"],"order"=>$_POST["order"]
			));
			$this->session->set_userdata("msg","1");
			redirect($this->session->userdata("refered_from"),"refresh");
		}
	}

	//inser message in user inbox
	public function insertInbox(){
		if($_POST){
			$this->form_validation->set_message('required', lang('required')."%s");
			$this->form_validation->set_rules('message', lang('enter_message'), 'required');
			if ($this->form_validation->run() == FALSE)
			{
				if(isset($_POST["refer"])){
					echo validation_errors();
				}else{
					$this->session->set_userdata("msg","-1");
					$this->session->set_userdata("message",validation_errors());
					redirect($this->session->userdata("refered_from"),"refresh");
				}
			}
			else
			{
				if($_POST["admin"]==1)
					$send = $this->homemodel->insertInbox(-1,$_POST["username"],$_POST["message"]);
				elseif($_POST["admin"]=="-1"){
					$this->homemodel->insertInbox($_POST["username"],-1,$_POST["message"]);
				}else
					$this->homemodel->insertInbox($this->session->userdata("id"),$_POST["username"],$_POST["message"]);
				$this->session->set_userdata("msg","1");
				if(isset($_POST["refer"])){
					echo $send;
				}else
					redirect($this->session->userdata("refered_from"),"refresh");
			}
		}
	}
}
