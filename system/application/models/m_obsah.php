<?php

class M_obsah extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByPk($id)
  {
		$this->db->where('id', $id);
    $query = $this->db->get('obsah');
		$result = $query->row_array();
		$this->db->where('obsah_id', $id);
		$query = $this->db->get('image');
		$result['files'] = $query->result_array();
		return $result;
  }

  function getByPath($path)
  {
		$this->db->where('path', $path);
    $query = $this->db->get('obsah');
		$result = $query->row_array();
		$this->db->where('obsah_id', $id);
		$query = $this->db->get('image');
		$result['files'] = $query->result_array();
		return $result;
  }

	function getByParams($params, $limit = null, $offset = null) {
		$this->db->where($params);
		$this->db->from('obsah');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => &$row) {
			$this->db->where('obsah_id', $row['id']);
			$query = $this->db->get('image');
			$row['files'] = $query->result_array();
		}
		return $result;
	}

  function insert($data)
  {
		$images = $data['images'];
		unset ($data['images']);
  	$this->db->insert('obsah', $data);
		$id = $this->db->insert_id();
		$data = array();
		foreach ($images as $image) {
			$this->db->insert('image', array('obsah_id' => $id, 'name' => $image));
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
		$this->db->update('obsah', $data);
		if (isset($images)) {
			$this->db->where('obsah_id', $id);
			$this->db->delete('image');
			$data = array();
			foreach ($images as $image) {
				$this->db->insert('image', array('obsah_id' => $id, 'name' => $image));
			}
		}
		return $this->db->affected_rows();
  }

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('obsah'); 
		return $this->db->affected_rows();
	}

}