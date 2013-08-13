<html>
<head>
</head>
<body>
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
			</select> <label id="forget_label"></label>
			<input type="text"name="content" id="" /> <input type="submit"	value="<?=lang("next") ?>" />
		</form>
	</div>
</body>
</html>

