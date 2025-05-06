<?php


class Setting extends CI_Controller
{

	public function index()
	{
		$data = $this->login_details();
		$data['pagename'] = 'My Profile';
		$data['user_dtl'] = $this->Login_model->get_user_profile_details();
		// echo "<pre>";print_r($data['user_dtl']);die();
		$this->load->view('profile', $data);
	}


	public function update_profile()
	{
		if ($this->ajax_login() === false) {
			return;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$_POST["kh_userid"] = $this->session->userdata('user_id');
			if ($data = $this->Setting_model->update_profile()) {
				$info = array(
					'status' => 'success',
					'message' => 'Admin Profile has been Updated successfully!'
				);
			} else {
				$info = array(
					'status' => 'fail',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}



	//---------------------- profile update----------------------\\


	public function app_setting()
	{
		// print_r('hii'); die();
		$data = $this->login_details();
		$data['pagename'] = 'Application Setting';
		$data['app_details'] = $this->Setting_model->get_application_settings();

		$this->load->view('app_setting', $data);
	}


	public function update_application_settings()
	{
		if ($this->ajax_login() === false) {
			return;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Setting_model->update_application_settings()) {
				$info = array(
					'status' => 'success',
					'message' => 'Application Settings has been update successfully!'
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

	//---------------clockin - clockout-------------------//
	public function clock_in()
	{
		$empId = $this->input->post('emp_id');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		if (!$empId) {
			echo json_encode(['status' => 'error', 'message' => 'Employee ID not provided.']);
			return;
		}
		$status = $this->Setting_model->get_last_status($empId);
		if ($status && $status->m_status == '0') {
			echo json_encode(['status' => 'error', 'message' => 'Already clocked in.']);
			return;
		}
		if ($status && $status->m_status == '1') {
			echo json_encode(['status' => 'error', 'message' => 'You have already clocked out today. You cannot clock in again today.']);
			return;
		}
		$data = [
			'm_emp_id' => $empId,
			'm_date' => date('Y-m-d'),
			'm_time_in' => date('H:i:s'),
			'm_lat_in' => $latitude ?: '',
			'm_long_in' => $longitude ?: '',
			'm_status' => '0',
			'm_updated_by' => date('Y-m-d H:i:s')
		];
		if ($this->Setting_model->insert_attendance($data)) {
			echo json_encode(['status' => 'success', 'message' => 'Clocked In successfully!']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to Clock In.']);
		}
	}


	public function clock_out()
	{
		$empId = $this->input->post('emp_id');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		if (!$empId) {
			echo json_encode(['status' => 'error', 'message' => 'Employee ID not provided.']);
			return;
		}

		$status = $this->Setting_model->get_last_status($empId);
		if (!$status || $status->m_status != '0') {
			echo json_encode(['status' => 'error', 'message' => 'Not clocked in or already clocked out.']);
			return;
		}
		$data = [
			'm_time_out' => date('H:i:s'),
			'm_lat_out' => $latitude ?: '',
			'm_long_out' => $longitude ?: '',
			'm_status' => '1',
			'm_updated_on' => date('Y-m-d H:i:s')
		];
		if ($this->Setting_model->update_attendance($empId, $data)) {
			echo json_encode(['status' => 'success', 'message' => 'Clocked Out successfully!']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to Clock Out.']);
		}
	}

	public function check_status()
	{
		$empId = $this->session->userdata('user_id');
		if (!$empId) {
			echo json_encode(['status' => 'error', 'message' => 'Employee not logged in.']);
			return;
		}
		$status = $this->Setting_model->get_last_status($empId);
		if ($status) {
			echo json_encode(['status' => $status->m_status]);
		} else {
			echo json_encode(['status' => '1']);
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
