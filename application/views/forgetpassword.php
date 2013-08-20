<html>
<head>
<meta charset="UTF-8" />
</head>
<body>
	<?php if(isset($msg)){
		echo $msg;
}?>
	<?php if(isset($check)){
		if($check==1){
$this->homemodel->array_print($req);
$this->homemodel->array_print($pass);

?>
	<div id="forget_password_div">
		<form class="form-horizontal" action="<?=base_url() ?>newuser/newPassword" method="POST">
			<label id="code_label"></label> 
			<input type="hidden" name="user" value="<?=$user ?>"/>
			<input type="text" name="code" id="" />
			<input type="submit" value="<?=lang("next") ?>" />
		</form>
	</div>
	<?php 
}else{
?>
	<div id="forget_password_div">
		<form class="form-horizontal" action="" method="POST">
			<select name="method">
				<option value="">
					<?=lang("choose_method") ?>
				</option>
				<option value="number">
					<?=lang("phone") ?>
				</option>
				<option value="username">
					<?=lang("username") ?>
				</option>
			</select> <label id="forget_label"></label> <input type="text"
				name="content" id="" /> <input type="submit"
				value="<?=lang("next") ?>" />
		</form>
	</div>
	<?php 
}
}?>

</body>
</html>

