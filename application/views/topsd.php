<?extend('base_template.php')?>

<? startblock('title1') ?>
	Top Solo Dungeon
<? endblock() ?>

<? startblock('content1') ?>
	<p>Top solo character in dungeon</p>

	<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>
	<?=form_open()?>
	<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
	<tr>
	<td><?=form_dropdown('dungeon', $this->config->item('SingleDungeonList'))?></td>
	<td><div class="demo"><?=form_submit('sd', 'View')?></div></td>
	</tr>
	</table>
	<?=form_close()?>
<?php endblock(); ?>


<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<?if ($this->form_validation->run() == TRUE):?>
	<?if ($query->num_rows() < 1):?>
		<h3>None have passed <?=$this->input->post('dungeon', TRUE)?> (Single) Dungeon</h3>
	<?else:?>
			<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
			<tr>
			<td colspan="4"><h3><?=$this->input->post('dungeon', TRUE)?> (Single)</h3></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td><strong>Name</strong></td>
			<td><strong>Time</strong></td>
			</tr>
		<?$i=1?>
		<?foreach($query->result() as $y):?>
			<tr>
			<td><?=$i++?></td>
			<td><?=$y->charName?></td>
			<td><?=$y->passTime?></td>
			</tr>
		<?endforeach?>
			</table>
	<?endif?>
<?endif?>
<? endblock() ?>

<?end_extend()?>