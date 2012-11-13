<?extend('user/base_template_user.php')?>

<? startblock('title1') ?>
Character Statistics
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<p>Insert character name</p>
<div class="demo">
<?=form_open()?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td align="right" valign="middle">Character : </td>
		<td><?=form_input(array('name' => 'char', 'value' => set_value('char'), 'maxlength' => '12', 'size' => '12'))?><?=form_error('char')?></td>
		<td><?=form_submit('search', 'Search')?></td>
	</tr>
</table>
<?=form_close()?>
</div>
<?endblock()?>

<?startblock('title2')?>
<?endblock() ?>

<?startblock('content2')?>
<?endblock() ?>

<?end_extend()?>