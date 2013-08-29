<?php $data["table"]=$table;?>
<?php $this->load->view("header")?>
<?php $this->load->view("top-nav",$data)?>
<?php $this->load->view("menu-bar",$data)?>

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
					<?= lang("forms") ?>
				</h5>
			</div>
			<!-- /page header -->
			<div class="body">
				<!-- absence forms table -->
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5>
								<?= lang("table")." ".lang("absence_form") ?>
							</h5>
						</div>
					</div>
					<form id="ab_table_form" method="post"
						action="<?= base_url()?>admin/delete">
						<input type="hidden" name="table" value="<?= $table ?>" />
						<table class="table table-checks table-hover
					table-striped"
							id="">
							<thead>
								<tr>
									<th><input type='checkbox' id='main_check_all' class='style' />
									</th>
									<th><?=lang("student")?></th>
									<th><?=lang("ab_date")?></th>
									<th><?=lang("abreason")?></th>
									<th><?=lang("agreed")?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($forms==false){?>
								<tr>
									<td colspan=5 style="text-align: center;"><?= lang("no_inputs") ?>
									</td>
								</tr>
								<?php }else{?>
								<?php foreach($forms as $form){?>
								<?php if($form->type==0){?>
								<tr>
									<td><input type='checkbox' id="<?=$form->id?>"
										value="<?=$form->id?>" name='checks[]'
										class='table_checks style' />
									</td>
									<td><?= $this->homemodel->getStudent($form->student)->fullname?>
									
									<td><?=$form->abday?> / <?=$this->homemodel->getMonth($form->abmonth)?>
									</td>
									<td><?=$form->abreason?></td>
									<td><?=$form->agreed?></td>
								</tr>
								<?php }?>
								<?php }?>
								<?php }?>
							</tbody>
						</table>
						<div class="well-smoke body">
							<button type="button" class="btn btn-danger"
								onClick="confirmDelete('#ab_table_form')">
								<i class="icon-remove"></i>
								<?=lang('delete')?>
							</button>
						</div>
					</form>
				</div>
				<!-- end of absence forms table -->

				<!-- permissions forms table -->
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5>
								<?= lang("table")." ".lang("per_form") ?>
							</h5>
						</div>
					</div>
					<form id="per_table_form" method="post"
						action="<?= base_url()?>admin/delete">
						<input type="hidden" name="table" value="<?= $table ?>" />
						<table class="table table-checks table-hover
					table-striped"
							id="">
							<thead>
								<tr>
									<th><input type='checkbox' id='main_check_all' class='style' />
									</th>
									<th><?=lang("student")?></th>
									<th><?=lang("perout")?></th>
									<th><?=lang("perreason")?></th>
									<th><?=lang("agreed")?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($forms==false){?>
								<tr>
									<td colspan=5 style="text-align: center;"><?= lang("no_inputs") ?>
									</td>
								</tr>
								<?php }else{?>
								<?php foreach($forms as $form){?>
								<?php if($form->type==1){?>
								<tr>
									<td><input type='checkbox' id="<?=$form->id?>"
										value="<?=$form->id?>" name='checks[]'
										class='table_checks style' />
									</td>
									<td><?= $this->homemodel->getStudent($form->student)->fullname?>
									
									<td><?=$form->perout?>
									</td>
									<td><?=$form->perreason?></td>
									<td><?=$form->agreed?></td>
								</tr>
								<?php }?>
								<?php }?>
								<?php }?>
							</tbody>
						</table>
						<div class="well-smoke body">
							<button type="button" class="btn btn-danger"
								onClick="confirmDelete('#per_table_form')">
								<i class="icon-remove"></i>
								<?=lang('delete')?>
							</button>
						</div>

					</form>
				</div>
				<!-- end of permissions froms table -->

				<!-- student id  forms table -->
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5>
								<?= lang("table")." ".lang("student_id") ?>
							</h5>
						</div>
					</div>
					<form id="id_table_form" method="post"
						action="<?= base_url()?>admin/delete">
						<input type="hidden" name="table" value="<?= $table ?>" />
						<table class="table table-checks table-hover
					table-striped"
							id="">
							<thead>
								<tr>
									<th><input type='checkbox' id='main_check_all' class='style' />
									</th>
									<th><?=lang("student")?></th>
									<th><?=lang("date")?></th>
									<th><?=lang("forwardto")?></th>
									<th><?=lang("agreed")?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($forms==false){?>
								<tr>
									<td colspan=5 style="text-align: center;"><?= lang("no_inputs") ?>
									</td>
								</tr>
								<?php }else{?>
								<?php foreach($forms as $form){?>
								<?php if($form->type==2){?>
								<tr>
									<td><input type='checkbox' id="<?=$form->id?>"
										value="<?=$form->id?>" name='checks[]'
										class='table_checks style' />
									</td>
									<td><?= $this->homemodel->getStudent($form->student)->fullname?>
									
									<td><?=$form->iddate?>
									</td>
									<td><?=$form->to?></td>
									<td><?=$form->agreed?></td>
								</tr>
								<?php }?>
								<?php }?>
								<?php }?>
							</tbody>
						</table>
						<div class="well-smoke body">
							<button type="button" class="btn btn-danger"
								onClick="confirmDelete('#id_table_form')">
								<i class="icon-remove"></i>
								<?=lang('delete')?>
							</button>
						</div>
					</form>
				</div>
				<!-- end of student id  froms table -->

				<!-- discount id  forms table -->
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5>
								<?= lang("table")." ".lang("dis_form") ?>
							</h5>
						</div>
					</div>
					<form id="dis_table_form" method="post"
						action="<?= base_url()?>admin/delete">
						<input type="hidden" name="table" value="<?= $table ?>" />
						<table class="table table-checks table-hover
					table-striped"
							id="">
							<thead>
								<tr>
									<th><input type='checkbox' id='main_check_all' class='style' />
									</th>
									<th><?=lang("student")?></th>
									<th><?=lang("fromcity")?></th>
									<th><?=lang("tocity")?></th>
									<th><?=lang("agreed")?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($forms==false){?>
								<tr>
									<td colspan=5 style="text-align: center;"><?= lang("no_inputs") ?>
									</td>
								</tr>
								<?php }else{?>
								<?php foreach($forms as $form){?>
								<?php if($form->type==3){?>
								<tr>
									<td><input type='checkbox' id="<?=$form->id?>"
										value="<?=$form->id?>" name='checks[]'
										class='table_checks style' />
									</td>
									<td><?= $this->homemodel->getStudent($form->student)->fullname?>
									
									<td><?=$form->disfrom?>
									</td>
									<td><?=$form->disto?></td>
									<td><?=$form->agreed?></td>
								</tr>
								<?php }?>
								<?php }?>
								<?php }?>
							</tbody>
						</table>
						<?php if($this->homemodel->checkDeletePermissions("ra_forms")==1){?>
						<div class="well-smoke body">
							<button type="button" class="btn btn-danger"
								onClick="confirmDelete('#dis_table_form')">
								<i class="icon-remove"></i>
								<?=lang('delete')?>
							</button>
						</div>
						<?php }?>
					</form>
				</div>
				<!-- end of discount  froms table -->
			</div>
		</div>
	</div>
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
</body>
</html>
