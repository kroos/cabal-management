<?extend('base_template.php')?>

	<? startblock('title1') ?>
			Event
	<? endblock() ?>

	<? startblock('content1') ?>
<?if($event->num_rows() < 1):?>
	<h3>No news for event yet</h3>
<?else:?>
	<?foreach($event->result() as $events):?>
		<hr />
		<h3><b><?=ucwords($events->Subject)?></b></h3>

	<?if(floatval(phpversion()) > '5.3'):?>
		<div class="none"><p><small>Posted on <?=date_my($events->Date)?> by <font color="#008080"><?=ucwords(strtolower($events->Author))?></font></small></p></div>
	<?else:?>
		<div class="none"><p><small>Posted on <?=$events->Date?> by <font color="#008080"><?=ucwords(strtolower($events->Author))?></small></font></p></div>
	<?endif?>

		<?=$events->HTML?>
		<hr />

		<?$r = $this->cabalweb_comment->reply($events->Bil)?>

		<?if($r->num_rows() < 1):?>
			<p>&nbsp;</p>
		<?else:?>

			<?foreach ($r->result() as $reply):?>
				<hr />

	<?if(floatval(phpversion()) > '5.3'):?>
		<p>Reply from <font color="#008080"><?=ucwords($reply->Author)?></font> on <?=date_my($reply->date)?></p>
	<?else:?>
		<p>Reply from <font color="#008080"><?=ucwords($reply->Author)?></font> on <?=$reply->date?></p>
	<?endif?>

				<?=$reply->html?>
				<hr />
			<?endforeach?>

		<?endif?>

	<?endforeach?>
<?endif?>
<?php endblock(); ?>

	<? startblock('title2') ?>
	<? endblock() ?>

	<? startblock('content2') ?>
	<? endblock() ?>

<?end_extend()?>