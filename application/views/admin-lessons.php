<?php $this->load->view("body-head")?>
<form id="select_class_lessons_form" class="form-horizontal"
	action="<?=base_url()?>admin/showLessons" method="post">
	<div class="control-group">
		<label class="control-label"><?= lang("class") ?>:<span class="req">*</span>
		</label>
		<div class="controls">
			<select name="class" class="" id="">
				<?php
foreach($classes as $class){?>
				<option value=<?= $class->id ?>>
					<?= $class->class?>
				</option>
				<?php }?>
			</select> <input type="submit" value="submit" class="btn" />
		</div>
	</div>
</form>
<?php if(isset($lessons)){?>
<form action="<?=base_url()?>admin/showLessons" method="post">
	<input type="hidden" value="<?=$class_id?>" name="class" /> <input
		type="hidden" value="1" name="insert" />
	<div class="block well">
		<div class="navbar">
			<div class="navbar-inner">
				<h5>
					<?= lang("table")." ".lang($table)." - ".lang("class")." : ".$this->homemodel->getClass($class_id)->class ?>
				</h5>
			</div>
		</div>
		<div class="table-overflow">
			<table class="table">
				<thead>
					<tr>
						<th></th>
						<th><?=lang("first")?></th>
						<th><?=lang("second")?></th>
						<th><?=lang("third")?></th>
						<th><?=lang("fourth")?></th>
						<th><?=lang("fifth")?></th>
						<th><?=lang("sixth")?></th>
						<th><?=lang("seventh")?></th>
						<th><?=lang("eightth")?></th>
						<th><?=lang("ninth")?></th>
					</tr>
				</thead>
				<tbody>
					<?php for($i=0;$i<7;$i++){?>
					<tr>
						<td><?=$this->homemodel->getDay($i)?></td>
						<?php for($j=0;$j<9;$j++){?>
						<td><select name="lessons[<?=$i?>][<?=$j?>]" class="" id=""
							style="width: 75px;">
								<option value="">
									<?=lang("without")?>
								</option>
								<?php
foreach($subjects as $subject){?>
<?php $subject1=0;
foreach($lessons as $lesson){
if($lesson["day"]==$i&&$lesson["class"]==$class_id&&$lesson["order"]==$j&&$lesson["subject"]==$subject->id)
	$subject1=$lesson["subject"];
}
?>
								<option value="<?= $subject->id ?>"
								<?=($subject1==$subject->id)?"selected='selected'":""?>>
									<?= $subject->subject?>
								</option>
								<?php }?>
						</select></td>
						<?php }?>
					</tr>
					<?php }?>
				</tbody>

			</table>
		</div>
	</div>
	<?php if($this->homemodel->checkModifyPermissions("ra_lessons")==1){?>
	<div class="modal-footer">
		<input value="<?= lang("add")?>" type="submit" class="btn btn-primary" />
		<button type="reset" class="btn">
			<?= lang("reset")?>
		</button>
	</div>
	<?php }?>
</form>
<?php }?>
</div>
</div>
</div>

</body>
</html>
