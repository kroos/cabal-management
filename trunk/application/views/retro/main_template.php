<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link href="<?=base_url()?>css/retro.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/cufon-yui.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/cufon-replace.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/Jikharev_400.font.js" type="text/javascript"></script>

	<? start_block_marker('head') ?>

	<? end_block_marker() ?>

<!--[if lt IE 7]>
	<script type="text/javascript" src="<?=base_url()?>js/ie_png.js"></script>
	<script type="text/javascript">
		 ie_png.fix('.png, .list1 li img, #contacts-form input, #contacts-form textarea');
	</script>
<![endif]-->
</head>
<body id="page4">

<!--
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '272932559472765',
            status     : true, 
            cookie     : true,
            xfbml      : true,
            oauth      : true,
          });
        };
        (function(d){
           var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           d.getElementsByTagName('head')[0].appendChild(js);
         }(document));
      </script>
      <div class="fb-login-button" scope="email,user_checkins">
        Login with Facebook
      </div>
-->

<script>
	$(function() {
		$( "a", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return true; });
	});
</script>
<!-- HEADER -->
<div id="header">
		<div class="logo1"><img src="<?=base_url()?>images/retro/force_archer.png" /></div>

	<div class="logo"><a href=""><img src="<?=base_url()?>images/retro/logo.gif" alt="<?=$this->config->item('server')?>" /></a></div>
	<div class="site-nav">
		<ul>

	<? start_block_marker('topnav') ?>

	<? end_block_marker() ?>

		</ul>
	</div>
</div>
<!-- CONTENT -->
<div id="content">
	<div class="top">
		<div class="bot">
			<div class="inner"><div class="inner_copy"></div>
				<div class="wrapper">
					<div class="col-1">
						<div class="indent">
							<h3>Menu</h3>
							<ul class="list">

	<? start_block_marker('rightnav') ?>

	<? end_block_marker() ?>

							</ul>
							<!-- <a href="#"><b>News Archive</b></a> -->
						</div>

	<? start_block_marker('righttitle') ?>

	<? end_block_marker() ?>

	<? start_block_marker('rightexptitle') ?>

	<? end_block_marker() ?>

	<? start_block_marker('rightexpcon1') ?>

	<? end_block_marker() ?>

	<? start_block_marker('rightexpcon2') ?>

	<? end_block_marker() ?>

					</div>
					<div class="col-2">

	<? start_block_marker('title') ?>

	<? end_block_marker() ?>

	<? start_block_marker('content') ?>

	<? end_block_marker() ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- FOOTER -->
<div id="footer">
	<div class="indent">
		<div class="fleft">Copyright - <strong><?=$this->config->item('server')?> Private Server</strong></div>
		<div class="fright">Page rendered in <strong>{elapsed_time}</strong> seconds using <strong>{memory_usage}</strong></div>
	</div>
</div>
</body>
</html>