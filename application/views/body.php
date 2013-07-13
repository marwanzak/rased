
<!-- Main content -->
<div class="content">

	<div class="outer">
		<div class="inner">
			<div class="page-header">
				<!-- Page header -->
				<h5>
					<i class="font-home"></i>
					<?= lang($table) ?>
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
				<?php if($table!=""){?>
				<?php array_unshift($headings,"<input type = 'checkbox' id = 'all_check' class='style'/>");?>


				<input type="hidden" value=<?= $table ?> name="table" />
				<a data-toggle="modal" href="#add_<?= $table ?>_dialog"
					class="btn btn-success"><i class="icon-plus"></i> <?= lang("add") ?></a>



				<!-- Table with checkboxes -->
				<div class="block well">
					<div class="navbar">
						<div class="navbar-inner">
							<h5><?= lang("table")." ".lang($table) ?></h5>
						</div>
					</div>
					<div class="table-overflow">
						<table class="table table-block table-bordered table-checks"
							id="select-all">
							<thead>
								<tr>
									<?php foreach($headings as $heading){?>
									<th><?= $heading ?>
									</th>
									<?php }?>
								</tr>
							</thead>
							<tbody>
								<?php 	if(count($rows)==0){?>
								<tr>
									<td><?= lang("no_rows") ?></td>
								</tr>
								<?php } else { ?>
								<?php foreach($rows as $row){ 

									$id = $row[0];
									array_shift($row);
									array_unshift($row,"<input type = 'checkbox' id ='".$id."' name = 'checks[]' class = 'table_checks style'/>");
									array_push($row,'<a id='.$id.' data-toggle="modal" href="#add_'.$table.'_dialog" class="btn btn-primary modify_'.$table.'"><i class="icon-wrench"></i></a>');
									
									?>

								<tr>
									<?php foreach($row as $field){ ?>
									<td><?= $field ?>
									</td>
									<?php }?>
								</tr>
								<?php }
}?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /table with checkboxes -->
				<?php }?>

			</div>
		</div>
	</div>
</div>
<!-- /main content -->
</div>
<!-- /main wrapper -->

