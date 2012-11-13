<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
Change Password
<?endblock()?>

<?startblock('content1')?>
	<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<div class="demo">
<?=form_open()?>
<table border="0" width="100%">
	<tr>
		<td align="right">Username : </td>
		<td align="left"><?=$acc->row()->ID?><?=form_hidden(array('name' => 'username', 'value' => $acc->row()->ID))?></td>
	</tr>
	<tr>
		<td align="right">Current Password : </td>
		<td align="left"><?=form_password(array('name' => 'currpasswd', 'value' => set_value('currpasswd'), 'maxlength' => '10', 'size' => '12'))?><?=form_error('currpasswd')?></td>
	</tr>
	<tr>
		<td align="right">New Password : </td>
		<td align="left"><?=form_password(array('name' => 'newpasswd', 'value' => set_value('newpasswd'), 'maxlength' => '10', 'size' => '12'))?><?=form_error('newpasswd')?></td>
	</tr>
	<tr>
		<td align="right">Retype New Password : </td>
		<td align="left"><?=form_password(array('name' => 'rnewpasswd', 'value' => set_value('rnewpasswd'), 'maxlength' => '10', 'size' => '12'))?><?=form_error('rnewpasswd')?></td>
	</tr>
	<tr>
		<td align="right">Email : </td>
		<td align="left"><?=$acc->row()->Email?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><?=form_submit('changepass', 'Change Password')?></td>
	</tr>
</table>
<?=form_close()?>

</div>
<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>