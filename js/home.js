$(document).ready(function(){
	
	//delete main table rows
	$("#confirm_delete_but").on("click", function(){
		$("#main_table_form").submit();
	});
		
	//hide password modify div
	$(".hide_modify_password").on("click", function(){
		$(this).closest("div").hide();
	});

	$(".togglecheck").click(function(){
		$(this).parent("label")
		.css({border: this.checked?"1px solid red":"1px solid green"});
	});
	//hide password div in users table
	$("#modify_user_dialog div").hide();
	//show password div to modify in users table
	$(".modify_password").on("click",function(){
		$(this).parent("div").find("div").find("form").find("input[name='password']").val("");
		$(this).parent("div").find("div").find("form").find("input[name='id']").val(this.id);
		$(this).parent("div").find("div").show();
		
	});
	
	//get probs on change level selector put them in probs selector
	//in notes begin add
	$("#begin_notes_levels").on("change", function(){
		$("#begin_notes_classes").empty();
		$('<option/>').val('').html('اختر الفصل').appendTo('#begin_notes_classes');
		$("#begin_notes_students").empty();
		$('<option/>').val('').html('اختر الطالب').appendTo('#begin_notes_students');
		$("#begin_notes_subjects").empty();
		$('<option/>').val('').html('اختر المادة').appendTo('#begin_notes_subjects');
		$("#begin_notes_types").empty();
		$('<option/>').val('').html('اختر بند الملاحظة').appendTo('#begin_notes_types');
		getProbs(this.value, "begin_notes_probs");
		return false;
	});
	
	//get subjects and notes probs when change classes select in begin notes dialog
	$("#begin_notes_classes").on("change", function(){
		$("#begin_notes_students").empty();
		$('<option/>').val('').html('اختر الطالب').appendTo('#begin_notes_students');
		$("#begin_notes_subjects").empty();
		$('<option/>').val('').html('اختر المادة').appendTo('#begin_notes_subjects');
		$("#begin_notes_types").empty();
		$('<option/>').val('').html('اختر بند الملاحظة').appendTo('#begin_notes_types');
		$("#begin_notes_probs").empty();
		$('<option/>').val('').html('اختر نوع الملاحظة').appendTo('#begin_notes_probs');
		$.ajax({
			url:"/rased/get/getClassSubjects",
			data:{"class":this.value},
			type:"POST",
			dataType:"JSON"
		})
		.done(function(data){
			$("#begin_notes_subjects").empty();
			$('<option/>').val('').html('اختر المادة').appendTo("#begin_notes_subjects");
			for (var i = 0; i < data.length; i++) {
				$('<option/>').val(data[i].id).html(data[i].subject).appendTo("#begin_notes_subjects");
			}
		});
		
		$.ajax({
			url:"/rased/get/getClassProbs",
			data:{"class":this.value},
			type:"POST",
			dataType:"JSON"
		})
		.done(function(data){
			$("#begin_notes_probs").empty();
			$('<option/>').val('').html('اختر نوع الملاحظة').appendTo("#begin_notes_probs");
			for (var i = 0; i < data.length; i++) {
				$('<option/>').val(data[i].id).html(data[i].prob).appendTo("#begin_notes_probs");
			}
		});
		getClassStudents(this.value, "#begin_notes_students");

		
	});
	//get types on change prob selector and put them in types selector
	$("#begin_notes_probs").on("change", function(){
		var notes_types = $(this).parent().parent().find("#begin_notes_types");
		getTypes(this.value, notes_types);
	});
	
	//get types on change prob selector and put them in types selector of notes add
	$(".notes_probs").on("change", function(){
		var notes_types = $(this).parent().parent().find(".types_select");
		getTypes(this.value, notes_types);
	});
	//put astrix after required inputs.
	//$($(".required"))
	//.after("<label class = 'ast'>*</label>");
	//verify required select elements.
	$( "form :not('#begin_notes_form')" ).on( "submit", function( event ) {
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

	// get grade subjects
	$(".grades_select").on("change", function(){
		var subjects_select = $(this).parent().parent().find(".subjects_select");
		subjects_select.empty();
		$('<option/>').val('').html('اختر المادة').appendTo(subjects_select);
		getSubjects(this.value, subjects_select);
	});
	// make check all check box for tables.
	$(".body").on("click","#all_check",function(){
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
		var gradeselect = $(".grades_select");
		getGrades(this.value,gradeselect);
	});

	//get classes and put them in classes select on grade select changing.
	$(".grades_select").on("change",function(){
		var classesselect = $(".classes_select");
		getClasses(this.value, classesselect);
	});

	//get students and put them in students select on class select changing.
	$(".classes_select").on("change",function(){
		//var studentsselect = $(this).parent().find(".students_select");
		//getClassStudents(this.value, studentsselect)
	});
	//get level probs for notestypes add and modify
	$("#add_notetype_levels").on("change", function(){
		var add_notetype_probs = $(this).parent().parent().find("#add_notetype_probs");
		getProbs(this.value,add_notetype_probs);
	});
	
	//get level probs for notestypes notes add
	$(".notes_levels").on("change", function(){
		var probs_select = $(this).parent().parent().find(".probs_select");
		getProbs(this.value,probs_select);
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
function getGrades(thislevel,gradesselect){
	$.ajax({
		url:"/rased/get/getLevelGrades",
		dataType:"JSON",
		data:{level:thislevel},
		type:"post",
		async:false
	})
	.done(function(data){
		$(gradesselect).empty();
		$('<option/>').val('').html('اختر الصف').appendTo(gradesselect);
		for (var i = 0; i < data.length; i++) {
			$('<option/>').val(data[i].id).html(data[i].grade).appendTo(gradesselect);
		}
	});
	return false;
}
//get grade classes
function getClasses(thisgrade, classesselect){
	$.ajax({
		url:"/rased/get/getGradeClasses",
		dataType:"JSON",
		data:{grade:thisgrade},
		type:"post",
		async:false

	})
	.done(function(data){
		$(classesselect).empty();
		$('<option/>').val('').html('اختر فصل').appendTo(classesselect);
		for (var i = 0; i < data.length; i++) {
			$('<option/>').val(data[i].id).html(data[i].class).appendTo(classesselect);
		}
	});
	return false;
}
//function to get level probs
function getProbs(thislevel,probselect){
	$.ajax({
		url:"/rased/get/getLevelProbs",
		dataType:"JSON",
		data:{level:thislevel},
		type:"post",
		async:false

	})
	.done(function(data){
		$(probselect).empty();
		$('<option/>').val('').html('اختر نوع الملاحظة').appendTo(probselect);
		for (var i = 0; i < data.length; i++) {
			$('<option/>').val(data[i].id).html(data[i].prob).appendTo(probselect);
		}
	});
	return false;
}

//function to get grade subjects
function getSubjects(thisgrade,subjectsselect){
	$.ajax({
		url:"/rased/get/getGradeSubjects",
		dataType:"JSON",
		data:{grade:thisgrade},
		type:"post",
		async:false

	})
	.done(function(data){
		$(subjectsselect).empty();
		$('<option/>').val('').html('اختر المادة').appendTo(subjectsselect);
		for (var i = 0; i < data.length; i++) {
			$('<option/>').val(data[i].id).html(data[i].subject).appendTo(subjectsselect);
		}
	});
	return false;
}

//function to get prob types
function getTypes(thisprob,typesselect){
	$.ajax({
		url:"/rased/get/getProbTypes",
		dataType:"JSON",
		data:{prob:thisprob},
		type:"post",
		async:false

	})
	.done(function(data){
		$(typesselect).empty();
		$('<option/>').val('').html('اختر بند الملاحظة').appendTo(typesselect);
		for (var i = 0; i < data.length; i++) {
			$('<option/>').val(data[i].id).html(data[i].body + " (" + data[i].sold + ")").appendTo(typesselect);
		}
	});
	return false;
}

function getClassStudents(thisclass, studentsselect){
	$.ajax({
		url:"/rased/get/getClassStudents",
		dataType:"JSON",
		data:{"class":thisclass},
		type:"post"

	})
	.done(function(data){
		$(studentsselect).empty();
		$('<option/>').val('').html('اختر طالب').appendTo(studentsselect);
		for (var i = 0; i < data.length; i++) {
			$('<option/>').val(data[i].id).html(data[i].fullname).appendTo(studentsselect);
		}
	});
	return false;
}

