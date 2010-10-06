<?php

function site_root($path)
{
	return base_url() . "{$path}";
}

function stylesheet($css)
{
	$CI =& get_instance();
	return $CI->matchbook->stylesheet_link($css);
}

function stylesheets()
{
	$CI =& get_instance();
	return $CI->matchbook->stylesheets();
}

function script($script)
{
	$CI =& get_instance();
	return $CI->matchbook->script_link($script);
}

function scripts()
{
	$CI =& get_instance();
	return $CI->matchbook->scripts();
}

function head_scripts()
{
	$CI =& get_instance();
	return $CI->matchbook->head_scripts();
}

function footer_scripts()
{
	$CI =& get_instance();
	return $CI->matchbook->footer_scripts();
}

function head()
{
	$CI =& get_instance();
	return $CI->matchbook->head();
}

function footer()
{
	$CI =& get_instance();
	return $CI->matchbook->footer();
}

function build_attributes($attributes)
{
	$CI =& get_instance();
	return $CI->matchbook->build_attributes($attributes);
}

function img($image, $options = array())
{
	$CI =& get_instance();
	return $CI->matchbook->img($image, $options);
}

?>