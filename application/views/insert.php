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
			<input value="<?= lang("add")?>" type="submit"
				class="btn btn-primary" />
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
<div id="add_ra_defaultnumemail_dialog" class="modal hide fade"
	tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("add")." ".lang("note_type") ?>
		</h5>
	</div>
	<form id="add_def_form" action="<?= base_url() ?>insert/insertDef"
		method="post">
		<div class="modal-body">
			<div class="row-fluid">
				<input type="hidden" id="hidden_ra_defaultnumemail" name="id" />
				<div class="control-group">
					<label class="control-label"><?= lang("username") ?> </label>
					<div class="controls">
						<select name="username" class="users_select" id="add_def_users">
							<option value="">
								<?= lang("choose_user")?>
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
					<label class="control-label"><?= lang("phone") ?> 1:<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" name="number1"
							onkeypress="return isNumberKey(event)" />
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("phone") ?> 2: </label>
					<div class="controls">
						<input type="text" class="span12" name="number2"
							onkeypress="return isNumberKey(event)" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("email") ?> 1: </label>
					<div class="controls">
						<input type="text" class="span12" name="email1" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("email") ?> 2: </label>
					<div class="controls">
						<input type="text" class="span12" name="email2" />
					</div>
				</div>

			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<input value="<?= lang("add")?>" type="submit"
				class="btn btn-primary" />
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>

<!-- add note type for level -->
<div id="add_ra_notestypes_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("add")." ".lang("note_type") ?>
		</h5>
	</div>
	<form id="add_notetype_form"
		action="<?= base_url() ?>insert/insertNoteType" method="post">
		<div class="modal-body">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?= lang("ra_levels") ?> </label>
					<div class="controls">
						<select name="level" class="levels_select"
							id="add_notetype_levels">
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
					<label class="control-label"><?= lang("type"). " " . lang("note") ?>
						: </label>
					<div class="controls">
						<select name="prob" class="probs_select" id="add_notetype_probs">
							<option value="">
								<?= lang("choose_prob")?>
							</option>
							<?php
foreach($probs as $prob){?>
							<option value=<?= $prob->id ?>>
								<?= $prob->prob ?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("sold") ?> :<span class="req">*</span>
					</label>
					<div class="controls">
						<input type="text" name="sold" class="required span12"
							id="add_notetype_sold" onkeypress="return isNumberKey(event)" />
					</div>
				</div>



				<div class="control-group">
					<label class="control-label"><?= lang("body"). " " . lang("note") ?>
						:<span class="req">*</span> </label>
					<div class="controls">
						<input type="text" name="body" class="required span12"
							id="add_notetype_body" />
					</div>
				</div>
			</div>
			<input type="hidden" id="hidden_ra_notestypes" name="id" />

		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<input value="<?= lang("add")?>" type="submit"
				class="btn btn-primary" />
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
	</form>
</div>


<!-- add ready message dialog -->
<div id="add_ra_readymessages_dialog" class="modal hide fade"
	tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("add")." ".lang("note_type") ?>
		</h5>
	</div>
	<form id="add_ready_form" action="<?= base_url() ?>insert/insertReady"
		method="post">
		<div class="modal-body">
			<div class="row-fluid">
				<input type="hidden" id="hidden_ra_readymessages" name="id" />

				<div class="control-group">
					<label class="control-label"><?= lang("body"). " " . lang("note") ?>
						:<span class="req">*</span> </label>
					<div class="controls">
						<textarea cols=30 rows=7 name="message" class="required span12"
							id="add_notetype_body"></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
			<input value="<?= lang("add")?>" type="submit"
				class="btn btn-primary" />
			<button type="reset" class="btn">
				<?= lang("reset")?>
			</button>

		</div>
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
						<input type="text" class="required span12" name="prob" id="" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("color") ?>:<span class="req">*</span>
					</label>
					<div class="controls">
						<input type="text" class="required span12" name="color"
							id="add_level_color" />
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

<!-- open dialog to begin add notes-->
<div id="add_ra_notes_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("add")." ".lang("note") ?>
		</h5>
	</div>
	<form id="begin_notes_form" action="<?= base_url() ?>admin/showNotes"
		method="post">
		<div class="modal-body flow_dialog">
			<div class="row-fluid">
				<div class="control-group">
					<label class="control-label"><?= lang("priority") ?> </label>
					<div class="controls">
						<select
							name="priority" class="" id="begin_notes_priority">
							<?php
foreach($prios as $key => $prio){?>
							<option value=<?= $key ?>>
								<?= $prio?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?= lang("class") ?> </label>
					<div class="controls">
						<input type="hidden" id="hidden_ra_notes" name="id" /> <select
							name="class" class="" id="begin_notes_classes">
							<option value="">
								<?= lang("choose_class")?>
							</option>
							<?php
foreach($user_classes as $class){?>
							<option value=<?= $class['id'] ?>>
								<?= $class['class']?>
							</option>
							<?php }?>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("student") ?> </label>
					<div class="controls">
						<select name="student" class="students_select"
							id="begin_notes_students">
							<option value="">
								<?= lang("choose_student")?>
							</option>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("notes_num") ?> :<span
						class="req">*</span> </label>
					<div class="controls">
						<input type="text" class="required span12" id="begin_notes_num"
							value="1" name="num" />
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("subject") ?> </label>
					<div class="controls">
						<select name="subject" class="subjects_select"
							id="begin_notes_subjects">
							<option value="">
								<?= lang("choose_subject")?>
							</option>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("note_prob") ?> </label>
					<div class="controls">
						<select name="prob" class="probs_select" id="begin_notes_probs">
							<option value="">
								<?= lang("choose_prob")?>
							</option>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("note_type") ?> </label>
					<div class="controls">
						<select name="type" class="types_select" id="begin_notes_types">
							<option value="">
								<?= lang("choose_type")?>
							</option>
						</select>

					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("status")?> </label> <input
						type="button" id="begin_status"
						class="btn btn-success btnc active" data-toggle="button"
						value="<?= lang("continue") ?>" /> <input type="checkbox"
						name="status" checked="checked" style="display: none;" />
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("date") ?> :<span class="req">*</span>
					</label>
					<div class="controls">
						<input type="text" disabled
							value="<?= lang("semester").": ".$settings->semester ?>"
							class="datestyle" /> <input type="text" disabled
							value="<?= $settings->date ?>" class="datestyle" /> <select
							class="required datestyle" id="" name="month">
							<?php foreach($monthes as $month){?>
							<option value="<?= $month ?>">
								<?= $month ?>
							</option>
							<?php }?>
						</select> <select class="required datestyle" id="" name="day">
							<?php foreach($days as $day){?>
							<option value="<?= $day ?>">
								<?= $day?>
							</option>
							<?php }?>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?= lang("note")?> </label>
					<textarea class="span12" name="note" cols="5" rows="5"
						id="begin_notes_note" name="note"></textarea>
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



