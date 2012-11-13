<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
Hack User Log
<?endblock() ?>

<?startblock('content1')?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>



<?if($query->num_rows() < 1):?>
<p>No log of hack user</p>
<?else:?>
	<div class="demo">
	<p>Click "Ban No." to ban the selected account.</p>
	<table border="1" cellpadding="2" cellspacing="0" width="100%">
		<tr>
			<td>UserNum</td>
			<td>Character</td>
			<td>Date</td>
			<td>HackType</td>
		</tr>
	<?foreach($query->result() as $p):?>
		<tr>
			<td><?=anchor('admin/cabal/ban_user/'.$p->userNum, 'Ban '.$p->userNum)?></td>
		<?php
		$this->load->database('GAMEDB', TRUE);
		$r = $this->cabal_character_table->charid($p->characterIdx)->row()->Name;
		?>
			<td><?=$r?></td>

		<?if(floatval(phpversion()) > '5.3'):?>
			<td><?=date_my($p->registerDate)?></td>
		<?else:?>
			<td><?=$p->registerDate?></td>
		<?endif?>
			<td><?=$p->comment?></td>
		</tr>
	<?endforeach?>
	</table>
	<p>&nbsp;</p>
	<p>By clicking button below, you will delete all the data in the database. This will not banned or unbanned each of the account.</p>
	<p><?=anchor('admin/cabal/del_hackuserlog', 'Clear Hack User Log')?></p>
</div>
<?endif?>
<?endblock(); ?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>