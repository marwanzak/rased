<!-- add level dialog  -->
<div id="add_level_dialog" class="dialog_div">
	<form id="add_level_form"
		action="http://<?= base_url() ?>insert/insertLevel" method="post">
		<label><?= lang("level") ?> :</label><input type="text"
			id="add_level_input" name="level" /> <input type="submit"
			value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add grade dialog  -->
<div id="add_grade_dialog" class="dialog_div">
	<form id="add_grade_form"
		action="http://<?= base_url() ?>insert/insertGrade" method="post">
		<label><?= lang("level") ?> :</label><select id="grade_levels"
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
		</select><label><?= lang("grade") ?> :</label> <input type="text"
			id="add_grade_input" name="grade" /> <input type="submit"
			value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add class dialog  -->
<div id="add_class_dialog" class="dialog_div">
	<form id="add_class_form"
		action="http://<?= base_url() ?>insert/insertClass" method="post">
		<label><?= lang("level") ?> :</label><select id="class_levels"
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
		</select> <label><?= lang("grade") ?> :</label><select
			id="class_grades" class="grades_select" name="grade">
			<option value="">
				<?= lang("choose_grade") ?>
			</option>
		</select> <label><?= lang("class") ?> :</label><input type="text"
			id="add_class_input" name="class" /> <input type="submit"
			value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add subject dialog  -->
<div id="add_subject_dialog" class="dialog_div">
	<form id="add_subject_form"
		action="http://<?= base_url() ?>insert/insertSubject" method="post">
		<label><?= lang("level") ?> :</label><select id="subject_levels"
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
		</select> <label><?= lang("grade") ?> :</label><select
			id="subject_grades" class="grades_select" name="grade">
			<option value="">
				<?= lang("choose_grade") ?>
			</option>
		</select><label><?= lang("subject") ?> :</label> <input type="text"
			id="add_grade_input" name="subject" /> <input type="submit"
			value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- new user form -->

<div id="add_user_dialog" class="dialog_div">
	<form id="add_user_form"
		action="http://<?= base_url()?>insert/insertUser" method="post">
		<label><?= lang("username") ?> :</label><input type="text"
			name="username" /> <label><?= lang("fullname") ?> :</label><input
			type="text" name="name" /> <label><?= lang("password") ?> :</label><input
			type="password" name="password" /> <label><?= lang("role") ?> :</label><select
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
		</select> <label><?= lang("user_status") ?>:</label><input
			type="radio" name="active" checked="checked" value="active">
		<?= lang("active") ?>
		<input type="radio" name="active" value="inactive">
		<?= lang("inactive") ?>
		<input type="submit" value="<?= lang("add") ?>" />
	</form>
</div>
<!-- add new default numbers and emails for user -->
<div id="add_def_dialog" class="dialog_div">
	<form id="add_def_form"
		action="http://<?= base_url() ?>insert/insertDef" method="post">
		<label><?= lang("user") ?> :</label><select id="add_def_users"
			class="users_select" name="username">
			<option value="">
				<?= lang("choose_user")?>
			</option>
			<?php
foreach($users as $user){?>
			<option value="<?= $user->id ?>">
				<?= $user->username ?>
			</option>
			<?php }?>
		</select> <label><?= lang("phone") ?> 1 :</label><input type="text"
			name="number1" /> <label><?= lang("phone") ?> 2 :</label><input
			type="text" name="number2" /> <label><?= lang("email") ?> 1 :</label><input
			type="text" name="email1" /> <label><?= lang("email") ?> 2 :</label><input
			type="text" name="email2" /> <input type="submit"
			value="<?= lang("add")?>" />
	</form>
</div>


<!-- add note type for level -->
<div id="add_notetype_dialog" class="dialog_div">
	<form id="add_notetype_form"
		action="http://<?= base_url() ?>insert/insertNoteType" method="post">
		<label><?= lang("level") ?> :</label><select id="add_notetype_levels"
			class="levels_select" name="level">
			<option value="">
				<?= lang("choose_level")?>
			</option>
			<?php
foreach($levels as $level){?>
			<option value="<?= $level->id ?>">
				<?= $level->level ?>
			</option>
			<?php }?>
		</select> <label><?= lang("type"). " " . lang("note") ?> :</label><input
			type="text" name="type" /> <label><?= lang("body"). " " . lang("note") ?>
			:</label>
		<textarea cols=30 rows=7 name="body"></textarea>
		<input type="submit" value="<?= lang("add")?>" />
	</form>
</div>

<!-- add ready message dialog -->
<div id="add_ready_dialog" class="dialog_div">
	<form id="add_ready_form"
		action="http://<?= base_url() ?>insert/insertReady" method="post">
		<label><?= lang("message") ?> </label>
		<textarea cols=30 rows=7 name="message"></textarea>
		<input type="submit" value="<?= lang("add") ?>" />
	</form>
</div>
<!-- add user role dialog -->
<div id="add_role_dialog" class="dialog_div">
	<form id="add_role_form"
		action="http://<?= base_url() ?>insert/insertRole" method="post">
		<label><?= lang("role") ?> </label><input type="text" name="role" /> <input
			type="submit" value="<?= lang("add") ?>" />
	</form>
</div>

<!-- add new student -->
<div id="add_student_dialog" class="dialog_div">
	<form id="add_student_form"
		action="http://<?= base_url() ?>insert/insertStudent" method="post">
		<label><?= lang("user") ?> :</label><select id="add_student_users"
			class="users_select" name="username">
			<option value="">
				<?= lang("choose_user")?>
			</option>
			<?php
foreach($users as $user){?>
			<option value="<?= $user->id ?>">
				<?= $user->username ?>
			</option>
			<?php }?>
		</select> <label><?= lang("level") ?> :</label><select
			id="add_student_levels" class="levels_select" name="">
			<option value="">
				<?= lang("choose_level")?>
			</option>
			<?php
foreach($levels as $level){?>
			<option value=<?= $level->id ?>>
				<?= $level->level ?>
			</option>
			<?php }?>
		</select> <label><?= lang("grade") ?> :</label><select
			id="add_student_grades" class="grades_select" name="">
			<option value="">
				<?= lang("choose_grade") ?>
			</option>
		</select> <label><?= lang("class") ?> :</label><select
			id="add_student_classes" class="classes_select" name="class">
			<option value="">
				<?= lang("choose_class") ?>
			</option>
		</select> <label><?= lang("idnum") ?> :</label><input type="text"
			name="idnum" /> <label><?= lang("fullname") ?> :</label><input
			type="text" name="fullname" /> <input type="submit"
			value="<?= lang("add")?>" />
	</form>
</div>


