var base_url = "http://localhost/rased/";
$(document).ready(function() {
	$("#loader_div").hide();
	$(document).ajaxStart(function(){
		$(".loader_div").show();
	});
	$(document).ajaxStop(function(){
		$(".loader_div").hide();
	});
	$("#email_method_smtp").on("click", function(){
		$("#email_settings_div").show();
	});
	$("#email_method_php").on("click", function(){
		$("#email_settings_div").hide();
	});
	
	$("#export_table_form").on("submit", function(){
		var thead = $("div#table_for_print thead tr th");
		var tbody_tr = $("div#table_for_print tbody tr");
		var tbody_td = $("div#table_for_print tbody tr td");
		var thead_array = new Array();
		var tbody_array = new Array();
		for(var i=1;i<thead.length;i++){
			thead_array.push(thead[i].innerHTML);
		}
			for(var k=0;k<tbody_td.length;k++){
				if(tbody_td[k].innerHTML.search("<")==-1)
				tbody_array.push(tbody_td[k].innerHTML);
			}
		thead_array = JSON.stringify(thead_array);
		tbody_array = JSON.stringify(tbody_array);
		$(this).find("textarea[name=tbody]")
		.val(tbody_array);
		$(this).find("textarea[name=thead]")
		.val(thead_array);
	});
	
	$("#table_pdf_export_but").on('click', function(){
		$("#export_table_form input[name=method]").val("pdf");
		$("#export_table_form").submit();
	});
	$("#table_excel2003_export_but").on('click', function(){
		$("#export_table_form input[name=method]").val("excel2003");
		$("#export_table_form").submit();

	});
	$("#table_excel2007_export_but").on('click', function(){
		$("#export_table_form input[name=method]").val("excel2007");
		$("#export_table_form").submit();

	});
	
	$(".permission_row_check").on("click", function(){
		if($(this).is(":checked")){
			$(this).parent().parent().parent().parent().find(".permissions_checks").prop("checked", true);
			$(this).parent().parent().parent().parent().find(".permissions_checks").parent().addClass("checked");
		}else{
			$(this).parent().parent().parent().parent().find(".permissions_checks").prop("checked", false);
			$(this).parent().parent().parent().parent().find(".permissions_checks").parent().removeClass("checked");
		}

	});
	
	$(".message-img").on("click", function(){
		var this_id = this.id;
		$.ajax({
			url:base_url+"modify/readMessage",
			data:{"message_id":this.id},
			type:"post",
		}).done(function(data){
				if(data!=1){
					alert("حدث خطأ أثناء تعديل وضعية قراءة الرسالة");
				return;
				}
				else if(data==1){
					$(".timeline-messages .message #"+this_id).removeClass("icon-eye-open");
					$(".timeline-messages .message #"+this_id).addClass("icon-ok");
					return;
				}
			
		});
	});
	
	$(".report_pdf_but").on("click", function(){
		$("#hidden_pdf_content").val($(this).parent().parent().find(".table_div_print").html());
		$("#report_pdf_form").submit();
	});
	
	$("#main_check_all").on("click", function(){
		if($(this).is(":checked")){
			$(".table_checks").prop("checked", true);
			$(".table_checks").parent().addClass("checked");
		}else{
			$(".table_checks").prop("checked", false);
			$(".table_checks").parent().removeClass("checked");
		}
	});
	
	$("#set_print_notes").on("click", function(){
		$("#main_table_form").attr("action", base_url+"admin/setNotesPage");
		$("#main_table_form").attr("target", "_blank");
		$("#main_table_form").submit();
		$("#main_table_form").attr("action", base_url+"admin/delete");
		$("#main_table_form").attr("target", "");

	});

	$(".search_agree").on("click", function(){
		if ($(this).parent().find("input[type=checkbox]").is(":checked")) {
			$(this).parent().find("input[type=checkbox]").prop("checked", false);
			$(this).val("غير موافق");
		} else {
			$(this).parent().find("input[type=checkbox]").prop("checked", true);
			$(this).val("تم الموافقة");
		}
	});

	$("#search_notes_classes").on("change", function(){
		$("#search_notes_students").empty();
		$('<option/>').val('').html('اختر الطالب').appendTo(
		'#search_notes_students');
		$("#begin_notes_subjects").empty();
		$('<option/>').val('').html('اختر المادة').appendTo(
		'#search_notes_subjects');
		$("#search_notes_types").empty();
		$('<option/>').val('').html('اختر بند الملاحظة')
		.appendTo('#search_notes_types');
		$("#search_notes_probs").empty();
		$('<option/>').val('').html('اختر نوع الملاحظة')
		.appendTo('#search_notes_probs');
		getClassStudents(this.value, "#search_notes_students");
		getUserClassSubjects(this.value, "#search_notes_subjects");
		getClassProbs(this.value, "#search_notes_probs");

	});

	$("#notes_check_all").click(function() {
		if ($(this).is(":checked")) {
			$(".notes_check").prop("checked", true);
		} else {
			$(".notes_check").prop("checked", false);
		}

	});
	$(".status-btn").on("click", function() {
		if ($(this).parent().find("input[type=checkbox]").is(":checked")) {
			$(this).parent().find("input[type=checkbox]").prop("checked", false);
			$(this).val("تم حلها");
		} else {
			$(this).parent().find("input[type=checkbox]").prop( "checked", true);
			$(this).val("مستمرة");
		}

	});

	$(".modify_agree").on("click", function() {
		if ($(this).parent().find("input[type=checkbox]").is(":checked")) {
			$(this).parent().find("input[type=checkbox]").prop("checked", false);
			$(this).val("غير موافق");
			modifyAgree(this.id, 0);
		} else {
			$(this).parent().find("input[type=checkbox]").prop("checked", true);
			$(this).val("تم الموافقة");
			modifyAgree(this.id, 1);

		}

	});
	// delete main table rows
	$("#confirm_delete_but").on("click", function() {
		$("#main_table_form").submit();
	});

	// hide password modify div
	$(".hide_modify_password").on("click", function() {
		$(this).closest("div").hide();
	});

	$(".togglecheck").click(function() {
		$(this).parent("label").css({
			border : this.checked ? "1px solid red" : "1px solid green"
		});
	});
	// hide password div in users table
	$("#modify_user_dialog div").hide();
	// show password div to modify in users table
	$(".modify_password").on(
			"click",
			function() {
				$(this).parent("div").find("div").find("form").find(
				"input[name='password']").val("");
				$(this).parent("div").find("div").find("form").find(
				"input[name='id']").val(this.id);
				$(this).parent("div").find("div").show();

			});

	// get probs on change level selector put them in probs selector
	// in notes begin add
	$("#begin_notes_levels").on("change",
			function() {
		$("#begin_notes_classes").empty();
		$('<option/>').val('').html('اختر الفصل').appendTo(
		'#begin_notes_classes');
		$("#begin_notes_students").empty();
		$('<option/>').val('').html('اختر الطالب').appendTo(
		'#begin_notes_students');
		$("#begin_notes_subjects").empty();
		$('<option/>').val('').html('اختر المادة').appendTo(
		'#begin_notes_subjects');
		$("#begin_notes_types").empty();
		$('<option/>').val('').html('اختر بند الملاحظة')
		.appendTo('#begin_notes_types');
		getProbs(this.value, "begin_notes_probs");
		return false;
	});

	// get subjects and notes probs when change classes select in begin
	// notes dialog
	$("#begin_notes_classes").on(
			"change",
			function() {
				$("#begin_notes_students").empty();
				$('<option/>').val('').html('اختر الطالب').appendTo(
				'#begin_notes_students');
				$("#begin_notes_subjects").empty();
				$('<option/>').val('').html('اختر المادة').appendTo(
				'#begin_notes_subjects');
				$("#begin_notes_types").empty();
				$('<option/>').val('').html('اختر بند الملاحظة')
				.appendTo('#begin_notes_types');
				$("#begin_notes_probs").empty();
				$('<option/>').val('').html('اختر نوع الملاحظة')
				.appendTo('#begin_notes_probs');
				$.ajax({
					url : "/rased/get/getUserClassSubjects",
					data : {
						"class" : this.value
					},
					type : "POST",
					dataType : "JSON"
				}).done(
						function(data) {
							$("#begin_notes_subjects").empty();
							$('<option/>').val('').html('اختر المادة')
							.appendTo("#begin_notes_subjects");
							for ( var i = 0; i < data.length; i++) {
								$('<option/>').val(data[i].id).html(
										data[i].subject).appendTo(
										"#begin_notes_subjects");
							}
						});

				$.ajax({
					url : "/rased/get/getClassProbs",
					data : {
						"class" : this.value
					},
					type : "POST",
					dataType : "JSON"
				}).done(
						function(data) {
							$("#begin_notes_probs").empty();
							$('<option/>').val('').html(
							'اختر نوع الملاحظة').appendTo(
							"#begin_notes_probs");
							for ( var i = 0; i < data.length; i++) {
								$('<option/>').val(data[i].id).html(
										data[i].prob).appendTo(
										"#begin_notes_probs");
							}
						});
				getClassStudents(this.value, "#begin_notes_students");

			});
	// get types on change prob selector and put them in types selector
	// $("#begin_notes_probs").on("change", function(){
	// var notes_types = $("#begin_notes_types");
	// getTypes(this.value, notes_types);
	// });

	// get types on change prob selector and put them in types selector
	// of notes add
	$(".probs_select").on("change", function() {
		var notes_types = $(".types_select");
		getTypes(this.value, notes_types);
	});

	// get types on change prob selector in notes show
	$(".notes_probs").on(
			"change",
			function() {
				var notes_types = $(this).parent().parent().find(
				".notes_types");
				getTypes(this.value, notes_types);
			});
	// put astrix after required inputs.
	// $($(".required"))
	// .after("<label class = 'ast'>*</label>");
	// verify required select elements.
	$("form :not('#begin_notes_form')").on("submit", function(event) {
		var sele = $(this).find("select");
		for ( var u = 0; u < sele.length; u++) {
			if (sele[u].value == "") {
				alert("اختر المطلوب في القوائم");
				return false;
			}
		}
		var inputs = $(this).find("input,textarea");
		for ( var i = 0; i < inputs.length; i++)
			if (inputs[i].className.match(/\brequired\b/))
				if (inputs[i].value == '') {
					inputs[i].className = "";
					inputs[i].className += "required redalert";
					return false;
				} else {
					inputs[i].className = "";
					inputs[i].className += "required greenalert";
				}
		var parent_id = $(this).parent().attr("id");
		$.ajax({
			url : $(this).attr("action"),
			type : "post",
			data : $(this).serialize()
		}).done(function(data) {
			if (data == "1") {
				$("#" + parent_id).dialog("close");
				alert("تم الاضافة بنجاح");
			} else {
				alert("error occurred!");
			}
		});

		return false;
	});

	// get grade subjects
	$(".grades_select").on(
			"change",
			function() {
				var subjects_select = $(this).parent().parent().find(
				".subjects_select");
				subjects_select.empty();
				$('<option/>').val('').html('اختر المادة').appendTo(
						subjects_select);
				getSubjects(this.value, subjects_select);
			});
	// make check all check box for tables.
	$(".body").on("click", "#all_check", function() {
		if ($(this).is(":checked"))
			$(".table_checks").prop("checked", true);
		else
			$(".table_checks").prop("checked", false);
	});

	// verfiy password and repassword inputs in user add form.
	$("#add_user_repassword").blur(function() {
		if (this.value != $("#add_user_password").val())
			alert("كلمة المرور غير متطابقة");
		return false;
	});

	// verfiy password and repassword inputs in user add form.
	$("#add_user_password").blur(function() {
		var re = $("#add_user_repassword").val();
		if (re != "")
			if (this.value != $("#add_user_repassword").val())
				alert("كلمة المرور غير متطابقة");
		return false;
	});

	// validate username in forms
	$("#add_user_username").blur(
			function() {
				$.ajax({
					url : "/rased/get/getUserNames",
					data : {
						username : this.value
					},
					type : "POST"
				}).done(
						function(data) {
							if (data == "0")
								$("#add_user_notify").text(
								"اسم المستخدم موجود مسبقاً");
							else
								$("#add_user_notify").text("");
						});
				return false;
			});

	// validate username in forms
	$("#modify_user_username").blur(
			function() {
				$.ajax({
					url : "/rased/get/getUserModify",
					data : {
						username : this.value,
						id : $("#hidden_ra_users").val()
					},
					type : "POST"
				}).done(
						function(data) {
							if (data == "0")
								$("#modify_user_notify").text(
								"اسم المستخدم موجود مسبقاً");
							else
								$("#modify_user_notify").text("");
						});
				return false;
			});

	// validate id number for students
	$("input[name='idnum']").blur(function() {
		$.ajax({
			url : "/rased/get/getStudentId",
			data : {
				idnum : this.value
			},
			type : "POST"
		}).done(function(data) {
			if (data == "0")
				alert("الرقم المدخل للطالب موجود مسبقاً")
		});
		return false;
	});

	// get grades and put them in grades select on level select
	// changing.
	$(".levels_select").on("change", function() {
		var gradeselect = $(".grades_select");
		getGrades(this.value, gradeselect);
	});

	// get classes and put them in classes select on grade select
	// changing.
	$(".grades_select").on("change", function() {
		var classesselect = $(".classes_select");
		getClasses(this.value, classesselect);
	});

	// get students and put them in students select on class select
	// changing.
	$(".classes_select").on("change", function() {
		// var studentsselect =
		// $(this).parent().find(".students_select");
		// getClassStudents(this.value, studentsselect)
	});



	// get level probs for notestypes add and modify
	$("#add_notetype_levels").on("change", function() {
		var add_notetype_probs = $("#add_notetype_probs");
		getProbs(this.value, add_notetype_probs);
	});

	// get level probs for notestypes notes add
	$(".notes_levels").on("change", function() {
		var probs_select = $(".probs_select");
		getProbs(this.value, probs_select);
	});
});

