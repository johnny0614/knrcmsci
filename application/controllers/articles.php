<?php
class Articles extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('articles_model');	
		$this->load->model('categories_model');
	
		if (!$this->auth->is_logged_in() || !$this->auth->is_admin()) {
			$curr_uri_string = uri_string();
			//strstr is used instead of equals because pagination would occur
			//empty string is compared because articles/index is the home page
			if (!strstr($curr_uri_string, 'articles/index') && !strstr($curr_uri_string, 'articles/get_by_id') && $curr_uri_string != '') {				
				redirect('users/login');
			}
		}		
	}
	
	public function index($offset=0) {
		$this->load->library('pagination');
		
		$data = array();
		
		$data['articles'] = $this->articles_model->get_all(10, $offset, $this->auth->is_admin()?'both':'post');
		
		$pagination_settings = array(
			'base_url' => site_url('articles/index'),
			'total_rows' => $this->articles_model->get_count($this->auth->is_admin()?'both':'post'),
			'per_page' => 10
		);
		
		$this->pagination->initialize($pagination_settings);		
		
		$this->load->view('head');
		$this->load->view('articles_index', $data);
		$this->load->view('foot');
	}
	
	public function get_by_id($id) {
		//We have to define pagination because we're re-using the view from index()
		$this->load->library('pagination');
		$pagination_settings = array(
				'base_url' => site_url('articles/index'),
				'total_rows' => 1,
				'per_page' => 10
		);		
		$this->pagination->initialize($pagination_settings);
		
		$this->load->view('head');
		$data = array();
		$data['articles'] = $this->articles_model->get_by_id($id);
		$this->load->view('articles_index', $data);
		$this->load->view('foot');
	}
	
	public function delete($id) {
		$this->articles_model->delete($id);
		redirect('articles/index');
	}
	
	public function edit($id=0) {
		if ($this->input->post()) {
			if (!$id) {
				$this->articles_model->insert(
					$this->input->post('title'),
					$this->input->post('content'),
					$this->input->post('category_id'),
					$this->input->post('type')
				);
			} else {
				$this->articles_model->update(
						$this->input->post('id'),
						$this->input->post('title'),
						$this->input->post('content'),
						$this->input->post('category_id'),
						$this->input->post('type')
				);				
			}
			redirect('articles');
			return;
		}
		
		$data = array();
		
		if ($id) {
			$data['articles'] = $this->articles_model->get_by_id($id);
		}
		
		$data['categories_list'] = $this->categories_model->get_list();
		
		$this->load->view('head');
		$this->load->view('articles_edit', $data); //TODO- Change
		$this->load->view('foot');
	}
}