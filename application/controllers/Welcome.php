<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
 
	public function index()
	{
		$this->login_details();
		$this->load->view('dashboard');
	}

 //==========================Details===========================//
 protected function login_details()
 {
	 $this->require_login();
	 $data['log_user_dtl'] = $this->Login_model->user_details();
	 return $data;
 }
 //=========================/Details===========================//

 //======================Login Validation======================//
 protected function require_login()
 {
	 $is_user_in = $this->session->userdata('is_user_in');
	 if (isset($is_user_in) || $is_user_in == true) {
		 return;
	 } else {
		 redirect('Login');
	 }
 }

 protected function ajax_login()
 {
	 $is_user_in = $this->session->userdata('is_user_in');
	 if (isset($is_user_in) || $is_user_in == true) {
		 return true;
	 } else {
		 echo json_encode(array('status' => 'error', 'message' => 'You are not Logged in Now!! Please login again.'));
		 return false;
	 }
 }


}
