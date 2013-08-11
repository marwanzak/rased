<?php 
unset($permissions->id);
unset($permissions->role);
?>
<div class="content">
	<div class="outer">
		<div class="inner">
			<div class="page-header">
				<!-- Page header -->
				<h5>
					<i class="font-home"></i>
					<?= lang("permissions") ?>


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
				<form action="<?= base_url()?>modify/modifyPermissions"
					method="post">
					<input type="hidden" value="<?= $id ?>" name="role" />
					<div class="block well">
						<div class="table-overflow">
							<table id="notes_table"
								class="table table-block table-bordered table-checks"
								id="notes_table">
								<thead>
									<tr>
										<th width="150px"><?= lang("table") ?>
										</th>
										<th><?= lang("see") ?>
										</th>
										<th><?= lang("create") ?>
										</th>
										<th><?= lang("modify") ?>
										</th>
										<th><?= lang("delete") ?>
										</th>
										<th><?= lang("choose_row") ?>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($permissions as $key =>$permission){?>
									<tr>
										<td><?= lang($key) ?>
										</td>
										<?php foreach($permission as $key1=> $value){?>
										<td><?php if($value!=""){?> 
										<input type="hidden" name="<?= $key1 ?>" value="0"/>
										<input name="<?= $key1 ?>"
											type="checkbox" class="permissions_checks style"
											<?= ($value==1)?"checked='checked'":''; ?> value="1" /> <?php }?>
										</td>
										<?php }?>
										<td>
										<input type="checkbox" class="permission_row_check style" /> 
										</td>
										
									</tr>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="form-actions align-right">
						<button type="submit" class="btn btn-primary"><?= lang('modify') ?></button>
					</div>
				</form>

			</div>

		</div>
	</div>
</div>
<!-- /main content -->
</div>
<!-- /main wrapper -->
