<?php

class M_blocks_image extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByObsah($id)
  {
		$this->db->where('block_id', $id);
		$query = $this->db->get('blocks_image');
		$images = array();
		foreach ($query->result_array() as $image) {
			$images[] = $image['name'];
		}
		return $images;
	}
}