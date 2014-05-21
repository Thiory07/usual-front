<!doctype html>
<html lang="pt-br">
<head>
	<?php require("src/config/seo.php"); ?>
	<meta charset="UTF-8">
	<title><?php echo $titulo; ?></title>
	<meta name="description" content="<?php echo $description; ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<meta name="apple-touch-fullscreen" content="yes" /> 
	<meta name="geo.region" content="BR-SP">
	<meta name="geo.placename" content="Jundiai">     
	
	<link rel="cannonical" href="<?php echo $cannonical; ?>">
	<link rel="icon" type="image/png" href="imagens/favicon.png" />
	<?php require_once 'src/controller/css.php'; ?>	

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=583584088334898";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>