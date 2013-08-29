<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Riyadh");
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
		$user_disagreed_notes = $this->homemodel->getClassDisagreedNotes($this->session->userdata("id"));
		$this->session->set_userdata('refered_from', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$table_permissions = $this->homemodel->checkSeePermissions($table);
		if($table_permissions==false)
			exit("no_permissions");
		$table1['table']=$table;
		$this->load->view('header');
		$this->load->view('top-nav', $table1);
		$this->load->view('menu-bar', $table1);
		$user_classes = $this->homemodel->getUserClasses(
				$this->session->userdata("id"), "array");
		$user_subjects = $this->homemodel->getUsersubjects(
				$this->session->userdata("id"), "array");
		$role_query = $this->db->get_where("users", array("id" => $this->session->userdata("id")));
		$role = $role_query->row();
		$permissions_query = $this->db->get_where("permissions", array("role" => $role->role ));
		$permissions = $permissions_query->row();

		if($table!="" && !$_POST){
			$table_data = $this->homemodel->getTable($table);
		}elseif($table!="" && $_POST["word"]!=null){
			$table_data = $this->homemodel->searchWord($table,$_POST['word']);
		}
		$table_data["table"] = $table;
		$table_data["permissions"] = $permissions;
		$table_data["disagreed_notes"] = $user_disagreed_notes;
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
				"prios" => $prio,
				"weekdays" => $this->homemodel->getWeekDays(),
				"orders" => $this->homemodel->getOrders()
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
		$table1['table']="showNotes";
		$this->load->view('header');
		$this->load->view('top-nav', $table1);
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

	//show roles permissions
	public function showPermissions(){
		$table1['table']="";
		$this->load->view('header');
		$this->load->view('top-nav',$table1);
		$this->load->view('menu-bar', $table1);
		$query = $this->db->get_where("permissions", array("role" => $_GET["id"]));
		$permissions = $query->row();
		$permissions_array = array(
				"ra_levels" => array(
						"level_see" =>	$permissions->level_see,
						"level_create" =>	$permissions->level_create,
						"level_modify" => $permissions->level_modify,
						"level_delete" => $permissions->level_delete
				),
				"ra_grades" => array(
						"grade_see" => $permissions->grade_see,
						"grade_create" => $permissions->grade_create,
						"grade_modify" => $permissions->grade_modify,
						"grade_delete" => $permissions->grade_delete
				),
				"ra_classes" => array(
						"class_see" => $permissions->class_see,
						"class_create" => $permissions->class_create,
						"class_modify" => $permissions->class_modify,
						"class_delete" => $permissions->class_delete
				),
				"ra_subjects" => array(
						"subject_see" => $permissions->subject_see,
						"subject_create" => $permissions->subject_create,
						"subject_modify" => $permissions->subject_modify,
						"subject_delete" => $permissions->subject_delete
				),
				"ra_students" => array(
						"student_see" => $permissions->student_see,
						"student_create" => $permissions->student_create,
						"student_modify" => $permissions->student_modify,
						"student_delete" => $permissions->student_delete
				),
				"ra_readymessages" => array(
						"ready_see" => $permissions->ready_see,
						"ready_create" => $permissions->ready_create,
						"ready_modify" => $permissions->ready_modify,
						"ready_delete" => $permissions->ready_delete
				),
				"ra_defaultnumemail" => array(
						"def_see" => $permissions->def_see,
						"def_create" => $permissions->def_create,
						"def_modify" => $permissions->def_modify,
						"def_delete" => $permissions->def_delete
				),
				"ra_notes" => array(
						"note_see" => $permissions->note_see,
						"note_create" => $permissions->note_create,
						"note_modify" => $permissions->note_modify,
						"note_delete" => $permissions->note_delete
				),
				"ra_notesprob" => array(
						"prob_see" => $permissions->prob_see,
						"prob_create" => $permissions->prob_create,
						"prob_modify" => $permissions->prob_modify,
						"prob_delete" => $permissions->prob_delete
				),
				"ra_notestypes" => array(
						"type_see" => $permissions->type_see,
						"type_create" => $permissions->type_create,
						"type_modify" => $permissions->type_modify,
						"type_delete" => $permissions->type_delete
				),
				"ra_roles" => array(
						"role_see" => $permissions->role_see,
						"role_create" => $permissions->role_create,
						"role_modify" => $permissions->role_modify,
						"role_delete" => $permissions->role_delete
				),
				"ra_users" => array(
						"user_see" => $permissions->user_see,
						"user_create" => $permissions->user_create,
						"user_modify" => $permissions->user_modify,
						"user_delete" => $permissions->user_delete
				),
				"ra_slider" => array(
						"slider_see" => $permissions->slider_see,
						"slider_insert" => $permissions->slider_insert,
						"slider_modify" => $permissions->slider_modify,
						"slider_delete" => $permissions->slider_delete
				),
				"ra_forms" => array(
						"forms_see" => $permissions->forms_see,
						"",
						"",
						"forms_delete" => $permissions->forms_delete
				),
				"ra_lessons" => array(
						"lessons_see" => $permissions->lessons_see,
						"",
						"lessons_modify"=>$permissions->lessons_modify,
						""
				),
				"sitesettings" => array(
						"sitesettings" => $permissions->sitesettings,
						"",
						"",
						""
				),
				"admin_login" => array(
						"admin_login" => $permissions->admin_login,
						"",
						"",
						""
				),
				"modify_agree" => array(
						"modify_agree" => $permissions->modify_agree,
						"",
						"",
						""
				)
		);
		$data = array(
				"id" => $_GET["id"],
				"permissions" => $permissions_array
		);

		$this->load->view("permissions", $data);
		$this->load->view("footer");
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
					if($table =="ra_roles"){
						$this->db->where("role", $check);
						$this->db->delete("ra_permissions");
					}
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

	//search word
	public function searchNotes(){
		$table1["table"]="search_note";
		$user = $this->session->userdata("id");
		$classes = $this->homemodel->getUserClasses($user, "array");
		$subjects = $this->homemodel->getUserSubjects($user, "array");
		$priority = $this->homemodel->getPriorities();
		$data = array(
				"classes" => $classes,
				"subjects" => $subjects,
				"priority" => $priority,
				"monthes" => $this->homemodel->getMonthes(),
				"days" => $this->homemodel->getDays()
		);
		$this->load->view('header');
		$this->load->view('top-nav', $table1);
		$this->load->view('menu-bar', $table1);
		$this->load->view("searchnotes", $data);
		$this->load->view("footer");
	}

	//show notes choosen in search notes page
	public function showSearchNotes(){
		if($_POST){
			foreach($_POST as $key => $value){
				if($value==""){
					unset($_POST[$key]);
				}
			}
			$table1['table']="ra_notes";
			$this->load->view('header');
			$this->load->view('top-nav', $table1);
			$this->load->view('menu-bar', $table1);
			$table_data = $this->homemodel->getTable("ra_notes", "1", $_POST);
			$table_data["print"]="1";
			$table_data["table"] = "ra_notes";
			$role_query = $this->db->get_where("users", array("id" => $this->session->userdata("id")));
			$role = $role_query->row();
			$permissions_query = $this->db->get_where("permissions", array("role" => $role->role ));
			$permissions = $permissions_query->row();
			$table_data["permissions"] = $permissions;
			$user_classes = $this->homemodel->getUserClasses(
					$this->session->userdata("id"), "array");
			$user_subjects = $this->homemodel->getUsersubjects(
					$this->session->userdata("id"), "array");
			$prio = $this->homemodel->getPriorities();
			$this->load->view('body',$table_data);
			$data = array(
					"levels" 		=> $this->homemodel->getAllLevel(),
					"grades" 		=> $this->homemodel->getAllGrade(),
					"classes" 		=> $this->homemodel->getAllClass(),
					"subjects" 		=> $this->homemodel->getAllSubject(),
					"users" 		=> $this->homemodel->getAllUser(),
					"roles" 		=> $this->homemodel->getAllRole(),
					"user_classes" 	=> $user_classes,
					"user_subjects" => $user_subjects,
					"settings" 		=> $this->homemodel->getSettings(),
					"days" 			=> $this->homemodel->getDays(),
					"monthes" 		=> $this->homemodel->getMonthes(),
					"prios" 		=> $prio
			);
			$this->load->view('insert', $data);
			$this->load->view('modify');
			$this->load->view('footer');
		}
	}

	//set notes page to print
	public function setNotesPage(){
		if($_POST){
			$data["notes"] = array();
			$subject=lang("without");
			foreach($_POST["checks"] as $id){
				$query = $this->db->get_where("notes", array("id" => $id));
				$note = $query->row();
				$student = $this->homemodel->getStudent($note->student);
				if(!isset($data["notes"][$note->student]))
					$data["notes"][$note->student]=array();
				if($note->subject!=0){
					$subject1 = $this->homemodel->getSubject($note->subject);
					$note->subject = $subject1->subject;
				}else{
					$note->subject = $subject;
				}
				array_push($data["notes"][$note->student],$note);
			}
			$this->load->view("notesprint", $data);
		}
	}

	//export to pdf
	public function exportPdf(){
		$stylesheet = file_get_contents(base_url().'css/style.css');
		$this->load->library("MPDF56/mpdf.php","UTF-8");
		$this->mpdf->SetDirectionality('rtl');
		$html = $_POST["page"];
		$html = str_replace("\\\"","\"",$html);
		$this->mpdf->useLang = true;
		$this->mpdf->WriteHTML($stylesheet,1);
		$this->mpdf->WriteHTML($html,2);
		$this->mpdf->Output();
		exit;
	}

	//insert site settings
	public function insertSiteSettings(){
		$data=array();
		$data = array("username"=>"","password"=>"","date"=>"","semester"=>"","sender"=>"","morning"=>"","user_lessons"=>"");
		$data["msg"]="";
		$data["message"]="";
		if($_POST!=null){
			$query = $this->homemodel->insertSettings($_POST["smsusername"],
					$_POST["smspassword"],$_POST["date"],$_POST["semester"],
					$_POST["sender"],$_POST["mobileactivate"],$_POST["morning"],$_POST["user_lessons"]);
			if($query==1){
				$data["msg"]=1;
			}else{
				$data["msg"]=-1;
				$data["message"]=lang("error");
			}
		}
		$set = $this->homemodel->getSettings();
		if($set!=false){
			$password = $this->homemodel->dePassword($set->smspassword, $set->smssalt);
			$data["username"] = $set->smsusername;
			$data["password"] = $password;
			$data["date"] = $set->date;
			$data["semester"] = $set->semester;
			$data["sender"] = $set->sendername;
			$data["mobileactivate"] = $set->mobileactivate;
			$data["morning"] = $set->morning;
			$data["user_lessons"] = $set->user_lessons;
		}
		$table1['table']="sitesettings";
		$this->load->view('header');
		$this->load->view('top-nav', $table1);
		$this->load->view('menu-bar', $table1);
		$this->load->view('settings',$data);
		$this->load->view('footer');
	}

	//show lessons
	public function showLessons(){
		$table1['table']="ra_lessons";
		$this->load->view('header');
		$this->load->view('top-nav', $table1);
		$this->load->view('menu-bar', $table1);
		$data["classes"] = $this->homemodel->getAllClass();
		$data["subjects"] = $this->homemodel->getAllSubject();
		if(isset($_POST["class"])){
			$query = $this->db->get_where("lessons",array("class"=>$_POST["class"]));
			$data["lessons"]= $query->result_array();
			$data["class_id"]=$_POST["class"];
		}
		if(isset($_POST["insert"])){
			$query = $this->db->get_where("lessons",array("class"=>$_POST["class"]));
			$insert=0;
			if($query->num_rows()==0)
				$insert=1;
			foreach($_POST["lessons"] as $key=>$lesson)
				foreach($lesson as $key1 => $value){
				if($insert==1)
					$this->homemodel->insertLesson(array(
							"class"=>$_POST["class"],
							"day"=>$key,
							"order"=>$key1,
							"subject"=>$value
					));
				else
					$this->homemodel->modifyLesson(array("class"=>$_POST["class"],
							"day"=>$key,
							"order"=>$key1
					),$value);
			}
			redirect(base_url()."admin/showLessons","refresh");
		}
		$this->load->view('admin-lessons',$data);
		$this->load->view('footer');
	}

	//upload slider picture
	public function showSlider(){
		$this->form_validation->set_message('numeric', lang('order_numeric'));
		$this->form_validation->set_rules('order', lang('order'), 'numeric');
		$this->session->set_userdata('refered_from', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$data["table"]="ra_slider";
		if(isset($_POST["upload"])){
			if ($this->form_validation->run() == FALSE)
			{
				$data["msg"]="-1";
				$data["message"]= validation_errors();
			}
			else
			{
				if($_FILES["picture"]["error"]>0){
					$data["msg"]="-1";
					$data["message"]=($_FILES["picture"]["error"]==4)?lang("enter_picture"):"";
				}
				else
				{
					$config['upload_path'] = './images/slider/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '100';
					$config['max_width']  = '300';
					$config['max_height']  = '300';
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload("picture")){
						$data["msg"]="-1";
						$data["message"]=$this->upload->display_errors();
					}else{
						$data["msg"] = "1";
						$upload_data=$this->upload->data();
						$this->homemodel->insertSlider(array(
								"picture"=>base_url()."images/slider/".$upload_data["file_name"],
								"url"=>($_POST["url"]=="")?"#":$_POST["url"],
								"order"=>($_POST["order"]!="")?$_POST["order"]:0
						));
					}
				}
			}
		}
		$data["sliders"] = $this->homemodel->getAllSlider();
		$this->load->view("admin-slider",$data);

	}

	//show users form to admin
	public function showForms(){
		$this->session->set_userdata('refered_from', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$data["forms"] = $this->homemodel->getAllForm();
		$data["table"] = "ra_forms";
		$this->load->view("admin-forms",$data);
	}

	//show user inbox
	public function showInbox(){
		$this->session->set_userdata('refered_from', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$data["messages"] = $this->homemodel->getUserUnreadInbox();
		$data["admin_messages"] = $this->homemodel->getAdminMessages("unread");
		$data["users"] = $this->homemodel->getAllUser();
		$data["method"] = "inbox";
		$data["table"] = "ra_inbox";
		$data["admin"] = 0;
		if(isset($_GET["username"]))
			if($_GET["username"]!=""){
			$messages = $this->homemodel->getConversation($_GET["username"],$this->session->userdata("id"));
			if(isset($_GET["show"]))
				if($_GET["show"]=="all"){
				//if(isset($_GET["admin"]))
			//	if($_GET["admin"]=="1"){
			//	$messages = $this->homemodel->getConversation($username,-1,1);
			//	$data["admin"]=1;
			//}else
			$messages = $this->homemodel->getConversation($_GET["username"],$this->session->userdata("id"),1);
			}
			if(isset($_GET["admin"]))
				if($_GET["admin"]==1){
				$data["admin"]=1;
				$messages = $this->homemodel->getConversation($_GET["username"],-1);
				if(isset($_GET["show"]))
					if($_GET["show"]=="all"){
					$messages = $this->homemodel->getConversation($_GET["username"],-1,1);
				}
			}
			$data["messages"] = $messages;
			$data["method"] = "conversation";
			$data["username"] = $_GET["username"];
		}
		$this->load->view("admin-inbox", $data);
	}

	//delete message from inbox
	public function deleteInboxMessage(){
		if($_GET!=null){
			$query = $this->homemodel->deleteInbox($_GET["message_id"]);
			if($query!=1){
				$this->session->set_userdata("msg","-1");
				$this->session->set_userdata("message",lang('error'));
				redirect($this->session->userdata("refered_from"),"refresh");
			}else{
				$this->session->set_userdata("msg","1");
				redirect($this->session->userdata("refered_from"),"refresh");
			}
		}
	}

	public function exportTable(){
		$table = $this->homemodel->getTableForFile($_POST["tbody"],$_POST["thead"]);
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		for($i=0;$i<count($table["thead"]);$i++){
			$this->excel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $table["thead"][$i]);
		}
		for($i=0;$i<count($table["tbody"]);$i++){
			for($j=0;$j<count($table["thead"]);$j++)
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow($j, $i+2, $table["tbody"][$i][$j]);
		}

		if($_POST["method"]=="excel2003"){
			$filename=$_POST["title"].".xls"; //save our workbook as this file name
			header("Content-Type: application/vnd.ms-excel");
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		}elseif($_POST["method"]=="excel2007"){
			$filename=$_POST["title"].".xlsx"; //save our workbook as this file name
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		}elseif($_POST["method"]=="pdf"){
			$html="<table colspan=3 style='border:1px solid black;'><thead><tr style='background-color:#ddd'>";
			foreach($table["thead"] as $field){
				$html.="<th><span lang='ar'>".$field."</span></th>";
			}
			$html.="</tr></thead>";
			$html.="<tbody>";
			foreach($table["tbody"] as $tr){
				$html.="<tr>";
				foreach($tr as $td){
					$html.="<td style='border:1px solid black;padding:10px;'><span lang='ar'>".$td."</span></td>";
				}
				$html.="</tr>";
			}
			$html.="</tbody></table>";
			$this->homemodel->exportPdf($html);
		}


		if($_POST["method"]!="pdf"){
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			$objWriter->save('php://output');
		}
	}

}
