<? //extend('retro/main_template.php') ?>
<? extend('nightvision/main_template.php') ?>


	<? startblock('head') ?>
		<title><?=$this->config->item('server')?> Private Server</title>
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
	<? endblock() ?>



	<? startblock('rightnav') ?>
	<? endblock() ?>



	<? startblock('righttitle') ?>
	<? endblock() ?>

	<? startblock('rightexptitle') ?>
	<? endblock() ?>

	<? startblock('rightexpcon1') ?>
	<? endblock() ?>

	<? startblock('rightexpcon2') ?>
	<? endblock() ?>

	<? startblock('title1') ?>
						<h2>Error 404 !!</h2>
	<? endblock() ?>

	<? startblock('content1') ?>
    <div>
      <img src="<?=base_url()?>images/errors/404.png" alt="404 page not found" />
    </div>
	<? endblock() ?>

<? end_extend() ?>