<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Master extends CI_Controller
{


	//=========================/state===========================//
	public function state_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "State List";
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Master_model->get_all_state();
		$data['edit_value'] = $this->Master_model->get_edit_state($data['id']);
		$this->load->view('state_list', $data);
	}

	public function insert_state()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_state()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'State has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'State Updated Successfully'
					);
				} else if ($data == 3) {
					$info = array(
						'status' => 'error',
						'message' => 'State with same name already exist'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_state()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_state()) {

				$info = array(
					'status' => 'success',
					'message' => 'State has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//=========================/state===========================//

	//-------------------------- city ------------------------//
	public function city_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "City List";
		$data['id'] = $this->input->get('id');
		$data['get_active_state'] = $this->Master_model->get_active_state();
		$data['all_value'] = $this->Master_model->get_all_city();
		$data['edit_value'] = $this->Master_model->get_edit_city($data['id']);

		$this->load->view('city_list', $data);
	}

	public function insert_city()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_city()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'City has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'City Updated Successfully'
					);
				} else if ($data == 3) {
					$info = array(
						'status' => 'error',
						'message' => 'City with same name already exist'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function insert_shortcut_city()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_shortcut_city()) {

				$info = array(
					'status' => 'success',
					'message' => 'City has been Added successfully!',
					'data' => $this->Master_model->get_edit_city($data),
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_city()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_city()) {
				$info = array(
					'status' => 'success',
					'message' => 'City has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function get_city(){ 
		$data = $this->login_details();
		 if ($_SERVER["REQUEST_METHOD"] == "POST") {
		   $m_state = $this->input->post('m_state');
	   
		   if ($data = $this->Master_model->get_city($m_state)) {
			 echo json_encode($data);
		   }
		 }
		 }

	//-------------------------- city ------------------------//


	

	//========================= perm ===========================//

	public function perm_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Permission list";
		$data['id'] = $this->input->get('id');
		$data['edit_value'] = $this->Master_model->get_edit_perm($data['id']);
		$data['all_value'] = $this->Master_model->all_perm();
		$this->load->view('perm_list', $data);
	}

	public function insert_perm()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_perm()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Data has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Data Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_perm()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_perm()) {
				$info = array(
					'status' => 'success',
					'message' => 'Data has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//========================= perm ===========================//


	//========================= userperm ===========================//
	public function rolls_permission(){
		$data = $this->login_details();
		$data['pagename'] = "All Rolls Permission"; 
		$data['user_dtl'] = $this->Master_model->rolls_permission_list(); 
		// print_r($data['user_dtl']); die();
		$this->load->view('rolls_permission', $data);	
	}

	public function userperm_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Permission";
		$data['userid']  = $this->input->get('id'); 
		$data['user_dtl'] = $this->Master_model->user_details($data['userid']);
		$data['edit_value'] = $this->Master_model->get_userperm_userId($data['userid']);
		$data['all_value'] = $this->Master_model->all_perm();
		// print_r($data['user_dtl']); die();
		$this->load->view('user_permission_list', $data);
	}

	public function insert_userperm()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_userperm()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Data has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Data Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	//   public function delete_userperm(){

	// 	if($_SERVER["REQUEST_METHOD"] == "POST"){
	// 	  if($data = $this->Master_model->delete_userperm()){
	// 	  $info = array( 'status'=>'success',
	// 	  'message'=>'Data has been Deleted successfully!'
	// 	  );
	// 	  }else{ 
	// 		$info = array( 'status'=>'error',
	// 		  'message'=>'Some problem Occurred!! please try again'
	// 		);
	// 	  } 
	// 	  echo json_encode($info);
	// 	}
	//   }
	//========================= userperm ===========================//



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
