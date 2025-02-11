<?php


class Report extends CI_Controller
{
	//    --------------------emp salary----------------------------------   
	public function emp_add_salary(){
		$data = $this->login_details();
		$data['pagename'] = 'Add Salary';
		if (!empty($this->input->post('from_month'))) {
			$data['from_month'] = $this->input->post('from_month');
		} else {
			$data['from_month'] = date('m-Y');
		}
		$data['emp_att'] = $this->Report_model->get_emp_add_salary($data['from_month']);
		$data['emp_salary'] = $this->Report_model->get_empslaary($data['from_month']);
		// echo "<pre>";print_r($data['emp_salary']);die();
		$this->load->view('emp_add_salary', $data);
	}
	public function insert_salary() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$salaries = $this->input->post('salaries');
	
			if (empty($salaries)) {
				echo json_encode(['status' => 'error', 'message' => 'No modified data found!']);
				return;
			}
	
			$this->load->model('Report_model'); // Ensure model is loaded
			$success = true;
	
			foreach ($salaries as $salary) {
				$emp_id = $salary['emp_id'];
	
				// Check if record already exists
				$existing_salary = $this->Report_model->get_salary_by_emp_id($emp_id);
	
				$data = [
					'm_salinst_empid' => $emp_id,
					'm_salinst_salary' => $salary['salary'],
					'm_salinst_totaldays' => $salary['total_days'],
					'm_salinst_prdays' => $salary['present'],
					'm_salinst_absent' => $salary['absent'],
					'm_salinst_lvdays' => $salary['leave'],
					'm_salinst_payable' => $salary['payable'],
					'm_salinst_date' => date('Y-m-d'),
					'm_salinst_status' => 1,
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
		if (!empty($this->input->post('from_month'))) {
			$data['from_month'] = $this->input->post('from_month');
		} else {
			$data['from_month'] = date('m-Y');
		}
		$data['emp_att'] = $this->Report_model->get_emp_salary($data['from_month']);
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
		// echo "<pre>"; print_r($data['emp_att_del']);die();
		$this->load->view('emp_attd_report', $data);
	}

	public function emp_att_detail()
	{
		$data = $this->login_details();
		$data['pagename'] = 'Employee Detail';
		$id = $this->input->get('id');
		$data['id'] = $id;
		if (!empty($this->input->post('from_month'))) {
			$data['from_month'] = date('m-Y', strtotime($this->input->post('from_month')));
		} else {
			$data['from_month'] = date('m-Y');
		}
		$data['emp_att_del'] = $this->Report_model->get_empatt_detail($data['id'], $data['from_month']);
		// echo "<pre>"; print_r($data['emp_att_del']);die();
		$this->load->view('emp_attd_detail_copy', $data);
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
