<!-- Main content -->
<div class="content" id="main_content_div">
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
				<?php array_unshift($headings,"<input type = 'checkbox' id = 'main_check_all' class='style'/>");?>
				<?php $delete = $this->homemodel->checkCreatePermissions($table);?>
				<?php if($delete && $table!="ra_actions"){?>
				<div class="well-smoke body">
					<input type="hidden" value=<?= $table ?> name="table" /> <a
						data-toggle="modal" href="#add_<?= $table ?>_dialog"
						class="btn btn-success add_<?= $table?>"><i class="icon-plus"></i>
						<?= lang("add") ?> </a>
				</div>
				<?php }?>
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
							<table class="table table-checks table-hover table-striped"
								id="data-table">
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
										$delete = $this->homemodel->checkCreatePermissions($table);
										if($delete){
										if($table!="ra_users" && $table!="ra_roles")
											array_push($row,"<a title='".lang("modify")."' id=".$id." data-toggle='modal' href='#add_".$table."_dialog' class='btn btn-primary modify_".$table."'><i class='icon-wrench'></i></a>");
										if($table=="ra_users")
											array_push($row,"<a title='".lang("modify")."' id=".$id." data-toggle='modal' href='#add_".$table."_dialog' class='btn btn-primary modify_".$table."'><i class='icon-wrench'></i></a>
													<a title='".lang("change_password")."' id=".$id." data-toggle='modal' href='#modify_user_password_dialog' class='btn btn-inverse modify_user_password_but'><i class='icon-lock'></i></a>");
										if($table=="ra_roles")
											array_push($row,"<a title='".lang("modify")."' id=".$id." data-toggle='modal' href='#add_".$table."_dialog' class='btn btn-primary modify_".$table."'><i class='icon-wrench'></i></a>
													<a title='".lang("change_permissions")."' id=".$id." href='".base_url()."admin/showPermissions?id=".$id."' class='btn btn-inverse modify_role_permissions'><i class='icon-cog'></i></a>");
}
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
						<?php $this->load->view("buttons");?>
					</div>
				</form>
				<?php if(isset($print)){?>
					<div class="well-smoke body">
						<button type="submit" class="btn btn-primary" id="set_print_notes">
							<i class=" icon-print"></i>
							<?= lang("print_setup") ?>
						</button>
					</div>

				<?php }?>
				<!-- /table with checkboxes -->
				<?php }elseif($table=="showNotes"){?>
				<?php echo "showNotes";?>
				<?php }elseif($table==""){?>
				<?php //$this->homemodel->array_print($disagreed_notes);?>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<!-- /main content -->
</div>
<!-- /main wrapper -->

