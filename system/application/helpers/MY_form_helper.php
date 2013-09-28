<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function format_dropdown($array, $key, $value, $help = NULL) {
	$result = $help ? array(0 => $help) : array();
	foreach ($array as $row) {
		$result[$row[$key]] = $row[$value];
	}
	return $result;
}