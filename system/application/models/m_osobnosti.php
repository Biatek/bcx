<?php

class M_osobnosti extends Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  function getByPk($id)
  {
		$this->db->where('id', $id);
    $query = $this->db->get('osobnosti');
		$result = $query->row_array();
		$this->db->where('osobnosti_id', $id);
		$query = $this->db->get('osobnosti_image');
		$result['files'] = $query->result_array();
		$this->db->where('osobnost_id', $id);
		$query = $this->db->get('osobnosti_kategorie');
		$result['kategorie'] = $query->result_array();
		return $result;
  }

  function getByPath($path)
  {
		$this->db->where('path', $path);
    $query = $this->db->get('osobnosti');
		$result = $query->row_array();
		return $this->getByPk($result['id']);
  }

	function getByParams($params = array(), $limit = null, $offset = null) {
		$this->db->where($params);
		$this->db->from('osobnosti');
		$this->db->limit($limit, $offset);
		$this->db->order_by('name', 'asc');
		$query = $this->db->get();
		$result = $query->result_array();
		$res = array();
		foreach ($result as $key => &$row) {
			$res[] = $this->getByPk($row['id']);
		}
		return $res;
	}

  function insert($data)
  {
		$kategorie = $data['kategorie'];
		unset($data['kategorie']);
		$images = $data['images'];
		unset ($data['images']);
  	$this->db->insert('osobnosti', $data);
		$id = $this->db->insert_id();
		$this->save_kat($id, $kategorie);
		$data = array();
		foreach ($images as $image) {
			$this->db->insert('osobnosti_image', array('osobnosti_id' => $id, 'name' => $image));
		}
		return $this->db->affected_rows();
  }

  function update($id, $data)
  {
		$kategorie = $data['kategorie'];
		unset($data['kategorie']);
		if (isset($data['images'])) {
			$images = $data['images'];
			unset ($data['images']);			
		}
		$this->db->where('id', $id);
		$this->db->update('osobnosti', $data);
		$this->save_kat($id, $kategorie);
		if (isset($images)) {
			$this->db->where('osobnosti_id', $id);
			$this->db->delete('osobnosti_image');
			$data = array();
			foreach ($images as $image) {
				$this->db->insert('osobnosti_image', array('osobnosti_id' => $id, 'name' => $image));
			}
		}
		return $this->db->affected_rows();
  }

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('osobnosti'); 
		return $this->db->affected_rows();
	}
	
	function save_kat($id, $kategorie) {
		$this->db->where('osobnost_id', $id);
		$this->db->delete('osobnosti_kategorie');
		foreach ($kategorie as $kat) {
			$this->db->insert('osobnosti_kategorie', array('osobnost_id' => $id, 'kategoria_id' => $kat));
		}
		return $this->db->affected_rows();
	}

}