<?php $this->load->view("header")?>
<div class="content">
	<div class="outer">
		<div class="inner">
			<div class="page-header">
				<!-- Page header -->
				<h5>
					<i class="font-home"></i>
					<?= lang("inbox") ?>
				</h5>
			</div>
			<!-- /page header -->
			<div class="body">
				<!-- Messages -->
				<ul class="messages">
					<?php if(!$messages) echo lang("no_messages"); else{?>
					<?php foreach($messages as $message1){?>
					<!-- Message -->
					<li class=<?=($message1->from==$this->session->userdata("id"))?"by-user":"by-me"?>><?= ($message1->from==$this->session->userdata("id"))?"<a href='".base_url()."admin/deleteInboxMessage?message_id=".$message1->id."'><i class='icon-remove'></i></a>":""?>
						<div class="area">
							<span class="arrow"></span>
							<div class="info-row">
								<span class="pull-left"><strong><?=($message1->from!=-1)?lang("me"):lang("from_admin")?>
								</strong> </span> <span class="pull-right"><?=$this->homemodel->getTimeDef(time(),$message1->datetime)?>
								</span>
							</div>
							<p>
								<?=$message1->message?>
							</p>
						</div>
					</li>
					<!-- /message -->
					<?php }
}?>
				</ul>
				<!-- /messages -->

				<div class="enter-message-divider"></div>
				<form action="<?=base_url()?>insert/insertInbox" method="post">
					<input type="hidden" value="<?=$this->session->userdata("id")?>" name="username" /> <input
						type="hidden" value="-1" name="admin" />
					<!-- Enter message input -->
					<div class="enter-message">
						<textarea name="message" class="auto" rows="3" cols="1"
							placeholder="<?=lang("enter_msg")?>"></textarea>
						<div class="message-actions">
							<div class="send-button">
								<input type="submit" name="send-message" class="btn btn-danger"
									value="<?=lang("send")?>" />
							</div>
						</div>
					</div>
					<!-- /enter message input -->
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
