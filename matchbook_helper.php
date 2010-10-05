<?php

function site_root($path)
{
	return base_url() . "{$path}";
}

function css_link($css)
{
	$CI =& get_instance();
	return $CI->matchbook->stylesheet_link($css);
}

function js_link($script)
{
	$CI =& get_instance();
	return $CI->matchbook->script_link($script);
}


function head()
{
	$CI =& get_instance();
	$CI->matchsticks->head_content();
}
?>