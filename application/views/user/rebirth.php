<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
Rebirth
<?endblock()?>

<?startblock('content1')?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>
<p>For you to become stronger, i strongly suggest you use this feature. Make sure you have enough Alz in your bank ;-)</p>
		<table border="0" width="100%" style="border-collapse: collapse">
		<tr>
		<td align="center"><b>Rebirth</b></td>
		<td align="center"><b>Character Level</b></td>
		<td align="center"><b>Alz Needed</b></td>
		</tr>															
		<?for($i = $this->config->item('rebirth_level'); $i <= 200; $i++):?>
				<?$rbirth = $i - $this->config->item('rebirth_level') + 1?>
				<?$rbirthwz = $this->config->item('rebirth_alz') * ($rbirth - 1)?>
				<tr><td align='center'><?=$rbirth?></td>
				<td align='center'><?=$i?></td>
				<td align='center'><?=$rbirthwz?> wz</td></tr>
		<?endfor?>
		</table>

<!--	<script>
	$(function() {
		$( "#accordion" ).accordion();
	});
	</script>	-->
 	<script>
	$(function() {
		$( "#radio" ).buttonset();
	});
	</script>
<?=form_open()?>
<div class="demo">
<!-- <div id="accordion"> -->
<div id="radio">

<?$l = 0?>
<?$le = 0?>
<?foreach($query->result() as $o):?>
	<!-- <h4><a href="#"><?=$o->Name?></a></h4>
	<div> -->
		<?=form_radio(array('name' => 'character', 'id' => 'radio'.$l++, 'value' => $o->CharacterIdx))?><label for="radio<?=$le++?>"><?=$o->Name?></label>
	<!-- </div> -->
<?endforeach?>
<?=form_error('character')?>
</div>
<p align="center"><?=form_submit('rebirth', 'Rebirth')?></p>

<!-- </div> -->
</div>
<?=form_close()?>
<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>