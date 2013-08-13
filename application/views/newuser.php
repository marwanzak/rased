<!DOCTYPE html>
<html lang="ar">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?= lang("new_user") ?></title>
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

</head>
<body>
	<?php
	if(isset($msg)){
				if($msg=="1"){?>
	<div class="outer notice">
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<img alt="" src="<?= base_url() ?>images/icons/success.png">
			<?= lang("success") ?>
		</div>
	</div>
	<?php }elseif($msg=="-1"){?>
	<div class="outer notice">
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<img alt="" src="<?= base_url() ?>images/icons/error.png">
			<?= lang("error") ?>
		</div>
	</div>
	<div class="outer notice">
		<div class="alert alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<img alt="" src="<?= base_url() ?>images/icons/warning.png">
			<?= $message ?>
		</div>
	</div>
	<?php }
}?>

	<!-- Main content -->
	<div class="content" id="main_content_div">
		<div class="outer" style="width: 70%;">
			<div class="inner">
				<div class="page-header">
					<!-- Page header -->
					<h5>
						<i class="font-home"></i>
						<?= lang("new_user") ?>
					</h5>
				</div>
				<!-- /page header -->

				<div class="body">
					<form action='<?= base_url();?>newuser/newUser' class="row-fluid form-horizontal"
						method="post">
						<div class="control-group">
							<label class="control-label"><?= lang("username") ?>:<span
								class="req">*</span> </label>
							<div class="controls">
								<input type="text" class="required span6" name="username" id="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("password") ?>:<span
								class="req">*</span> </label>
							<div class="controls">
								<input type="text" class="required span6" name="password" id="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("repassword") ?>:<span
								class="req">*</span> </label>
							<div class="controls">
								<input type="text" class="required span6" name="" id="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("fullname") ?>:<span
								class="req">*</span> </label>
							<div class="controls">
								<input type="text" class="required span6" name="name" id="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("email") ?> 1:</label>
							<div class="controls">
								<input type="text" class="span6" name="email1" id="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("email") ?> 2: </label>
							<div class="controls">
								<input type="text" class="span6" name="email2" id="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("phone") ?> 1: </label>
							<div class="controls">
								<input type="text" class="span6" name="number1" id="" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("phone") ?> 2:</label>
							<div class="controls">
								<input type="text" class="span6" name="number2" id="" />
							</div>
						</div>
						<input type="hidden" class="required span6" name="idnum" id=""
							value="<?=$idnum ?>" />
						<div class="modal-footer">
							<input value="<?= lang("add")?>" type="submit"
								class="btn btn-primary" />
							<button type="reset" class="btn">
								<?= lang("reset")?>
							</button>
							<a style="float:right;" href="<?=base_url()?>userlogin" class="btn btn-inverse">
								<?= lang("back")?>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
