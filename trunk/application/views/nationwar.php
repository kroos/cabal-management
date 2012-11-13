<?extend('base_template.php')?>

<? startblock('title1') ?>
	Tierra Gloriosa
<? endblock() ?>

<? startblock('content1') ?>
<?if($query->num_rows() < 1):?>
<h3>Tierra Gloriosa have not been run yet.</h3>
<?else:?>
			<table border="0" width="100%" cellpadding="2" style="border-collapse: collapse">
			<tr>
			<td>&nbsp;</td>
			<td><strong>Total Round</strong></td>
			<td><strong>Capella Win</strong></td>
			<td><strong>Procyon Win</strong></td>
			<td><strong>Duration (Day)</strong></td>
			</tr>
		<?$i=1?>
		<?$y=0?>
		<?$u=0?>
		<?foreach($query->result() as $y):?>
		<?$t = decode_style($y->Style)?>
			<tr>
			<td><?=$i++?></td>
			<td><?=$y->TotalRound?></td>
			<td><?=$y->CapellaWin?><?$y+=$y->CapellaWin?></td>
			<td><?=$y->ProcyonWin?><?$u+=$y->ProcyonWin?></td>
			<td><?=$y->DurationDay?></td>
			</tr>
		<?endforeach?>
			<tr>
			<td colspan="2">Total Win</td>
			<td><?=$y?></td>
			<td><?=$u?></td>
			<td>&nbsp;</td>
			</tr>
			</table>
<?endif?>
<?php endblock(); ?>


<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>