<!-- add level dialog  -->
<div id="add_level_dialog" class="dialog_div">
	<form id="add_level_form"
		action="http://<?= base_url() ?>insert/insertLevel" method="post">
		<input type="hidden" id="hidden_ra_levels" name="id" /> <label><?= lang("level") ?>
			:</label><input type="text" id="add_level_input" name="level"
			class="required" /> <input type="submit" value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add grade dialog  -->
<div id="add_grade_dialog" class="dialog_div">
	<form id="add_grade_form"
		action="http://<?= base_url() ?>insert/insertGrade" method="post">
		<input type="hidden" id="hidden_ra_grades" name="id" /> <label><?= lang("level") ?>
			:</label><select id="grade_levels" class="levels_select" name="level"
			class="required">
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
			id="add_grade_input" name="grade" class="required" /> <input
			type="submit" value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add class dialog  -->
<div id="add_class_dialog" class="dialog_div">
	<form id="add_class_form"
		action="http://<?= base_url() ?>insert/insertClass" method="post">
		<input type="hidden" id="hidden_ra_classes" name="id" /> <label><?= lang("level") ?>
			:</label><select id="class_levels" class="levels_select" name="">
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
			id="add_class_input" name="class" class="required" /> <input
			type="submit" value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- add subject dialog  -->
<div id="add_subject_dialog" class="dialog_div">
	<form id="add_subject_form"
		action="http://<?= base_url() ?>insert/insertSubject" method="post">
		<input type="hidden" id="hidden_ra_subjects" name="id" /> <label><?= lang("level") ?>
			:</label><select id="subject_levels" class="levels_select" name="">
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
			id="add_subject_input" name="subject" class="required" /> <input
			type="submit" value="<?= lang("add"); ?>" />
	</form>
</div>

<!-- new user form -->

<div id="add_user_dialog" class="dialog_div">
	<form id="add_user_form"
		action="http://<?= base_url()?>insert/insertUser" method="post">
		<label><?= lang("username") ?> :</label><input type="text"
			name="username" class="required" id="add_user_username" /> <label
			id="add_user_notify"></label> <label><?= lang("fullname") ?> :</label><input
			type="text" name="name" class="required" id="add_user_name" /> <label><?= lang("password") ?>
			:</label><input type="password" name="password"
			id="add_user_password" class="required" /> <label><?= lang("repassword") ?>
			:</label><input type="password" name="" id="add_user_repassword"
			class="required" /> <label><?= lang("role") ?> :</label><select
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
			type="radio" name="active" checked="checked" value="active"
			id="add_user_active">
		<?= lang("active") ?>
		<input type="radio" name="active" value="inactive"
			id="add_user_inactive">
		<?= lang("inactive") ?>
		<input type="submit" value="<?= lang("add") ?>" /> <input
			id="user_classes_input" type="text" name="classes" /> <input
			type="button" id="user_classes_but"
			value="<?= lang("user_classes") ?>" /> <input
			id="user_subjects_input" type="text" name="subjects" /> <input
			type="button" id="user_subjects_but"
			value="<?= lang("user_subjects") ?>" />
		<input type="submit" value="<?= lang("add") ?>" />
	</form>
</div>
<!-- add new default numbers and emails for user -->
<div id="add_def_dialog" class="dialog_div">
	<form id="add_def_form"
		action="http://<?= base_url() ?>insert/insertDef" method="post">
		<input type="hidden" id="hidden_ra_defaultnumemail" name="id" /> <label><?= lang("user") ?>
			:</label><select id="add_def_users" class="users_select"
			name="username">
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
			name="number1" class="required" /> <label><?= lang("phone") ?> 2 :</label><input
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
		<input type="hidden" id="hidden_ra_notestypes" name="id" /> <label><?= lang("level") ?>
			:</label><select id="add_notetype_levels" class="levels_select"
			name="level">
			<option value="">
				<?= lang("choose_level")?>
			</option>
			<?php
foreach($levels as $level){?>
			<option value="<?= $level->id ?>">
				<?= $level->level ?>
			</option>
			<?php }?>
		</select> <label><?= lang("type"). " " . lang("note") ?> :</label><select
			id="add_notetype_probs" class="probs_select" name="prob">
			<option value="">
				<?= lang("choose_prob")?>
			</option>
			<?php
foreach($probs as $prob){?>
			<option value="<?= $prob->id ?>">
				<?= $prob->prob ?>
			</option>
			<?php }?>
		</select> <label><?= lang("body"). " " . lang("note") ?> :</label>
		<textarea cols=30 rows=7 name="body" class="required"></textarea>
		<input type="submit" value="<?= lang("add")?>" />
	</form>
</div>

<!-- add ready message dialog -->
<div id="add_ready_dialog" class="dialog_div">
	<form id="add_ready_form"
		action="http://<?= base_url() ?>insert/insertReady" method="post">
		<input type="hidden" id="hidden_ra_readymessages" name="id" /> <label><?= lang("message") ?>
		</label>
		<textarea cols=30 rows=7 name="message" class="required"></textarea>
		<input type="submit" value="<?= lang("add") ?>" />
	</form>
</div>

