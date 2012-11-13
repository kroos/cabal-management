<?extend('base_template.php')?>

	<? startblock('title1') ?>
			News & Announcement
	<? endblock() ?>

	<? startblock('content1') ?>
<?if($news->num_rows() < 1):?>
	<h3>No news or announcement yet</h3>
<?else:?>
	<?foreach($news->result() as $newss):?>
	
	<hr />
	<h3><b><?=ucwords($newss->Subject)?></b></h3>

	<?if(floatval(phpversion()) > '5.3'):?>
		<div class="none"><p><small>Posted on <?=date_my($newss->Date)?> by <font color="#008080"><?=ucwords(strtolower($newss->Author))?></font></small></p></div>
	<?else:?>
		<div class="none"><p><small>Posted on <?=$newss->Date?> by <font color="#008080"><?=ucwords(strtolower($newss->Author))?></small></font></p></div>
	<?endif?>
	
	<?=$newss->HTML?>
	<hr />
	
	<?$r = $this->cabalweb_comment->reply($newss->Bil)?>
	
	<?if($r->num_rows() < 1):?>
		<p>&nbsp;</p>
	<?else:?>
	
		<?foreach ($r->result() as $reply):?>
			<hr />

	<?if(floatval(phpversion()) > '5.3'):?>
		<h4>Reply from <font color="#008080"><?=ucwords($reply->Author)?></font> on <?=date_my($reply->Date)?></h4>
	<?else:?>
		<h4>Reply from <font color="#008080"><?=ucwords($reply->Author)?></font> on <?=$reply->Date?></h4>
	<?endif?>

			<?=$reply->HTML?>
			<hr />
		<?endforeach?>
	
	<?endif?>
	
	<?endforeach?>
<?endif?>
	<? endblock() ?>

	<? startblock('title2') ?>
	<? endblock() ?>

	<? startblock('content2') ?>
	<? endblock() ?>

<? end_extend() ?>