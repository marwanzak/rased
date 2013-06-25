<div id="modify_user_dialog" class="dialog_div">
	<form id="modify_user_form"
		action="http://<?= base_url()?>modify/modifyUser" method="post">
		<input type="hidden" id="hidden_ra_users" name="id" /> <label><?= lang("username") ?>
			:</label><input type="text" name="username" class="required"
			id="modify_user_username" /><label id="modify_user_notify"></label> <label><?= lang("fullname") ?>
			:</label><input type="text" name="name" class="required"
			id="modify_user_name" /> <label><?= lang("role") ?> :</label><select
			id="modify_user_roles" class="roles_select" name="role">
			<option value="">
				<?= lang("choose_role")?>
			</option>
			<?php
foreach($roles as $role){?>
			<option value="<?= $role->id ?>">
				<?= $role->role ?>
			</option>
			<?php }?>
		</select> <label><?= lang("user_status") ?>:</label><input
			type="radio" name="active" checked="checked" value="active"
			id="modify_user_active">
		<?= lang("active") ?>
		<input type="radio" name="active" value="inactive"
			id="modify_user_inactive">
		<?= lang("inactive") ?>
		<input type="submit" value="<?= lang("add") ?>" />


	</form>
	<div>
		<form action="http://<?= base_url() ?>modify/modifyPassword"
			method="post">
			<input type='password' name="password" /> <input type="hidden"
				name="id" /> <input type='submit' value='set' /> <input
				type='button' value='×' class="hide_modify_password" />
		</form>
	</div>
	<input type="button" value="<?= lang("modify_password") ?>"
		class="modify_password" />

</div>
