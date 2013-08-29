<?php $this->load->view("header")?>

<a href='http://localhost/rased/user/do_logout'>logout</a>
<?php if($activated==0){?>
<?php echo "not activated"?>
<form action="<?= base_url()?>newuser/checkCode" method="POST">
	<label>enter mobile code</label><input type="text" name="code" /> <input
		type="submit" value="submit" />
</form>
<?php }else{?>
<a href="<?= base_url()?>user/showForm">forms</a>
<a href="<?= base_url()?>user/showInbox">Inbox</a>
<?php if($show_lessons==1){?><a href="<?= base_url()?>user/showLessons">Lessons</a><br/><?php }?>
<a href="#show_student_notes_dialog" data-toggle="modal">notes</a>
<a href="<?=base_url()?>user/changeProfile">edit profile</a>
<a class="btn" href="#add_user_student_dialog" id="" data-toggle="modal">edit
	students</a>
<?php }?>

<!-- check student idnum  -->
<div id="add_user_student_dialog" class="modal hide fade" tabindex="-1"
	role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
			aria-hidden="true">&times;</button>
		<h5 id="">
			<?= lang("add")." ".lang("student") ?>
		</h5>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<form class="form-horizontal">
				<?php if($students!=0){?>
				<?php foreach($students as $student){?>

				<div class="control-group">
					<label class="control-label"><?= lang("student") ?>: </label>
					<div class="controls">
						<label id="<?=$student->id?>"><?=$student->fullname?> </label> <input
							class="btn btn-danger delete_user_student_but" type="button"
							value="<?=lang("delete")?>" id="<?=$student->id?>"
							style="float: left;" />
					</div>
				</div>
				<?php }?>
				<?php }else{
					echo "no_students";
				}?>
				<div class="gap"></div>
				<div class="control-group">
					<label class="control-label"><?= lang("add")." ".lang("student") ?>:
					</label>
					<div class="controls">
						<input class="span6" type="text" id="new_user_student_text" /> <span
							class="req">*</span> <label><?=lang("add_idnum")?> </label> <input
							class="btn btn-success add_user_student_but" type="button"
							value="<?=lang("add")?>" style="float: left;" />
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">
			<?= lang("close") ?>
		</button>
	</div>
</div>

<!-- check student idnum  -->
<div id="show_student_notes_dialog" class="modal hide fade"
	tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<form id="show_student_notes_form" class="form-horizontal"
		action="<?=base_url()?>user/showStudentNotes" method="post">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h5 id="">
				<?= lang("select_student_notes") ?>
			</h5>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
			<label class="control-label"><?=lang("student") ?>:
					</label>
				<select name="student_id" id="student_notes_select">
					<option value="">
						<?=lang("choose_student")?>
					</option>
					<?php foreach($students as $student){?>
					<option value="<?=$student->id?>">
						<?=$student->fullname?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" value="<?=lang("next")?>"
				class="btn btn-success" />
			<button class="btn" data-dismiss="modal">
				<?= lang("close") ?>
			</button>
		</div>
	</form>

</div>
</body>
</html>
