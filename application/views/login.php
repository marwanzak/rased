<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<title>Alaqsa database | login</title>
</head>
<body>

	<div id='login_form'>

		<div id="carbonForm">
			<h1>Log in</h1>

			<form action='http://<?php echo base_url();?>login/process' method='post'
				name='process'>

				<div class="fieldContainer">
					<br />
					<?php if(! is_null($msg)) echo $msg;?>
					<div class="inputcon">
						<label for='username'>Username</label> <input type='text'
							name='username' id='username' size='25' />
					</div>
					<div class="inputcon">

						<label for='password'>Password</label> <input type='password'
							name='password' id='password' size='25' />
					</div>
					<label>Language</label> <select name="lang_select">
						<option value="english">English</option>
						<option value="arabic">عربي</option>
					</select>
				</div>

				<div class="signupButton">
					<input id='submit' type='Submit' value='Log in' />
				</div>

			</form>

		</div>
	</div>

</body>
</html>
