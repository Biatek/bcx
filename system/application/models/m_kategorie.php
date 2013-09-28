<?php

class M_kategorie extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function get($params = array())
  {
		if ($params) {
			foreach ($params as $key => $value) {
				$this->db->where($key, $value);
			}
		}
		$result = $this->db->get('kategorie');
		return $result->result_array();
	}
	
	function save($kategoria) {
		if ($kategoria['id']) {
			$this->db->where('id', $kategoria['id']);
			$this->db->update('kategorie', $kategoria);
		}
		else {
			$this->db->insert('kategorie', $kategoria);
		}
		return $this->db->affected_rows();
	}
	
	function delete($id) {
		if (!$id) {
			return FALSE;
		}
		$this->db->where('id', $id);
		$this->db->delete('kategorie');
		return $this->db->affected_rows();
	}
}