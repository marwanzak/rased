<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8" />
<link href="<?= base_url() ?>css/style.css" rel="stylesheet"
	type="text/css" />
<link href="<?= base_url() ?>css/print.css" rel="stylesheet"
	type="text/css" media="print" />
<script src="<?=base_url()?>js/jquery.js"></script>
<script src="<?=base_url()?>js/home.js"></script>
</head>

<body>
	<?php foreach($notes as $student => $student_note){?>
	<?php $student1 = $this->homemodel->getStudent($student);?>
	<?php $class1 = $this->homemodel->getClass($student1->class)?>
	<div class="student" style="page-break-after: always;">
		<div class="table_div_print">
			<div>
				<span lang="ar" style="float:right; width:200px;"><label style="font-weight: bold;"><?= lang('student')?> </label> <label><?= $student1->fullname?> </label></span>
				<span lang="ar" style="width:200px;"><label style="font-weight: bold;"><?= lang('class')?> </label> <label><?= $class1->class?> </label></span>
			</div>
			<div style="clear: both;"></div>
			<table class="report-student-table" style="page-break-inside: avoid;">
				<thead>
					<tr>
						<th><span lang="ar"><?= lang("date")?> </span></th>
						<th><span lang="ar"><?= lang("semester")?> </span></th>
						<th><span lang="ar"><?= lang("year")?> </span></th>
						<th><span lang="ar"><?= lang("status")?> </span></th>
						<th><span lang="ar"><?= lang("subject")?> </span></th>
						<th><span lang="ar"><?= lang("prob")?> </span></th>
						<th><span lang="ar"><?= lang("type")?> </span></th>
						<th><span lang="ar"><?= lang("note")?> </span></th>
						<th><span lang="ar"><?= lang("sold")?> </span></th>
						<th><span lang="ar"><?= lang("priority")?> </span></th>
					</tr>
				</thead>
				<tbody>

					<?php foreach($student_note as $note){?>
					<tr>
						<td><span lang="ar"><?= $note->day."-".$this->homemodel->getMonth($note->month)?>
						</span></td>
						<td><span lang="ar"><?= $note->semester?> </span></td>
						<td><span lang="ar"><?= $note->year?> </span></td>
						<td><span lang="ar"><?= ($note->status==0)?lang("solved"):lang("continue")?>
						</span></td>
						<td><span lang="ar"><?= $note->subject?> </span></td>
						<td><span lang="ar"><?= ($note->prob!=0)?$this->homemodel->getProb($note->prob,"1"):lang('without')?>
						</span>
						</td>
						<td><span lang="ar"><?= ($note->type!=0)?$this->homemodel->getNoteType($note->type,"1"):lang('without')?>
						</span>
						</td>
						<td><span lang="ar"><?= ($note->note!="")?$note->note:lang("without")?>
						</span></td>
						<td><span lang="ar"><?= $note->sold?> </span></td>
						<td><span lang="ar"><?= $this->homemodel->getPriority($note->priority)?>
						</span></td>
						<?php }?>
					</tr>
				</tbody>
			</table>
		</div>
		<form id="report_pdf_form" action="<?=base_url() ?>admin/exportPdf"
			method="POST" target="_blank">
			<input type="hidden" id="hidden_pdf_content" name="page" /> <input
				type="button" id="" class="report_pdf_but" value="PDF" />
		</form>
	</div>

	<?php }?>

</body>
</html>
