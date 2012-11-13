<?extend('base_template.php')?>

	<?startblock('title1')?>
			Donate
	<?endblock() ?>

	<?startblock('content1')?>
	<p><?=$this->config->item('paypickupline')?></p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_donations">
		<input type="hidden" name="business" value="<?=$this->config->item('payemail')?>">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="item_name" value="<?=$this->config->item('server')?> Private Server">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	<?endblock()?>

	<?startblock('title2')?>
	<?endblock()?>

	<?startblock('content2')?>
	<?endblock()?>

<?end_extend()?>