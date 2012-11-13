<?extend('user/base_template_user.php')?>

<? startblock('title1') ?>
		News & Announcement
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<script>
	$(function() {
		$( "#radio" ).buttonset();
	});
</script>

<div class="demo">

		<table border="0" width="100%" cellspacing="2" cellpadding="2">
		<tr>
		<td>
		<?=form_open()?>
		<p align="center">Add your latest update in this form and then just submit.</p>
		<p align="center">Subject : <?=form_input(array('name' => 'subject', 'value' => set_value('subject'), 'maxlength' => '50', 'size' => '50'))?></p>
		<p><?=form_error('subject')?></p>
		<p align="center">
		<?=ckeditor('news_add', '', $this->session->userdata('group'))?>&nbsp;<?=form_error('news_add')?>
		</p>
		<p>Author</p>
		<?$i = 0?>
		<?$iq = 0?>
		<div id="radio">
		<?foreach($char->result() as $y):?>
		<?=form_radio(array('name' => 'character', 'id' => 'radio'.$i++, 'value' => $y->Name))?><label for="radio<?=$iq++?>"><?=$y->Name?></label>
		<?endforeach?>
		</div>
		<?=form_error('character')?>
		<p align="center"><?=form_submit('add_news', 'Add News')?></p>
		<?=form_close()?>
		<table border="1" width="100%" cellspacing="2" cellpadding="2" style="border-collapse: collapse">
		<tr>
		<td>Bil</td>
		<td>Author</td>
		<td>Date News</td>
		<td>Subject</td>
		<td>News</td>
		<td width="7%">Edit</td>
		<td width="7%">Delete</td>
		</tr>
			<?foreach($news->result() as $t):?>
				<tr>
				<td><?=$t->Bil?></td>
				<td><?=$t->Author?></td>
				<?if(floatval(phpversion()) > '5.3'):?>
					<td><?=date_my($t->Date)?></td>
				<?else:?>
					<td><?=$t->Date?></td>
				<?endif?>
				<td><?=$t->Subject?></td>
				<td><?=$t->HTML?></td>
				<td><?=anchor('admin/cabal/news_edit/'.$t->Bil, 'EDIT', 'title = "EDIT NEWS '.$t->Bil.'"')?></td>
				<td><?=anchor('admin/cabal/news_del/'.$t->Bil, 'DELETE', 'title = "DELETE NEWS '.$t->Bil.'"')?></td>
				</tr>
			<?endforeach?>
		</table>
		</td>
		</tr>
		</table>

</div>
<? endblock() ?>

<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<? end_extend() ?>