<? //extend('retro/main_template.php') ?>
<? extend('nightvision/main_template.php') ?>


	<? startblock('head') ?>
		<title><?=$this->config->item('server')?> Online Private Server</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="This is an Account Management System for <?=$this->config->item('server')?> Private Server. This system will be use by a player to modify their game account. Come and join us now !" />
		<meta name="keywords" content="cabal, cabal online, free private server, free cabal, <?=$this->config->item('server')?> private server, <?=$this->config->item('server')?> free, CABAL, cabalonline, CABAL online, ESTsoft, free online games, free to play, f2p, free game, mmorpg, mmog, morpg, cabal download, cabal online download, download cabal, cabal us, cabal na, cabal global, role playing" />
		<meta property="og:image" content="<?=base_url()?>images/nightvision/FB_Logo.gif" />
		<link rel="image_src" href="<?=base_url()?>images/nightvision/FB_Logo.gif" />
		<link rel="shortcut icon" href="<?=base_url()?>images/nightvision/favicon.ico" type="image/x-icon" />
		<meta name="author" content="Zaugola" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery/jquery.ui.all.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery/jquery-ui-1.8.20.custom.css" />
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.20.custom.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery.ui.button.js"></script>
	<? endblock() ?>

	<? startblock('topnav') ?>
			<li><?=anchor('', 'Home', array('title' => 'Home'))?></li>
			<li><?=anchor('cabal/download', 'Download', array('title' => 'Download'))?></li>
			<li><?=anchor('cabal/event', 'Event', array('title' => 'Event'))?></li>
			<?if($this->config->item('payemail') == NULL):?>
			<?else:?>
				<li><?=anchor('cabal/donate', 'Donate', array('title' => 'Donate'))?></li>
			<?endif?>
			<li><?=anchor($this->config->item('forum'), 'Forum', 'target="_blank" title="Forum"');?></li>
	<? endblock() ?>



	<? startblock('rightnav') ?>
		<li><div class="demo"><?=anchor('cabal/login', 'Login', array('title' => 'Login'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/register', 'Register', array('title' => 'Register'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/resetp', 'Reset Password', array('title' => 'Reset Password'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/status', 'Channel Status', array('title' => 'Channel Status'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/online', 'Players Online', array('title' => 'Players Online'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/topchar', 'Top Character', array('title' => 'Top Character'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/topcombo', 'Top Combo', array('title' => 'Top Combo Count'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/topsd', 'Top S. Dungeon', array('title' => 'Top Single Dungeon'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/topgd', 'Top G. Dungeon', array('title' => 'Top Group Dungeon'))?></div></li>
		<li><div class="demo"><?=anchor('cabal/nationwar', 'Tierra Gloriosa', array('title' => 'Tierra Gloriosa'))?></div></li>
	<? endblock() ?>



	<? startblock('righttitle') ?>
		<h2>Server Info</h2>
	<? endblock() ?>

	<? startblock('rightexptitle') ?>
		<h4>General Information</h4>
	<? endblock() ?>

	<? startblock('rightexpcon1') ?>
		<table border="0" width="100%">
			<tr>
				<td>Server Status</td>
				<?if (!portc($this->config->item('gameserver_ip'), $this->config->item('gameserver_port'))):?>
					<td><strong><span style="color:#ff0000">OFFLINE</span></strong></td>
				<?else:?>
					<td><strong><span style="color:#00ff00">ONLINE</span></strong></td>
				<?endif?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Server Version</td>
				<td><?=$this->config->item('version')?></td>
			</tr>
			<tr>
				<td>Players Online</td>
				<?$this->load->database('ACCOUNT', TRUE);?>
				<?$y = $this->cabal_auth_table->online();?>
				<td><?=$y->num_rows()?></td>
			</tr>
			<tr>
				<td>Account</td>
				<?$p = $this->cabal_auth_table->account();?>
				<td><?=$p->num_rows()?></td>
			</tr>
			<tr>
				<td>Character</td>
				<?$this->load->database('GAMEDB', TRUE);?>
				<?$b = $this->cabal_character_table->character();?>
				<td><?=$b->num_rows()?></td>
			</tr>
			<tr>
				<td>Experience Rate</td>
				<td><?=$this->config->item('exp_rate')?> X</td>
			</tr>
			<tr>
				<td>Experience Skill Rate</td>
				<td><?=$this->config->item('skill_rate')?> X</td>
			</tr>
			<tr>
				<td>Experience Craft Rate</td>
				<td><?=$this->config->item('craft_rate')?> X</td>
			</tr>
			<tr>
				<td>Alz Rate</td>
				<td><?=$this->config->item('alz_rate')?> X</td>
			</tr>
			<tr>
				<td>Item Drop Rate</td>
				<td><?=$this->config->item('drop_rate')?> X</td>
			</tr>
		</table>

	<? endblock() ?>

	<? startblock('rightexpcon2') ?>
	<?if ($this->config->item('facebook') == NULL):?>
	<?else:?>
		<iframe src="https://www.facebook.com/plugins/like.php?href=<?=$this->config->item('facebook')?>" scrolling="no" frameborder="0" style="border:none; width:237px; height:auto"></iframe>
	<?endif?>
	<? endblock() ?>

	<? startblock('title1') ?>
						<h2>Article 1</h2>
	<? endblock() ?>

	<? startblock('content1') ?>
						<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
						<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>
						<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
						<p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
	<? endblock() ?>

	<? startblock('title2') ?>
						<h2>Article 2</h2>
	<? endblock() ?>

	<? startblock('content2') ?>
						<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
						<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>
						<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
						<p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
	<? endblock() ?>

<? end_extend() ?>