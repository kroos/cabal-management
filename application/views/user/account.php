<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
Account
<?endblock()?>

<?startblock('content1')?>
	<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>
	<p>Please take note :<br />if you wanna bank-in alz from the <b>warehouse</b> INTO the <b>bank</b>, use <b>DEPOSIT</b>.<br />if you wanna withdraw alz from the <b>bank</b> INTO the <b>warehouse</b>, use <b>WITHDRAW</b></p>
<?=form_open()?>
<div class="demo">
<table border="0" width="100%">
	<tr>
		<td>Warehouse Alz</td>
		<td><?=$warehouse->Alz?> Alz</td>
		<td><?=form_input(array('name' => 'alzwithdraw', 'value' => set_value('alzwithdraw'), 'maxlength' => '12', 'size' => '12'))?></td>
		<td><?=form_submit('withdraw', 'Deposit')?></td>
	</tr>
	<tr>
		<td colspan="4"><?=form_error('alzwithdraw')?></td>
	</tr>
	<tr>
		<td>Bank Alz</td>
		<td><?=$bank->Alz?> Alz</td>
		<td><?=form_input(array('name' => 'alzdeposit', 'value' => set_value('alzdeposit'), 'maxlength' => '12', 'size' => '12'))?></td>
		<td><?=form_submit('deposit', 'Withdraw')?></td>
	</tr>
	<tr>
		<td colspan="4"><?=form_error('alzdeposit')?></td>
	</tr>
</table>
</div>
<?=form_close()?>

<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>