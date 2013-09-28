<?php

class M_stranka_image extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByStranka($id)
  {
		$this->db->where('stranka_id', $id);
		$query = $this->db->get('stranka_image');
		$images = array();
		foreach ($query->result_array() as $image) {
			$images[] = $image['name'];
		}
		return $images;
	}
}