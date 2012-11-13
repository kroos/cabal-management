<?extend('base_template.php')?>

<?startblock('topnav')?>
	<li><?=anchor('user/cabal', 'Home', array('title' => 'Home'))?></li>
	<li><?=anchor('user/cabal/download', 'Download', array('title' => 'Download'))?></li>
	<li><?=anchor('user/cabal/event', 'Event', array('title' => 'Event'))?></li>
	<li><?=anchor('shop/index/'.$this->session->userdata('usernum').'/'.$this->session->userdata('authkey'), 'Shop', array('title' => 'Shop'))?></li>
<?if($this->config->item('payemail') == NULL):?>
<?else:?>
	<li><?=anchor('user/cabal/donate', 'Donate', array('title' => 'Donate'))?></li>
<?endif?>
	<li><?=anchor('user/cabal/logout', 'Logout', array('title' => 'Logout'))?></li>
<?endblock()?>

<?startblock('rightnav')?>
	<li><div class="demo"><?=anchor('user/cabal/change_password', 'Change Password', array('title' => 'Change Password'))?></div></li>
	<li><div class="demo"><?=anchor('user/cabal/account', 'Account', array('title' => 'Account'))?></div></li>
	<li><div class="demo"><?=anchor('user/cabal/rebirth', 'Rebirth', array('title' => 'Rebirth'))?></div></li>
	<li><div class="demo"><?=anchor('user/cabal/reset_rebirth', 'Reset Rebirth', array('title' => 'Reset Rebirth'))?></div></li>
	<?if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') ):?>
		<li><div class="demo"><?=anchor('admin/cabal/editing_news', 'Edit News', array('title' => 'Edit News'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/editing_download', 'Edit Download', array('title' => 'Edit Download'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/editing_event', 'Edit Event', array('title' => 'Edit Event'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/online_chars', 'Online Character', array('title' => 'Online Character'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/info_account', 'Account Info', array('title' => 'Account Info'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/edit_account', 'Edit Account', array('title' => 'Edit Account'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/hackuserlog', 'Hack User Log', array('title' => 'Hack User Log'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/ban_account', 'Ban Account', array('title' => 'Ban Account'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/unban_account', 'Unban Account', array('title' => 'Unban Account'))?></div></li>
		<li><div class="demo"><?=anchor('admin/cabal/char_stats_search', 'Char Stats', array('title' => 'Char Stats'))?></div></li>
		<li><div class="demo"><?=anchor('admin/shop/home', 'Edit Shop', array('title' => 'Edit Shop'))?></div></li>
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
<?$k = $this->cabal_character_table->charuser($this->session->userdata('usernum'))?>
<table border="0" cellpadding="2" width="100%">
	<tr>
		<td><b>Account</b></td>
		<td><b>Character</b></td>
	</tr>
	<tr>
	<?$this->load->database('ACCOUNT', TRUE)?>
	<?$rt = $this->cabal_charge_auth->getAll($this->session->userdata('usernum'))->row()?>
		<td>
		<?php
		$skind = $this->config->item('Type');
		$skind1 = $this->config->item('ServiceKind');

		foreach ($skind as $b => $n)
			{
				//echo $b.' '.$n.'<br />';
				if ($rt->Type == $b)
					{
						echo '<p>'.$n.'</p>';
					}
			}

		if($rt->Type == 1)
			{
				foreach ($skind1 as $b1 => $n1)
					{
						//echo $b.' '.$n.'<br />';
						if ($rt->ServiceKind == $b1)
							{
								echo '<p>'.$n1.'</p>';
							}
					}
			}
		?>
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
	<?$rrt = $this->bank->get_alz($this->session->userdata('usernum'))->row()?>
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
<?endblock()?>

<?startblock('content1')?>
	<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>