// function to make input text type only numbers.
function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
				return false;

	return true;
}

// function to get grades belong to selected level in select drop
function getGrades(thislevel, gradesselect) {
	$.ajax({
		url : "/rased/get/getLevelGrades",
		dataType : "JSON",
		data : {
			level : thislevel
		},
		type : "post",
		async : false
	})
	.done(
			function(data) {
				$(gradesselect).empty();
				$('<option/>').val('').html('اختر الصف').appendTo(
						gradesselect);
				for ( var i = 0; i < data.length; i++) {
					$('<option/>').val(data[i].id).html(data[i].grade)
					.appendTo(gradesselect);
				}
			});
	return false;
}
// get grade classes
function getClasses(thisgrade, classesselect) {
	$.ajax({
		url : "/rased/get/getGradeClasses",
		dataType : "JSON",
		data : {
			grade : thisgrade
		},
		type : "post",
		async : false

	})
	.done(
			function(data) {
				$(classesselect).empty();
				$('<option/>').val('').html('اختر فصل').appendTo(
						classesselect);
				for ( var i = 0; i < data.length; i++) {
					$('<option/>').val(data[i].id).html(data[i].class)
					.appendTo(classesselect);
				}
			});
	return false;
}
// function to get level probs
function getProbs(thislevel, probselect) {
	$.ajax({
		url : "/rased/get/getLevelProbs",
		dataType : "JSON",
		data : {
			level : thislevel
		},
		type : "post",
		async : false

	}).done(
			function(data) {
				$(probselect).empty();
				$('<option/>').val('').html('اختر نوع الملاحظة').appendTo(
						probselect);
				for ( var i = 0; i < data.length; i++) {
					$('<option/>').val(data[i].id).html(data[i].prob).css(
							"background-color", data[i].color).appendTo(
									probselect);
				}
			});
	return false;
}

