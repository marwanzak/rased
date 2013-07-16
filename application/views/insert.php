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
		<div class="row-fluid"></div>
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

<!-- add level dialog  -->
<div id="add_ra_levels_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="add_level_label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("add")." ".lang("level") ?>
		</h5>
	</div>
	<form id="add_level_form" action="<?= base_url() ?>insert/insertLevel"
		method="post">
		<div class="modal-body">
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?= lang("level") ?>:<span class="req">*</span>
					</label>
					<div class="controls">
						<input type="text" class="required span12" name="level"
							id="add_level_input" />
					</div>
				</div>
			</div>
			<input type="hidden" id="hidden_ra_levels" name="id" />

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<input value="<?= lang("add")?>" type="submit" class="btn btn-primary"/>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>

<!-- add grade dialog -->
<div id="add_ra_grades_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="add_level_label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("add")." ".lang("grade") ?>
		</h5>
	</div>
	<form id="add_grade_form" action="<?= base_url() ?>insert/insertGrade"
		method="post">
		<div class="modal-body">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?= lang("ra_levels") ?> </label>
					<div class="controls">
						<input type="hidden" id="hidden_ra_grades" name="id" /> <select
							name="level" class="levels_select" id="grade_levels">
							<option value="">
								<?= lang("choose_level")?>
							</option>
							<?php
