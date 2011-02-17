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
	private $stylesheet_path = 'css/';
	private $script_path = 'js/';
	private $image_path = 'images/';
	private $icon_path = 'images/icons/';
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
	private $view_path = 'matchbook/';
	
	private $header;
	
	public function __construct($config = NULL)
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
		
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
		return $this->get_head();
	}
	
	private function get_head()
	{
		$head['doctype_delaration'] = $this->doctype_delaration();
		$head['title'] = $this->title;
		$head['description'] = $this->description;
		$head['author'] = $this->author;
		$head['meta_viewport_content'] = $this->meta_viewport_content;
		$head['favicon'] = $this->site_root('favicon.ico');
		$head['ios_icon'] = $this->site_root($this->icon_path . 'ios-icon.png');
		$head['stylesheets'] = $this->stylesheets();
		$head['head_scripts'] = $this->head_scripts();
		$head['body_id'] = $this->body_id;
		$head['body_class'] = $this->body_class;

		return $this->CI->load->view($this->view_path . 'head', $head, TRUE);;
	}
	
	private function doctype_delaration()
	{
		$doctypes = array(
			'HTML5' => '<!DOCTYPE html>',
			'Strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
			'Transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
			'Frameset' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">'
		);
		
		return $doctypes[$this->doctype];
	}
	
	private function site_root($path)
	{
		return base_url() . $path;
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
		return '<script src="' . site_root($this->script_path . $script) . '.js' . $cache_buster . '"></script>' . "\n";
	}
	
	public function img($image_path, $attributes = array())
	{
		if(!isset($attributes['alt']))
		{
			$attributes['alt'] = $image_path;
		}
		
		return '<img src="' . $this->image_src($image_path) . '"' . $this->build_attributes($attributes) . '/>';
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
		$this->{$script_location}[] = $script;
	}
	
	private function script_snippet($source)
	{
		$snippet['source'] = $source;
		return $this->CI->load->view($this->view_path . 'snippet', $source, TRUE);
	}
	
	public function add_snippet($source)
	{
		$this->snippets[] = $source;
	}
	
	private function snippets()
	{
		return (!empty($this->snippets)) ? $this->script_snippet(implode("\n", $this->snippets)) : '';
	}
	
	public function end_html()
	{
		$end['body_scripts'] = $this->body_scripts();
		$end['snippets'] = $this->snippets();
		return $this->CI->load->view($this->view_path . 'end', $end, TRUE);
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

/* End of file matchbook.php */