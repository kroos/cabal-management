<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<? start_block_marker('head') ?>

	<? end_block_marker() ?>

<link href="<?=base_url()?>css/nightvision.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<script>
	$(function() {
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return true; });
	});
	</script>
<!-- start header -->
<div id="wrapper">
<div id="header">
	<div id="logo">
		<h1><?=anchor('', $this->config->item('server'), array('title' => $this->config->item('server')))?></h1>
		<p><?=anchor('', ' Private Server', array('title' => ' Private Server'))?></p>
	</div>
	<!--
	id="rss"><a href="#">Subscribe to RSS Feed</a></div>
	<div id="search">
		<form id="searchform" method="get" action="">
			<fieldset>
				<input type="text" name="s" id="s" size="15" value="" />
				<input type="submit" id="x" value="Search" />
			</fieldset>
		</form>
	</div>
	-->
</div>
<!-- end header -->
<!-- star menu -->
<div id="menu">
	<ul>

	<? start_block_marker('topnav') ?>

	<? end_block_marker() ?>

	</ul>
</div>
<!-- end menu -->
<!-- start page -->
<div id="page">
	<!-- start ads -->
	<div id="ads"><img src="<?=base_url()?>images/nightvision/ad160x600.gif" alt="" width="160" height="600" /></div>
	<!-- end ads -->
	<!-- start content -->
	<div id="content">
		<div class="post">

			<div class="title">
				<h2>
	<? start_block_marker('title1') ?>

	<? end_block_marker() ?>
				</h2>
				<!-- <p><small>Posted on August 20th, 2007 by <a href="#">Free CSS Templates</a></small></p> -->
			</div>
			
			<div class="entry">

	<? start_block_marker('content1') ?>

	<? end_block_marker() ?>

			</div>
			<!-- <p class="links"> <a href="#" class="more">Read More</a> &nbsp;&nbsp;&nbsp; <a href="#" class="comments">No Comments</a> </p> -->
		</div>
		<div class="post">
			<div class="title">
				<h2>

	<? start_block_marker('title2') ?>

	<? end_block_marker() ?>

	</h2>
				<!-- <p><small>Posted on August 20th, 2007 by <a href="#">Free CSS Templates</a></small></p> -->
			</div>
			
			<div class="entry">

	<? start_block_marker('content2') ?>

	<? end_block_marker() ?>

			</div>
			<!-- <p class="links"> <a href="#" class="more">Read More</a> &nbsp;&nbsp;&nbsp; <a href="#" class="comments">No Comments</a> </p> -->
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
<?//if($this->session->userdata('logged_in') == TRUE):?>

<?//else:?>
	<div id="sidebar">
		<ul>
			<li id="categories">
				<h2>Menu</h2>
				<ul>
				
				<? start_block_marker('rightnav') ?>
				<? end_block_marker() ?>
	
				</ul>
			</li>
			<li>
			<? start_block_marker('righttitle') ?>
			<? end_block_marker() ?>

			<? start_block_marker('rightexptitle') ?>
			<? end_block_marker() ?>

			<? start_block_marker('rightexpcon1') ?>
			<? end_block_marker() ?>
			</li>
			<li>
			<?if ($this->config->item('facebook') == NULL):?>
			<?else:?>
				<h2>Facebook</h2>
			<?endif?>

			<? start_block_marker('rightexpcon2') ?>
			<? end_block_marker() ?>
			</li>
		</ul>
	</div>
<?//endif?>
	<!-- end sidebar -->
</div>
<!-- end page -->
<!-- start footer -->
<div id="footer">
	<p class="legal">
		Page rendered in <strong>{elapsed_time}</strong> seconds using <strong>{memory_usage}</strong>
	</p>
	<p class="legal">
		&copy;2012 <?=$this->config->item('server')?> Private Server. All Rights Reserved.&nbsp;&nbsp;&bull;&nbsp;&nbsp;Design by <a href="http://forum.ragezone.com/members/294574.html">Zaugola</a>.
	</p>
	<p class="links">
		<a href="http://validator.w3.org/check/referer" class="xhtml" title="This page validates as XHTML">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a>&nbsp;&bull;&nbsp;<a href="http://jigsaw.w3.org/css-validator/check/referer" class="css" title="This page validates as CSS">Valid <abbr title="Cascading Style Sheets">CSS</abbr></a>
	</p>
</div>
</div>
<!-- end footer -->
</body>
</html>
