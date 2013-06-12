$(document).ready(function(){

	//hide password modify div
	$(".hide_modify_password").on("click", function(){
		$(this).closest("div").hide();

	});
	//hide password div in users table
	$("#modify_user_dialog div").hide();
	//show password div to modify in users table
	$(".modify_password").on("click",function(){
		$(this).parent("div").find("div").find("form").find("input[name='id']").val(this.id);
		$(this).parent("div").find("div").show();
	});
	//put ast after required inputs.
	$($(".required"))
	.after("<label class = 'ast'>*</label>");
	//verify required select elements.
	$( "form" ).on( "submit", function( event ) {
		var sele = $(this).find("select");
		for(var u = 0; u<sele.length; u++)
		{
			if(sele[u].value == ""){
				alert("اختر المطلوب في القوائم");
				return false;
			}
		}
		var inputs = $(this).find("input,textarea");
		for(var i = 0; i<inputs.length; i++)
			if(inputs[i].className.match(/\brequired\b/))
				if(inputs[i].value == '')
				{
					inputs[i].className = "";				
					inputs[i].className += "required redalert";
					return false;
				}
				else
				{
					inputs[i].className = "";				
					inputs[i].className += "required greenalert";
				}
		var parent_id = $(this).parent().attr("id");
		$.ajax({
			url:$(this).attr("action"),
			type:"post",
			data:$(this).serialize()
		})
		.done(function(data){
			if(data=="1"){
				$("#"+parent_id).dialog("close");
				alert("تم الاضافة بنجاح");
			}
			else{alert("error occurred!");}
		});

		return false;
	});


	// make check all check box for tables.
	$("#container").on("click","#all_check",function(){
		if($(this).is(":checked"))
			$(".table_checks").prop("checked",true);
		else
			$(".table_checks").prop("checked",false);
	});

	//verfiy password and repassword inputs in user add form.
	$("#add_user_repassword").blur(function(){
		if(this.value!=$("#add_user_password").val())
			alert("كلمة المرور غير متطابقة");
		return false;
	});

	//verfiy password and repassword inputs in user add form.
	$("#add_user_password").blur(function(){
		var re = $("#add_user_repassword").val();
		if(re !="")
			if(this.value != $("#add_user_repassword").val())
				alert("كلمة المرور غير متطابقة");
		return false;
	});


	//validate username in forms
	$("#add_user_username").blur(function(){
		$.ajax({
			url:"/rased/get/getUserNames",
			data:{username:this.value},
			type:"POST"
		})
		.done(function(data){
			if(data == "0")
				$("#add_user_notify").text("اسم المستخدم موجود مسبقاً");
			else
				$("#add_user_notify").text("");
		});
		return false;
	});

	//validate username in forms
	$("#modify_user_username").blur(function(){
		$.ajax({
			url:"/rased/get/getUserModify",
			data:{username:this.value,id:$("#hidden_ra_users").val()},
			type:"POST"
		})
		.done(function(data){
			if(data == "0")
				$("#modify_user_notify").text("اسم المستخدم موجود مسبقاً");
			else
				$("#modify_user_notify").text("");
		});
		return false;
	});

	//validate id number for students
	$("input[name='idnum']").blur(function(){
		$.ajax({
			url:"/rased/get/getStudentId",
			data:{idnum:this.value},
			type:"POST"
		})
		.done(function(data){
			if(data == "0")
				alert("الرقم المدخل للطالب موجود مسبقاً")
		});
		return false;
	});

	//get grades and put them in grades select on level select changing.
	$(".levels_select").on("change",function(){
		getGrades(this.value);
	});

	//get classes and put them in classes select on grade select changing.
	$(".grades_select").on("change",function(){
		$.ajax({
			url:"/rased/get/getGradeClasses",
			dataType:"JSON",
			data:{grade:$(this).val()},
			type:"post"

		})
		.done(function(data){
			$(".classes_select").empty();
			$('<option/>').val('').html('اختر فصل').appendTo('.classes_select');
			for (var i = 0; i < data.length; i++) {
				$('<option/>').val(data[i].id).html(data[i].class).appendTo('.classes_select');
			}
		});
		return false;
	});

	//get students and put them in students select on class select changing.
	$(".classes_select").on("change",function(){
		$.ajax({
			url:"/rased/get/getClassStudents",
			dataType:"JSON",
			data:{class:$(this).val()},
			type:"post"

		})
		.done(function(data){
			$(".students_select").empty();
			$('<option/>').val('').html('اختر طالب').appendTo('.students_select');
			for (var i = 0; i < data.length; i++) {
				$('<option/>').val(data[i].id).html(data[i].fullname).appendTo('.students_select');
			}
		});
		return false;
	});


});
//function to make input text type only numbers.
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;

	return true;
}

//function to get grades belong to selected level in select drop
function getGrades(thislevel){
	$.ajax({
		url:"/rased/get/getLevelGrades",
		dataType:"JSON",
		data:{level:thislevel},
		type:"post",
		async:false
	})
	.done(function(data){
		$(".grades_select").empty();
		$('<option/>').val('').html('اختر الصف').appendTo('.grades_select');
		for (var i = 0; i < data.length; i++) {
			$('<option/>').val(data[i].id).html(data[i].grade).appendTo('.grades_select');
		}
	});
	return false;
}
