$(document).ready(function(){
	//add dialogs
	$("#container").on("click", ".add_ra_levels",function(){
		$("#add_level_form").attr("action","/rased/modify/insertLevel");

		openDialog("add_level_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_grades",function(){
		$("#add_level_form").attr("action","/rased/modify/insertGrade");

		openDialog("add_grade_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_classes",function(){
		$("#add_level_form").attr("action","/rased/modify/insertClass");

		openDialog("add_class_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_users",function(){
		$("#add_level_form").attr("action","/rased/modify/insertUser");

		openDialog("add_user_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_students",function(){
		$("#add_level_form").attr("action","/rased/modify/insertStudent");

		openDialog("add_student_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_defaultnumemail",function(){
		$("#add_level_form").attr("action","/rased/modify/insertDef");

		openDialog("add_def_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_notestypes",function(){
		$("#add_level_form").attr("action","/rased/modify/insertNoteType");

		openDialog("add_notetype_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_readymessages",function(){
		$("#add_level_form").attr("action","/rased/modify/insertReady");

		openDialog("add_ready_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_roles",function(){
		$("#add_level_form").attr("action","/rased/modify/modifyRole");

		openDialog("add_role_dialog", 400);
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
				});
		openDialog("add_class_dialog", 400);
	});
	
	$("#container").on("click", ".modify_ra_users",function(){
		openDialog("add_user_dialog", 400);
	});
	
	$("#container").on("click", ".modify_ra_students",function(){
		openDialog("add_student_dialog", 400);
	});
	
	$("#container").on("click", ".modify_ra_defaultnumemail",function(){
		openDialog("add_def_dialog", 400);
	});
	
	$("#container").on("click", ".modify_ra_notestypes",function(){
		openDialog("add_notetype_dialog", 400);
	});
	
	$("#container").on("click", ".modify_ra_readymessages",function(){
		openDialog("add_ready_dialog", 400);
	});
	
	$("#container").on("click", ".modify_ra_roles",function(){
		openDialog("add_role_dialog", 400);
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