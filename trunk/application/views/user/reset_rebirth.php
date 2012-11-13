<?extend('user/base_template_user.php')?>

<?startblock('title1')?>
Reset Rebirth
<?endblock()?>

<?startblock('content1')?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>
<p>Ever wonder how does it feel to have the power of Cabal God? PK-ing any character with 1 blow (i think...) ? Then take this rebirth reset. You can have this reset if and only if your rebirth is <strong><?=$this->config->item('rebirth_count')?></strong> and you have <strong><?=$this->config->item('alzresetrebirth')?></strong> Alz. Too expensive?<br>Its worth it!!!</p>

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
<p align="center"><?=form_submit('reset_rebirth', 'Reset Rebirth')?></p>

<!-- </div> -->
</div>
<?=form_close()?>
<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>