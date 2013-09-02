<div class="content">
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
			<?= $this->session->userdata("message") ?>
		</div>
	</div>
	<?php }
}?>
	<div class="outer">
		<div class="inner">
			<div class="page-header">
				<!-- Page header -->
				<h5>
					<i class="font-home"></i>
					<?= lang("site_settings") ?>
				</h5>
			</div>
			<!-- /page header -->
			<div class="body">

				<form action="<?= base_url()?>admin/insertSiteSettings"
					method="post">
					<div class="block well form-horizontal">
						<div class="control-group">
							<label class="control-label"><?= lang("sms_username") ?>:</label>
							<div class="controls">
								<input type="text" class="span6" name="smsusername" id=""
									value="<?=$username ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?= lang("sms_password") ?>:</label>
							<div class="controls">
								<input type="text" class="span6" name="smspassword" id=""
									value="<?=$password ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?= lang("email_method") ?>:</label> <label
								class="radio inline"><input
								type="radio" name="email_method" value="smtp" class="style" id="email_method_smtp"
								<?=($email_method=="smtp"? "checked='checked'":"")?>>SMTP</label> <label class="radio inline"><input
								type="radio" name="email_method" value="php_mail" class="style" id="email_method_php"
								<?=($email_method=="php_mail"? "checked='checked'":"")?>>PHP mail</label>
						</div>
						<div <?=($email_method=="php_mail"? "style='display:none;'":"")?> id="email_settings_div">
							<div class="control-group">
								<label class="control-label"><?= lang("email_server") ?>:</label>
								<div class="controls">
									<input type="text" class="span6" name="email_server" id=""
										value="<?=$email_server ?>" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"><?= lang("email_port") ?>:</label>
								<div class="controls">
									<input type="text" class="span6" name="email_port" id=""
										value="<?=$email_port ?>" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"><?= lang("email_username") ?>:</label>
								<div class="controls">
									<input type="text" class="span6" name="email_username" id=""
										value="<?=$email_username ?>" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"><?= lang("email_password") ?>:</label>
								<div class="controls">
									<input type="password" class="span6" name="email_password"
										id="" value="" />
								</div>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?= lang("semester") ?>:</label>
							<div class="controls">
								<input type="text" class="span6" name="semester" id=""
									value="<?=$semester ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?= lang("year") ?>:</label>
							<div class="controls">
								<input type="text" class="span6" name="date" id=""
									value="<?=$date ?>" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("sender_name") ?>:</label>
							<div class="controls">
								<input type="text" class="span6" name="sender" id=""
									value="<?=$sender ?>" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"><?= lang("morning") ?>:</label>
							<div class="controls">
								<input id="defaultValueExample" type="text" class="span6"
									name="morning" value="<?=$morning ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?=lang("mobile_activate")?> </label>
							<div class="controls on_off">
								<div class="checkbox inline">
									<input type="hidden" value="0" name="mobileactivate" /> <input
										type="checkbox" id="check20"
										<?=($mobileactivate=="1")?"checked='checked'":"" ?>
										name="mobileactivate" value="1" />
								</div>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?=lang("show_lessons_user")?> </label>
							<div class="controls on_off">
								<div class="checkbox inline">
									<input type="hidden" value="0" name="user_lessons" /> <input
										type="checkbox" id="check20"
										<?=($user_lessons=="1")?"checked='checked'":"" ?>
										name="user_lessons" value="1" />
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<input value="<?= lang("add")?>" type="submit"
							class="btn btn-primary" />
						<button type="reset" class="btn">
							<?= lang("reset")?>
						</button>

					</div>
				</form>

			</div>

		</div>
	</div>
</div>
<!-- /main content -->
</div>
<!-- /main wrapper -->
