<?extend('user/base_template_user.php')?>

<?startblock('topnav')?>
<?$i = 1?>
	<?foreach($cats as $f => $t):?>
		<li><?=anchor('admin/shop/'.$this->uri->segment(3, 0).'/'.$f, $t, array('title' => $t))?></li>
	<?endforeach?>

	<?if($this->session->userdata('logged_in') == FALSE):?>
		<li><?=anchor('http://cabalclose', 'Close', array('title' => 'Close', array('onclick' => "javscript:location.href='http://cabalclose'")))?></li>
	<?else:?>
		<li><?=anchor('user/cabal/logout', 'Logout', array('title' => 'Logout'))?></li>
	<?endif?>
<?endblock()?>

<? startblock('title1') ?>
Edit Shop
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>
<div class="demo"><p align="center"><?=anchor('admin/shop/add_item', 'Add Item', array('title' => 'Add Item'))?></p></div>
<?if ($query->num_rows() < 1):?>
	<p>No item for sell yet</p>
<?else:?>
	<p>Click on the link to edit the items</p>
		<div class="demo">
	<table border="0" width="100%">
	<?foreach($query->result() as $r):?>
		<tr>
			<td><img border="0" src="<?=$r->Image?>"></td>
			<td>
				<table border="0" width="100%">
					<tr>
						<td><?=anchor('admin/shop/edit_item/'.$this->uri->segment(4, 0).'/'.$r->Id, 'Edit '.$r->Name, array('title' => 'Edit '.$r->Name))?></td>
					</tr>
					<tr>
						<td><?=$r->Description?></td>
					</tr>
					<tr>
						<td><strong><?=$r->Alz?> Alz</strong></td>
					</tr>
				</table>
			</td>
			<?if ($r->Available == 0):?>
				<td><strong>Sold Out</strong></td>
			<?else:?>
				<td><strong><?=$r->Available?> Units</strong></td>
			<?endif?>
			<td><?=anchor('admin/shop/del_item/'.$this->uri->segment(4, 0).'/'.$r->Id, 'Delete', array('title' => 'Delete '.$r->Name))?></td>
		</tr>
	<?endforeach?>
	</table>
	</div>
<?endif?>
<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>