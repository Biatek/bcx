<?php

class M_blocks extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByPk($id)
  {
		$this->db->where('id', $id);
    $query = $this->db->get('blocks');
		$result = $query->row_array();
		$this->db->where('block_id', $id);
		$query = $this->db->get('blocks_image');
		$result['files'] = $query->result_array();
		return $result;
  }

	function getByParams($params, $limit = null, $offset = null) {
		$this->db->where($params);
		$this->db->from('blocks');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => &$row) {
			$this->db->where('block_id', $row['id']);
			$query = $this->db->get('blocks_image');
			$row['files'] = $query->result_array();
		}
		return $result;
	}

  function insert($data)
  {
		$images = $data['images'];
		unset ($data['images']);
  	$this->db->insert('blocks', $data);
		$id = $this->db->insert_id();
		$data = array();
		foreach ($images as $image) {
			$this->db->insert('blocks_image', array('block_id' => $id, 'name' => $image));
		}
		return $this->db->affected_rows();
  }

  function update($id, $data)
  {
		if (isset($data['images'])) {
			$images = $data['images'];
			unset ($data['images']);			
		}
		$this->db->where('id', $id);
		$this->db->update('blocks', $data);
		if (isset($images)) {
			$this->db->where('block_id', $id);
			$this->db->delete('blocks_image');
			$data = array();
			foreach ($images as $image) {
				$this->db->insert('blocks_image', array('block_id' => $id, 'name' => $image));
			}
		}
		return $this->db->affected_rows();
  }

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('blocks'); 
		return $this->db->affected_rows();
	}

}