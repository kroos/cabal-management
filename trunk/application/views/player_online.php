<?extend('base_template.php')?>

<? startblock('title1') ?>
	Players Online
<? endblock() ?>

<? startblock('content1') ?>
<?if($query->num_rows() < 1 ):?>
<p>No character online at the moment.</p>
<?else:?>
		<table border="1" width="100%" bordercolorlight="#00FF00" bordercolordark="#008000">
			<tr>
				<td>&nbsp;</td>
				<td>Name</td>
				<td>Level</td>
				<td>Channel</td>
				<td>Map</td>
				<td>LoginTime</td>
				<td>PlayTime</td>
			</tr>
		<?$u = 1?>
		<?foreach($query->result() as $t):?>
			<tr>
				<td><?=$u++?></td>
				<td><?=$t->Name?></td>
				<td><?=$t->LEV?></td>
				<td><?=$t->ChannelIdx?></td>
				<td>
			<?php
			$map = $this->config->item('map');
			foreach($map as $o => $l)
				{
					//echo $t.' '.$l;
					if ($t->WorldIdx == $o)
						{
							echo $l;
						}
				};
			?>
				</td>
				<?if(floatval(phpversion()) > '5.3'):?>
					<td><?=date_my($t->LoginTime)?></td>
				<?else:?>
					<td><?=$t->LoginTime?></td>
				<?endif?>
				<td><?=cabal_time($t->PlayTime)?></td>
			</tr>
		<?endforeach?>
		</table>
<?endif?>
<? endblock() ?>

<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>