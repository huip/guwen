<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_user_info'))
{
	function get_user_info($info)
	{
		$CI =& get_instance();
		$user_info = $CI->session->all_userdata();
		if( !empty( $user_info[$info]) )
		{
			return $user_info[$info];
		}
		else
		{
			return  NULL;
		}
		
	}
}

if( ! function_exists('get_local_time'))
{
	function get_local_time()
	{
		return date("Y-m-d H:i:s",time());
	}
}

if( ! function_exists('get_remote_ip'))
{
	function get_remote_ip()
	{
		return $_SERVER['REMOTE_ADDR'];
	}
}

if( ! function_exists('is_login'))
{
	function is_login()
	{
		$CI =& get_instance();
		$user_info = $CI->session->all_userdata();
		return $user_info;
	}
}