<!-- add note prob dialog -->
<div id="add_prob_dialog" class="dialog_div">
	<form id="add_prob_form"
		action="http://<?= base_url() ?>insert/insertProb" method="post">
		<input type="hidden" id="hidden_ra_notesprob" name="id" /> <label><?= lang("level") ?>
			:</label><select id="add_notesprob_levels" class="levels_select"
			name="level">
			<option value="">
				<?= lang("choose_level")?>
			</option>
			<?php
foreach($levels as $level){?>
			<option value="<?= $level->id ?>">
				<?= $level->level ?>
			</option>
			<?php }?>
		</select> <label><?= lang("prob") ?> </label> <input type="text"
			name="prob" class="required" /> <input type="submit"
			value="<?= lang("add") ?>" />
	</form>
</div>
<!-- add user role dialog -->
<div id="add_role_dialog" class="dialog_div">
	<form id="add_role_form"
		action="http://<?= base_url() ?>insert/insertRole" method="post">
		<input type="hidden" id="hidden_ra_roles" name="id" /> <label><?= lang("role") ?>
		</label><input type="text" name="role" class="required" /> <input
			type="submit" value="<?= lang("add") ?>" />
	</form>
</div>

<!-- add new student -->
<div id="add_student_dialog" class="dialog_div">
	<form id="add_student_form"
		action="http://<?= base_url() ?>insert/insertStudent" method="post">
		<input type="hidden" id="hidden_ra_students" name="id" /> <label><?= lang("user") ?>
			:</label><select id="add_student_users" class="users_select"
			name="username">
			<option value="">
				<?= lang("without")?>
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
			<option value="<?= $level->id ?>">
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
			name="idnum" onkeypress="return isNumberKey(event)" class="required" />
		<label><?= lang("fullname") ?> :</label><input type="text"
			name="fullname" /> <input type="submit" value="<?= lang("add")?>" />
	</form>
</div>

<!-- beginning values for inserting notes dialog -->
<div id="begin_notes_dialog" class="dialog_div">
	<form id="begin_notes_form"
		action="http://<?= base_url() ?>home/showNotes" method="POST">
		<!-- <label><?= lang("level") ?> :</label><select id="begin_notes_levels"
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
		</select> <label><?= lang("grade") ?> :</label><select
			id="begin_notes_grades" class="grades_select" name="grade">
			<option value="">
				<?= lang("choose_grade") ?>
			</option>
		</select> -->
		<label><?= lang("class") ?> :</label><select id="begin_notes_classes"
			class="classes_select" name="class">
			<option value="">
				<?= lang("choose_class") ?>
			</option>
			<?php foreach($classes as $class){?>
			<option value="<?= $class->id ?>">
				<?= $class->class ?>
			</option>
			<?php }?>
		</select>
		<div id="begin_notes_students_div">
			<label><?= lang("student") ?> :</label><select
				id="begin_notes_students" class="students_select" name="student">
				<option value="">
					<?= lang("choose_student") ?>
				</option>
			</select>
		</div>
		<label><?= lang("notes_num") ?> </label><input type="text" name="num"
			value="1" /> <label><?= lang("subject") ?> :</label><select
			id="begin_notes_subjects" class="subjects_select" name="subject">
			<option value="">
				<?= lang("choose_subject") ?>
			</option>
		</select> <label><?= lang("status") ?> </label><input type="radio"
			name="status" value="continue" checked="checked" />
		<?= lang("continue") ?>
		<input type="radio" name="status" value="solved" />
		<?= lang("solved") ?>
		<label><?= lang("datetime") ?> </label><input type="text"
			name="datetime" readonly="readonly" id="begin_notes_datetime" /><label><?= lang("note_prob") ?>
			:</label><select id="begin_notes_probs" class="probs_select"
			name="prob">
			<option value="">
				<?= lang("choose_prob") ?>
			</option>
		</select> <label><?= lang("note_type") ?> :</label><select
			id="begin_notes_types" class="types_select" name="type">
			<option value="">
				<?= lang("choose_type") ?>
			</option>
		</select> <label><?= lang("note") ?>:</label>
		<textarea id="begin_notes_note" cols="25" rows="10" name="note"></textarea>
		<input type="submit" value="continue" />
	</form>
</div>

<!-- user classes dialog to add to user permissions -->
<div id="user_classes_dialog" class="dialog_div">

	<input type="checkbox" id="user_classes_all_check" />
	<?= lang("choose_all") ?>
	<?php 
foreach($classes as $class){?>
	<input type="checkbox" value="<?= $class->id ?>"
		class="user_classes_checks" />
	<?= $class->class ?>
	<?php }?>
	<input type="button" value="<?= lang("continue") ?>"  />
</div>

<!-- user subjects dialog to add to user permissions -->
<div id="user_subjects_dialog" class="dialog_div">

	<input type="checkbox" id="user_subjects_all_check" />
	<?= lang("choose_all") ?>
	<?php 
foreach($subjects as $subject){?>
	<input type="checkbox" value="<?= $subject->id ?>"
		class="user_subjects_checks" />
	<?= $subject->subject ?>
	<?php }?>
	<input type="button" value="<?= lang("continue") ?>"  />
</div>
