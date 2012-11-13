<?extend('base_template.php')?>

<? startblock('title1') ?>
	Channel Status
<? endblock() ?>

<? startblock('content1') ?>
	<table width="100%" cellspacing="2" cellpadding="1" style="border:#202020 1px solid">
<?$i = 0?>
<?foreach($channels as $c):?>
<?$i++?>
	<tr>
	<td><strong><?=$channels[$i]['name']?></strong></td>
	<?$r = $this->cabal_character_table->channel_status($channels[$i]['number'])->num_rows()?>
	<?$p=round((100 / $this->config->item('maxplayers')) * $r,0);?>
	<?for ($j=1; $j<=8; $j++):?>
		<?if ($p>100):?>
			<td style="border-bottom:#404040 1px dashed"><img src="<?=base_url()?>images/4.png" /></td>
		<?elseif($p>= round(100/8*$j,0)):?>
			<td style="border-bottom:#404040 1px dashed"><img src="<?=base_url()?>images/<?=round($j/2,0)?>.png" /></td>
		<?else:?>
			<td style="border-bottom:#404040 1px dashed"><img src="<?=base_url()?>images/0.png" /></td>
		<?endif?>
	<?endfor?>
	<?if (!portc($this->config->item('gameserver_ip'), $channels[$i]['port'])):?>
		<td align="center" style="border-bottom:#404040 1px dashed"><strong><span style="color:#ff0000">offline</span></strong></td>
	<?else:?>
		<td align="center" style="border-bottom:#404040 1px dashed"><strong><span style="color:#00ff00">online</span></strong></td>
	<?endif?>
	</tr>
<?endforeach?>
	<tr>
	<td colspan="9" style="padding-left:4px;"><span style="color:#c0c0c0"><strong>Login server</strong></td>
	<?if (!portc($this->config->item('gameserver_ip'), $this->config->item('gameserver_port'))):?>
		<td align="center"><strong><span style="color:#ff0000">offline</span></strong></td>
	<?else:?>
		<td align="center"><strong><span style="color:#00ff00">online</span></strong></td>
	<?endif?>
	</tr>
	</table>
<? endblock() ?>

<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>