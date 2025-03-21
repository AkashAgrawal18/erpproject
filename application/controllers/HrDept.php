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
	public function shift_roster_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Shift Roster List";
		$data['pgtype'] = 4;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_dept($data['pgtype']);
		$data['edit_value'] = $this->Hr_model->get_dept_dtl($data['id']);
		$this->load->view('dept_list', $data);
	}
	public function roll_list(){
		$data = $this->login_details();
		$data['pagename'] = "Roll List";
		$data['pgtype'] = 5;
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
					$headname = "Rolls";
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
		$data['all_value'] = $this->Holiday_model->get_all_holiday();
		$data['edit_value'] = $this->Holiday_model->get_edit_holiday($data['id']);
		$this->load->view('holiday_list', $data);
	}


	public function insert_holiday()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Holiday_model->insert_holiday()) {

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
			if ($data = $this->Holiday_model->delete_holiday()) {

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



	//--------------store---------------------//
	public function store_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Stores List";
		$data['all_value'] = $this->Store_model->get_all_store();
		$this->load->view('store_list', $data);
	}
	public function store_add()
	{
		$data = $this->login_details(); 
		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Store Detail";
		} else {
			$data['pagename'] = "Add New Store";
		}
		$data['get_active_state'] = $this->Master_model->get_active_state();
		$data['get_active_city'] = $this->Master_model->get_active_city();
		$data['edit_value'] = $this->Store_model->get_edit_store($data['id']);
		// print_r($data['get_active_city']); die();
		$this->load->view('store_add', $data);
	}

	public function insert_store()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Store_model->insert_store()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Store has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Store Updated Successfully'
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
			if ($data = $this->Store_model->delete_store()) {

				$info = array(
					'status' => 'success',
					'message' => 'Store has been Deleted successfully!'
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

	
	//--------------Leaves---------------------//
	public function leave_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Leaves List";
		$data['all_value'] = $this->Leave_model->get_all_leave();
		$this->load->view('leave_list', $data);
	}
	public function leave_add()
	{
		$data = $this->login_details();
		$data['pagename'] = "Leave List";
		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Leave Detail";
		} else {
			$data['pagename'] = "Add New Leave";
		}
		$data['emp_value'] = $this->Employee_model->get_emp_list();
		$data['edit_value'] = $this->Leave_model->get_edit_leave($data['id']);
		$this->load->view('leave_add', $data);
	}

	public function insert_leave()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Leave_model->insert_leave()) {

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
			if ($data = $this->Leave_model->delete_leave()) {

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
		$this->load->view('employe_list', $data);
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
		$this->load->view('add_employe', $data);
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
		$this->load->view('edit_employee', $data);
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
