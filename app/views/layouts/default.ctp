<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title_for_layout?></title>

	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	
	<link rel="stylesheet" href="/css/reset.css" type="text/css" media="screen" />
	
</head>
<body>
	<header>
		<h1><a href="/">Shell Addict</a></h1>
		<?php echo $this->element('navs/utility'); ?>
	</header>

	<?php echo $this->Session->flash(); ?>
	
	<?php echo $content_for_layout ?>

	<footer>
		<p>Created by <a href="http://www.bwigg.com" target="_blank">Brian Wigginton</a> and <a href="http://www.gibbonsr.net" target="_blank">Ryan Gibbons</a></p>
	</footer>

	<script type="text/javascript" src="/js/modernizr-1-1.6.min.js"></script>
	<?php echo $scripts_for_layout ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>