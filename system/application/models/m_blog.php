<?php

class M_blog extends Model {

  function __construct() {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByPk($id) {
		$this->db->where('id', $id);
		$this->db->where('published', 1);
    $query = $this->db->get('obsah');
		$result = $query->row_array();
		return $result;
  }

  function getByPath($path) {
		$this->db->where('path', $path);
		$this->db->where('published', 1);
    $query = $this->db->get('obsah');
		$result = $query->row_array();
		return $result;
  }

	function getAll($limit = NULL) {
		$this->db->where('published', 1);
		$this->db->where('lang', $this->language->lang());
		$this->db->order_by('created desc'); 
		if ($limit) {
  		$this->db->limit($limit);
		}
		$query = $this->db->get('obsah');
		$result = $query->result_array();
		return $result;
	}
}