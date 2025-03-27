<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Billing extends CI_Controller
{


	//--------------Entities---------------------//
	public function entity_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Entities List";
		$data['all_value'] = $this->Billing_model->get_all_entity();
		$this->load->view('entity_list', $data);
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
		$data['emp_value'] = $this->Employee_model->get_emp_list();
		$data['edit_value'] = $this->Billing_model->get_edit_entity($data['id']);
		$this->load->view('entity_add', $data);
	}

	public function insert_entity()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Billing_model->insert_entity()) {

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
			if ($data = $this->Billing_model->delete_entity()) {

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

//--------------------stock transfer-------------------//

public function stock_transfer_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Stock Transfer List";
		$data['all_value'] = $this->Billing_model->get_all_entity();
		$this->load->view('stock_transfer_list', $data);
	}
	public function stock_transfe_add()
	{
		$data = $this->login_details(); 
		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Stock Transfer Detail";
		} else {
			$data['pagename'] = "Add New Stock Transfer";
		}
		$data['batch_value'] = $this->Billing_model->get_batch_list();
		$data['entity_value'] = $this->Billing_model->get_all_entity();
		$data['warehouse_value'] = $this->Billing_model->get_all_warehouse();
		$data['edit_value'] = $this->Billing_model->get_all_stocktransf($data['id']);
		$this->load->view('stock_transfe_add', $data);
	} 

	public function insert_stock_transfe()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Billing_model->insert_stock_transfe()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Stock Transfer has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Stock Transfer Updated Successfully'
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

	public function delete_stock_transfe()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Billing_model->delete_stock_transfe()) {

				$info = array(
					'status' => 'success',
					'message' => 'Stock Transfer has been Deleted successfully!'
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

//--------------------stock transfer-------------------//

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
