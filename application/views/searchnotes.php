<div class="content">
	<div class="outer">
		<div class="inner">
			<div class="page-header">
				<!-- Page header -->
				<h5>
					<i class="font-home"></i>
					<?= lang("search_note") ?>


				</h5>
				<ul class="icons">
					<li><a href="#" class="hovertip" title="My tasks"><i
							class="font-tasks"></i> </a>
					</li>
					<li><a href="#" class="hovertip" title="Reload data"><i
							class="font-refresh"></i> </a>
					</li>
					<li><a href="#" class="hovertip" title="Settings"><i
							class="font-cog"></i> </a>
					</li>
				</ul>
			</div>
			<!-- /page header -->
			<div class="body">
				<div class="block well">
					<div class="row-fluid">
						<form class="form-horizontal"
							action="<?=base_url()?>admin/showSearchNotes" method="POST">
							<div class="control-group">
								<div class="span4">
									<label class="control-label"><?= lang("class") ?> </label>
									<div class="controls">
										<select name="class" class="classes_select"
											id="search_notes_classes">
											<option value="">
												<?= lang("choose_class")?>
											</option>
											<?php
foreach($classes as $class){?>
											<option value=<?= $class['id'] ?>>
												<?= $class['class']?>
											</option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="span4">
									<label class="control-label"><?= lang("student") ?> </label>
									<div class="controls">
										<select name="student" class="students_select"
											id="search_notes_students">
											<option value="">
												<?= lang("choose_student")?>
											</option>
										</select>

									</div>
								</div>
								<div class="span4">
									<label class="control-label"><?= lang("subject") ?> </label>
									<div class="controls">
										<select name="subject" class="subjects_select"
											id="search_notes_subjects">
											<option value="">
												<?= lang("choose_subject")?>
											</option>
										</select>
									</div>
								</div>
							</div>
							<div class="control-group">
								<div class="span4">
									<label class="control-label"><?= lang("note_prob") ?> </label>
									<div class="controls">
										<select name="prob" class="probs_select"
											id="search_notes_probs">
											<option value="">
												<?= lang("choose_prob")?>
											</option>
										</select>
									</div>
								</div>
								<div class="span4">

									<label class="control-label"><?= lang("note_type") ?> </label>
									<div class="controls">
										<select name="type" class="types_select"
											id="search_notes_types">
											<option value="">
												<?= lang("choose_type")?>
											</option>
										</select>

									</div>
								</div>
								<div class="span4">

									<label class="control-label"><?= lang("priority") ?> </label>
									<div class="controls">
										<select name="priority" class="" id="begin_notes_priority">
											<option value="">
												<?= lang("without")?>
											</option>
											<?php
foreach($priority as $key => $prio){?>
											<option value=<?= $key ?>>
												<?= $prio?>
											</option>
											<?php }?>
										</select>

									</div>
								</div>
							</div>
							<div class="control-group">
								<div class="span4">
									<label class="control-label"><?= lang("sold") ?> </label>
									<div class="controls">
										<input type="text" name="sold" id="search_notes_sold">
									</div>
								</div>


								<div class="span4">
									<label class="control-label"><?= lang("agreed") ?> :</label>
									<div class="controls">
										<select name="agreed">
											<option value="">
												<?= lang("without") ?>
											</option>
											<option value="1">
												<?= lang("agree") ?>
											</option>
											<option value="0">
												<?= lang("not_agree") ?>
											</option>
										</select>
									</div>

								</div>

								<div class="span4">
									<label class="control-label"><?= lang("continuas") ?> :</label>
									<div class="controls">
										<select name="status">
											<option value="">
												<?= lang("without") ?>
											</option>
											<option value="1">
												<?= lang("continue") ?>
											</option>
											<option value="0">
												<?= lang("solved") ?>
											</option>
										</select>
									</div>
								</div>
							</div>

							<div class="control-group">
								<div class="span6">
									<label class="control-label"><?= lang("from") ?> :</label>
									<div class="controls">
										<select class="required datestyle" id="" name="month1">
											<option value="">
												<?= lang('without') ?>
											</option>
											<?php foreach($monthes as $key1 => $month){?>
											<option value="<?= $key1 ?>" >
												<?= $month ?>
											</option>


											<?php }?>


										</select> <select class="required datestyle" id="" name="day1">
											<option value="">
												<?= lang('without') ?>
											</option>
											<?php foreach($days as $day){?>
											<option value="<?= $day ?>">
												<?= $day?>
											</option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="span6">
									<label class="control-label"><?= lang("to") ?> :</label>
									<div class="controls">
										<select class="required datestyle" id="" name="month2">
											<option value="">
												<?= lang('without') ?>
											</option>
											<?php foreach($monthes as $key1 => $month){?>
											<option value="<?= $key1 ?>">
												<?= $month ?>
											</option>
											<?php }?>
										</select> <select class="required datestyle" id="" name="day2">
											<option value="">
												<?= lang('without') ?>
											</option>
											<?php foreach($days as $day){?>
											<option value="<?= $day ?>">
												<?= $day?>
											</option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"><?= lang("note") ?> </label>
								<div class="controls">
									<textarea rows=3 cols=50 name="note" id="search_notes_note"></textarea>
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

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /main content -->
</div>
<!-- /main wrapper -->
