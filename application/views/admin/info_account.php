<?extend('user/base_template_user.php')?>

<? startblock('title1') ?>
Account Info
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<p>Insert character name to view its detail.</p>
<div class="demo">
<?=form_open()?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td align="right" valign="middle">Character : </td>
		<td><?=form_input(array('name' => 'char', 'value' => set_value('char'), 'maxlength' => '12', 'size' => '12'))?><?=form_error('char')?></td>
		<td><?=form_submit('search', 'View')?></td>
	</tr>
</table>
<?=form_close()?>
</div>

<p>&nbsp;</p>
<?if (($this->form_validation->run() == FALSE) ):?>
<?elseif($acc->num_rows() >0 ):?>

		<h3>Account</h3>
		<table border="0" cellpadding="2" width="100%">
		<?foreach($acc->result() as $t):?>
			<tr>
				<td>UserNum</td><td><?=$t->UserNum?></td>
			</tr>
			<tr>
				<td>ID</td><td><?=$t->ID?></td>
			</tr>
			<tr>
				<td>Login</td>
				<?if ($t->Login == 0):?>
					<td>Offline</td>
				<?else:?>
					<td>Online</td>
				<?endif?>
			</tr>
			<tr>
				<td>LoginTime</td>
				<?if(floatval(phpversion()) > '5.3'):?>
					<td><?=date_my($t->LoginTime)?></td>
				<?else:?>
					<td><?=$t->LoginTime?></td>
				<?endif?>
			</tr>
			<tr>
				<?if(floatval(phpversion()) > '5.3'):?>
					<td>LogoutTime</td><td><?=date_my($t->LogoutTime)?></td>
				<?else:?>
					<td>LogoutTime</td><td><?=$t->LogoutTime?></td>
				<?endif?>
			</tr>
			<tr>
				<td>AuthType</td>
				<?if ($t->AuthType == 1):?>
					<td>Normal</td>
				<?elseif ($t->AuthType == 2):?>
					<td>Banned</td>
				<?endif?>
			</tr>
			<tr>
				<td>PlayTime</td>
				<?php
				$z = fmod($t->PlayTime, 60);
				$x = $t->PlayTime - $z;
				$l = $x / 60;
				?>
				<td><?=cabal_time($t->PlayTime)?></td>
			</tr>
			<tr>
				<td>LastIp</td><td><?=$t->LastIp?></td>
			</tr>
			<tr>
				<td>CreateDate</td><td><?=$t->CreateDate?></td>
			</tr>
			<tr>
				<td>Email</td><td><?=$t->Email?></td>
			</tr>
		<?endforeach?>
		
			<tr>
				<td>Type</td>
				<td>
					<?php
					$type1 = $auth->row()->Type;
					foreach($type as $r => $g)
						{
							if ($type1 == $r)
								{
									echo $g;
								}
						}
					?>
				</td>
			</tr>

		<?if ($type1 == 1):?>
			<tr>
				<td>Service Kind</td>
				<td>
					<?php
					$type12 = $auth->row()->ServiceKind;
					foreach($servicekind as $r1 => $g1)
						{
							if ($type12 == $r1)
								{
									echo $g1;
								}
						}
					?>
				</td>
			</tr>
		<?endif?>
		</table>
		<p>&nbsp;</p>
		<h3>Character</h3>
		<table border="0" width="100%">
		<?foreach($char->result() as $yi):?>
			<tr>
				<td><strong>CharacterIdx</strong></td>
				<td><?=$yi->CharacterIdx?></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><?=$yi->Name?></td>
			</tr>
			<tr>
				<td>Level</td>
				<td><?=$yi->LEV?></td>
			</tr>
			<tr>
				<td>Strength</td>
				<td><?=$yi->STR?></td>
			</tr>
			<tr>
				<td>Dexterity</td>
				<td><?=$yi->DEX?></td>
			</tr>
			<tr>
				<td>Intelligence</td>
				<td><?=$yi->INT?></td>
			</tr>
			<tr>
				<td>Stat Points</td>
				<td><?=$yi->PNT?></td>
			</tr>
			<tr>
				<td>Alz</td>
				<td><?=$yi->Alz?></td>
			</tr>
			<tr>
				<td>Map</td>
				<td>
				<?php
				foreach($this->config->item('map') as $re => $er)
					{
						if ($yi->WorldIdx == $re)
							{
								echo $er;
							}
					}
				?>
				</td>
			</tr>
			<tr>
				<td>Map Code</td>
				<td><?=$yi->MapsBField?></td>
			</tr>
			<tr>
				<td>Warp Code</td>
				<td><?=$yi->WarpBField?></td>
			</tr>
			<tr>
				<td>Nation</td>
				<td>
				<?php
				$trw = $this->config->item('nation');
				foreach($trw as $rew => $erw)
					{
						if ($yi->Nation == $rew)
							{
								echo $erw;
							}
					}
				?>
				</td>
			</tr>
			<tr>
				<td>Honour</td>
				<td><?=$yi->Reputation?></td>
			</tr>
			<tr>
				<td><hr /></td>
				<td><hr /></td>
			</tr>
		<?endforeach?>
		</table>
<?endif?>

<?php endblock(); ?>

<? startblock('title2') ?>
<? endblock() ?>

<? startblock('content2') ?>
<? endblock() ?>

<?end_extend()?>