<div class="content">
	<div class="outer">
		<div class="inner">
			<div class="page-header">
				<!-- Page header -->
				<h5>
					<i class="font-home"></i>
					<?= lang("dashboard") ?>
				</h5>
			</div>
			<!-- /page header -->

			<div class="body">
			<?php $permissions1 = $this->homemodel->checkSeePermissions("admin_inbox")?>
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5>
								<?=lang("students_mornings")?>
							</h5>
							<div class="nav pull-right"></div>
						</div>
					</div>
					<div class="body">
						<div class="block well">
						<div class="table-overflow">
						<table class="table table-hover table-striped" id="">
							<thead>
								<tr>
									<th><?= lang("class")?>
									</th>
									<th><?= lang("student") ?>
									</th>
									<th><?= lang("date") ?>
									</th>
									<th><?= lang("student_present") ?>
									</th>
									<th><?=lang("actions")?></th>
								</tr>
							</thead>
							<tbody>
								<?php if(!$mornings) echo lang("no_lates");else{?>
								<?php foreach($mornings as $morning){?>
								<tr>
								<td><?= $this->homemodel->getClass($this->homemodel->getStudentTree($morning->student,"object")->class)->class?>
									<td><?=$this->homemodel->getStudent($morning->student)->fullname?>
									</td>
									<td><?= date("Y-m-d",$morning->time)?></td>
									<td><?= date("h:i a", $morning->time)?></td>
									<td>
												<?php if($permissions1){?>
										<ul>
											<li class="dropdown" id="menu2"><a class="dropdown-toggle"
												data-toggle="dropdown" href="#menu2"><?=lang("guard_send")?><b
													class="caret"></b> </a>
												<ul class="dropdown-menu">
													<li><a data-toggle="modal" href="#send_sms_dialog" id="<?=$morning->student?>" class="dashboard_send_sms_but"><i class="icon-comment"></i>
														<?=lang("send_sms")?>
													</a></li>
													<li><a data-toggle="modal" href="#send_message_dialog" id="<?=$morning->student?>" class="dashboard_send_message_but"><i class="icon-inbox"></i>
														<?=lang("send_message")?>
													</a></li>
													<li><a data-toggle="modal" href="#send_email_dialog" id="<?=$morning->student?>" class="dashboard_send_email_but"><i class="icon-envelope"></i>
														<?=lang("send_email")?>
													</a></li>
												</ul>
											</li>
										</ul>
										<?php }?>
									</td>
								</tr>
								<?php }?>
								<?php }?>
							</tbody>
						</table>
						</div>
						</div>
					</div>
				</div>
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5>
								<?=lang("notes")?>
							</h5>
							<div class="nav pull-right"></div>
						</div>
					</div>
					<div class="body">
						<div class="block well">
							<div class="table-overflow">
								<table class="table table-hover table-striped" id="">
									<thead>
										<tr>
											<th><?= lang("class") ?>
											</th>
											<th><?= lang("student_name") ?>
											</th>
											<th><?= lang("subject") ?>
											</th>
											<th><?= lang("priority") ?>
											</th>
											<th><?= lang("continuas") ?>
											</th>
											<th><?= lang("date") ?>
											</th>
											<th><?= lang("note_prob") ?>
											</th>
											<th><?= lang("note_type") ?>
											</th>
											<th><?= lang("note") ?>
											</th>
											<th><?= lang("agreed") ?>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!$notes) echo lang("no_new_notes"); else{?>
										<?php foreach($notes as $key =>$note){?>
										<?php foreach($note as $key1 =>$note1){?>
										<tr>
											<td><?=$this->homemodel->getClass($note1["class"])->class?>
											</td>
											<td><?=$this->homemodel->getStudent($note1["student"])->fullname?>
											</td>
											<td><?=($note1["subject"]!=0?$this->homemodel->getSubject($note1["subject"])->subject:lang("without"))?>
											</td>
											<td><?=$this->homemodel->getPriority($note1["priority"])?>
											</td>
											<td><?=($note1["status"]!=0?lang("solved"):lang("continue"))?>
											</td>
											<td><?=$note1["day"]."-".$this->homemodel->getMonth($note1["month"])?>
											</td>
											<td><?=($note1["prob"]!=0?$this->homemodel->getProb($note1["prob"]):lang("without"))?>
											</td>
											<td><?=($note1["type"]!=0?$this->homemodel->getNoteType($note1["body"]):lang("without"))?>
											</td>
											<td><?=($note1["note"]!=""?$note1["note"]:lang("without"))?>
											</td>
											<td><div>
													<input type="button" id=<?=$note1["id"]?>
														class="btn btn-success btnc modify_agree active"
														data-toggle="button" value="<?=lang("not_agree")?>" /> <input
														type="checkbox" name="" style="display: none;" />
												</div></td>

										</tr>
										<?php }?>
										<?php }?>
										<?php }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
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
						<div class="timeline-messages">
							<?php if(!$user_inbox) echo lang("no_unread_messages"); else{?>
							<?php foreach($user_inbox as $message){?>
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
					</div>
				</div>
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
						<?php if($permissions->admin_inbox==1){?>
						<div class="timeline-messages">
							<?php if(!$admin_inbox) echo lang("no_unread_messages"); else{?>
							<?php foreach($admin_inbox as $message){?>
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
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view("sendemail")?>
<?php $this->load->view("sendmessage")?>
<?php $this->load->view("sendsms")?>
<?php $this->load->view("readymsg",$ready_messages)?>



	</body>
	</html>