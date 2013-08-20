<html>
<head>
<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/user.js"></script>
<meta charset="utf-8" />
</head>
<body>
<a href="<?base_url()?>user">back</a>
	<?php if(isset($msg)){
		if($msg!=""){
			echo $msg;
}
}?>
	<div id="forms_div">
		<label id="form_title_label"></label>
		<form method="post" action="#">
			<select name="student">
				<option value="">
					<?=lang("choose_student")?>
				</option>
				<?php foreach($students as $student){?>
				<option value="<?=$student->id?>">
					<?=$student->fullname?>
				</option>
				<?php }?>
			</select> <select name="type" id="form_type_select">
				<option value="">
					<?=lang("choose_form")?>
				</option>
				<?php foreach($forms as $key => $form){?>
				<option value="<?=$key?>" onclick="showAbForm('<?=$form[0] ?>');">
					<?=$form[1]?>
				</option>
				<?php }?>
			</select> <label id="form_id_label"></label> <label
				id="form_class_label"></label>
			<div id="per_form" style="display: none;">
				<label><?=lang("perout")?> </label><input type="text" name="perout" />
				<label><?=lang("perreason")?> </label>
				<textarea cols="40" rows="5" name="perreason"></textarea>
				<input type="submit" value="<?=lang("add")?>" />
			</div>
			<div id="ab_form" style="display: none;">
				<label><?=lang("abdate")?> </label><select name="abmonth"
					class="datestyle">

					<?php
foreach($monthes as $key1 => $montha){?>
					<option value="<?= $key1 ?>">
						<?= $montha?>
					</option>
					<?php }?>
				</select> <select name="abday" class="width50">
					<?php
foreach($days as $daya){?>
					<option value="<?= $daya ?>">
						<?= $daya?>
					</option>
					<?php }?>
				</select> <label><?=lang("abreason")?> </label>
				<textarea cols="40" rows="5" name="abreason"></textarea>
				<input type="submit" value="<?=lang("add")?>" />

			</div>
			<div id="dis_form" style="display: none;">
				<label><?=lang("fromcity")?> </label><input type="text"
					name="disfrom" /> <label><?=lang("tocity")?> </label><input
					type="text" name="disto" /> <input type="submit"
					value="<?=lang("add")?>" />

			</div>
			<div id="id_form" style="display: none;">
				<label><?=lang("iddate")?> </label><input type="text" name="iddate" />
				<label><?=lang("forwardto")?> </label>
				<textarea cols="40" rows="5" name="to"></textarea>
				<input type="submit" value="<?=lang("add")?>" />

			</div>
		</form>
	</div>
</body>
</html>
