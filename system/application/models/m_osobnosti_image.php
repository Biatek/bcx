<?php

class M_osobnosti_image extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByOsoba($id)
  {
		$this->db->where('osobnosti_id', $id);
		$query = $this->db->get('osobnosti_image');
		$images = array();
		foreach ($query->result_array() as $image) {
			$images[] = $image['name'];
		}
		return $images;
	}
}