<?extend('base_template.php')?>

<? startblock('title1') ?>
	Top Character
<? endblock() ?>

<? startblock('content1') ?>
	<p><strong>Top characters in <?=$this->config->item('server')?></strong></p>
	<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
	<tr>
	<td>&nbsp;</td>
	<td><strong>Name</strong></td>
	<td><strong>Class</strong></td>
	<td><strong>Level</strong></td>
	<td><strong>Class Rank</strong></td>
	<td><strong>Rebirth</strong></td>
	<td><strong>Reset</strong></td>
	</tr>
<?$i=1?>
<?foreach($query->result() as $y):?>
<?$t = decode_style($y->Style)?>
	<tr>
	<td><?=$i++?></td>
	<td><?=$y->Name?></td>
	<td><?=$t['Class_Name']?></td>
	<td><?=$y->LEV?></td>
	<td><?=$t['Class_Rank']?></td>
	<td><?=$y->Rebirth?></td>
	<td><?=$y->Reset?></td>
	</tr>
<?endforeach?>
	</table>
<?php endblock(); ?>


<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>