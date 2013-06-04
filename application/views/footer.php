<!-- add level dialog  -->
<div id="add_level_dialog" class="dialog_div">
	<form id="add_level_form"
		action="http://<?= base_url() ?>insert/insertLevel" method="post">
		<label><?= lang("level") ?> </label><input type="text"
			id="add_level_input" name="level" /> <input type="submit"
			value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add grade dialog  -->
<div id="add_grade_dialog" class="dialog_div">
	<form id="add_grade_form"
		action="http://<?= base_url() ?>insert/insertGrade" method="post">
		<label><?= lang("level") ?> </label><select id="grade_levels"
			class="levels_select" name="level">
			<option value="">
				<?= lang("choose_level")?>
			</option>
			<?php
foreach($levels as $level){?>
			<option value=<?= $level->id ?>>
				<?= $level->level ?>
			</option>
			<?php }?>
		</select><label><?= lang("grade") ?> </label> <input type="text"
			id="add_grade_input" name="grade" /> <input type="submit"
			value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add class dialog  -->
<div id="add_class_dialog" class="dialog_div">
	<form id="add_class_form"
		action="http://<?= base_url() ?>insert/insertClass" method="post">
		<label><?= lang("level") ?> </label><select id="class_levels"
			class="levels_select" name="">
			<option value="">
				<?= lang("choose_level")?>
			</option>
			<?php
foreach($levels as $level){?>
			<option value="<?= $level->id ?>">
				<?= $level->level ?>
			</option>
			<?php }?>
		</select> <label><?= lang("grade") ?> </label><select
			id="class_grades" class="grades_select" name="grade">
			<option value="">
				<?= lang("choose_grade") ?>
			</option>
		</select> <label><?= lang("class") ?> </label><input type="text"
			id="add_class_input" name="class" /> <input type="submit"
			value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add subject dialog  -->
<div id="add_subject_dialog" class="dialog_div">
	<form id="add_subject_form"
		action="http://<?= base_url() ?>insert/insertSubject" method="post">
		<label><?= lang("level") ?> </label><select id="subject_levels"
			class="levels_select" name="">
			<option value="">
				<?= lang("choose_level")?>
			</option>
			<?php
foreach($levels as $level){?>
			<option value="<?= $level->id ?>">
				<?= $level->level ?>
			</option>
			<?php }?>
		</select> <label><?= lang("grade") ?> </label><select
			id="subject_grades" class="grades_select" name="grade">
			<option value="">
				<?= lang("choose_grade") ?>
			</option>
		</select><label><?= lang("subject") ?> </label> <input type="text"
			id="add_grade_input" name="subject" /> <input type="submit"
			value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- new user form -->

<div id="add_user_dialog" class="dialog_div">
	<form id="add_user_form"
		action="http://<?= base_url()?>insert/insertUser" method="post">
		<label><?= lang("username") ?> </label><input type="text"
			name="username" /> <label><?= lang("fullname") ?> </label><input
			type="text" name="name" /> <label><?= lang("password") ?> </label><input
			type="password" name="password" /> <label><?= lang("role") ?> </label><select
			id="add_user_roles" class="roles_select" name="role">
			<option value="">
				<?= lang("choose_role")?>
			</option>
			<?php
foreach($roles as $role){?>
			<option value="<?= $role->id ?>">
				<?= $role->role ?>
			</option>
			<?php }?>
		</select> <input type="radio" name="active" checked="checked"
			value="active">
		<?= lang("active") ?>
		<input type="radio" name="active" value="inactive">
		<?= lang("inactive") ?>

	</form>
</div>



</html>
