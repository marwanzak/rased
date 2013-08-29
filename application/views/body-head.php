<!-- Main content -->
<div class="content" id="main_content_div">
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

			<div class="body"></div>