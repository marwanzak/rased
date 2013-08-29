<?php $data["table"]=$table;?>
<?php $this->load->view("header")?>
<?php $this->load->view("top-nav",$data)?>
<?php $this->load->view("menu-bar",$data)?>

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
					<?= lang("site_settings") ?>
				</h5>
			</div>
			<!-- /page header -->
			<div class="body">
			<?php $permissions = $this->homemodel->checkCreatePermissions($table);?>
			<?php if($permissions==1){?>
				<div class="well-smoke body">
					<a data-toggle="modal" href="#add_new_slide_dialog" id="add_ra_slider"
						class="btn btn-success"><i class="icon-plus"></i> <?= lang("add") ?>
					</a>
				</div>
				<?php }?>
				<form id="main_table_form" method="post"
					action="<?= base_url()?>admin/delete">
					<input type="hidden" name="table" value="<?= $table ?>" />

					<table class="table table-checks table-hover
					table-striped"
						id="">
						<thead>
							<tr>
								<th><input type='checkbox' id='main_check_all' class='style' />
								</th>
								<th><?=lang("order")?></th>
								<th><?=lang("url")?></th>
								<th><?=lang("picture")?></th>
								<th><?=lang("actions")?></th>
							</tr>
						</thead>
						<tbody>
							<?php if($sliders==false){?>
							<tr>
								<td colspan=5 style="text-align: center;"><?= lang("no_inputs") ?>
								</td>
							</tr>
							<?php }else{?>
							<?php foreach($sliders as $slider){?>
							<tr>
								<td><input type='checkbox' id="<?=$slider->id?>"
									value="<?=$slider->id?>" name='checks[]'
									class='table_checks style' />
								</td>
								<td><?=$slider->order?></td>
								<td><?=$slider->url?></td>
								<td><a href="<?=$slider->picture?>" target="_blank"><img
										src="<?=$slider->picture?>"
										style="width: 100px; height: 100px;" /> </a>
								</td>
								<td>
								<?php if($this->homemodel->checkModifyPermissions("ra_slider")==1){?>
								<a title="<?=lang("modify")." ".lang("slider")?>"
									id="<?= $slider->id?>" data-toggle='modal'
									href='#add_new_slide_dialog'
									class='btn btn-primary modify_ra_slider'><i class='icon-wrench'></i>
								</a>
								<?php }?>
								</td>

							</tr>
							<?php }?>
							<?php }?>
						</tbody>
					</table>
				</form>
				<?php $this->load->view("buttons");?>


			</div>

		</div>
	</div>
</div>
<!-- /main content -->
</div>
<!-- /main wrapper -->

<!-- add new slider to slider dialog -->
<div id="add_new_slide_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<form id="add_new_slide_form" class="form-horizontal"
		action="<?=base_url()?>admin/showSlider" method="post"
		enctype="multipart/form-data">
		<input type="hidden" value="1" name="upload" /> <input type="hidden"
			name="id" />
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h5 id="">
				<?= lang("add")." ".lang("slider") ?>
			</h5>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label"><?= lang("order") ?>:</label>
				<div class="controls">
					<input type="text" class="span6" name="order" />
				</div>
			</div>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label class="control-label"><?= lang("url") ?>:</label>
				<div class="controls">
					<input type="text" class="span6" name="url" />
				</div>
			</div>
		</div>
		<div class="modal-body" id="add_slide_div">
			<div class="control-group">
				<label class="control-label"><?= lang("picture") ?>:</label> <label
					style="color: green;"><?=lang("picture_valid")?> </label>
				<div class="controls">
					<input type="file" class="span6" name="picture" /> <label
						style="color: blue;"><?=lang("picture_types")?> </label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" value="<?=lang("add")?>" class="btn btn-success" />
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
		</div>
	</form>

</div>
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
