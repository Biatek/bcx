<?php

class M_calc extends Model {
	
	function get($hash) {
		$this->db->where('hash', $hash);
		$result = $this->db->get('results');
		$array = $result->row_array();
		$array['data'] = unserialize($array['data']);
		return $array;
	}
	
	function save($hash, $data, $lang = 'en') {
		$insert = array(
			'hash'		=>	$hash,
			'data'		=>	serialize($data),
			'lang'		=>	$lang
			);
		$this->db->insert('results', $insert);
		return $this->db->affected_rows();
	}
}