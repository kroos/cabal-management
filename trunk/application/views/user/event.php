<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
Event
<?endblock()?>

<?startblock('content1')?>
	<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

	<script>
	$(function() {
		$( "#radio" ).buttonset();
	});
	</script>

<div class="demo">

<?if($event->num_rows() < 1):?>
	<h3>No event news or announcement has been created</h3>
<?else:?>
<?$u = 0?>
<?$ue = 0?>
	<?foreach($event->result() as $newss):?>
		<hr />
		<h3><b><?=ucwords($newss->Subject)?></b></h3>

	<?if(floatval(phpversion()) > '5.3'):?>
		<div class="none"><p><small>Posted on <?=date_my($newss->Date)?> by <font color="#008080"><?=ucwords(strtolower($newss->Author))?></font></small></p></div>
	<?else:?>
		<div class="none"><p><small>Posted on <?=$newss->Date?> by <font color="#008080"><?=ucwords(strtolower($newss->Author))?></small></font></p></div>
	<?endif?>

		<?=$newss->HTML?>
		<hr />

		<?$this->load->database('ACCOUNT', TRUE)?>
		<?$r = $this->cabalweb_comment->reply($newss->Bil)?>

		<?if($r->num_rows() < 1):?>
			<p>No reply yet</p>
		<?else:?>
				<?foreach ($r->result() as $reply):?>
					<hr />
					<?foreach($char->result() as $y):?>
						<?if($y->Name == $reply->Author):?>
							<p><?=anchor('user/cabal/reply/'.$reply->Bil, 'Edit', array('title' => 'Edit Post '.$reply->Bil))?></p>
						<?endif?>
					<?endforeach?>
					<?if($this->session->userdata('group') == 'GM'):?>
						<p><?=anchor('user/cabal/reply/'.$reply->Bil, 'GM Edit', array('title' => 'GM Edit Post '.$reply->Bil))?>&nbsp;<?=anchor('user/cabal/replyr/'.$reply->Bil, 'GM Remove', array('title' => 'GM Remove Post '.$reply->Bil))?></p>
					<?endif?>
				<?if(floatval(phpversion()) > '5.3'):?>
					<p>Reply from <font color="#008080"><?=ucwords($reply->Author)?></font> on <?=date_my($reply->Date)?></p>
				<?else:?>
					<p>Reply from <font color="#008080"><?=ucwords($reply->Author)?></font> on <?=$reply->Date?></p>
				<?endif?>
				<?=$reply->HTML?>
					<hr />
				<?endforeach?>
		<?endif?>

		<h2>Reply</h2>

		<?=form_open('', array('bil_post' => $newss->Bil), array('bil_post' => $newss->Bil))?>
		<p><?=ckeditor('news_reply', '', $this->session->userdata('group'))?><?=form_error('news_reply')?></p>

		<h2>Author</h2>

		<?$i = 0?>
		<?$i1 = 0?>
		<div id="radio">
		<?foreach($char->result() as $y):?>
		<?=form_radio(array('name' => 'character', 'id' => 'radio'.$i++.$u++, 'value' => $y->Name))?><label for="radio<?=$i1++?><?=$ue++?>"><?=$y->Name?></label>
		<?endforeach?>
		</div>
		<?=form_error('character')?>
		<p><?=form_submit('rely_news', 'Reply News')?></p>
		<?=form_close()?>
	<?endforeach?>
<?endif?>
</div>
<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>