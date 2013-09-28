<?php

class M_front extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getAll()
  {
    $query = $this->db->get('front_page');
		$result = $query->result_array();
		return $result;
  }
  
  function getByLang($lang = 'en')
  {
    $this->db->where('lang', $lang);
    $query = $this->db->get('front_page');
		$result = $query->row_array();
		return $result;
  }
  
  function update($lang, $data)
  {
		$this->db->where('lang', $lang);
		$this->db->update('front_page', $data);
		return $this->db->affected_rows();
  }
  
}
