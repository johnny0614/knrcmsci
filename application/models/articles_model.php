<?php
class Articles_Model extends CI_Model {
	public $db_table_name = 'articles';
	
	public function get_all($limit=10, $offset=0, $type = 'post') {
		$this->db->order_by('id', 'desc');
		if ($type != 'both') $this->db->where('type', $type);
		return $this->db->get($this->db_table_name, $limit, $offset)->result();
	}
	
	public function get_count($type = 'post') {
		if ($type != 'both') $this->db->where('type', $type);
		return $this->db->count_all_results($this->db_table_name);
	}
	
	public function get_list($type = 'post') {
		$this->db->select('id, title');
		if ($type != 'both') $this->db->where('type', $type);
		$result = $this->db->get($this->db_table_name)->result();
		
		$retval = array();
		foreach($result as $row) {
			$retval[$row->id] = $row->title;
		}
		
		return $retval;
	}
	
	public function get_by_id($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->db_table_name)->result();
	}
	
	public function get_by_name($name) {
		$this->db->where('title', $name);
		return $this->db->get($this->db_table_name)->result();
	}
	
	public function insert($title, $content, $category_id, $type = 'post') {
		$currdatetime = date('Y-m-d g:i:s',time());
		$this->db->insert(
			$this->db_table_name,
			array(
				'title' => $title,
				'content' => $content,
				'category_id' => $category_id,
				'type' => $type,
				'created' => $currdatetime,
				'updated' => $currdatetime
			)
		);
		return $this->db->insert_id();
	}
	
	public function update($id, $title, $content, $category_id, $type = 'post') {
		$currdatetime = date('Y-m-d g:i:s',time());
		$this->db->where('id', $id);
		$this->db->update(
			$this->db_table_name,
			array(
				'title' => $title,
				'content' => $content,
				'category_id' => $category_id,
				'type' => $type,
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