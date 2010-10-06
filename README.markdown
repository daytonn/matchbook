## Installation
* Copy matchbook.php into your Codeigniter application's "libraries" folder
* Copy matchbook_helper into your Codeigniter application's "helpers" folder (optional)
* Copy and rename config.php to matchbook.php into your Codeigniter application's "config" folder (optional)

## Usage

* Either autoload or load the matchbook library

<pre name="code" class="php">
	$this->load->library('matchbook');
</pre>

* Set your configuration in config/matchbook.php

<pre name="code" class="php">
	$config['doctype'] = 'HTML5';
	$config['title'] = "Matchbook - Asset Management Library for Codeigniter";
	$config['icon_path'] = "images/icons/";
	$config['stylesheet_path'] = "css/";
	$config['javascript_path'] = 'js/';
	$config['stylesheets'] = array('main');
	$config['head_scripts'] = array('headscript');
	$config['body_scripts'] = array('pagescript');
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