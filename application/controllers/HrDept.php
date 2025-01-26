<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class HrDept extends CI_Controller
{

//-------------------------- dept ------------------------//
	public function department_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Department List";
		$data['pgtype'] = 1;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_dept($data['pgtype']);
		$data['edit_value'] = $this->Hr_model->get_dept_dtl($data['id']);

		$this->load->view('dept_list', $data);
	}

	public function designation_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Designation List";
		$data['pgtype'] = 2;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_dept($data['pgtype']);
		$data['edit_value'] = $this->Hr_model->get_dept_dtl($data['id']);

		$this->load->view('dept_list', $data);
	}
	public function salaryBreakup_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Salary Breakup List";
		$data['pgtype'] = 3;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_dept($data['pgtype']);
		$data['edit_value'] = $this->Hr_model->get_dept_dtl($data['id']);

		$this->load->view('dept_list', $data);
	}

	public function insert_dept()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$dept_type = $this->input->post('m_dept_type');
			switch ($dept_type) {
				case 1: $headname = "Department";
					break;
				case 2: $headname = "Desgination";
					break;
				case 3: $headname = "Breakup";
					break;
				
				default:
				$headname = "Data";
					break;
			}

			if ($data = $this->Hr_model->insert_dept()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => $headname.' has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => $headname.' Updated Successfully'
					);
				} else if ($data == 3) {
					$info = array(
						'status' => 'error',
						'message' => $headname.' with same name already exist'
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

	public function delete_dept()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_dept()) {
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
	//-------------------------- dept ------------------------//

	 
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
