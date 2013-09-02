<?php $data["table"]=$table;?>
<?php $data["users"]=$users;?>
<?php $this->load->view("header")?>
<?php $this->load->view("top-nav",$data)?>
<?php $this->load->view("menu-bar",$data)?>
<div
	class="content">
	<?php 
	if($this->session->userdata("msg")){
		$msg = $this->session->userdata("msg");
		$this->session->set_userdata('msg',"");
	}
	?>
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
					<?= lang("inbox") ?>
				</h5>
			</div>
			<!-- /page header -->
			<div class="body">
				<?=($method=="conversation"?"<a href='".base_url()."admin/showInbox?username=".$username."&show=all".($admin==1?"&admin=1":"")."'>".lang("show_all_messages")."</a>":"")?>
				<!-- Timeline messages -->
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5>
								<?=lang("personal_messages")?>
							</h5>
							<div class="nav pull-right"></div>
						</div>
					</div>
					<div class="body">
						<?php if($method=="inbox"){?>
						<div class="timeline-messages">
							<?php if(!$messages) echo lang("no_unread_messages"); else{?>
							<?php foreach($messages as $message){?>
							<?php if($message->from==-1) continue;?>
							<!-- Comment -->
							<div class="message">
								<a href="#" id="<?=$message->id?>"
									class="<?=($message->read==0?"icon-eye-open":"icon-ok")?> message-img"></a>
								<div class="message-body">
									<div class="text">
										<p>
											<?=$message->message?>
										</p>
									</div>
									<p class="attribution">
										<?=lang("written_by")?>
										<a
											href="<?=base_url()?>admin/showInbox?username=<?=$message->from?>"><?=$this->homemodel->getUser($message->from)->name?>
										</a>
									</p>
								</div>
							</div>
							<!-- /comment -->
							<?php }
}?>
						</div>
						<?php }if($method=="conversation"){?>
						<!-- Messages -->
						<ul class="messages">
							<?php if(!$messages) echo lang("no_messages"); else{?>
							<?php foreach($messages as $message1){?>
							<!-- Message -->
							<li class=<?=($message1->from==$username)?"by-user":"by-me"?>><?= ($message1->from==$this->session->userdata("id"))?"<a href='".base_url()."admin/deleteInboxMessage?message_id=".$message1->id."'><i class='icon-remove'></i></a>":""?>
								<div class="area">
									<span class="arrow"></span>
									<div class="info-row">
										<span class="pull-left"><strong><?=($message1->from!=-1)?$this->homemodel->getUser($message1->from)->name:lang("from_admin")?>
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
							<input type="hidden" value="<?=$username?>" name="username" /> <input
								type="hidden" value="<?=$admin?>" name="admin" />
							<!-- Enter message input -->
							<div class="enter-message">
								<textarea name="message" class="auto" rows="3" cols="1"
									placeholder="<?=lang("enter_msg")?>"></textarea>
								<div class="message-actions">
									<div class="send-button">
										<input type="submit" name="send-message"
											class="btn btn-danger" value="<?=lang("send")?>" />
									</div>
								</div>
							</div>
							<!-- /enter message input -->
						</form>
						<!-- /standard messages -->
						<?php }?>

					</div>
					<!-- /timeline messages -->
				</div>
			</div>
			<div class="body">
				<?php if($method=="inbox"){?>
				<?php $permissions1 = $this->homemodel->checkSeePermissions("admin_inbox")?>
				<?php if($permissions1){?>
				<!-- admin inbox -->
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5>
								<?=lang("guards_messages")?>
							</h5>
							<div class="nav pull-right"></div>
						</div>
					</div>
					<div class="body">
						<div class="timeline-messages">
							<?php if(!$admin_messages) echo lang("no_unread_messages"); else{?>
							<?php foreach($admin_messages as $message){?>
							<!-- Comment -->
							<div class="message">
								<a href="#" id="<?=$message->id?>"
									class="<?=($message->read==0?"icon-eye-open":"icon-ok")?> message-img"></a>
								<div class="message-body">
									<div class="text">
										<p>
											<?=$message->message?>
										</p>
									</div>
									<p class="attribution">
										<?=lang("written_by")?>
										<a
											href="<?=base_url()?>admin/showInbox?username=<?=$message->from?>&admin=1"><?=$this->homemodel->getUser($message->from)->name?>
										</a>
									</p>
								</div>
							</div>
							<!-- /comment -->
							<?php }
}?>
						</div>
					</div>
				</div>
			</div>
			<!-- end of admin inbox -->
			<?php }?>
			<?php }?>
		</div>
		<!-- /main content -->
	</div>
	<!-- /main wrapper -->
	<!-- confirm delete tables row  -->
	<div id="confirm_delete_dialog" class="modal hide fade" tabindex="-1"
		role="dialog" aria-labelledby="" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h5 id="">
				<?= lang("confirm")." ".lang("delete") ?>
			</h5>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<?= lang("confirm_delete_msg") ?>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary" id="confirm_delete_but">
				<?= lang("confirm")?>
			</button>
		</div>
	</div>
</div>
</body>
</html>
