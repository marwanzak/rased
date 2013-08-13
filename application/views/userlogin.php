<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?= lang("rased_login") ?></title>
<link href="<?= base_url() ?>css/main.css" rel="stylesheet"
	type="text/css" />
<!--[if IE]> <link href="<?= base_url() ?>css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<script type="text/javascript"
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/jquery_ui_custom.js"></script>

<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.autosize.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.ibutton.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.validate.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.uniform.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/forms/jquery.cleditor.js"></script>

<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/uploader/plupload.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/wizard/jquery.form.wizard.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/wizard/jquery.form.js"></script>

<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/ui/jquery.timepicker.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/ui/jquery.jgrowl.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/ui/jquery.pie.chart.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/ui/jquery.fullcalendar.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/ui/jquery.elfinder.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/ui/jquery.fancybox.js"></script>

<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/tables/jquery.dataTables.min.js"></script>

<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/bootstrap/bootstrap-bootbox.min.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/bootstrap/bootstrap-progressbar.js"></script>
<script type="text/javascript"
	src="<?= base_url() ?>js/plugins/bootstrap/bootstrap-colorpicker.js"></script>

<script type="text/javascript"
	src="<?= base_url() ?>js/functions/custom.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/home.js"></script>
</head>

<body>
	<div class="login">
		<?php if(! is_null($msg)){?>
		<div class="notice outer closing">
			<div class="note <?=$color?>">
				<button type="button" class="close">×</button>
				<strong><?= $msg ?> </strong>
			</div>
		</div>
		<?php }?>
		<!-- Main wrapper -->
		<div class="login-wrapper">


			<!-- Login block -->
			<div class="well">
				<div class="navbar">
					<div class="navbar-inner">
						<h6>
							<i class="font-user"></i>
							<?= lang("rased_login") ?>
						</h6>

					</div>
				</div>
				<form action='<?= base_url();?>userlogin/process' class="row-fluid"
					method="post">
					<div class="control-group">
						<label class="control-label"><?= lang("username") ?>:</label>
						<div class="controls">
							<input class="span12" type="text" name="username"
								placeholder="<?= lang("username") ?>" />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"><?= lang("password") ?>:</label>
						<div class="controls">
							<input class="span12" type="password" name="password"
								placeholder="<?= lang("password") ?>" />
						</div>
					</div>

					<div class="login-btn">
						<input type="submit" value="<?= lang("login") ?>"
							class="btn btn-info btn-block btn-large" />
					</div>
				</form>
				<div class="control-group" style="text-align: center;">
					<input type="button" class="btn btn-inverse"
						value="<?=lang("new_user") ?>" id="new_id_but" />
				</div>
			<a href="<?= base_url() ?>newuser/forgetPassword">forget password</a>
				<div id="new_id_num_div">
					<form class="form-horizontal"
						action="<?=base_url() ?>newuser/checkIdnum" method="POST">
						<div class="control-group">
							<label class="control-label" style="width: 30% !important;"><?= lang('idnum') ?><span
								class="req">*</span> </label>
							<div class="controls">
								<input type="text" class="required span12" name="idnum"
									id="" />
							</div>
							<div class="control-group" style="text-align: center;">
								<input type="submit" class="btn btn-success"
									value="<?=lang("next") ?>" />
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- /login block -->

		</div>

	</div>
	<!-- /main wrapper -->

</body>
</html>
