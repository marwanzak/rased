<?php $this->load->view("header")?>
<?php $i=0;?>
<table>
<thead><tr>
<th><?=lang("number")?></th>
<th><?= lang("prob")?></th>
<th><?= lang("type")?></th>
<th><?= lang("note")?></th>
<th><?= lang("date")?></th>
<th><?= lang("subject")?></th>
<th><?= lang("sold")?></th>
<th><?= lang("status")?></th>
<th><?= lang("priority")?></th>

</tr></thead>
<?php foreach($notes as $note){?>

<tr>
<td><?=$i++?></td>
<td><?= ($note->prob!=0)?$this->homemodel->getProb($note->prob)->prob:lang('without');?></td>
<td><?= ($note->type!=0)?$this->homemodel->getNoteType($note->type)->body:lang('without');?></td>
<td><?= ($note->note!="")?$note->note:lang('without');?></td>
<td><?= $this->homemodel->getMonth($note->month)." - ".$note->day?></td>
<td><?= ($note->subject!=0)?$this->homemodel->getSubject($note->subject)->subject:lang('without');?></td>
<td><?= $note->sold?></td>
<td><?= ($note->status==0)?"<span style='color:green;'>".lang("solved")."</span>":"<span style='color:red;'>".lang("continue")."</span>"?></td>
<td><?= $this->homemodel->getPriority($note->priority)?></td>
</tr>
<?php }?>
</table>
</body>
</html>