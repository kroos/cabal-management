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
Add Item Shop
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<div class="demo">
<?=form_open()?>
<table border="0" cellpadding="2" width="100%">
	<tr>
		<td>Item Name : </td>
		<td><?=form_input(array('name' => 'item_name', 'value' => set_value('item_name'), 'size' => 30, 'maxlength'   => 30))?><?=form_error('item_name')?></td>
	</tr>
	<tr>
		<td>Item Description : </td>
		<td><?=form_textarea(array('name' => 'item_desc', 'value' => set_value('item_desc'), 'cols' => 30, 'rows'   => 3))?><?=form_error('item_desc')?></td>
	</tr>
	<tr>
		<td>Item Id : </td>
		<td><?=form_input(array('name' => 'item_id', 'value' => set_value('item_id'), 'size' => 30, 'maxlength'   => 30))?><?=form_error('item_id')?></td>
	</tr>
	<tr>
		<td>Item Option : </td>
		<td><?=form_input(array('name' => 'item_opt', 'value' => set_value('item_opt'), 'size' => 30, 'maxlength'   => 30))?><?=form_error('item_opt')?></td>
	</tr>
	<tr>
		<td>Duration</td>
		<td><?=form_dropdown('iduration', $idur, 1)?><?=form_error('iduration')?></td>
	</tr>
	<tr>
		<td>Item Image : </td>
		<td><?=form_input(array('name' => 'item_img', 'value' => set_value('item_img'), 'size' => 30, 'maxlength'   => 30))?><?=form_error('item_img')?><br />example : http://yourdomain.com/images/shop/abc.jpeg<br />OR<br />http://imagehosting.com/234/dfgcv</td>
	</tr>
	<tr>
		<td>Item Alz Cost : </td>
		<td><?=form_input(array('name' => 'item_alz', 'value' => set_value('item_alz'), 'size' => 30, 'maxlength'   => 30))?><?=form_error('item_alz')?></td>
	</tr>
	<tr>
		<td>Item Category : </td>
		<td><?=form_dropdown('item_cat', $cats)?><?=form_error('item_cat')?></td>
	</tr>
	<tr>
		<td>Item Available : </td>
		<td><?=form_input(array('name' => 'item_avail', 'value' => set_value('item_avail'), 'size' => 30, 'maxlength'   => 30))?><?=form_error('item_avail')?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><?=form_submit('add_item', 'Add Item')?></td>
	</tr>
</table>
<?=form_close()?>
</div>

<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>