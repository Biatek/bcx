<?php

class M_stranka extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByPk($id)
  {
		$this->db->where('id', $id);
    $query = $this->db->get('stranka');
		$result = $query->row_array();
		$this->db->where('stranka_id', $id);
		$query = $this->db->get('stranka_image');
		$result['files'] = $query->result_array();
		return $result;
  }

  function getByPath($path)
  {
		$this->db->where('path', $path);
    $query = $this->db->get('stranka');
		$result = $query->row_array();
		if ($result) {
			$this->db->where('stranka_id', $result['id']);
			$query = $this->db->get('stranka_image');
			$result['files'] = $query->result_array();
		}
		return $result;
  }

	function getByParams($params, $limit = null, $offset = null) {
		$this->db->where($params);
		$this->db->from('stranka');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => &$row) {
			$unset = FALSE;
			$this->db->where('stranka_id', $row['id']);
			$query = $this->db->get('stranka_image');
			$row['files'] = $query->result_array();
		}
		return $result;
	}
	
	function getMenu() {
		$this->db->where('published', 1);
		$this->db->where('lang', $this->language->lang());		
		$this->db->from('stranka');
		//$this->db->limit($limit, $offset);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

  function insert($data)
  {
		$images = $data['images'];
		unset ($data['images']);
  	$this->db->insert('stranka', $data);
		$id = $this->db->insert_id();
		$data = array();
		foreach ($images as $image) {
			$this->db->insert('stranka_image', array('stranka_id' => $id, 'name' => $image));
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
		$this->db->update('stranka', $data);
		if (isset($images)) {
			$this->db->where('stranka_id', $id);
			$this->db->delete('stranka_image');
			$data = array();
			if (is_array($images)) {
				foreach ($images as $image) {
					$this->db->insert('stranka_image', array('stranka_id' => $id, 'name' => $image));
				}
			}
		}
		return $this->db->affected_rows();
  }

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('stranka');
	}
}