<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Leads extends CI_Controller
{


	//-------------------------- status ------------------------//
	public function status_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Status List";
		$data['pgtype'] = 1;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Lead_model->get_status_list($data['pgtype']);
		$data['edit_value'] = $this->Lead_model->get_status_dtl($data['id']);

		$this->load->view('Leads/status_list', $data);
	}

	public function source_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Source List";
		$data['pgtype'] = 2;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Lead_model->get_status_list($data['pgtype']);
		$data['edit_value'] = $this->Lead_model->get_status_dtl($data['id']);

		$this->load->view('Leads/status_list', $data);
	}

	public function insert_status()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$status_type = $this->input->post('m_status_type');
			switch ($status_type) {
				case 1:
					$headname = "Status";
					break;
				case 2:
					$headname = "Source";
					break;
				default:
					$headname = "Data";
					break;
			}

			if ($data = $this->Lead_model->insert_status()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => $headname . ' has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => $headname . ' Updated Successfully'
					);
				} else if ($data == 3) {
					$info = array(
						'status' => 'error',
						'message' => $headname . ' with same name already exist'
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

	public function delete_status()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Lead_model->delete_status()) {
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

	//-------------- Status ---------------------//
	//-------------- Leads---------------------//
	public function lead_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Leads List";
		$data['emp_value'] = $this->Hr_model->get_Active_emp();
		$data['status_value'] = $this->Lead_model->get_status_list(1, 1);
		$data['pro_value'] = $this->Product_model->get_all_product(1);
		$data['all_value'] = $this->Lead_model->get_all_lead();
		$this->load->view('Leads/lead_list', $data);
	}
	public function lead_add()
	{
		$data = $this->login_details();

		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit lead Detail";
		} else {
			$data['pagename'] = "Add New lead";
		}
		$data['state_list'] = $this->Master_model->get_active_state();
		$data['city_list'] = $this->Master_model->get_active_city();
		$data['area_list'] = $this->Master_model->get_active_area(1);
		$data['subarea_list'] = $this->Master_model->get_active_area(2);
		$data['emp_value'] = $this->Hr_model->get_Active_emp();
		$data['status_value'] = $this->Lead_model->get_status_list(1, 1);
		$data['source_value'] = $this->Lead_model->get_status_list(2, 1);
		$data['edit_value'] = $this->Lead_model->get_edit_lead($data['id']);
		$this->load->view('Leads/add_lead', $data);
	}

	public function insert_lead()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Lead_model->insert_lead()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Leads has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Data Details Updated Successfully'
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

	public function delete_lead()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Lead_model->delete_lead()) {

				$info = array(
					'status' => 'success',
					'message' => 'Leads has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	//-----------------leads------------------------------//
	//----------------- Follow up ------------------------------//
	public function add_followup()
	{
		$data = $this->login_details();

		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit followup Detail";
		} else {
			$data['pagename'] = "Add followup";
		}
		$data['emp_value'] = $this->Hr_model->get_Active_emp();
		$data['status_value'] = $this->Lead_model->get_status_list(1, 1);
		$data['pro_value'] = $this->Product_model->get_all_product(1);
		$data['edit_value'] = $this->Lead_model->get_edit_lead($data['id']);
		$this->load->view('Leads/add_followup', $data);
	}

	public function get_lead_details()
	{
		$id = $this->input->post('leadid');
		$data = $this->Lead_model->get_lead_details($id);
		echo json_encode($data);
	}

	public function insert_followup()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Lead_model->insert_followup()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Followup has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Followup Detail Updated Successfully'
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

	public function delete_followup()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Lead_model->delete_followup()) {

				$info = array(
					'status' => 'success',
					'message' => 'Followup has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	//----------------- follow up ------------------------------//

	//-------------------------- trans lead ------------------------//
	public function leadtrans_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Lead Transfer List";
		$data['all_value'] = $this->Lead_model->get_leadtrans_list();
		$this->load->view('Leads/transfer_list', $data);
	}

	public function insert_leadtrans()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if ($data = $this->Lead_model->insert_leadtrans()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Lead has been Assigned successfully!'
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

	public function delete_leadtrans()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Lead_model->delete_leadtrans()) {
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

	//-------------- trans lead ---------------------//

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
