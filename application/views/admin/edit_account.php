<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
Editing Account
<?endblock() ?>

<?startblock('content1')?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript">
			$(function(){
				// Datepicker
				$('#datepicker').datetimepicker({dateFormat: "yy-mm-dd", timeFormat: "hh:mm:ss", showSecond: true, showMillisec: false, ampm: false, stepHour: 1, stepMinute: 1, stepSecond: 5});
			});
		</script>

<p>Please insert <strong>character</strong> name and choose type of account</p>
<div class="demo">
<?=form_open()?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td align="right" valign="middle">Character : </td>
		<td><?=form_input(array('name' => 'char', 'value' => set_value('char'), 'maxlength' => '12', 'size' => '12'))?><?=form_error('char')?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Type : </td>
		<td><?=form_dropdown('type', $Type, 0)?><?=form_error('type')?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">ServiceKind : </td>
		<td><?=form_dropdown('servicekind', $ServiceKind, 0)?><?=form_error('servicekind')?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Expiry Date : </td>
		<td><?=form_input(array('name' => 'date', 'value' => set_value('date'), 'maxlength' => 20, 'size' => 20, 'id' => 'datepicker'))?><?=form_error('date')?></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><?=form_submit('changeacc', 'Change Account')?></td>
	</tr>
</table>
<?=form_close()?>
</div>
<?endblock(); ?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>