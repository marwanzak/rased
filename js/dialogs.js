$(document).ready(function(){
	//add dialogs
	$("#body_container").on("click", ".add_ra_levels",function(){
		$("#add_level_form").attr("action","/rased/insert/insertLevel");

		openDialog("add_level_dialog", 400);
	});

	$("#body_container").on("click", ".add_ra_grades",function(){
		$("#add_grade_dialog").attr("action","/rased/insert/insertGrade");

		openDialog("add_grade_dialog", 400);
	});

	$("#body_container").on("click", ".add_ra_classes",function(){
		$("#add_class_dialog").attr("action","/rased/insert/insertClass");

		openDialog("add_class_dialog", 400);
	});

	$("#body_container").on("click", ".add_ra_users",function(){
		$("#add_user_dialog").attr("action","/rased/insert/insertUser");

		openDialog("add_user_dialog", 400);
	});

	$("#body_container").on("click", ".add_ra_students",function(){
		$("#add_student_dialog").attr("action","/rased/insert/insertStudent");

		openDialog("add_student_dialog", 400);
	});

	$("#body_container").on("click", ".add_ra_defaultnumemail",function(){
		$("#add_def_dialog").attr("action","/rased/insert/insertDef");

		openDialog("add_def_dialog", 400);
	});

	$("#body_container").on("click", ".add_ra_notestypes",function(){
		$("#add_notetype_dialog").attr("action","/rased/insert/insertNoteType");

		openDialog("add_notetype_dialog", 400);
	});

	$("#body_container").on("click", ".add_ra_readymessages",function(){
		$("#add_ready_dialog").attr("action","/rased/insert/insertReady");

		openDialog("add_ready_dialog", 400);
	});

	$("#body_container").on("click", ".add_ra_roles",function(){
		$("#add_role_form").attr("action","/rased/insert/insertRole");

		openDialog("add_role_dialog", 400);
	});
	
	$("#body_container").on("click", ".add_ra_subjects",function(){
		$("#add_subject_form").attr("action","/rased/insert/insertSubject");

		openDialog("add_role_dialog", 400);
	});
	
	$("#body_container").on("click", ".add_ra_notesprob",function(){
		$("#add_prob_form").attr("action","/rased/insert/insertProb");

		openDialog("add_prob_dialog", 400);
	});
	
	$("#body_container").on("click", ".add_ra_notes",function(){

		openDialog("begin_notes_dialog", 400);
	});
	
	$("#add_user_dialog").on("click", "#user_classes_but", function(){
		
		openDialog("user_classes_dialog", 600);
	});
	
	$("#add_user_dialog").on("click", "#user_subjects_but", function(){
		
		openDialog("user_subjects_dialog", 600);
	});

	//modify dialogs
	//modify level
	$("#container").on("click", ".modify_ra_levels",function(){
		$("#hidden_ra_levels").val(this.id);
		$("#add_level_form").attr("action","/rased/modify/modifyLevel");
		$.ajax({
			url:"/rased/get/getLevel",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_level_input").val(data.level);
		});
		openDialog("add_level_dialog", 400);
	});
	//modify grade
	$("#container").on("click", ".modify_ra_grades",function(){
		$("#hidden_ra_grades").val(this.id);
		$("#add_grade_form").attr("action","/rased/modify/modifyGrade");
		$.ajax({
			url:"/rased/get/getGrade",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_grade_input").val(data.grade);
			$("#grade_levels").val(data.level).select();
		});
		openDialog("add_grade_dialog", 400);
	});
	//modify class
	$("#container").on("click", ".modify_ra_classes",function(){
		$("#hidden_ra_classes").val(this.id);
		$("#add_class_form").attr("action","/rased/modify/modifyClass");
		$.ajax({
			url:"/rased/get/getClass",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_class_input").val(data.class);
			$("#class_levels").val(data.level).select();
			getGrades(data.level);
			$("#class_grades").val(data.grade).select();
		});
		openDialog("add_class_dialog", 400);
	});
//modify user
	$("#container").on("click", ".modify_ra_users",function(){
		$("#hidden_ra_users").val(this.id);
		$(".modify_password").prop("id",this.id);
		$.ajax({
			url:"/rased/get/getUser",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#modify_user_username").val(data.username);
			$("#hidden_ra_users_username").val(data.username);
			$("#modify_user_name").val(data.name);
			$("#modify_user_roles").val(data.role).select();
			(data.active == "1")?$("#modify_user_active").prop("checked",true):$("#modify_user_inactive").prop("checked",true);
		});

		openDialog("modify_user_dialog", 400);
	});
	//modify subject
	$("#container").on("click", ".modify_ra_subjects",function(){
		$("#hidden_ra_subjects").val(this.id);
		$("#add_subject_form").attr("action","/rased/modify/modifySubject");
		$.ajax({
			url:"/rased/get/getSubject",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_subject_input").val(data.subject);
			$("#subject_levels").val(data.level).select();
			getGrades(data.level);
			$("#subject_grades").val(data.grade).select();
		});
		openDialog("add_subject_dialog", 400);
	});
//modify student
	$("#container").on("click", ".modify_ra_students",function(){
		$("#hidden_ra_students").val(this.id);
		$("#add_student_form").attr("action","/rased/modify/modifyStudent");
		$.ajax({
			url:"/rased/get/getStudent",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_student_users").val(data.username).select();
			$("#add_student_dialog input[name='idnum']").val(data.idnum);
			$("#add_student_levels").val(data.level).select();
			getGrades(data.level);
			$("#add_student_grades").val(data.grade).select();
			getClasses(data.grade);
			$("#add_student_classes").val(data.class).select();
			$("#add_student_dialog input[name='fullname']").val(data.fullname);


		});
		openDialog("add_student_dialog", 400);
	});
	//modify default numbers and emails for a user
	$("#container").on("click", ".modify_ra_defaultnumemail",function(){
		$("#hidden_ra_defaultnumemail").val(this.id);
		$("#add_def_form").attr("action","/rased/modify/modifyDef");
		$.ajax({
			url:"/rased/get/getDef",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_def_dialog input[name='number1']").val(data.number1);
			$("#add_def_dialog input[name='number2']").val(data.number2);
			$("#add_def_dialog input[name='email2']").val(data.email2);
			$("#add_def_dialog input[name='email1']").val(data.email1);
			$("#add_def_users").val(data.username).select();
		});
		openDialog("add_def_dialog", 400);
	});
	//modify note type
	$("#container").on("click", ".modify_ra_notestypes",function(){
		$("#hidden_ra_notestypes").val(this.id);
		$("#add_notetype_form").attr("action","/rased/modify/modifyNoteType");
		$.ajax({
			url:"/rased/get/getNoteType",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_notetype_levels").val(data.level).select();
			getProbs(data.level,"add_notetype_probs");
			$("#add_notetype_probs").val(data.prob).select();
			$("#add_notetype_dialog textarea[name='body']").val(data.body);


		});
		openDialog("add_notetype_dialog", 400);
	});

	$("#container").on("click", ".modify_ra_readymessages",function(){
		$("#hidden_ra_readymessages").val(this.id);
		$("#add_ready_form").attr("action","/rased/modify/modifyReady");
		$.ajax({
			url:"/rased/get/getReady",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_ready_dialog textarea[name='message']").val(data.message);
		});
		openDialog("add_ready_dialog", 400);
	});

	$("#container").on("click", ".modify_ra_roles",function(){
		$("#hidden_ra_roles").val(this.id);
		$("#add_role_form").attr("action","/rased/modify/modifyRole");
		$.ajax({
			url:"/rased/get/getRole",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_role_dialog input[name='role']").val(data.role);
		});
		openDialog("add_role_dialog", 400);
	});
	
	$("#container").on("click", ".modify_ra_notesprob",function(){
		$("#hidden_ra_notesprob").val(this.id);
		$("#add_prob_form").attr("action","/rased/modify/modifyProb");
		$.ajax({
			url:"/rased/get/getProb",
			data:{id:this.id},
			type:"post",
			dataType:"json"
		})
		.done(function(data){
			$("#add_notesprob_levels").val(data.level).select();
			$("#add_prob_dialog input[name='prob']").val(data.prob);

		});
		openDialog("add_prob_dialog", 400);
	});
	
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
	
	$("#user_classes_dialog input[type='button']").click(function(){
		var classes="";
		var classes_arr = $(".user_classes_checks:checked");
		for(var i=0; i<classes_arr.length;i++){
			classes = classes_arr[i].value+"--"+classes;
			}
		$("#add_user_form #user_classes_input").val(classes);
		$(this).parent().dialog("close");
	});
	
	$("#user_subjects_dialog input[type='button']").click(function(){
		var subjects="";
		var subjects_arr = $(".user_subjects_checks:checked");
		for(var i=0; i<subjects_arr.length;i++){
			subjects = subjects_arr[i].value+"--"+subjects;
			}
		$("#add_user_form #user_subjects_input").val(subjects);
		$(this).parent().dialog("close");
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