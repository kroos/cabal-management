<?extend('base_template.php')?>

<? startblock('title1') ?>
	Reset Password
<? endblock() ?>

<? startblock('content1') ?>

<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<p>By submitting this page, i considered you have forgotten your password. Therefor, there is no way that i can retrieve it for you unless i have to reset your password.</p>
<p>Please take a look in your email for your new password after submitting this page.</p>
<?=form_open()?>
<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
<tr>
<td align="right">Username : </td><td align="left"><?=form_input(array('name' => 'username', 'value' => set_value('username'), 'maxlength' => '10', 'size' => '10'))?>&nbsp;&nbsp;&nbsp;<?=form_error('username')?></td>
</tr>
<tr>
<td align="right">Email : </td><td align="left"><?=form_input(array('name' => 'email', 'value' => set_value('email'), 'size' => '35'))?>&nbsp;&nbsp;&nbsp;<?=form_error('email')?></td>
</tr>
<tr>
<td colspan="2" align="center"><div class="demo"><?=form_submit('forgot_password', 'Get Password')?></div></td>
</tr>
</table>
<?=form_close()?>
<?php endblock(); ?>

<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>