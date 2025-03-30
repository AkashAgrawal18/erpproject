<?php
class Report extends CI_Controller
{
	

	public function emp_attd_report()
	{
		$data = $this->login_details();
		$data['pagename'] = 'EMP Attendance Report';
		if (!empty($this->input->post('from_month'))) {
			$data['from_month'] = date('m-Y', strtotime($this->input->post('from_month')));
		} else {
			$data['from_month'] = date('m-Y');
		}
		$data['emp_att_del'] = $this->Report_model->get_emp_attd($data['from_month']);
		$this->load->view('emp_attd_report', $data);
	}

	public function get_attd_detail()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$data = $this->Report_model->get_empatt_detail($this->input->post('attd_id'), $this->input->post('type'));

			if ($data) {
				echo json_encode(['status' => 'success', 'data' => $data]);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to process Attendance detail .']);
			}
		}
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

	protected function ajax_login($nav_id = '')
	{
		$is_user_in = $this->session->userdata('is_user_in');
		if (isset($is_user_in) || $is_user_in == true) {
			return true;
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'You are not Logged in Now!! Please login again.'));
			return false;
		}
	}
	//=====================/Login Validation======================//


}
