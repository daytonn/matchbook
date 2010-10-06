<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MatchBook
 *
 * Yet another asset manager for Codeigniter
 *
 * @package		MatchBook
 * @author		Dayton Nolan
 * @license		MIT License http://www.opensource.org/licenses/mit-license.html
 * @link		http://github.com/textnotspeech/matchsticks
 */

// ------------------------------------------------------------------------

class MatchBook
{
	private $doctype;
	private $title = 'Untitled Document';
	private $icon_path = 'images/icons/';
	private $stylesheet_path = 'css/';
	private $javascript_path = 'js/';
	private $image_path = 'images/';
	private $meta_viewport_content = 'width=device-width; initial-scale=1.0';
	private $stylesheets = array();
	private $javascripts = array();
	private $head_scripts = array();
	private $body_scripts = array();
	private $use_cachebuster = TRUE;
	private $cachebuster = FALSE;
	private $description = '';
	private $author = '';
	private $body_id = '';
	private $body_class = '';
	private $snippets = array();
	
	private $header;
	
	public function __construct($config = FALSE)
	{
		$this->CI =& get_instance();
		
		if($config && is_array($config))
		{
			foreach($config as $setting => $value)
			{
				$this->$setting = $value;
			}
		}
	}
	
	public function head()
	{
		return $this->build_header();
	}
	
	private function build_header()
	{
		$header = <<<HEAD
{$this->doctype_delaration()}
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

	<title>{$this->title}</title>
  	<meta name="description" content="{$this->description}">
  	<meta name="author" content="{$this->author}">

  	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
  	<meta name="viewport" content="{$this->meta_viewport_content}">

  	<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  	<link rel="shortcut icon" href="{$this->site_root('favicon.ico')}">
  	<link rel="apple-touch-icon" href="{$this->site_root($this->icon_path)}ios-icon.png">

	{$this->stylesheets()}
	{$this->head_scripts()}
</head>
<body{$this->body_id}{$this->body_class}>

HEAD;

		return $header;
	}
	
	private function doctype_delaration()
	{
		switch($this->doctype)
		{
			case 'HTML5':
				return '<!DOCTYPE html>';
			break;
			
			case 'Strict':
				return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
			break;
			
			case 'Transitional':
				return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
			break;
			
			case 'Frameset':
				return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">';
			break;
		}
	}
	
	private function site_root($path)
	{
		return base_url() . "{$path}";
	}
	
	public function stylesheets()
	{
		return implode('', $this->stylesheet_links());
	}
	
	private function stylesheet_links()
	{
		$stylesheet_links = array();
		foreach($this->stylesheets as $stylesheet)
		{
			$stylesheet_links[] = $this->stylesheet_link($stylesheet);
		}
		return $stylesheet_links;
	}
	
	public function stylesheet_link($stylesheet)
	{
		$cache_buster = $this->use_cachebuster ? $this->build_cachebuster() : '';
		return '<link rel="stylesheet" href="' . base_url() . $this->stylesheet_path . $stylesheet . '.css' . $cache_buster . '" type="text/css" charset="utf-8" />' . "\n";
	}
	
	private function build_cachebuster()
	{
		return $this->cachebuster ? '?' . $this->cachebuster . '&'. time() : '?' . time();
	}
	
	public function head_scripts()
	{
		$head_script_links = array();
		
		foreach($this->head_scripts as $script)
		{
			$head_script_links[] = $this->script_link($script);
		}
		
		return implode($head_script_links);
	}
	
	public function body_scripts()
	{
		$body_script_links = array();
		
		foreach($this->body_scripts as $script)
		{
			$body_script_links[] = $this->script_link($script);
		}
		
		return implode($body_script_links);
	}
	
	public function scripts()
	{		
		$scripts = array_merge($this->head_scripts, $this->body_scripts);
		$script_links = array();
		
		foreach($scripts as $script)
		{
			$script_links[] = $this->script_link($script);
		}
		
		return implode($script_links);
	}
	
	public function script_link($script)
	{
		$cache_buster = $this->use_cachebuster ? $this->build_cachebuster() : '';
		return '<script src="' . site_root($this->javascript_path . $script) . '.js' . $cache_buster . '"></script>' . "\n";
	}
	
	public function img($image_path, $options = array())
	{
		if(!isset($options['alt']))
		{
			$options['alt'] = $image_path;
		}
		
		return '<img src="' . $this->image_src($image_path) . '"' . $this->build_attributes($options) . '/>';
	}
	
	public function image_src($path)
	{
		return $this->site_root($this->image_path . $path);
	}
	
	public function build_attributes($attributes)
	{		
		$attributes_string = '';
		foreach($attributes as $attr => $val)
		{
			$attributes_string .= ' ' . $attr . '="' . $val . '"';
		}
		
		return $attributes_string;
	}
		
	public function add_stylesheet($stylesheet)
	{
		$this->stylesheets[] = $stylesheet;
	}

	public function add_script($script, $location = 'head')
	{
		$script_location = $location . '_scripts';
		$this->{$location}[] = $script;
	}
	
	private function script_snippet($source)
	{
		$snippet = <<<SNIP
<script>
/* <![CDATA[ */
	{$source}
/* ]]> */
</script>	
SNIP;
		return $snippet;
	}
	
	public function add_snippet($source)
	{
		$this->snippets[] = $source;
	}
	
	private function snippets()
	{
		return (!empty($this->snippets)) ? $this->script_snippet(implode("\n", $this->snippets)) : '';
	}
	
	public function footer()
	{
		return <<<FOOTER
{$this->body_scripts()}
{$this->snippets()}
</body>
</html>	
FOOTER;
	}
	
	public function page_info($options)
	{
		$this->title = (isset($options['title'])) ? $options['title'] : $this->title;
		$this->body_id = (isset($options['id'])) ? ' id="' . $options['id'] . '"' : '';
		$this->body_class = (isset($options['class'])) ? ' class="' . $options['class'] . '"' : '';
	}
	
	public function title($title)
	{
		$this->title = $title;
	}
	
	public function body_id($id)
	{
		$this->body_id = ' id="' . $id . '"';
	}
	
	public function body_class($class)
	{
		$this->body_class = ' class="' . $class .'"';
	}
}

/* End of file matsticks.php */