// function to get level probs
function getClassProbs(thisclass, probselect) {
	$.ajax({
		url : "/rased/get/getClassProbs",
		dataType : "JSON",
		data : {
			class : thisclass
		},
		type : "post",
		async : false

	}).done(
			function(data) {
				$(probselect).empty();
				$('<option/>').val('').html('اختر نوع الملاحظة').appendTo(
						probselect);
				for ( var i = 0; i < data.length; i++) {
					$('<option/>').val(data[i].id).html(data[i].prob).css(
							"background-color", data[i].color).appendTo(
									probselect);
				}
			});
	return false;
}

// function to get grade subjects
function getSubjects(thisgrade, subjectsselect) {
	$.ajax({
		url : "/rased/get/getGradeSubjects",
		dataType : "JSON",
		data : {
			grade : thisgrade
		},
		type : "post",
		async : false

	}).done(
			function(data) {
				$(subjectsselect).empty();
				$('<option/>').val('').html('اختر المادة').appendTo(
						subjectsselect);
				for ( var i = 0; i < data.length; i++) {
					$('<option/>').val(data[i].id).html(data[i].subject)
					.appendTo(subjectsselect);
				}
			});
	return false;
}

// function to get user subjects when change class select
function getUserClassSubjects(thisclass, subjectsselect) {
	$.ajax({
		url : "/rased/get/getUserClassSubjects",
		dataType : "JSON",
		data : {
			"class" : thisclass
		},
		type : "post",
		async : false

	}).done(
			function(data) {
				$(subjectsselect).empty();
				$('<option/>').val('').html('اختر المادة').appendTo(
						subjectsselect);
				for ( var i = 0; i < data.length; i++) {
					$('<option/>').val(data[i].id).html(data[i].subject)
					.appendTo(subjectsselect);
				}
			});
	return false;
}

