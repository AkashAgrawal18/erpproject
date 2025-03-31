<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class General extends CI_Controller
{


	//--------------Entities---------------------//
	public function entity_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Entities List";
		$data['all_value'] = $this->General_model->get_all_entity();
		$this->load->view('General/entity_list', $data);
	}
	public function entity_add()
	{
		$data = $this->login_details();
		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Entity Detail";
		} else {
			$data['pagename'] = "Add New Entity";
		}
		$data['emp_value'] = $this->Hr_model->get_emp_list();
		$data['edit_value'] = $this->General_model->get_edit_entity($data['id']);
		$this->load->view('General/entity_add', $data);
	}

	public function insert_entity()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->General_model->insert_entity()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Entity has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Entity Updated Successfully'
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

	public function delete_entity()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->General_model->delete_entity()) {

				$info = array(
					'status' => 'success',
					'message' => 'Entity has been Deleted successfully!'
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

	//--------------entities---------------------//

	//--------------store---------------------//
	public function store_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Stores List";
		$data['pgtype'] = 1;
		$data['all_value'] = $this->General_model->get_all_store($data['pgtype']);
		$this->load->view('General/store_list', $data);
	}

	public function warehouse_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Warehouse List";
		$data['pgtype'] = 2;
		$data['all_value'] = $this->General_model->get_all_store($data['pgtype']);
		$this->load->view('General/store_list', $data);
	}

	public function store_add()
	{
		$data = $this->login_details();
		$data['id'] = $this->input->get('id');
		$data['type'] = $this->input->get('type');
		if (!empty($data['id'])) {
			$data['pagename'] = $data['type'] == 1 ? "Edit Store Detail" : "Edit Warehouse Detail";
		} else {
			$data['pagename'] = $data['type'] == 1 ? "Add New Store": "Add New Warehouse";
		}
		$data['get_active_state'] = $this->Master_model->get_active_state();
		$data['get_active_city'] = $this->Master_model->get_active_city();
		$data['edit_value'] = $this->General_model->get_edit_store($data['id']);
		// print_r($data['get_active_city']); die();
		$this->load->view('General/store_add', $data);
	}

	public function insert_store()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->General_model->insert_store()) {

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

	public function delete_store()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->General_model->delete_store()) {

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

	//-----------------store------------------------------//

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
