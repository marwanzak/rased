<?php $this->load->view("header")?>
<a href="<?base_url()?>user">back</a>
<form id="show_lessons_form" action="<?=base_url()?>user/showLessons"
	method="post">
	<select name="class" class="classes_select" id="lessons_class_select">
		<option value="">
			<?= lang("choose_class")?>
		</option>
		<?php
foreach($classes as $class){?>
		<option value=<?= $class->id ?>
		<?=($class_id==$class->id)?"selected='selected'":""?>>
			<?= $class->class?>
		</option>
		<?php }?>
	</select> <input type="submit" value="submit" class="btn" />
</form>
<?php if(isset($lessons)){?>
<div class="block well">
	<div class="navbar">
		<div class="navbar-inner">
			<h5>
				<?= lang("table")." ".lang("ra_lessons")." - ".lang("class")." : ".$this->homemodel->getClass($class_id)->class ?>
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
					<td><?php foreach($lessons as $lesson){?> <?=($lesson["day"]==$i&&$lesson["order"]==$j&&$lesson["class"]==$class_id&&$lesson["subject"]!=0)?"<label>".$this->homemodel->getSubject($lesson["subject"])->subject."</label>":""?>
						<?php }?>
					</td>
					<?php }?>
				</tr>
				<?php }?>
			</tbody>

		</table>
	</div>
</div>
<?php }?>
</body>
</html>
