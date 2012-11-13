<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
Ban Account
<?endblock() ?>

<?startblock('content1')?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>



<p>Please insert <strong>character</strong> name</p>
<?if($query->num_rows() < 1):?>
<p>No list of ban account</p>
<?else:?>
	<div class="demo">
	<table border="1" cellpadding="2" cellspacing="0" width="100%">
		<tr>
			<td>UserNum</td>
			<td>UserName</td>
			<td>Last IP</td>
			<td>Date Join</td>
			<td>Email</td>
		</tr>
	<?foreach($query->result() as $p):?>
		<tr>
			<td><?=anchor('admin/cabal/unban_user/'.$p->UserNum, 'Unban '.$p->UserNum)?></td>
			<td><?=$p->ID?></td>
			<td><?=$p->LastIp?></td>
<?if(floatval(phpversion()) > '5.3'):?>
			<td><?=date_my($p->CreateDate)?></td>
<?else:?>
			<td><?=$p->CreateDate?></td>
<?endif?>
			<td><?=$p->Email?></td>
		</tr>
	<?endforeach?>
	</table>
</div>
<?endif?>
<?endblock(); ?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>