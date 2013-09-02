<!-- ready messages dialog -->
<div id="ready_message_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("send_email")?>
		</h5>
	</div>
	<form>
		<div class="modal-body">
			<?php if(!$ready_messages) echo lang("no_inputs"); else{?>
			<?php foreach($ready_messages as $message){?>
			<div class="control-group">
				<div class="controls">
					<textarea name="message" cols=60 rows=5><?=$message->message?></textarea>
					<button class="btn btn-success choose_readymsg_but" id="" data-dismiss="modal"><?= lang("choose")?></button>
				</div>
			</div>
			<?php }?>
			<?php }?>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
		</div>
	</form>
</div>
