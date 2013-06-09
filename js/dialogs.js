$(document).ready(function(){
	$("#container").on("click", ".add_ra_levels",function(){
		openDialog("add_level_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_grades",function(){
		openDialog("add_grade_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_classes",function(){
		openDialog("add_class_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_users",function(){
		openDialog("add_user_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_students",function(){
		openDialog("add_student_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_defaultnumemail",function(){
		openDialog("add_def_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_notestypes",function(){
		openDialog("add_notetype_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_readymessages",function(){
		openDialog("add_ready_dialog", 400);
	});
	
	$("#container").on("click", ".add_ra_roles",function(){
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