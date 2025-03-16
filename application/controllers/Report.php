<?php
class Report extends CI_Controller
{
	//    --------------------emp salary----------------------------------   
	public function emp_add_salary()
	{
		$data = $this->login_details();
		$data['pagename'] = 'Add Salary';

		$data['from_month'] = $this->input->post('from_month') ?: date('Y-m');
		$data['emp_att'] = $this->Report_model->get_emp_add_salary($data['from_month']);
		// echo "<pre>";print_r($data['emp_att']);die();
		$this->load->view('emp_add_salary', $data);
	}
	public function insert_salary()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$salinst_empid = $this->input->post('m_salinst_empid');
			$salinst_salary = $this->input->post('m_salinst_salary');
			$salinst_totaldays = $this->input->post('m_salinst_totaldays');
			$salinst_prdays = $this->input->post('m_salinst_prdays');
			$salinst_lvdays = $this->input->post('m_salinst_lvdays');
			$salinst_absent = $this->input->post('m_salinst_absent');
			$salinst_payable = $this->input->post('m_salinst_payable');

			if (empty($salinst_empid)) {
				echo json_encode(['status' => 'error', 'message' => 'No modified data found!']);
				return;
			}
			$success = true;

			foreach ($salinst_empid as $key => $emp_id) {
				// Check if record already exists
				$existing_salary = $this->Report_model->get_salary_by_emp_id($emp_id,$this->input->post('m_salinst_date'));

				$data = [
					'm_salinst_empid' => $emp_id,
					'm_salinst_salary' => $salinst_salary[$key],
					'm_salinst_totaldays' => $salinst_totaldays[$key],
					'm_salinst_prdays' => $salinst_prdays[$key],
					'm_salinst_absent' => $salinst_lvdays[$key],
					'm_salinst_lvdays' => $salinst_absent[$key],
					'm_salinst_payable' => $salinst_payable[$key],
					'm_salinst_date' => date('Y-m-d',strtotime($this->input->post('m_salinst_date'))),
					'm_salinst_status' => 1,
					'm_salinst_addedon' => date('Y-m-d'),
				];

				if ($existing_salary) {
					// If employee salary exists, update it
					$update_status = $this->Report_model->update_salary($emp_id, $data);
					if (!$update_status) {
						$success = false;
					}
				} else {
					// If employee salary does not exist, insert new record
					$insert_status = $this->Report_model->insert_salary($data);
					if (!$insert_status) {
						$success = false;
					}
				}
			}

			if ($success) {
				echo json_encode(['status' => 'success', 'message' => 'Salary data processed successfully!']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to process some salary data.']);
			}
		}
	}

	public function emp_salary_list()
	{
		$data = $this->login_details();
		$data['pagename'] = 'Employee Salary';
		$data['from_month'] = $this->input->post('from_month') ?: date('Y-m');
		$data['emp_id'] = $this->input->post('emp_id') ?: '';

		$data['emp_list'] = $this->Employee_model->get_Active_emp();
		$data['emp_att'] = $this->Report_model->get_emp_salary($data['emp_id'], $data['from_month']);
		// echo "<pre>";print_r($data['emp_att']);die();
		$this->load->view('emp_salary_list', $data);
	}

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
