<html>
<head>
<meta charset="utf-8" />
</head>
<body>
<a href="<?base_url()?>user">back</a>
	<?php if(isset($msg)){
		if($msg=="-1"){
			echo "<span style='color:red;'>".lang("error")."</span>";
			echo "<span style='color:orange;'>".$message."</span>";
		}elseif($msg=="1"){
			echo "<span style='color:green;'>".lang("success")."</span>";
		}
	}?>
	<div>
		<form method="post" action="<?=base_url()?>user/changeProfile">
			<label><?=lang("username")?>: </label>
			<input type="text" value="<?=$username ?>" name="username" /> 
			<label><?=lang("fullname")?>: </label><input type="text" name="name" value="<?=$name ?>"/> 
			<label><?=lang("email")?>1: </label><input type="text" name="email1" value="<?=$email1 ?>"/> 
			<label><?=lang("email")?>2: </label><input type="text" name="email2" value="<?=$email2 ?>"/> 
			<label><?=lang("phone")?>1: </label><input type="text" name="number1" value="<?=$number1 ?>"/>
			 <label><?=lang("phone")?>2: </label><input type="text" name="number2" value="<?=$number2 ?>"/>
				<input type="submit" value="<?=lang("modify")?>"/>
		</form>
		<form method="post" action="<?= base_url()?>user/changePassword">
		<label><?= lang("password") ?></label><input type="password" name="password" id="user_pass1"/>
		<label><?= lang("repassword")?></label><input type="password" name="" id="user_pass2"/>
		<input type="submit" value="<?=lang("modify")?>"/>
		</form>
	</div>
</body>
</html>
