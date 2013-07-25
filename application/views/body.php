
<!-- Main content -->
<div class="content">
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
					<?= lang($table) ?>
				</h5>
				<ul class="icons">
					<li><a href="#" class="hovertip" title="My tasks"><i
							class="font-tasks"></i> </a></li>
					<li><a href="#" class="hovertip" title="Reload data"><i
							class="font-refresh"></i> </a></li>
					<li><a href="#" class="hovertip" title="Settings"><i
							class="font-cog"></i> </a></li>
				</ul>
			</div>
			<!-- /page header -->

			<div class="body">
				<?php if($table!="" && $table!="showNotes"){?>
				<?php array_unshift($headings,"<input type = 'checkbox' id = '' class='style'/>");?>

				<div class="well-smoke body">
					<input type="hidden" value=<?= $table ?> name="table" /> <a
						data-toggle="modal" href="#add_<?= $table ?>_dialog"
						class="btn btn-success add_<?= $table?>"><i class="icon-plus"></i>
						<?= lang("add") ?> </a>
				</div>

				<form id="main_table_form" method="post"
					action="<?= base_url()?>admin/delete">
					<input type="hidden" name="table" value="<?= $table ?>" />
					<!-- Table with checkboxes -->
					<div class="block well">
						<div class="navbar">
							<div class="navbar-inner">
								<h5>
									<?= lang("table")." ".lang($table) ?>
								</h5>
							</div>
						</div>
						<div class="table-overflow">
							<table class="table table-block table-bordered table-checks"
								id="select-all">
								<thead>
									<tr>
										<?php foreach($headings as $heading){?>
										<th><?= $heading ?>
										</th>
										<?php }?>
									</tr>
								</thead>
								<tbody>
									<?php 	if(count($rows)==0){?>
									<tr>
										<td colspan="<?= count($headings)?>"
											style="text-align: center;"><?= lang("no_inputs") ?></td>
									</tr>
									<?php } else { ?>
									<?php foreach($rows as $row){ 
										$id = $row[0];
										array_shift($row);
										array_unshift($row,"<input type = 'checkbox' id ='".$id."' value='".$id."' name = 'checks[]' class = 'table_checks style'/>");
										if($table!="ra_users")
											array_push($row,"<a title='".lang("modify")."' id=".$id." data-toggle='modal' href='#add_".$table."_dialog' class='btn btn-primary modify_".$table."'><i class='icon-wrench'></i></a>");
										if($table=="ra_users")
											array_push($row,"<a title='".lang("modify")."' id=".$id." data-toggle='modal' href='#add_".$table."_dialog' class='btn btn-primary modify_".$table."'><i class='icon-wrench'></i></a>
													<a title='".lang("change_password")."' id=".$id." data-toggle='modal' href='#modify_user_password_dialog' class='btn btn-inverse modify_user_password_but'><i class='icon-lock'></i></a>");
										?>

									<tr>
										<?php foreach($row as $field){ ?>
										<td><?= $field ?>
										</td>
										<?php }?>
									</tr>
									<?php }
}?>
								</tbody>
							</table>
						</div>
						<div class="well-smoke body">
							<input type="hidden" value=<?= $table ?> name="table" /> <a
								data-toggle="modal" href="#confirm_delete_dialog"
								class="btn btn-danger" id="table_delete_but"><i
								class="icon-remove"></i> <?= lang("delete") ?> </a>
						</div>
					</div>
				</form>
				<!-- /table with checkboxes -->
				<?php }elseif($table=="showNotes"){?>
				<?php echo "showNotes";?>
				<?php }?>

			</div>
		</div>
	</div>
</div>
<!-- /main content -->
</div>
<!-- /main wrapper -->

