<a href='http://localhost/rased/user/do_logout'>logout</a>
<?php if($this->session->userdata("msg")) echo $this->session->userdata("msg")?>

<?php if($activated==0){?>
<?php echo "not activated"?>
<form action="<?= base_url()?>newuser/checkCode" method="POST">
	<label>enter mobile code</label><input type="text" name="code" /> 
	<input type="submit" value="submit" />
</form>
<?php }else{?>
<?php echo "activated"?>
<?php }?>