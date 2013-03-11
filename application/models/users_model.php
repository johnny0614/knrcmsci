<?php
class Users_Model extends CI_Model {
	public $db_table_name = 'users';

	public function get_all() {
		return $this->db->get($this->db_table_name)->result();
	}
	
	public function get_by_id($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->db_table_name)->result();
	}
	
	public function get_by_name($name) {
		$this->db->where('username', $name);
		return $this->db->get($this->db_table_name)->result();
	}
	
	public function insert($name, $password) {
		$currdatetime = date('Y-m-d g:i:s',time());
		$this->db->insert(
			$this->db_table_name,
			array(
				'username' => $name,
				'password' => $password,
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
				'username' => $name,
				'password' => $password,
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