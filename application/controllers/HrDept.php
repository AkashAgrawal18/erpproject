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

		$this->load->view('Hr/dept_list', $data);
	}

	public function designation_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Designation List";
		$data['pgtype'] = 2;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_dept($data['pgtype']);
		$data['edit_value'] = $this->Hr_model->get_dept_dtl($data['id']);

		$this->load->view('Hr/dept_list', $data);
	}

	public function salaryBreakup_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Salary Breakup List";
		$data['pgtype'] = 3;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_dept($data['pgtype']);
		$data['edit_value'] = $this->Hr_model->get_dept_dtl($data['id']);

		$this->load->view('Hr/dept_list', $data);
	}
	public function shift_roster_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Shift Roster List";
		$data['pgtype'] = 4;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_dept($data['pgtype']);
		$data['edit_value'] = $this->Hr_model->get_dept_dtl($data['id']);
		$this->load->view('Hr/dept_list', $data);
	}
	public function role_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Roles List";
		$data['pgtype'] = 5;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_dept($data['pgtype']);
		$data['edit_value'] = $this->Hr_model->get_dept_dtl($data['id']);
		$this->load->view('Hr/dept_list', $data);
	}

	public function insert_dept()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$dept_type = $this->input->post('m_dept_type');
			switch ($dept_type) {
				case 1:
					$headname = "Department";
					break;
				case 2:
					$headname = "Desgination";
					break;
				case 3:
					$headname = "Breakup";
					break;
				case 4:
					$headname = "Shift Roster";
					break;
				case 5:
					$headname = "Roles";
					break;

				default:
					$headname = "Data";
					break;
			}

			if ($data = $this->Hr_model->insert_dept()) {

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

	//--------------holiday---------------------//
	public function holiday_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Holidays List";
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_all_holiday();
		$data['edit_value'] = $this->Hr_model->get_edit_holiday($data['id']);
		$this->load->view('Hr/holiday_list', $data);
	}


	public function insert_holiday()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_holiday()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Holiday has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Holiday Updated Successfully'
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

	public function delete_holiday()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_holiday()) {

				$info = array(
					'status' => 'success',
					'message' => 'Holiday has been Deleted successfully!'
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

	//--------------holiday---------------------//

	//--------------Leaves---------------------//
	public function leave_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Leaves List";
		$data['all_value'] = $this->Hr_model->get_all_leave();
		$this->load->view('Hr/leave_list', $data);
	}
	public function leave_add()
	{
		$data = $this->login_details();

		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Leave Detail";
		} else {
			$data['pagename'] = "Add New Leave";
		}
		$data['emp_value'] = $this->Employee_model->get_emp_list();
		$data['edit_value'] = $this->Hr_model->get_edit_leave($data['id']);
		$this->load->view('Hr/leave_add', $data);
	}

	public function insert_leave()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_leave()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Leaves has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Leaves Updated Successfully'
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

	public function delete_leave()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_leave()) {

				$info = array(
					'status' => 'success',
					'message' => 'Leaves has been Deleted successfully!'
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

	//-----------------leaves------------------------------//


	//-----------------employee------------------------------------//
	public function employe_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Employee List";
		$data['from_date'] = '';
		$data['to_date'] = '';
		$data['from_date'] = $this->input->post('from_date');
		$data['to_date'] = $this->input->post('to_date');

		if (!empty($this->input->post('Excel'))) {
			$this->excelForemp($data['from_date'], $data['to_date']);
		}

		$data['emp_value'] = $this->Employee_model->get_emp_list($data['from_date'], $data['to_date']);
		$this->load->view('Hr/employe_list', $data);
	}

	public function add_employe()
	{
		$data = $this->login_details();
		$data['pagename'] = "Add New Employee";
		$data['store_list'] = $this->Hr_model->get_active_store();
		$data['dept_value'] = $this->Hr_model->get_active_dept();
		$data['shift_value'] = $this->Hr_model->get_active_shiftroster();
		$data['design_value'] = $this->Hr_model->get_active_design();
		$data['salarybk_value'] = $this->Hr_model->get_active_salarybk();
		$data['roll_value'] = $this->Hr_model->get_active_roll();
		//   print_r($data['slbk_value']); die();
		$this->load->view('Hr/add_employe', $data);
	}
	public function edit_employee()
	{
		$data = $this->login_details();
		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Employee Details";
		} else {
			$data['pagename'] = "Add New Employee";
		}
		$data['store_list'] = $this->Hr_model->get_active_store();
		$data['dept_value'] = $this->Hr_model->get_active_dept();
		$data['design_value'] = $this->Hr_model->get_active_design();
		$data['shift_value'] = $this->Hr_model->get_active_shiftroster();
		$data['salarybk_value'] = $this->Hr_model->get_active_salarybk();
		// $data['hq_value'] = $this->Hr_model->get_active_hq();
		// $data['emp_list'] = $this->Hr_model->get_Active_emp();
		$data['edit_value'] = $this->Employee_model->get_emp_dtl($data['id']);
		$data['slbk_value'] = $this->Employee_model->get_salarybk($data['id']);
		$data['roll_value'] = $this->Hr_model->get_active_roll();
		//   print_r($data['slbk_value']); die();
		$this->load->view('Hr/edit_employee', $data);
	}

	public function insert_emp()
	{
		if ($this->ajax_login() === false) {
			return;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($this->Employee_model->insert_emp()) {
				$info = array(
					'status' => 'success',
					'message' => 'Employee has been added successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem occurred! Please try again'
				);
			}

			echo json_encode($info);
		}
	}

	public function update_emp()
	{
		if ($this->ajax_login() === false) {
			return;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($this->Employee_model->update_emp()) {
				$info = array(
					'status' => 'success',
					'message' => 'Employee data updated successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem occurred! Please try again'
				);
			}

			echo json_encode($info);
		}
	}
	public function delete_slarybk()
	{
		$data = $this->login_details();
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Employee_model->delete_slarybk()) {
				$info = array(
					'status' => 'success',
					'message' => 'Salary has been Deleted successfully!'
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


	public function check_emp_history()
	{

		$id = $this->input->post('empid');
		$res = $this->Employee_model->check_emp_history($id);
		if (!empty($res)) {
			$curdate = date('Y-m-d');
			$date1 = date_create($curdate);
			$date2 = date_create($res[0]->m_advance_date);
			$diff = date_diff($date1, $date2);

			$data['status'] = $diff->format("%a") >= 10 ? 'success' : 'error';
			$data['message'] = 'Advance Not Allowed ! There should 10 days difference';
		} else {
			$data['status'] = 'success';
			$data['message'] = 'Allowed';
		}
		$data['advc_his'] = $res;
		$data['emp_dtl'] = $this->Employee_model->get_emp_dtl($id);
		echo json_encode($data);
	}

	public function get_emp_dtl()
	{

		$id = $this->input->post('empid');
		$data = $this->Employee_model->get_emp_dtl($id);
		echo json_encode($data);
	}

	public function delete_emp()
	{
		if ($this->ajax_login() === false) {
			return;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($this->Employee_model->delete_emp()) {
				$info = array(
					'status' => 'success',
					'message' => 'Data has been Deleted Successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some Problem Occured'
				);
			}
			echo json_encode($info);
		}
	}

	public function excelForemp($from_date, $to_date)
	{

		$allreportdata  = $this->Employee_model->get_emp_list($from_date, $to_date);

		$count = 0;
		$data = array();
		foreach ($allreportdata as $key) {
			$count++;
			$subArray = array();

			$subArray[] = $count;
			$subArray[] = $key->m_emp_code;
			$subArray[] = $key->m_emp_id;
			$subArray[] = $key->m_emp_name;
			$subArray[] = date('d-m-Y h:i', strtotime($key->m_emp_doj));
			$subArray[] = $key->m_emp_gross_salary;
			$subArray[] = $key->m_emp_epfno;
			$subArray[] = $key->m_emp_esicno;
			$subArray[] = $key->m_emp_panno;
			$subArray[] = $key->m_emp_mobile;
			$subArray[] = $key->m_emp_accno;
			$subArray[] = $key->m_emp_company;
			$subArray[] = $key->m_dept_name;
			$subArray[] = $key->m_design_name;

			$data[] = $subArray;
		}

		//  echo "<pre>" ;   print_r($data) ; die ;
		$fileName = 'emp_list' . date('Y_m_d_h_i_s') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$fileName");
		header("Content-Type: application/csv; ");
		$report = $data;
		$file = fopen('php://output', 'w');

		$header = array(
			"Sno.",
			"EmpCode",
			"Login ID",
			"EmpName",
			"DOJ",
			"GSalary",
			"EPF No",
			"ESIC No",
			"Pan No",
			"Mobile No",
			"BankAccNo",
			"Company",
			"Dept",
			"Desig",


		);
		fputcsv($file, $header);
		foreach ($report as $line) {
			fputcsv($file, $line);
		}
		fclose($file);
		// echo json_encode(array(
		//   'status' => 'success',
		//   'message' => 'Data Export successfully!'
		// ));
		exit;
	}

	//    --------------------emp salary----------------------------------   
	public function emp_add_salary()
	{
		$data = $this->login_details();
		$data['pagename'] = 'Add Salary';

		$data['from_month'] = $this->input->post('from_month') ?: date('Y-m');
		$data['emp_att'] = $this->Report_model->get_emp_add_salary($data['from_month']);
		// echo "<pre>";print_r($data['emp_att']);die();
		$this->load->view('Hr/emp_add_salary', $data);
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
				$existing_salary = $this->Report_model->get_salary_by_emp_id($emp_id, $this->input->post('m_salinst_date'));

				$data = [
					'm_salinst_empid' => $emp_id,
					'm_salinst_salary' => $salinst_salary[$key],
					'm_salinst_totaldays' => $salinst_totaldays[$key],
					'm_salinst_prdays' => $salinst_prdays[$key],
					'm_salinst_absent' => $salinst_lvdays[$key],
					'm_salinst_lvdays' => $salinst_absent[$key],
					'm_salinst_payable' => $salinst_payable[$key],
					'm_salinst_date' => date('Y-m-d', strtotime($this->input->post('m_salinst_date'))),
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
		$this->load->view('Hr/emp_salary_list', $data);
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
