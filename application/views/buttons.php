<?php $delete = $this->homemodel->checkDeletePermissions($table);?>
<?php if($delete){?>
<div class="well-smoke body">
	<input type="hidden" value=<?= $table ?> name="table" /> <a
		data-toggle="modal" href="#confirm_delete_dialog"
		class="btn btn-danger" id="table_delete_but"><i class="icon-remove"></i>
		<?= lang("delete") ?> </a>
</div>
<?php }?>
