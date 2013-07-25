<div class="content">
	<div class="outer">
		<div class="inner">
			<div class="page-header">
				<!-- Page header -->
				<h5>
					<i class="font-home"></i>
					<?= lang("add_notes") ?>


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
			<div class="body">
				<form action="<?= base_url()?>insert/insertNote" method="post">
					<div class="block well">
						<div class="table-overflow">
							<table id="notes_table"
								class="table table-block table-bordered table-checks"
								id="notes_table">
								<thead>
									<tr>
										<th><input type="checkbox" id="notes_check_all" class="" /></th>
										<th><?= lang("student_name") ?></th>
										<th><?= lang("subject") ?></th>
										<th><?= lang("priority") ?></th>
										<th><?= lang("continuas") ?></th>
										<th><?= lang("date") ?></th>
										<th><?= lang("note_prob") ?></th>
										<th><?= lang("note_type") ?></th>
										<th><?= lang("note") ?></th>
									</tr>
								</thead>
								<tbody>
									<?php

									foreach($students as $key => $student)
									{

										for($num1=$num;$num1>0;$num1--){
		?>
									<tr>

										<td>
										<input type="hidden" name="notescheck[<?= $key ?>]" value="0"/>
										<input type="checkbox" name="notescheck[<?= $key ?>]"
											class="notes_check " id="<?= $student["id"] ?>" value="<?= $student['id']?>" /></td>
										<td><label><?= $student["student"] ?> </label></td>
										<!-- <td><select id="" class="levels_select notes_levels" name="levels[]">
				<option value="">
					<?= lang("choose_level")?>
				</option>
				<?php
foreach($levels as $levela){?>
				<option value="<?= $levela->id ?>"
				<?= ($levela->id == $student["level"])? "selected='selected'":"" ?>>
					<?= $levela->level ?>
				</option>
				<?php }?>
		</select>
		</td>
		<td><select id="" class="grades_select" name="grades[]">
				<option value="">
					<?= lang("choose_grade")?>
				</option>
				<?php
foreach($grades as $gradea){?>
				<option value="<?= $gradea->id ?>"
				<?= ($gradea->id == $student["grade"])? "selected='selected'":"" ?>>
					<?= $gradea->grade ?>
				</option>
				<?php }?>
		</select>
		</td> -->
										<td><select id="" class="subjects_select datestyle"
											name="subjects[<?= $key ?>]">
												<option value="">
													<?= lang("choose_subject")?>
												</option>
												<?php
foreach($student['subjects'] as $subjecta){?>
												<option value="<?= $subjecta['id'] ?>"
												<?= ($subjecta['id'] == $subject)? "selected='selected'":"" ?>>
													<?= $subjecta['subject']?>
												</option>
												<?php }?>
										</select>
										</td>
										<td><select id="" class="priority_select datestyle"
											name="priority[<?= $key ?>]">
												<?php
foreach($prios as $key1 => $prioa){?>
												<option value="<?= $key1 ?>"
												<?= ($key1 == $prio)? "selected='selected'":"" ?>>
													<?= $prioa?>
												</option>
												<?php }?>
										</select>
										</td>
										<td>
											<div class="control-group">
												<input type="button"
													class="btn btn-success btnc <?= ($status=="checked")?"active":"" ?>"
													data-toggle="button"
													value="<?= ($status=="checked")?lang("continue"):lang("solved") ?>" />
													<input type="hidden" value="0" name="status[<?= $key ?>]"/>
												<input type="checkbox" name="status[<?= $key ?>]"
													checked="<?= $status ?>" style="display: none;" value="1" />
													
											</div>
										</td>
										<td><select name="month[<?= $key ?>]" class="datestyle">

												<?php
foreach($monthes as $montha){?>
												<option value="<?= $montha ?>"
												<?= ($montha == $month)? "selected='selected'":"" ?>>
													<?= $montha?>
												</option>
												<?php }?>
										</select> <select name="day[<?= $key ?>]" class="width50">
												<?php
foreach($days as $daya){?>
												<option value="<?= $daya ?>"
												<?= ($daya == $day)? "selected='selected'":"" ?>>
													<?= $daya?>
												</option>
												<?php }?>
										</select></td>
										<td><select id="" class="notes_probs datestyle" name="probs[<?= $key ?>]">
												<option value="">
													<?= lang("choose_prob")?>
												</option>
												<?php
foreach($student["probs"] as $proba){?>
												<option value="<?= $proba->id ?>"
												<?= ($proba->id == $prob)? "selected='selected'":"" ?>>
													<?= $proba->prob?>
												</option>
												<?php }?>
										</select>
										</td>
										<td><select id="" class="notes_types datestyle" name="types[<?= $key ?>]">
												<option value="">
													<?= lang("choose_type")?>
												</option>
												<?php

foreach($types as $typea){?>
												<option value="<?= $typea->id ?>"
												<?= ($typea->id == $type)? "selected='selected'":"" ?>>
													<?= $typea->body . " (" . $typea->sold . ")"?>
												</option>
												<?php }?>
										</select>
										</td>
										<td><textarea name="notes[<?= $key ?>]" cols="50" rows="2"><?= $note ?></textarea></td>
									</tr>
									<?php }
} ?>
								</tbody>
							</table>
						</div>
					</div>
					<input type="submit" value="submit" />
				</form>

			</div>

		</div>
	</div>
</div>
<!-- /main content -->
</div>
<!-- /main wrapper -->
