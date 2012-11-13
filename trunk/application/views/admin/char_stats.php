<?extend('user/base_template_user.php')?>

<? startblock('title1') ?>
Editing Character Statistics
<? endblock() ?>

<? startblock('content1') ?>
<p><font color="#FF0000"><blink><?=@$info?></blink></font></p>

<p>Edit any value as you see fit, otherwise just leave the default value intact</p>
<?=form_open()?>
		<div class="demo">
				<table border="1" cellpadding="2" cellspacing="1" width="100%" style="border-collapse: collapse">
					<tr>
						<td><b>Categories</b></td>
						<td><b>Details</b></td>
						<td><b>Edit</b></td>
						<td><b>Comment</b></td>
					</tr>
			<?foreach($query->result() as $u):?>
					<tr>
						<td>ID</td>
						<td align="center"><?=$u->CharacterIdx?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Character</td>
						<td align="center"><?=$u->Name?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Level</td>
						<td align="center"><?=$u->LEV?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Strength</td>
						<td align="center"><?=$u->STR?></td>
						<td><?=form_input(array('name' => 'str', 'value' => 0, 'maxlength' => 7, 'size' => 7))?><?=form_error('str')?></td>
						<td>this value will be <strong>ADDED</strong> to the existing <strong>strength</strong> point</td>
					</tr>

					<tr>
						<td>Dexterity</td>
						<td align="center"><?=$u->DEX?></td>
						<td><?=form_input(array('name' => 'dex', 'value' => 0, 'maxlength' => 7, 'size' => 7))?><?=form_error('dex')?></td>
						<td>this value will be <strong>ADDED</strong> to the existing <strong>dexterity</strong> point</td>
					</tr>

					<tr>
						<td>Intelligence</td>
						<td align="center"><?=$u->INT?></td>
						<td><?=form_input(array('name' => 'int', 'value' => 0, 'maxlength' => 7, 'size' => 7))?><?=form_error('int')?></td>
						<td>this value will be <strong>ADDED</strong> to the existing <strong>intelligence</strong> point</td>
					</tr>

					<tr>
						<td>Extra Points</td>
						<td align="center"><?=$u->PNT?></td>
						<td><?=form_input(array('name' => 'pnt', 'value' => $u->PNT, 'maxlength' => 7, 'size' => 7))?><?=form_error('pnt')?></td>
						<td>this value will be <strong>SET</strong> to the existing <strong>Extra Points</strong> point</td>
					</tr>

					<tr>
						<td>Rank</td>
						<td align="center"><?=$u->Rank?></td>
						<td><?=form_input(array('name' => 'rnk', 'value' => $u->Rank, 'maxlength' => 15, 'size' => 15))?><?=form_error('rnk')?></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Alz</td>
						<td align="center"><?=$u->Alz?></td>
						<td><?=form_input(array('name' => 'alz', 'value' => $u->Alz, 'maxlength' => 15, 'size' => 15))?><?=form_error('alz')?></td>
						<td>this value will be <strong>SET</strong> to the existing <strong>alz</strong> point</td>
					</tr>

					<tr>
						<td>Style</td>
						<?$t = decode_style($u->Style)?>
						<td align="center"><?=$u->Style?><br />Rank <?=$t['Class_Rank']?></td>
						<td><?=form_dropdown('style', $this->config->item('style'), 0)?><?=form_error('style')?></td>
						<td>this value will be <strong>ADDED</strong> to the existing <strong>style</strong> point</td>
					</tr>

					<tr>
						<td>Warp Code</td>
				<?foreach($this->config->item('wmcode') as $poe => $ope):?>
					<?if($u->WarpBField == $poe):?>
						<td align="center"><?=$ope?></td>
					<?endif?>
				<?endforeach?>
						<td><?=form_dropdown('wc', $this->config->item('wmcode'), $u->WarpBField)?><?=form_error('wc')?></td>
						<td>this value will be <strong>SET</strong> to the existing <strong>warp code</strong> point</td>
					</tr>

					<tr>
						<td>Maps Code</td>
				<?foreach($this->config->item('wmcode') as $poes => $opes):?>
					<?if($u->MapsBField == $poes):?>
						<td align="center"><?=$opes?></td>
					<?endif?>
				<?endforeach?>
						<td><?=form_dropdown('mc', $this->config->item('wmcode'), $u->MapsBField)?><?=form_error('mc')?></td>
						<td>this value will be <strong>SET</strong> to the existing <strong>map code</strong> point</td>
					</tr>

					<tr>
						<td>RP</td>
						<td align="center"><?=$u->RP?></td>
						<td><?=form_input(array('name' => 'rp', 'value' => $u->RP, 'maxlength' => 15, 'size' => 15))?><?=form_error('rp')?></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Honor</td>
						<td align="center"><?=$u->Reputation?></td>
						<td><?=form_input(array('name' => 'reput', 'value' => $u->Reputation, 'maxlength' => 15, 'size' => 15))?><?=form_error('reput')?></td>
						<td>this value will be <strong>SET</strong> to the existing <strong>reputation</strong> point</td>
					</tr>

					<tr>
						<td>Nation</td>
				<?foreach($this->config->item('nation') as $po => $op):?>
					<?if($u->Nation == $po):?>
						<td align="center"><?=$op?></td>
					<?endif?>
				<?endforeach?>
						<td><?=form_dropdown('nat', $this->config->item('nation'), 0)?><?=form_error('nat')?></td>
						<td>Please take note : if you set this character as <strong>GM</strong>, he/she will have access to the restricted page such as this page</td>
					</tr>

					<tr>
						<td>Rebirth</td>
						<td align="center"><?=$u->Rebirth?></td>
						<td><?=form_input(array('name' => 'rb', 'value' => $u->Rebirth, 'maxlength' => 2, 'size' => 2))?><?=form_error('rb')?></td>
						<td>this value will be <strong>SET</strong> to the existing <strong>rebirth</strong> point</td>
					</tr>

					<tr>
						<td>Reset</td>
						<td align="center"><?=$u->Reset?></td>
						<td><?=form_input(array('name' => 'rs', 'value' => $u->Reset, 'maxlength' => 2, 'size' => 2))?><?=form_error('rs')?></td>
						<td>this value will be <strong>SET</strong> to the existing <strong>reset</strong> point</td>
					</tr>

			<?endforeach?>
			<tr>
				<td colspan="4" align="center"><?=form_submit('submit', 'Submit')?></td>
			</tr>
		</table>
		</div>
<?=form_close()?>
<?endblock()?>

<?startblock('title2')?>
<?endblock()?>

<?startblock('content2')?>
<?endblock()?>

<?end_extend()?>