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
