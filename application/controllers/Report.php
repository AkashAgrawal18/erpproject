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
	/* ======================================= attendence report ======================================== */

	/* ======================================= Stock report ======================================== */

	public function store_wise_stock()
	{
		$data = $this->login_details();
		$data['pagename'] = 'Store Stock Report';
		$data['user_store'] = $this->session->userdata('user_store'); 
		$data['to_date'] = $this->input->post('to_date') ?: date('Y-m-d');
		$data['m_cate'] = $this->input->post('m_cate');
		$data['m_subcate'] = $this->input->post('m_subcate');
		$data['m_store'] = $this->input->post('m_store') ?:$data['user_store'];
		$data['cate_value'] = $this->Product_model->get_cate_list(1);
		$data['subcate_value'] = $this->Product_model->get_sucat_list(1,$data['m_cate']);
		$data['store_value'] = $this->General_model->get_all_store(null,1);
		$data['all_value'] = $this->Report_model->store_wise_stock($data['to_date'],$data['m_store'],$data['m_cate'],$data['m_subcate']);
		$this->load->view('Reports/stock_list', $data);
	}

	/* ======================================= Stock report ======================================== */

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
