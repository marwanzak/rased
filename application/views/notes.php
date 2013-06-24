<table id = "notes_table">
<thead>
<tr>
<th><input type = "checkbox" id = "notes_check_all"/></th>
<th><?= lang("student_name") ?></th>
<th><?= lang("subject") ?></th>
<th><?= lang("continuas") ?></th>
<th><?= lang("datetime") ?></th>
<th><?= lang("note_prob") ?></th>
<th><?= lang("note_type") ?></th>
<th><?= lang("note") ?></th>
</tr>
</thead>
	<?php

	foreach($students as $student)
	{
		
		for($num1=$num;$num1>0;$num1--){
		?>
	<tr>

		<td><input type="checkbox" name="notescheck[]" class = "notes_check"
			id="<?= $student["id"] ?>" /></td>
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
		<td><select id="" class="subjects_select" name="subjects[]">
				<option value="">
					<?= lang("choose_subject")?>
				</option>
				<?php
foreach($subjects as $subjecta){?>
				<option value="<?= $subjecta->id ?>"
				<?= ($subjecta->id == $subject)? "selected='selected'":"" ?>>
					<?= $subjecta->subject?>
				</option>
				<?php }?>
		</select>
		</td>
		<td><label><input type="checkbox" class="togglecheck" value="1" name="status[]" /></label>
		</td>
		<td><input type="text" readonly value="<?= $datetime ?>" name="datetime[]" />
		</td>
		<td><select id="" class="probs_select notes_probs" name="probs[]">
				<option value="">
					<?= lang("choose_prob")?>
				</option>
				<?php
foreach($probs as $proba){?>
				<option value="<?= $proba->id ?>"
				<?= ($proba->id == $prob)? "selected='selected'":"" ?>>
					<?= $proba->prob?>
				</option>
				<?php }?>
		</select>
		</td>
		<td><select id="" class="types_select" name="types[]">
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
		<td><textarea name = "notes[]">
				<?= $note ?>
			</textarea>
		</td>
	</tr>
	<?php }} ?>
</table>
