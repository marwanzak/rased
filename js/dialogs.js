var base_url = "http://localhost/rased/";

$(document).ready(function(){
	// add dialogs
	$(".body").on("click", ".add_ra_levels",function(){
		$("#add_level_form").attr("action",base_url+"insert/insertLevel");
	});
	
	$(".body").on("click", "#add_ra_slider",function(){
		$("#add_new_slide_form").attr("action",base_url+"admin/showSlider");
		$("#add_slide_div").show();

	});	
	
	$(".body").on("click", ".add_ra_lessons",function(){
		$("#add_lesson_form").attr("action",base_url+"insert/insertLesson");
	});

	$(".body").on("click", ".add_ra_grades",function(){
		$("#add_grade_form").attr("action",base_url+"insert/insertGrade");
	});

	$(".body").on("click", ".add_ra_classes",function(){
		$("#add_class_form").attr("action",base_url+"insert/insertClass");
	});

	$(".body").on("click", ".add_ra_users",function(){
		$("#add_user_form").attr("action",base_url+"insert/insertUser");
		$("#password_container").show();
	});

	$(".body").on("click", ".add_ra_students",function(){
		$("#add_student_form").attr("action",base_url+"insert/insertStudent");
	});

	$(".body").on("click", ".add_ra_defaultnumemail",function(){
		$("#add_def_form").attr("action",base_url+"insert/insertDef");
	});

	$(".body").on("click", ".add_ra_notestypes",function(){
		$("#add_notetype_form").attr("action",base_url+"insert/insertNoteType");
	});

	$(".body").on("click", ".add_ra_readymessages",function(){
		$("#add_ready_form").attr("action",base_url+"insert/insertReady");
	});

	$(".body").on("click", ".add_ra_roles",function(){
		$("#add_role_form").attr("action",base_url+"insert/insertRole");
	});

	$(".body").on("click", ".add_ra_subjects",function(){
		$("#add_subject_form").attr("action",base_url+"insert/insertSubject");
	});

	$(".body").on("click", ".add_ra_notesprob",function(){
		$("#add_prob_form").attr("action",base_url+"insert/insertProb");
	});

	$(".body").on("click", ".add_ra_notes",function(){
		$("#begin_notes_form input[name=num]").parent().parent().show();
		$("#begin_notes_form").attr("action",base_url+"admin/showNotes");
	});

	$("#add_ra_users_dialog").on("click", "#user_classes_but", function(){

	});

	$("#add_ra_users_dialog").on("click", "#user_subjects_but", function(){

	});


	// modify dialogs
	// modify level
	$(".body").on("click", ".modify_ra_levels",function(){
		$("#hidden_ra_levels").val(this.id);
		$("#add_level_form").attr("action",base_url+"modify/modifyLevel");
		$.ajax({
			url:base_url+"get/getLevel",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_level_input").val(data.level);
		});

	});
	// modify grade
	$(".body").on("click", ".modify_ra_grades",function(){
		$("#hidden_ra_grades").val(this.id);
		$("#add_grade_form").attr("action",base_url+"modify/modifyGrade");
		$.ajax({
			url:base_url+"get/getGrade",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_grade_input").val(data.grade);
			$("#grade_levels").val(data.level).select();
		});
	});
	// modify class
	$(".body").on("click", ".modify_ra_classes",function(){
		$("#hidden_ra_classes").val(this.id);
		$("#add_class_form").attr("action",base_url+"modify/modifyClass");
		$.ajax({
			url:base_url+"get/getClass",
			data:{id:this.id},
			type:"post",
			dataType:"json",
			async:false
		})
		.done(function(data){
			$("#add_class_input").val(data.class);
			$("#class_levels").val(data.level).select();
			getGrades(data.level,"#class_grades");
			$("#class_grades").val(data.grade).select();
		});
	});
//	modify user
	$(".body").on("click", ".modify_ra_users",function(){
		$("#hidden_ra_users").val(this.id);
		$("#add_user_form").attr("action",base_url+"modify/modifyUser");
		$(".modify_password").attr("id",this.id);
		$.ajax({
			url:base_url+"get/getUser",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#password_container").hide();
			$("#add_user_username").val(data.username);
			$("#hidden_ra_users_username").val(data.username);
			$("#add_user_name").val(data.name);
			$("#add_user_roles").val(data.role).select();
			if(data.active == "1"){
				$("#user_active_radio").prop("checked",true);
				$("#user_active_radio").parent().addClass("checked");
				$("#user_inactive_radio").parent().removeClass("checked");
			}else{
				$("#user_inactive_radio").prop("checked",true);
				$("#user_inactive_radio").parent().addClass("checked");
				$("#user_active_radio").parent().removeClass("checked");
			}
			$("#hidden_user_classes").val(data.classes);
			$("#hidden_user_subjects").val(data.subjects);
			var sub_array = strToArray(data.subjects);
			var sub_checks = $(".user_subjects_checks");
			
			for(var i=0;i<sub_checks.length;i++){
				for(var j=0; j<sub_array.length; j++){
					sub_checks[i].checked=false;
					sub_checks[i].parentNode.className="";					
					if(sub_checks[i].value==sub_array[j]){
						sub_checks[i].checked=true;
						sub_checks[i].parentNode.className="checked";
						break;
					}
				}
			}
			
			var class_array = strToArray(data.classes);
			var class_checks = $(".user_classes_checks");
			
			for(var i=0;i<class_checks.length;i++){
				for(var j=0; j<class_array.length; j++){
					class_checks[i].checked=false;
					class_checks[i].parentNode.className="";					
					if(class_checks[i].value==class_array[j]){
						class_checks[i].checked=true;
						class_checks[i].parentNode.className="checked";
						break;
					}
				}
			}
		});

	});
	
	//modify user password
	$(".body").on("click", ".modify_user_password_but", function(){
		$("#hidden_user_password_id").val(this.id);
	});

	// modify subject
	$(".body").on("click", ".modify_ra_subjects",function(){
		$("#hidden_ra_subjects").val(this.id);
		$("#add_subject_form").attr("action",base_url+"modify/modifySubject");
		$.ajax({
			url:base_url+"get/getSubject",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_subject_input").val(data.subject);
			$("#subject_levels").val(data.level).select();
			getGrades(data.level,"#subject_grades");
			$("#subject_grades").val(data.grade).select();
		});
	});
	
	// modify slider
	$(".body").on("click", ".modify_ra_slider",function(){
		$("#add_new_slide_form input[name=id]").val(this.id);
		$("#add_slide_div").hide();
		$("#add_new_slide_form").attr("action",base_url+"modify/modifySlider");
		$.ajax({
			url:base_url+"get/getSlider",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_new_slide_form input[name=url]").val(data.url);
			$("#add_new_slide_form input[name=order]").val(data.order);
		});
	});
	
	
//	modify student
	$(".body").on("click", ".modify_ra_students",function(){
		$("#hidden_ra_students").val(this.id);
		$("#add_student_form").attr("action",base_url+"modify/modifyStudent");
		$.ajax({
			url:base_url+"get/getStudent",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_student_users").val(data.username).select();
			$("#add_ra_students_dialog input[name='idnum']").val(data.idnum);
			$("#add_student_levels").val(data.level).select();
			getGrades(data.level, ".grades_select");
			$("#add_student_grades").val(data.grade).select();
			getClasses(data.grade,".classes_select");
			$("#add_student_classes").val(data.class).select();
			$("#add_ra_students_dialog input[name='fullname']").val(data.fullname);
			$("#add_ra_students_dialog input[name='finger']").val(data.fingerprint);


		});
	});
	// modify default numbers and emails for a user
	$(".body").on("click", ".modify_ra_defaultnumemail",function(){
		$("#hidden_ra_defaultnumemail").val(this.id);
		$("#add_def_form").attr("action",base_url+"modify/modifyDef");
		$.ajax({
			url:base_url+"get/getDef",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_def_form input[name='number1']").val(data.number1);
			$("#add_def_form input[name='number2']").val(data.number2);
			$("#add_def_form input[name='email2']").val(data.email2);
			$("#add_def_form input[name='email1']").val(data.email1);
			$("#add_def_users").val(data.username).select();
		});
	});
	// modify note type
	$(".body").on("click", ".modify_ra_notestypes",function(){
		$("#hidden_ra_notestypes").val(this.id);
		$("#add_notetype_form").attr("action",base_url+"modify/modifyNoteType");
		$.ajax({
			url:base_url+"get/getNoteType",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_notetype_levels").val(data.level).select();
			getProbs(data.level,"#add_notetype_probs");
			$("#add_notetype_probs").val(data.prob).select();
			$("#add_ra_notestypes_dialog input[name='body']").val(data.body);
			$("#add_ra_notestypes_dialog input[name='sold']").val(data.sold);


		});
	});
	
	//modify note
	$(".body").on("click", ".modify_ra_notes",function(){
		$("#begin_notes_form input[name=num]").parent().parent().hide();
		$("#hidden_ra_notes").val(this.id);
		$("#begin_notes_form").attr("action",base_url+"modify/modifyNote");
		$.ajax({
			url:base_url+"get/getNote",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#begin_notes_form select[name=priority]").val(data.priority).select();				
			$("#begin_notes_classes").val(data.class).select();
			getClassStudents(data.class, $("#begin_notes_students"));
			$("#begin_notes_students").val(data.student).select();
			getUserClassSubjects(data.class, $("#begin_notes_subjects"));
			$("#begin_notes_subjects").val(data.subject).select();
			getClassProbs(data.class, $("#begin_notes_probs"));
			$("#begin_notes_probs").val(data.prob).select();	
			getTypes(data.prob, $("#begin_notes_types"));
			$("#begin_notes_types").val(data.type).select();
			$("#begin_notes_form select[name=month]").val(data.month).select();
			$("#begin_notes_form select[name=day]").val(data.day).select();
			$("#begin_notes_form textarea[name=note]").val(data.note);
			if(data.status==1){
				$("#begin_notes_form #begin_status").addClass("active");
				$("#begin_notes_form #begin_status").val("مستمرة");
				$("#begin_notes_form input[name=status]").prop("checked",true);
			}else{
				$("#begin_notes_form #begin_status").removeClass("active");
				$("#begin_notes_form #begin_status").val("تم حلها");
				$("#begin_notes_form input[name=status]").prop("checked",false);				
			}
			
			
		});
	});	

	//modify ready message
	$(".body").on("click", ".modify_ra_readymessages",function(){
		$("#hidden_ra_readymessages").val(this.id);
		$("#add_ready_form").attr("action",base_url+"modify/modifyReady");
		$.ajax({
			url:base_url+"get/getReady",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_ra_readymessages_dialog textarea[name='message']").val(data.message);
		});
	})
	
	//modify lesson
		//modify ready message
	$(".body").on("click", ".modify_ra_lessons",function(){
		$("#hidden_ra_lessons").val(this.id);
		$("#add_lesson_form").attr("action",base_url+"modify/modifyLesson");
		$.ajax({
			url:base_url+"get/getLesson",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_ra_lessons_dialog select[name=day]").val(data.day).select();
			$("#add_ra_lessons_dialog select[name=class]").val(data.class).select();
			$("#add_ra_lessons_dialog select[name=subject]").val(data.subject).select();
			$("#add_ra_lessons_dialog select[name=order]").val(data.order).select();
		});
	});

	//modify role
	$(".body").on("click", ".modify_ra_roles",function(){
		$("#hidden_ra_roles").val(this.id);
		$("#add_role_form").attr("action",base_url+"modify/modifyRole");
		$.ajax({
			url:base_url+"get/getRole",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_ra_roles_dialog input[name='role']").val(data.role);
		});
	});

	//modify note prob
	$(".body").on("click", ".modify_ra_notesprob",function(){
		$("#hidden_ra_notesprob").val(this.id);
		$("#add_prob_form").attr("action",base_url+"modify/modifyProb");
		$.ajax({
			url:base_url+"get/getProb",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_notesprob_levels").val(data.level).select();
			$("#add_ra_notesprob_dialog input[name='prob']").val(data.prob);
			$("#add_ra_notesprob_dialog input[name='color']").val(data.color);

		});
	});
	
	//check all checks in table
	$("#user_classes_all_check").on("click",function(){
		if($(this).is(":checked"))
			$(this).parent().find(".user_classes_checks").prop("checked",true);
		else
			$(this).parent().find(".user_classes_checks").prop("checked",false);
	});

	$("#user_subjects_all_check").on("click",function(){
		if($(this).is(":checked"))
			$(this).parent().find(".user_subjects_checks").prop("checked",true);
		else
			$(this).parent().find(".user_subjects_checks").prop("checked",false);
	});

	$("#user_classes_ok").click(function(){
		var classes="";
		var classes_arr = $(".user_classes_checks:checked");
		for(var i=0; i<classes_arr.length;i++){
			classes += "--"+classes_arr[i].value;
		}
		$("#hidden_user_classes").val(classes);
	});

	$("#user_subjects_ok").click(function(){
		var subjects="";
		var subjects_arr = $(".user_subjects_checks:checked");
		for(var i=0; i<subjects_arr.length;i++){
			subjects +=  "--" + subjects_arr[i].value;
		}
		$("#hidden_user_subjects").val(subjects);
	});

});
//open dialog function.
function openDialog(dialog,dwidth){
	$( "#"+dialog ).dialog({ autoOpen: false, draggable: true,
		modal: true, resizable: false,
		show: { effect: 'drop', direction: "up" } ,
		width: dwidth } );	
	$("#"+dialog).dialog("open");
}

function strToArray(str){
	var new_array = str.split("--");
	return new_array;
}