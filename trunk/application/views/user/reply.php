<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
<h2>Edit Reply</h2>
<?endblock()?>

<?startblock('content1')?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<?$this->load->database('GAMEDB', TRUE)?>
<?$u = $this->cabal_character_table->charb($reply->Author)?>

<?if (($u->row()->CharacterIdx >= (8 * $this->session->userdata('usernum')) && $u->row()->CharacterIdx <= ((8 * $this->session->userdata('usernum')) +5)) || $this->session->userdata('group') == 'GM'):?>
	<h2>Reply</h2>
	<?=form_open('')?>
	<p><?=ckeditor('edit_news', $reply->HTML, $this->session->userdata('group'))?>&nbsp;<?=form_error('news_edit')?></p>
	<div class="demo"><p><?=form_submit('news_edit', 'Edit Reply')?></p></div>
	<?=form_close()?>
<?else:?>
<p>Unauthorized Editing</p>
<?endif?>
<?php endblock(); ?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>