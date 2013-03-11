<?php
class Auth {
	var $CI;
	
	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		$this->CI->load->model('users_model');
	}
	
	public function is_admin() {
		$admin_user_csv = $this->CI->config->item('admin_users');
		$admin_user_arr = explode(',', $admin_user_csv);
		return in_array($this->CI->session->userdata('user_name'), $admin_user_arr);
	}
	
	public function is_logged_in() {
		if ($this->CI->session->userdata('user_id')) {
			return true;
		} else {
			return false;
		}
	}
	
	public function logout() {
		$this->CI->session->unset_userdata('user_id');
		$this->CI->session->unset_userdata('user_name');
	}
	
	public function check_login() {
		if (!$this->CI->input->post()) return false;
		
		$username = $this->CI->input->post('username');
		$password = $this->CI->input->post('password');
		
		$user_arr = $this->CI->users_model->get_by_name($username);
		if (count($user_arr)==1 && $user_arr[0]->password == $password) {
			$this->CI->session->set_userdata('user_id', $user_arr[0]->id);
			$this->CI->session->set_userdata('user_name', $user_arr[0]->username);
			redirect(site_url());
		} else {
			if (count($user_arr)==1) {
				$this->CI->session->set_flashdata('loginerror', 'Password mismatch');
			} else if (count($user_arr)==0) {
				$this->CI->session->set_flashdata('loginerror', 'Invalid user');
			}
			return false;
		}		
	}
}