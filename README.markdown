## Installation
* Copy matchbook.php into your Codeigniter application's "libraries" folder
* Copy matchbook_helper into your Codeigniter application's "helpers" folder (optional)
* Copy and rename config.php to matchbook.php into your Codeigniter application's "config" folder (optional)

## Configuration
Basic configuration
<pre name="code" class="php">
	$config['doctype'] = 'HTML5';
	$config['title'] = 'Matchbook - Asset Management Library for Codeigniter';
	$config['icon_path'] = 'images/icons/';
	$config['stylesheet_path'] = 'css/';
	$config['javascript_path'] = 'js/';
	$config['stylesheets'] = array('main');
	$config['head_scripts'] = array('headscript');
	$config['body_scripts'] = array('bodycript');
	$config['author'] = 'Dayton Nolan';
	$config['description'] = 'Yet another asset management library for Codeigniter';
</pre>

<table border="0" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th>Setting</th>
			<th>Default</th>
			<th>Options</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>doctype</td>
			<td>HTML5</td>
			<td>HTML5, Strict, Transitional, Frameset</td>
			<td>Sets the doctype for the rendered head markup.</td>
		</tr>
		<tr>
			<td>title</td>
			<td>Untitled Document</td>
			<td>string</td>
			<td>Sets the default title for the rendered head markkup.</td>
		</tr>
		<tr>
			<td>stylesheet_path</td>
			<td>css/</td>
			<td>string</td>
			<td>Sets the default path to css files.</td>
		</tr>
		<tr>
			<td>script_path</td>
			<td>js/</td>
			<td>string</td>
			<td>Sets the default path to script files.</td>
		</tr>
		<tr>
			<td>image_path</td>
			<td>images/</td>
			<td>string</td>
			<td>Sets the default path to image files.</td>
		</tr>
		<tr>
			<td>icon_path</td>
			<td>images/icons/</td>
			<td>string</td>
			<td>Sets the default path to icon files for devices.</td>
		</tr>
		<tr>
			<td>use_cachebuster</td>
			<td>TRUE</td>
			<td>boolean</td>
			<td>Determines whether or not a cache buster will be appended to resource requests.</td>
		</tr>
		<tr>
			<td>cachebuster</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Sets the query string param to be used in cache buster for (ie. cache=0).</td>
		</tr>
		<tr>
			<td>head_scripts</td>
			<td>(empty array)</td>
			<td>array</td>
			<td>Scripts to be loaded inside the head tag.</td>
		</tr>
		<tr>
			<td>body_scripts</td>
			<td>(empty array)</td>
			<td>array</td>
			<td>Scripts to be loaded at the end of the body tag.</td>
		</tr>
		<tr>
			<td>author</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Author meta tag content</td>
		</tr>
		<tr>
			<td>description</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Description meta tag content</td>
		</tr>
		<tr>
			<td>body_id</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Sets default body id for rendered head markup</td>
		</tr>
		<tr>
			<td>body_class</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Sets default body class for rendered head markup</td>
		</tr>
	</tbody>
</table>

## Usage

Either autoload or load the matchbook library (make sure to setup your config/matchbook.php)

<pre name="code" class="php">
	// config/autoload.php
	$autoload['libraries'] = array('matchbook');
	
	//-- OR --//
	
	// controllers/controller.php
	$this->load->library('matchbook');
</pre>

You can now control head content via the matchbook API

<pre name="code" class="php">
	// controllers/controller.php
	$this->matchbook->page_info(array('title' = 'My Page Title', 'id' => 'home'));
	$data['head'] = $this->matchbook->head(); // Get the head markup
	$data['footer'] = $this->matchbook->footer(); // Get the closing footer markup
	$this->load->view('myview', $data); // Pass markup to view
	
	// Then in views/myview.php
	<?php echo $head; ?>
		<!-- Content goes here -->
	<?php echo $footer ?>
	
	//-- OR --//
	
	// You can use the matchbook helper to print the markup directly in a view
	// In views/myview.php
	<?php echo head(); ?>
		<!-- Content goes here -->
	<?php echo footer(); ?>
</pre>

Which will render something like this:

<pre name="code" class="php">
	<!DOCTYPE html>
	<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
	<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
	<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
	<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
	<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
	<head>
		<script>document.documentElement.className = 'js';</script>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
			 Remove this if you use the .htaccess -->

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Matchbook - Asset Management Library for Codeigniter</title>
	  	<meta name="description" content="Yet another asset manager for Codeigniter">
	  	<meta name="author" content="Dayton Nolan">

	  	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
	  	<meta name="viewport" content="width=device-width; initial-scale=1.0">

	  	<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->

	  	<link rel="shortcut icon" href="http://example.com/favicon.ico">
	  	<link rel="apple-touch-icon" href="http://example.com/images/icons/ios-icon.png">

		<link rel="stylesheet" href="http://example.com/css/main.css?1286342222" type="text/css" charset="utf-8" />

		<script src="http://example.com//js/headscript.js?1286342222"></script>

	</head>
	<body id="home">
		<!-- Content goes here -->
	<script src="http://example.com/js/application/bodyscript.js?1286342222"></script>
	</body>
	</html>
</pre>

Matchbook provides a full API to dynamically add and edit the head content from your controller:

### add_stylesheet((string) $stylesheet)
<pre name="code" class="php">
	$this->matchbook->add_stylesheet('styles'); // adds styles.css to the list of stylesheets to be included in the head markup
</pre>
The add_stylesheet method adds a stylesheet to be included in the head markup. Note: the css extension is excluded.

### add_script((string) $script, (string) $location = 'head')
<pre name="code" class="php">
	$this->matchbook->add_script('jquery-1.4.2.min'); // adds jquery-1.4.2.min.js to the list of head_scripts to be included in the head markup
</pre>
The add_script method adds a script to be included in either the head or the footer markup. The second (optional) argument is the location where the script will be included, one of either head or footer. Note: The default location is header and the js extension is excluded.