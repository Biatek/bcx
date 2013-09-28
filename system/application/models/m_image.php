<?php

class M_image extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByObsah($id)
  {
		$this->db->where('obsah_id', $id);
		$query = $this->db->get('image');
		$images = array();
		foreach ($query->result_array() as $image) {
			$images[] = $image['name'];
		}
		return $images;
	}
}