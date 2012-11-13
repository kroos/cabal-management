<?extend('base_template.php')?>

<? startblock('title1') ?>
	Top Combo Count
<? endblock() ?>

<? startblock('content1') ?>
	<p><strong>Top combo count in <?=$this->config->item('server')?></strong></p>
	<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
	<tr>
	<td>&nbsp;</td>
	<td><strong>Name</strong></td>
	<td><strong>Combo Count</strong></td>
	</tr>
<?$i=1?>
<?foreach($query->result() as $y):?>
	<tr>
	<td><?=$i++?></td>
	<td><?=$this->cabal_character_table->charid($y->charIdx)->row()->Name?></td>
	<td><?=$y->cntcombo?></td>
	</tr>
<?endforeach?>
	</table>
<?php endblock(); ?>


<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>