$(document).ready(function(){
	$("#form_type_select").on("change", function(){
		if(this.value=="")
			$("#forms_div div").hide();
	});
	
	$(".delete_user_student_but").on("click", function(){
		var conf = confirm("هل أنت متأكد من عملية الحذف؟");
		if(conf){
		$.ajax({
			url:base_url+"user/deleteUserStudent",
			data:{"student":this.id},
			type:"post",
			success:function(data){
				alert((data!=0)?"تم الحذف":"حدث خطأ أثناء عملية الحذف");
				document.location.reload(true);
			}
		});
		return false;
		}
	});
	
	$(".add_user_student_but").on("click", function(){
		$.ajax({
			url:base_url+"user/checkIdnumExist",
			data:{"idnum":$("#new_user_student_text").val()},
			type:"post",
			success:function(data){
				switch(data){
				case "2":
					alert("الطالب تم اضافته إلى مستخدم مسبقا");
					return false;
					break;
				case "3":
					alert("الطالب غير موجود");
					return false;
					break;
				case "1":
					$.ajax({
						url:base_url+"user/addUserStudent",
						data:{"idnum":$("#new_user_student_text").val()},
						type:"post",
						success:function(data){
							if(data==1){
								alert("تم إضافة الطالب");
								document.location.reload(true);
							}else{
								alert("حدث خطأ أثناء الاضافة");
								return false;
							}
							
						}
					});
					return false;
					break;
				default:
					alert("حدث خطأ أثناء الاضافة");
				return false;
					break;
				}
				return false;
			}
		});
	});
	
	$("#check_idnum_but").on("click", function(){
		$.ajax({
			url:base_url+"user/checkIdnumExist",
			data:{"idnum":$("#add_student_idnum_text").val()},
			type:"post"
		}).done(function(data){
			alert(data);
		});
		
	});
	
	$("#new_id_num_div").hide();
	$("#new_id_but").on("click", function(){
		$("#new_id_num_div").show();
	});
	
	$('#show_student_notes_form').on("submit", function(){
		if($("#student_notes_select").val()==""){
			alert("اختر طالب");
			return false;
		}
			
	});
});
function showAbForm(div){
	$("#form_title_label").text($("#form_type_select").text());
	$("#forms_div div").hide();
	$("#forms_div #"+div+"_form").show();
}