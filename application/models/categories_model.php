<?php
class Categories_Model extends CI_Model {
	public $db_table_name = 'categories';
	
	public function get_all() {
		return $this->db->get($this->db_table_name)->result();
	}
	
	public function get_list() {
		$result = $this->db->get($this->db_table_name)->result();
		
		$retval = array();
		foreach($result as $row) {
			$retval[$row->id] = $row->name;
		}
		
		return $retval;
	}
	
	public function get_by_id($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->db_table_name)->result();		
	}
	
	public function get_name_by_id($id) {
		$this->db->where('id', $id);
		$result = $this->db->get($this->db_table_name)->result();
		if (!count($result)==1) return NULL;
		return $result[0]->name;		
	}
	
	public function get_by_name($name) {
		$this->db->where('name', $name);
		return $this->db->get($this->db_table_name)->result();		
	}
	
	public function insert($name) {
		$currdatetime = date('Y-m-d g:i:s',time());
		$this->db->insert(
			$this->db_table_name,
			array(
				'name' => $name,
				'created' => $currdatetime,
				'updated' => $currdatetime
			)
		);
		return $this->db->insert_id();
	}
	
	public function update($id, $name) {
		$currdatetime = date('Y-m-d g:i:s',time());
		$this->db->where('id', $id);
		$this->db->update(
			$this->db_table_name,
			array(
				'name' => $name,
				'updated' => $currdatetime
			)
		);
		return $this->db->affected_rows();
	}
	
	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->db_table_name);
	}
}