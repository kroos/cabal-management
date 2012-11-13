<?extend('base_template.php')?>

<? startblock('title1') ?>
	Login
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<?=form_open('')?>
	<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
		<tr>
			<td align="right">Username : </td>
			<td align="left"><?=form_input(array('name' => 'username', 'value' => set_value('username'), 'maxlength' => '12', 'size' => '12'))?>&nbsp;&nbsp;&nbsp;<?=form_error('username')?></td>
		</tr>
		<tr>
			<td align="right">Password : </td>
			<td align="left"><?=form_password(array('name' => 'passwd', 'value' => set_value('passwd'), 'maxlength' => '10', 'size' => '12'))?>&nbsp;&nbsp;&nbsp;<?=form_error('passwd')?></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><div class="demo"><?=form_submit('sign-in', 'Login')?></div></td>
		</tr>
	</table>
<?=form_close()?>
<? endblock() ?>

<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<? end_extend() ?>