foreach($levels as $level){?>
							<option value=<?= $level->id ?>>
								<?= $level->level ?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("grade") ?> :<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" id="add_grade_input"
							name="grade" />
					</div>
				</div>

			</div>
			<input type="hidden" id="hidden_ra_levels" name="id" />

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<?= lang("add")?>
			</button>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>

<!-- add class dialog -->
<div id="add_ra_classes_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="add_level_label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("add")." ".lang("class") ?>
		</h5>
	</div>
	<form id="add_class_form" action="<?= base_url() ?>insert/insertClass"
		method="post">
		<div class="modal-body">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?= lang("level") ?> </label>
					<div class="controls">
						<select name="level" class="levels_select" id="class_levels">
							<option value="">
								<?= lang("choose_level")?>
							</option>
							<?php
foreach($levels as $level){?>
							<option value=<?= $level->id ?>>
								<?= $level->level ?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("grade") ?> </label>
					<div class="controls">
						<select name="grade" class="grades_select" id="class_grades">
							<option value="">
								<?= lang("choose_grade")?>
							</option>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("class") ?> :<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" id="add_class_input"
							name="class" />
					</div>
				</div>

			</div>
			<input type="hidden" id="hidden_ra_classes" name="id" />

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<?= lang("add")?>
			</button>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>

<!-- add subject dialog -->
<div id="add_ra_subjects_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="add_subject_label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("add")." ".lang("subject") ?>
		</h5>
	</div>
	<form id="add_subject_form"
		action="<?= base_url() ?>insert/insertSubject" method="post">
		<div class="modal-body">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?= lang("subject") ?> </label>
					<div class="controls">
						<select name="level" class="levels_select" id="subject_levels">
							<option value="">
								<?= lang("choose_level")?>
							</option>
							<?php
foreach($levels as $level){?>
							<option value=<?= $level->id ?>>
								<?= $level->level ?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("grade") ?> </label>
					<div class="controls">
						<select name="grade" class="grades_select" id="subject_grades">
							<option value="">
								<?= lang("choose_grade")?>
							</option>

						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("subject") ?> :<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" id="add_subject_input"
							name="subject" />
					</div>
				</div>

			</div>
			<input type="hidden" id="hidden_ra_subjects" name="id" />

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<?= lang("add")?>
			</button>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>

<!-- add user dialog -->
<div id="add_ra_users_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="add_user_label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("add")." ".lang("user") ?>
		</h5>
	</div>
	<form id="add_user_form" action="<?= base_url() ?>insert/insertUser"
		method="post">
		<input type="hidden" id="hidden_ra_users" name="id" />
		<div class="modal-body flow_dialog">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?= lang("username") ?> :<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" id="add_user_username"
							name="username" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("fullname") ?> :<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" id="add_user_name"
							name="name" />
					</div>
				</div>
				<div id="password_container">
					<div class="control-group">
						<label class="control-label"><?= lang("password") ?> :<span
							class="req">*</span> </label>
						<div class="controls">
							<input type="password" class="required span12"
								id="add_user_password" name="password" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><?= lang("repassword") ?> :<span
							class="req">*</span> </label>
						<div class="controls">
							<input type="password" class="required span12"
								id="add_user_repassword" name="" />
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("role") ?> </label>
					<div class="controls">
						<select name="role" class="roles_select" id="add_user_roles">
							<option value="">
								<?= lang("choose_role")?>
							</option>
							<?php
foreach($roles as $role){?>
							<option value=<?= $role->id ?>>
								<?= $role->role ?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="for control-label"><?= lang("user_status") ?>:</label>
					<div class="controls">
						<label class="radio inline"><input type="radio" name="active"
							id="user_active_radio" value="active" class="style"
							checked="checked"> <?= lang("active") ?> </label> <label
							class="radio inline"><input type="radio" id="user_inactive_radio"
							name="active" value="inactive" class="style"> <?= lang("inactive") ?>
						</label>
					</div>
				</div>


				<div class="control-group">
					<input type="hidden" id="hidden_user_classes" name="classes" /> <label
						class="control-label"><?= lang("user_classes") ?> :<span
						class="req">*</span> </label>
					<div class="controls">
						<a href="#user_classes_dialog" class="btn btn-primary"
							data-toggle="modal" id="user_classes_but"><b class="icon-comment"></b>
							<?= lang("user_classes") ?> </a>
					</div>
				</div>

				<div class="control-group">
					<input type="hidden" id="hidden_user_subjects" name="subjects" /> <label
						class="control-label"><?= lang("user_subjects") ?> :<span
						class="req">*</span> </label>
					<div class="controls">
						<a href="#user_subjects_dialog" class="btn btn-primary"
							data-toggle="modal" id="user_subjects_but"> <b
							class="icon-comment"></b> <?= lang("user_subjects") ?>
						</a>

					</div>
				</div>

			</div>

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<?= lang("add")?>
			</button>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>

<!-- modify user password dialog  -->
<div id="modify_user_password_dialog" class="modal hide fade"
	tabindex="-1" role="dialog" aria-labelledby="add_level_label"
	aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("modify")." ".lang("password") ?>
		</h5>
	</div>
	<form id="" action="<?= base_url() ?>modify/modifyPassword"
		method="post">
		<div class="modal-body">
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?= lang("password") ?>:<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="password" class="required span12" name="password"
							id="add_level_input" />
					</div>
				</div>
			</div>
			<input type="hidden" id="hidden_user_password_id" name="id" />

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<?= lang("modify")?>
			</button>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
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

<!-- add note prob dialog  -->
<div id="add_ra_notesprob_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("add")." ".lang("note_prob") ?>
		</h5>
	</div>
	<form id="add_prob_form" action="<?= base_url() ?>insert/insertProb"
		method="post">
		<input type="hidden" id="hidden_ra_notesprob" name="id" />
		<div class="modal-body">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?= lang("ra_levels") ?> </label>
					<div class="controls">
						<select name="level" class="levels_select"
							id="add_notesprob_levels">
							<option value="">
								<?= lang("choose_level")?>
							</option>
							<?php
foreach($levels as $level){?>
							<option value=<?= $level->id ?>>
								<?= $level->level ?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("note_prob") ?>:<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" name="prob"
							id="add_level_input" />
					</div>
				</div>
			</div>

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<?= lang("add")?>
			</button>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>

<!-- add note prob dialog -->
<div id="" class="dialog_div">
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

<!-- add role dialog  -->
<div id="add_ra_roles_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("add")." ".lang("role") ?>
		</h5>
	</div>
	<form id="add_role_form" action="<?= base_url() ?>insert/insertRole"
		method="post">
		<div class="modal-body">
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?= lang("role") ?>:<span class="req">*</span>
					</label>
					<div class="controls">
						<input type="text" class="required span12" name="role" id="" />
					</div>
				</div>
			</div>
			<input type="hidden" id="hidden_ra_roles" name="id" />

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<?= lang("add")?>
			</button>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>



<!-- add new student dialog  -->
<div id="add_ra_students_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("add")." ".lang("student") ?>
		</h5>
	</div>
	<form id="add_student_form"
		action="<?= base_url() ?>insert/insertStudent" method="post">
		<div class="modal-body flow_dialog">
			<div class="row-fluid">

				<div class="control-group">
					<label class="control-label"><?= lang("username") ?> </label>
					<div class="controls">
						<select name="username" class="users_select"
							id="add_student_users">
							<option value="">
								<?= lang("without")?>
							</option>
							<?php
foreach($users as $user){?>
							<option value=<?= $user->id ?>>
								<?= $user->username ?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("level") ?> </label>
					<div class="controls">
						<select name="" class="levels_select" id="add_student_levels">
							<option value="">
								<?= lang("choose_level")?>
							</option>
							<?php
foreach($levels as $level){?>
							<option value=<?= $level->id ?>>
								<?= $level->level ?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("grade") ?> </label>
					<div class="controls">
						<select name="" class="grades_select" id="add_student_grades">
							<option value="">
								<?= lang("choose_grade")?>
							</option>

						</select>

					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("class") ?> </label>
					<div class="controls">
						<select name="class" class="classes_select"
							id="add_student_classes">
							<option value="">
								<?= lang("choose_class")?>
							</option>

						</select>

					</div>
				</div>


				<div class="control-group">
					<label class="control-label"><?= lang("idnum") ?>:<span class="req">*</span>
					</label>
					<div class="controls">
						<input type="text" class="required span12" name="idnum"
							onkeypress="return isNumberKey(event)" id="add_student_idnum" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("fullname") ?>:<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" name="fullname"
							id="add_student_fullname" />
					</div>
				</div>
			</div>
			<input type="hidden" id="hidden_ra_students" name="id" />

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<?= lang("add")?>
			</button>
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
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
<div id="user_classes_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="add_user_classes_label"
	aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="myModalLabel">
			<?= lang("user_classes") ?>
		</h5>
	</div>

	<div class="modal-body">
		<div class="row-fluid">
			<div class="control-group">
				<div class="controls">
					<?php 
foreach($classes as $class){?>
					<label class="checkbox"><input type="checkbox"
						class="style user_classes_checks" value="<?= $class->id ?>"
						checked=""> <?= $class->class ?> </label>
					<?php }?>

				</div>
			</div>


		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">
			<?= lang("close") ?>
		</button>
		<button type="submit" class="btn btn-primary" id="user_classes_ok"
			data-dismiss="modal">
			<?= lang("continue")?>
		</button>

	</div>
</div>

<!-- user subjects dialog to add to user permissions -->
<div id="user_subjects_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("user_subjects") ?>
		</h5>
	</div>

	<div class="modal-body">
		<div class="row-fluid">
			<div class="control-group">
				<div class="controls">
					<?php 
foreach($subjects as $subject){?>
					<label class="checkbox"><input type="checkbox"
						class="style user_subjects_checks" value="<?= $subject->id ?>" />
						<?= $subject->subject ?> </label>
					<?php }?>

				</div>
			</div>


		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">
			<?= lang("close") ?>
		</button>
		<button type="submit" class="btn btn-primary" id="user_subjects_ok"
			data-dismiss="modal">
			<?= lang("continue")?>
		</button>

	</div>
</div>



<!-- /dialog content -->


<!-- add level dialog  -->
<div id="" class="dialog_div">
	<form id="add_level_form"
		action="http://<?= base_url() ?>insert/insertLevel" method="post">
		<input type="hidden" id="hidden_ra_levels" name="id" /> <label><?= lang("level") ?>
			:</label><input type="text" id="add_level_input" name="level"
			class="required" /> <input type="submit" value="<?= lang("add"); ?>" />
	</form>
</div>
<!-- add grade dialog  -->
<div id="" class="dialog_div">
	<form id="add_ra_gradse_form"
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

<div id="add_user_dialog" class="dialog_div scrollspy-example">
	<div class="">
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
				value="<?= lang("user_subjects") ?>" /> <input type="submit"
				value="<?= lang("add") ?>" />
		</form>
	</div>
</div>

<!-- add new student -->
<div id="" class="dialog_div">
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

<!-- add user role dialog -->
<div id="" class="dialog_div">
	<form id="add_role_form"
		action="http://<?= base_url() ?>insert/insertRole" method="post">
		<input type="hidden" id="hidden_ra_roles" name="id" /> <label><?= lang("role") ?>
		</label><input type="text" name="role" class="required" /> <input
			type="submit" value="<?= lang("add") ?>" />
	</form>
</div>


