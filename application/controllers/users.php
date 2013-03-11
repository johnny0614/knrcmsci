<?php
/*
 * TODO: Reset password
 */
class Users extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('users_model');
		
		if (!$this->auth->is_logged_in()) {
			//check URI segment
			$curr_uri_string = uri_string(); 
			if ($curr_uri_string != 'users/register'
				&& $curr_uri_string != 'users/login') {
				redirect('users/login');
			}
		}
	}
	
	public function logout() {
		$this->auth->logout();
		redirect(site_url());
	}
	
	public function index() {
		$data = array();
		$data['users'] = $this->users_model->get_all();
		$this->load->view('head');
		$this->load->view('users_list', $data);
		$this->load->view('foot');		
	}
	
	public function login() {
		if (!$this->auth->check_login()) {
			$this->load->view('head');				
			$this->load->view('users_login');				
			$this->load->view('foot');				
		}
	}
	
	public function register() {
		if (!$this->config->item('enable_user_reg')) {
			redirect(site_url());
			return;
		}
		
		if (!$this->input->post()) {
			$this->load->view('head');
			$this->load->view('users_register');
			$this->load->view('foot');				
		} else {
			if ($this->input->post('password') != $this->input->post('confirm')) {
				$this->session->set_flashdata('regerror', 'Password and confirmation do not match');
			} else {			
				$stat = $this->users_model->insert(
					$this->input->post('username'),
					$this->input->post('password')
				);
				
				if ($stat) {
					redirect(site_url());
					return;
				} else {					
					//TODO: Check why it didn't get inserted. Eg. user already exists
				
					$this->session->set_flashdata('status', 'User could not be created');
				}
			}
			
			$this->load->view('head');
			$this->load->view('users_register');
			$this->load->view('foot');				
		}
	}
	
	public function delete($id) {
		$this->users_model->delete($id);
		redirect('users');
	}
}