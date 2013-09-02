<!-- send message dialog -->
<div id="send_message_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("send_email")?>
		</h5>
	</div>
	<form id="send_message_form"
		action="<?= base_url() ?>insert/insertInbox" method="post">
		<div class="modal-body">
			<div class="row-fluid">
				<input type="hidden" name="admin" value="1" /> <input type="hidden"
					name="refer" value="dashboard" /> <input type="hidden"
					name="username" />
				<div class="control-group">
					<label class="control-label"><?= lang("message") ?>: </label>
					<div class="controls">
						<textarea name="message" cols=60 rows=5></textarea>
						<div class="loader_div"><img src="<?=base_url()?>images/elements/loaders/1.gif" alt=""/><?=lang("sending")?></div>
					</div>
					
				</div>
			</div>
			<a class="btn btn-inverse" href="#ready_message_dialog" data-toggle="modal" ><?=lang("choose_ready")?></a>

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<input value="<?= lang("add")?>" type="submit"
				class="btn btn-primary" />
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>