// function to get prob types
function getTypes(thisprob, typesselect) {
	$.ajax({
		url : "/rased/get/getProbTypes",
		dataType : "JSON",
		data : {
			prob : thisprob
		},
		type : "post",
		async : false

	}).done(
			function(data) {
				$(typesselect).empty();
				$('<option/>').val('').html('اختر بند الملاحظة').appendTo(
						typesselect);
				for ( var i = 0; i < data.length; i++) {
					$('<option/>').val(data[i].id).html(
							data[i].body + " (" + data[i].sold + ")").appendTo(
									typesselect);
				}
			});
	return false;
}

function getClassStudents(thisclass, studentsselect) {
	$.ajax({
		url : "/rased/get/getClassStudents",
		dataType : "JSON",
		data : {
			"class" : thisclass
		},
		type : "post",
		async : false

	}).done(
			function(data) {
				$(studentsselect).empty();
				$('<option/>').val('').html('اختر طالب').appendTo(
						studentsselect);
				for ( var i = 0; i < data.length; i++) {
					$('<option/>').val(data[i].id).html(data[i].fullname)
					.appendTo(studentsselect);
				}
			});
	return false;
}

function modifyAgree(thisnote, agree) {
	$.ajax({
		url : "/rased/modify/modifyAgree",
		dataType : "JSON",
		data : {
			"id" : thisnote,
			"agree" : agree
		},
		type : "post",
		async : false

	}).done(function(data) {
	});
	return false;
}

function confirmDelete(form_id){
var c = confirm("هل أنت متأكد من عملية الحذف؟");
if(c){
	$(form_id).submit();
}
}