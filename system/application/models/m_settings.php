<?php

class M_settings extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function get($key = null)
  {
		$this->db->where('id', 1);
		$query = $this->db->get('settings');
		$result = $query->row_array();
		if ($key) {
			return $result[$key];
		}
		else {
			return $result;
		}
	}
	
	function save($data) {
		$this->db->where('id', 1);
		$this->db->update('settings', $data);
		return $this->db->affected_rows();
	}
}