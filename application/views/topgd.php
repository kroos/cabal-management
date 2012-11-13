<?extend('base_template.php')?>

<? startblock('title1') ?>
	Top Group Dungeon
<? endblock() ?>

<? startblock('content1') ?>
	<p>Top group in dungeon</p>

	<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>
	<?=form_open()?>
	<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
	<tr>
	<td><?=form_dropdown('dungeon', $this->config->item('GroupDungeonList'))?></td>
	<td><div class="demo"><?=form_submit('gd', 'View')?></div></td>
	</tr>
	</table>
	<?=form_close()?>
<?php endblock(); ?>


<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<?if ($this->form_validation->run() == TRUE):?>
	<?if ($query->num_rows() < 1):?>
		<h3>No group have passed <?=$this->input->post('dungeon', TRUE)?> (Group) Dungeon</h3>
	<?else:?>
			<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
			<tr>
			<td colspan="4"><h3><?=$this->input->post('dungeon', TRUE)?> (Group)</h3></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td><strong>Name</strong></td>
			<td><strong>Time</strong></td>
			<td><strong>Group Leader</strong></td>
			<td><strong>Group Member</strong></td>
			</tr>
		<?$i=1?>
		<?foreach($query->result() as $y):?>
			<tr>
			<td><?=$i++?></td>
			<td><?=$y->charName?></td>
			<td><?=$y->passTime?></td>
			<td><?=$this->cabal_character_table->charid($y->partyLeaderIdx)->row()->Name?></td>
			<td><?=$y->partyMemberCnt?></td>
			</tr>
		<?endforeach?>
			</table>
	<?endif?>
<?endif?>
<? endblock() ?>

<?end_extend()?>