<?php
class Categories extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('categories_model');

		if (!$this->auth->is_logged_in() || !$this->auth->is_admin()) {
			//check URI segment
			$curr_uri_string = uri_string();
			if ($curr_uri_string != 'categories/index') {
				redirect('users/login');
			}
		}		
	}
	
	public function index() {
		$data = array();
		
		$data['categories'] = $this->categories_model->get_all();
		
		$this->load->view('head');
		$this->load->view('categories_index', $data);
		$this->load->view('foot');
	}
	
	public function get_by_id() {
		//TODO
	}
	
	public function get_by_name() {
		//TODO
	}
	
	public function edit($id=0) {
		if ($this->input->post()) {
			if (!$this->input->post('id')) {
				$this->categories_model->insert($this->input->post('name'));
			} else {
				$this->categories_model->update($this->input->post('id'), $this->input->post('name'));
			}
			redirect('categories');
			return;
		}
		
		$data = array();
		
		if ($id) {
			$data['categories'] = $this->categories_model->get_by_id($id);
		}
		
		$this->load->view('head');
		$this->load->view('categories_edit', $data);
		$this->load->view('foot');
	}
	
	public function delete($id) {
		$this->categories_model->delete($id);
		redirect('categories');
	}
}