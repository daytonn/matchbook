<?= $doctype_delaration ?>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<script>document.documentElement.className = 'js';</script>
	<meta charset="utf-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?= $title ?></title>
  	<meta name="description" content="<?= $description ?>">
  	<meta name="author" content="<?= $author ?>">

  	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
  	<meta name="viewport" content="<?= $meta_viewport_content ?>">

  	<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  	<link rel="shortcut icon" href="<?= $favicon ?>">
  	<link rel="apple-touch-icon" href="<?= $ios_icon ?>">
		
		<?= $stylesheets ?>
		<?= $head_scripts ?>
</head>
<body<?= $body_id . $body_class ?>>