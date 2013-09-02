<!-- send sms dialog -->
<div id="send_sms_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("send_email")?>
		</h5>
	</div>
	<form id="send_sms_form" action="<?= base_url() ?>admin/sendSms"
		method="post">
		<div class="modal-body">
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?= lang("number") ?>: </label>
					<div class="controls">
						<input type="number" class="required span12" name="number" id="" onkeypress="return isNumberKey(event)" />
					</div>
				</div>


				<div class="control-group">
					<label class="control-label"><?= lang("sms_body") ?>: </label>
					<div class="controls">
						<textarea name="message" cols=60 rows=5></textarea>
						<div class="loader_div"><img src="<?=base_url()?>images/elements/loaders/1.gif" alt=""/><?=lang("sending")?></div>
					</div>
				</div>
			<a class="btn btn-inverse" href="#ready_message_dialog" data-toggle="modal" ><?=lang("choose_ready")?></a>
				
			</div>

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<input value="<?= lang("send")?>" type="submit"
				class="btn btn-primary" />
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>
