<?extend('base_template.php')?>

<?startblock('topnav')?>
<?$i = 1?>
	<?foreach($cats as $f => $t):?>
		<li><?=anchor('shop/index/'.$this->uri->segment(3, 0).'/'.$this->uri->segment(4, 0).'/'.$f, $t, array('title' => $t))?></li>
	<?endforeach?>

	<?if($this->session->userdata('logged_in') == FALSE):?>
		<li><?=anchor('http://cabalclose', 'Close', array('title' => 'Close', array('onclick' => "javscript:location.href='http://cabalclose'")))?></li>
	<?else:?>
		<li><?=anchor('user/cabal/logout', 'Logout', array('title' => 'Logout'))?></li>
	<?endif?>
<?endblock()?>

<?startblock('rightnav')?>
	<?if($this->session->userdata('logged_in') == FALSE):?>
	<?else:?>
		<li><div class="demo"><?=anchor('user/cabal', 'Back', array('title' => 'Back'))?></div></li>
	<?endif?>
<?endblock()?>

<?startblock('righttitle')?>
	<h2>General Information</h2>
<?endblock()?>

<?startblock('rightexptitle')?>
	<h3>Account Info</h3>
<?endblock()?>

<?startblock('rightexpcon1')?>
<?$this->load->database('GAMEDB', TRUE)?>

<?if($this->session->userdata('logged_in') == FALSE):?>
	<?$k = $this->cabal_character_table->charuser($this->uri->segment(3, 0))?>
<?else:?>
	<?$k = $this->cabal_character_table->charuser($this->session->userdata('usernum'))?>
<?endif?>

<table border="0" cellpadding="2" width="100%">
	<tr>
		<td><b>Account</b></td>
		<td><b>Character</b></td>
	</tr>
	<tr>
	<?$this->load->database('ACCOUNT', TRUE)?>

<?if($this->session->userdata('logged_in') == FALSE):?>
	<?$rt = $this->cabal_charge_auth->getAll($this->uri->segment(3, 0))->row()?>
<?else:?>
	<?$rt = $this->cabal_charge_auth->getAll($this->session->userdata('usernum'))->row()?>
<?endif?>

		<td>
		<?php
		switch ($rt->ServiceKind)
			{
				case 0:
				$sk = 'Normal';
				break;

				case 1:
				$sk = 'Normal';
				break;

				case 5:
					$sk = 'Premium';
				break;
			}
		?>
		<?=$sk?>
		</td>
		<td>
			<table border="0" cellpadding="2" width="100%">
			<?foreach ($k->result() as $e):?>
				<tr>
					<td><?=$e->Name?><br /><?=$e->Alz?> Alz<hr /></td>
				</tr>
			<?endforeach?>
			</table>
		</td>
	</tr>
	<tr>
	<?$this->load->database('CASHSHOP', TRUE)?>

<?if($this->session->userdata('logged_in') == FALSE):?>
	<?$rrt = $this->bank->get_alz($this->uri->segment(3, 0))->row()?>
<?else:?>
	<?$rrt = $this->bank->get_alz($this->session->userdata('usernum'))->row()?>
<?endif?>

	<td colspan="2">Bank = <?=$rrt->Alz?> Alz</td>
	</tr>
</table>

<?endblock()?>

<?startblock('rightexpcon2')?>
	<?if ($this->config->item('facebook') == NULL):?>
	<?else:?>
		<iframe src="https://www.facebook.com/plugins/like.php?href=<?=$this->config->item('facebook')?>" scrolling="no" frameborder="0" style="border:none; width:237px; height:auto"></iframe>
	<?endif?>
<?endblock()?>

<?startblock('title1')?>
Cabal Online Shop
<?endblock()?>

<?startblock('content1')?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

	<script>
	$(function() {
		$( "#radio" ).buttonset();
	});
	</script>

<?if ($query->num_rows() < 1):?>
	<p>No item for sell yet</p>
<?else:?>
<?php
$hidden = array (
					'usernum' => $this->uri->segment(3, 0),
					'authkey' => $this->uri->segment(4, 0),
					'category' => $this->uri->segment(5, 0)
				);
?>
<?=form_open('', '', $hidden)?>
<?$l = 0?>
<?$le = 0?>

<div class="demo">
<div id="radio">
	<table border="0" width="100%">
	<?foreach($query->result() as $r):?>
		<tr>
			<td><img border="0" src="<?=$r->Image?>"></td>
			<td>
				<table border="0" width="100%">
					<tr>
					<?if ($r->Available == 0):?>
						<td><h3><?=$r->Name?></h3></td>
					<?else:?>
						<td><?=form_radio(array('name' => 'item', 'id' => 'radio'.$l++, 'value' => $r->Id))?><label for="radio<?=$le++?>"><?=$r->Name?></label><br /><?=form_error('item')?></td>
					<?endif?>
					</tr>
					<tr>
						<td><?=$r->Description?></td>
					</tr>
					<tr>
						<td><strong><?=$r->Alz?> Alz</strong></td>
					</tr>
				</table>
			</td>
			<?if ($r->Available == 0):?>
				<td><strong>Sold Out</strong></td>
			<?else:?>
				<td><strong><?=$r->Available?> Units</strong></td>
			<?endif?>
		</tr>
	<?endforeach?>
		<tr>
			<td align="center" colspan="3"><?=form_submit('buy', 'Purchase')?></td>
		</tr>
	</table>
</div>
</div>
<?=form_close()?>
<?endif?>

<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>