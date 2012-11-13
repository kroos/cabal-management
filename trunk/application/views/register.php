<?extend('base_template.php')?>

<? startblock('title1') ?>
	Register Account
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>
<p>Username and password must be minimum of 6 chars, letters and numbers only but not more than 10 chars.</p>
<?=form_open()?>
<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
<tr>
<td align="right">Username : </td><td align="left"><?=form_input(array('name' => 'username', 'value' => set_value('username'), 'maxlength' => '10', 'size' => '10'))?>&nbsp;&nbsp;&nbsp;<?=form_error('username')?></td>
</tr>
<tr>
<td align="right">Password : </td><td align="left"><?=form_password(array('name' => 'password1', 'value' => set_value('password1'), 'maxlength' => '10', 'size' => '10'))?>&nbsp;&nbsp;&nbsp;<?=form_error('password1')?></td>
</tr>
<tr>
<td align="right">Retype Password : </td><td align="left"><?=form_password(array('name' => 'password2', 'value' => set_value('password1'), 'maxlength' => '10', 'size' => '10'))?>&nbsp;&nbsp;&nbsp;<?=form_error('password2')?></td>
</tr>
<tr>
<td align="right">Email : </td><td align="left"><?=form_input(array('name' => 'email', 'value' => set_value('email'), 'size' => '35'))?>&nbsp;&nbsp;&nbsp;<?=form_error('email')?></td>
</tr>
<tr>
<td align="right">Image Verification </td><td align="left"><?=$cap['image']?> : <?=form_input(array('name' => 'verify', 'value' => set_value('verify'), 'maxlength' => '5', 'size' => '5'))?>&nbsp;&nbsp;&nbsp;<?=form_error('verify')?></td>
</tr>
<tr>
<td colspan="2" align="center"><div class="demo"><?=form_submit('create_acc', 'Register')?></div></td>
</tr>
</table>
<?=form_close()?>
<?php endblock(); ?>

<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>