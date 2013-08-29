<?php $this->db->order_by("order","asc")?>
<?php $query=$this->db->get("slider")?>
<?php $sliders = $query->result_array()?>
<?php $this->load->view("header")?>
<div class="login">
	<?php if(! is_null($msg)){?>
	<div class="notice outer closing">
		<div class="note <?=$color?>">
			<button type="button" class="close">×</button>
			<strong><?= $msg ?> </strong>
		</div>
	</div>
	<?php }?>
	<!-- Main wrapper -->
	<div class="login-wrapper">


		<!-- Login block -->
		<div class="well">
			<div class="navbar">
				<div class="navbar-inner">
					<h6>
						<i class="font-user"></i>
						<?= lang("rased_login") ?>
					</h6>

				</div>
			</div>
			<form action='<?= base_url();?>userlogin/process' class="row-fluid"
				method="post">
				<div class="control-group">
					<label class="control-label"><?= lang("username") ?>:</label>
					<div class="controls">
						<input class="span12" type="text" name="username"
							placeholder="<?= lang("username") ?>" />
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("password") ?>:</label>
					<div class="controls">
						<input class="span12" type="password" name="password"
							placeholder="<?= lang("password") ?>" />
					</div>
				</div>

				<div class="login-btn">
					<input type="submit" value="<?= lang("login") ?>"
						class="btn btn-info btn-block btn-large" />
				</div>
				<a style="margin-right: 50px;"
					href="<?= base_url() ?>newuser/forgetPassword" target="_blank"><?= lang("forget_password")?>
				</a>

			</form>
			<div class="control-group" style="text-align: center;">
				<input type="button" class="btn btn-inverse"
					value="<?=lang("new_user") ?>" id="new_id_but" />
			</div>
			<div id="new_id_num_div">
				<form class="form-horizontal"
					action="<?=base_url() ?>newuser/checkIdnum" method="POST">
					<div class="control-group">
						<label class="control-label" style="width: 30% !important;"><?= lang('idnum') ?><span
							class="req">*</span> </label>
						<div class="controls">
							<input type="text" class="required span12" name="idnum" id="" />
						</div>
						<div class="control-group" style="text-align: center;">
							<input type="submit" class="btn btn-success"
								value="<?=lang("next") ?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /login block -->

	</div>
	<div id="" class="user-slider">
		<?php if($query->num_rows()>0){?>
		<?php $num=$query->num_rows()?>
		<?php foreach($sliders as $slider){?>
		<?php if($slider["order"]>0){?>
		<div class="slide_<?=$slider["order"]?>">
		<a  href="<?=$slider["url"]?>"><img  src="<?=$slider["picture"]?>" style="position:absolute;width:300px;height:300px;"/> </a>
		</div>
		<?php }?>
		<?php }?>
		<?php }?>
	</div>

</div>
<!-- /main wrapper -->

</body>
</html>
