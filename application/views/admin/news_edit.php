<?extend('user/base_template_user.php')?>

<? startblock('title1') ?>
Edit News
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<script>
	$(function() {
		$( "#radio" ).buttonset();
	});
</script>

<div class="demo">

<?$i = 0?>
<?$iq = 0?>
		<table border="0" width="100%" cellspacing="2" cellpadding="2">
		<tr>
		<td>
		<?=form_open()?>
		<p align="center">Add your latest news update in this form and then just submit.</p>
		<p align="center">Subject : <?=form_input(array('name' => 'subject', 'value' => $news->row()->Subject, 'maxlength' => '50', 'size' => '50'))?></p>
		<p><?=form_error('subject')?></p>
		<p align="center">
		<?=ckeditor('news_edit', $news->row()->HTML, $this->session->userdata('group'))?>&nbsp;<?=form_error('news_edit')?>
		</p>
		<p>Author</p>
		<div id="radio">
		<?foreach($char->result() as $y):?>
		<?=form_radio(array('name' => 'character', 'id' => 'radio'.$i++, 'value' => $y->Name))?><label for="radio<?=$iq++?>"><?=$y->Name?></label>
		<?endforeach?>
		</div>
		<?=form_error('character')?>
		<p align="center"><?=form_submit('news_edit_btn', 'Edit News')?></p>
		<?=form_close()?>
		</td>
		</tr>
		</table>
</div>


<?php endblock(); ?>

<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>