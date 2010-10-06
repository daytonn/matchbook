## Installation
* Copy matchbook.php into your Codeigniter application's "libraries" folder
* Copy matchbook_helper into your Codeigniter application's "helpers" folder (optional)
* Copy and rename config.php to matchbook.php into your Codeigniter application's "config" folder (optional)

## Usage
Either autoload or load the matchbook library
	$this->load->library('matchbook');
Set your configuration in config/matchbook.php
		$config['doctype'] = 'HTML5';
		$config['title'] = "Matchbook - Asset Management Library for Codeigniter";
		$config['icon_path'] = "images/icons/";
		$config['stylesheet_path'] = "css/";
		$config['javascript_path'] = 'js/';
		$config['stylesheets'] = array('main');
		$config['head_scripts'] = array('application/matchsticks');
		$config['body_scripts'] = array('application/bodyscript');