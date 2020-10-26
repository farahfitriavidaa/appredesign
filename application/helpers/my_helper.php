<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('trimId'))
{
	function trimId($prefix, $id)
	{
		$return   = str_replace($prefix, '', $id);
		for ($i=0; $i < strlen($return); $i++) {
			if ($return[$i] === '0')
				$return = ltrim($return, '0');
			else
				break;
		}
		return $return;
	}   
}