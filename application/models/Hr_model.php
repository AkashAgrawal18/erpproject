<?php date_default_timezone_set('Asia/Kolkata');
class Hr_model extends CI_model
{

	//========================== dept  =============================//

	public function get_dept($type, $status = '')
	{
		$this->db->select('*');
		if (!empty($status)) {
			$this->db->where('m_dept_status', $status);
		}
		$this->db->order_by('m_dept_id', 'desc');
		$res = $this->db->where('m_dept_type', $type)->get('master_department_tbl')->result();
		return $res;
	}
	public function get_dept_dtl($edid)
	{
		$this->db->select('*');
		$this->db->where('m_dept_id', $edid);
		$res = $this->db->get('master_department_tbl')->row();
		return $res;
	}
	public function insert_dept()
	{
		$id = $this->input->post('m_dept_id');
		$dept_name = $this->input->post('m_dept_name');
		$starttime = $this->input->post('m_start_time') ?: 0;
		$endtime = $this->input->post('m_end_time') ?: 0;
		$dept_type = $this->input->post('m_dept_type');
		$check = $this->db->where('m_dept_name', $dept_name)->where('m_dept_type', $dept_type)->where('m_dept_id !=', $id)->get('master_department_tbl')->num_rows();
		if ($check > 0) {
			return 3;
		}
		$s_data = array(
			"m_dept_name" => $dept_name,
			"m_dept_code" => $this->input->post('m_dept_code') ?: '',
			"m_start_time" => $starttime,
			"m_end_time" => $endtime,
			"m_dept_status" => $this->input->post('m_dept_status'),
			"m_dept_type " => $dept_type,
			"m_dept_added_on" => date('Y-m-d H:i'),
		);
		if (!empty($id)) {
			$this->db->where('m_dept_id', $id)->update('master_department_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_department_tbl', $s_data);
			return 1;
		}
	}


	public function delete_dept()
	{
		$this->db->where('m_dept_id', $this->input->post('delete_id'));
		return $this->db->delete('master_department_tbl');
	}

	public function get_active_dept()
	{
		$this->db->select('dept.m_dept_name,dept.m_dept_id');
		$this->db->where('m_dept_type', 1);
		$this->db->where('m_dept_status', 1);
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl dept')->result();
		return $res;
	}

	public function get_active_salarybk()
	{
		$this->db->select('dept.m_dept_name,dept.m_dept_id');
		$this->db->where('m_dept_type', 3);
		$this->db->where('m_dept_status', 1);
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl dept')->result();
		return $res;
	}

	public function get_active_design()
	{
		$this->db->select('dept.m_dept_name,dept.m_dept_id');
		$this->db->where('m_dept_type', 2);
		$this->db->where('m_dept_status', 1);
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl dept')->result();
		return $res;
	}

	public function get_active_shiftroster()
	{
		$this->db->select('dept.m_dept_name,dept.m_dept_id');
		$this->db->where('m_dept_type', 4);
		$this->db->where('m_dept_status', 1);
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl dept')->result();
		return $res;
	}
	public function get_active_roll()
	{
		$this->db->select('dept.m_dept_name,dept.m_dept_id');
		$this->db->where('m_dept_type', 5);
		$this->db->where('m_dept_status', 1);
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl dept')->result();
		return $res;
	}
	//=========================================== dept ===============================================//


	//========================== holidaye  =============================//

	public function get_all_holiday()
	{
		$this->db->select('*');
		$this->db->order_by('m_hol_id', 'desc');
		$res = $this->db->get('master_holiday_tbl')->result();
		return $res;
	}
	public function get_edit_holiday($edid)
	{
		$this->db->select('*');
		$this->db->where('m_hol_id', $edid);
		$res = $this->db->get('master_holiday_tbl')->row();
		return $res;
	}

	public function insert_holiday()
	{
		$s_data = array(
			"m_hol_date" => $this->input->post('m_hol_date'),
			"m_hol_name" => $this->input->post('m_hol_name'),
			"m_hol_status" => $this->input->post('m_hol_status'),
			"m_hol_addedon" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_hol_id');
		if (!empty($id)) {
			$this->db->where('m_hol_id', $id)->update('master_holiday_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_holiday_tbl', $s_data);
			return 1;
		}
	}

	public function delete_holiday()
	{
		$this->db->where('m_hol_id', $this->input->post('delete_id'));
		return $this->db->delete('master_holiday_tbl');
	}
	//========================== holidaye  =============================//

	//========================== leave  =============================//

	public function get_all_leave()
	{
		$this->db->select('*');
		$this->db->order_by('m_leav_id', 'desc');
		$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = master_leaves_tbl.m_leav_empname', 'left');
		$res = $this->db->get('master_leaves_tbl')->result();
		return $res;
	}
	public function get_edit_leave($edid)
	{
		$this->db->select('*');
		$this->db->where('m_leav_id', $edid);
		$res = $this->db->get('master_leaves_tbl')->row();
		return $res;
	}

	public function insert_leave()
	{
		if (!empty($_FILES['m_leav_imgfile']['name'])) {

			$name1 = $_FILES['m_leav_imgfile']['name'];
			$fileNameParts = explode(".", $name1); // explode file name to two part
			$fileExtension = end($fileNameParts); // give extension
			$fileExtension = strtolower($fileExtension);
			$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
			$config['file_name'] = $encripted_pic_name;
			$config['file_name'] = $_FILES['m_leav_imgfile']['name'];
			$config['upload_path'] = 'uploads/leavefile/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_leav_imgfile']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('m_leav_imgfile')) {
				$uploadData = $this->upload->data();
				if (!empty($update_data['m_leav_imgfile'])) {
					if (file_exists($config['m_leav_imgfile'] . $update_data['m_leav_imgfile'])) {
						unlink($config['upload_path'] . $update_data['m_leav_imgfile']); /* deleting Image */
					}
				}
				$m_leav_imgfile = $uploadData['file_name'];
			}
		} else {
			$m_leav_imgfile = $this->input->post('leaveimg');
		}
		$s_data = array(
			"m_leav_empname" => $this->input->post('m_leav_empname'),
			"m_leav_type" => $this->input->post('m_leav_type'),
			"m_leav_duration" => $this->input->post('m_leav_duration'),
			"m_leav_absence" => $this->input->post('m_leav_absence'),
			"m_leav_fromdate" => $this->input->post('m_leav_fromdate'),
			"m_leav_todate" => $this->input->post('m_leav_todate'),
			"m_leav_imgfile" => $m_leav_imgfile,
			"m_leav_status" => 1,
			"m_leav_date" => date('Y-m-d'),
			"m_leav_addedon" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_leav_id');
		if (!empty($id)) {
			$this->db->where('m_leav_id', $id)->update('master_leaves_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_leaves_tbl', $s_data);
			return 1;
		}
	}

	public function delete_leave()
	{
		$this->db->where('m_leav_id', $this->input->post('delete_id'));
		return $this->db->delete('master_leaves_tbl');
	}
	//========================== leave  =============================//


	//=======================================================employee=================================================//


	public function get_emp_list()
	{
		$this->db->where('m_login_type !=', 1);
		$this->db->join('master_department_tbl design', 'design.m_dept_id  = master_employee_tbl.m_emp_design', 'left');
		$res = $this->db->get('master_employee_tbl')->result();
		return $res;
	}

	public function get_Active_emp()
	{
		$res = $this->db->select('m_emp_name,m_emp_mobile,m_emp_code,m_emp_id')->where('m_login_type !=', 1)->where('m_emp_status', 1)->get('master_employee_tbl')->result();
		return $res;
	}

	public function get_emp_design_list($design)
	{
		$res = $this->db->select('m_emp_name,m_emp_mobile,m_emp_code,m_emp_id')->where_in('m_emp_design', $design)->where('m_emp_status', 1)->get('master_employee_tbl')->result();
		return $res;
	}

	// public function get_credit_emp()
	// {
	// 	$res = $this->db->where('m_emp_status', 1)->where('m_emp_type', 1)->get('master_employee_tbl')->result();
	// 	return $res;
	// }

	public function get_emp_dtl($id)
	{
		$this->db->select('*');
		$this->db->where('m_emp_id', $id);
		$res = $this->db->get('master_employee_tbl')->row();
		return $res;
	}

	public function get_emp_detail($id)
	{
		return $this->db->select('emp.*,depart.m_dept_name as depart_name,design.m_dept_name as design_name,shift.m_dept_name as shift_name,roll.m_dept_name as roll_name,store.m_str_name as store_name,reporting.m_emp_name as reported_to,(case when emp.m_emp_rest = 1 then "Monday" when emp.m_emp_rest = 2 then "Tuesday" when emp.m_emp_rest = 3 then "Wednesday" when emp.m_emp_rest = 4 then "Thursday" when emp.m_emp_rest = 5 then "Friday" when emp.m_emp_rest = 6 then "Saturday" when emp.m_emp_rest = 7 then "Sunday" Else "None" End) as rest_day')->join('master_department_tbl depart', 'depart.m_dept_id  = emp.m_emp_dept', 'left')->join('master_department_tbl design', 'design.m_dept_id  = emp.m_emp_design', 'left')->join('master_department_tbl shift', 'shift.m_dept_id  = emp.m_emp_dshift', 'left')->join('master_department_tbl roll', 'roll.m_dept_id  = emp.m_emp_roll', 'left')->join('master_store_tbl store', 'store.m_str_id  = emp.m_emp_store', 'left')->join('master_employee_tbl reporting', 'reporting.m_emp_id = emp.m_emp_reporting', 'left')->where('emp.m_emp_id', $id)->get('master_employee_tbl emp')->row();
		
	}

	public function get_salarybk($id)
	{
		$this->db->select('*');
		$this->db->where('m_empid', $id);
		$res = $this->db->get('master_emp_salary_breakup')->result();
		return $res;
	}

	public function insert_emp()
	{

		$emp_id = $this->input->post('m_emp_id');

		$is_esic_applicable = $this->input->post('is_esic_applicable') ? 1 : 0;
		$is_tds_applicable = $this->input->post('is_tds_applicable') ? 1 : 0;
		$is_epf_applicable = $this->input->post('is_epf_applicable') ? 1 : 0;

		$data = array(
			"m_emp_code" => 		$this->input->post('m_emp_code'),
			"m_emp_name" => 		$this->input->post('m_emp_name'),
			"m_emp_fhname" => 		$this->input->post('m_emp_fhname'),
			"m_emp_doj" => 			$this->input->post('m_emp_doj'),
			"m_emp_dob" => 			$this->input->post('m_emp_dob'),
			"m_emp_mobile" => 		$this->input->post('m_emp_mobile'),
			"m_emp_store" => 		$this->input->post('m_emp_store'),
			"m_emp_roll" => 		$this->input->post('m_emp_roll'),
			"m_emp_monthly" => 		$this->input->post('m_emp_monthly') ?: '',
			"m_emp_yearly" => 		$this->input->post('m_emp_yearly') ?: '',
			"m_emp_dept" => 		$this->input->post('m_emp_dept') ?: '',
			"m_emp_design" => 		$this->input->post('m_emp_design') ?: '',
			"m_emp_altmobile" =>	$this->input->post('m_emp_altmobile'),
			"m_emp_email" => 		$this->input->post('m_emp_email') ?: '',
			"m_emp_altemail" => 	$this->input->post('m_emp_altemail') ?: '',
			"m_emp_dshift" => 		$this->input->post('m_emp_dshift'),
			"m_emp_dtype" => 		$this->input->post('m_emp_dtype'),
			"m_emp_rest" => 		$this->input->post('m_emp_rest'),
			"m_emp_salary" => 		$this->input->post('m_emp_salary') ?: '',
			"m_emp_gross" => 		$this->input->post('m_emp_gross') ?: '',
			"m_emp_epfno" => 		$this->input->post('m_emp_epfno') ?: '',
			"m_emp_esicno" => 		$this->input->post('m_emp_esicno') ?: '',
			"m_emp_accno" => 		$this->input->post('m_emp_accno') ?: '',
			"m_emp_panno" => 		$this->input->post('m_emp_panno') ?: '',
			"m_emp_uanno" => 		$this->input->post('m_emp_uanno') ?: '',
			"m_emp_bankname" => 	$this->input->post('m_emp_bankname') ?: '',
			"m_emp_bankbranch" => 	$this->input->post('m_emp_bankbranch') ?: '',
			"m_emp_adharno" => 		$this->input->post('m_emp_adharno') ?: '',
			"m_emp_ifsc" => 		$this->input->post('m_emp_ifsc') ?: '',
			"m_emp_prev_empr" => 	$this->input->post('m_emp_prev_empr') ?: '',
			"m_emp_prev_dept" => 	$this->input->post('m_emp_prev_dept') ?: '',
			"m_emp_prev_design" => 	$this->input->post('m_emp_prev_design') ?: '',
			"m_emp_prev_duration" => $this->input->post('m_emp_prev_duration') ?: '',
			"m_emp_laddress" => 	$this->input->post('m_emp_laddress') ?: '',
			"m_emp_paddress" => 	$this->input->post('m_emp_paddress') ?: '',
			"m_emp_password" => 	$this->input->post('m_emp_password') ?: '',
			"m_emp_qualification" => $this->input->post('m_emp_qualification') ?: '',
			"m_emp_dol" => 			$this->input->post('m_emp_dol') ?: '',
			"m_emp_salmode" => 			$this->input->post('m_emp_salmode') ?: '',
			"m_emp_status"       => $this->input->post('m_emp_status') ?: '',
			"m_emp_reporting"       => $this->input->post('m_emp_reporting') ?: '',
			"is_esic_applicable" => $is_esic_applicable,
			"is_tds_applicable" => 	$is_tds_applicable,
			"is_epf_applicable" => 	$is_epf_applicable,
			"m_login_type" => 2,


		);

		if (!empty($emp_id)) {
			$this->db->where('m_emp_id', $emp_id)->update('master_employee_tbl', $data);
			$last_id = $emp_id;
			$res = 2;
		} else {
			$this->db->insert('master_employee_tbl', $data);
			$last_id = $this->db->insert_id();
			$res = 1;
		}


		$esalary_id = $this->input->post('m_esalary_id');
		$key_feature = $this->input->post('m_sbreakup_id');
		$m_amounttype = $this->input->post('m_amounttype');
		$m_amount = $this->input->post('m_amount');
		// print_r($data); die(); 

		if (!empty($key_feature)) {
			foreach ($key_feature  as $i => $key) {
				if (!empty($m_amount[$i])) {
					$upddata = array(
						"m_empid" => $last_id,
						"m_sbreakup_id" => $key,
						"m_amounttype" => $m_amounttype[$i],
						"m_amount" => $m_amount[$i],
						"m_status" => 1,
						"m_addedon" => date('Y-m-d H:i'),
					);
					if (!empty($esalary_id[$i])) {
						$this->db->where('m_esalary_id', $esalary_id[$i])->update('master_emp_salary_breakup', $upddata);
					} else {
						$this->db->insert('master_emp_salary_breakup', $upddata);
					}
				}
			}
		}

		return $res;
	}

	public function delete_emp()
	{
		$this->db->where('m_emp_id', $this->input->post('delete_id'));
		$this->db->delete('master_employee_tbl');
		return true;
	}

	public function delete_slarybk()
	{
		$this->db->where('m_esalary_id', $this->input->post('delete_id'));
		$this->db->delete('master_emp_salary_breakup');
		return true;
	}
	//=======================================================employee=================================================//

	//======================================================= salary employee =================================================//

	public function get_emp_salary($emp_id = '', $from_month = '')
	{
		if (!empty($emp_id)) {
			$this->db->where('m_salinst_empid', $emp_id);
		}
		if (!empty($from_month)) {
			$this->db->like('m_salinst_date', $from_month, 'after'); // Matches 'YYYY-MM%'
		}
		return $this->db->select('master_salaryinst_tbl.*,emp.m_emp_id,emp.m_emp_name,emp.m_emp_pic,emp.m_emp_mobile')
			->join('master_employee_tbl emp', 'emp.m_emp_id = master_salaryinst_tbl.m_salinst_empid')
			->get('master_salaryinst_tbl')->result();
	}

	public function get_salary_by_emp_id($emp_id, $date)
	{
		$this->db->where('m_salinst_empid', $emp_id);
		$this->db->where('m_salinst_date', $date);
		$query = $this->db->get('master_salaryinst_tbl');
		return $query->row();
	}

	public function insert_salary($data)
	{
		return $this->db->insert('master_salaryinst_tbl', $data);
	}

	public function update_salary($emp_id, $data)
	{
		$this->db->where('m_salinst_empid', $emp_id);
		return $this->db->update('master_salaryinst_tbl', $data);
	}

	public function get_emp_add_salary($from_month)
	{
		$result = [];
		$total_days = date('t', strtotime($from_month));
		// Get the list of active employees
		$emp_list = $this->db->select('m_emp_id, m_emp_name, m_emp_mobile,m_emp_rest,m_emp_monthly,m_emp_salary,m_emp_gross')
			->where('m_emp_status', 1)
			->get('master_employee_tbl')
			->result();

		if (empty($emp_list)) return $result;

		// Fetch all attendance data in one query
		$holidays = $this->db->like('m_hol_date', $from_month, 'after')->get('master_holiday_tbl')->num_rows();


		$attendance_data = $this->db->select('m_emp_id, COUNT(*) AS present_days')
			->where('m_status', 1)
			->like('m_date', $from_month, 'after')
			->group_by('m_emp_id')
			->get('master_emp_attendance')
			->result_array();

		$attendance_map = array_column($attendance_data, 'present_days', 'm_emp_id');

		// Fetch all leaves in one query
		$leaves_data = $this->db->select('m_leav_empname, m_leav_fromdate, m_leav_todate')
			->where('m_leav_status', 2)
			->where("DATE_FORMAT(m_leav_fromdate, '%Y-%m') <=", $from_month)
			->where("DATE_FORMAT(m_leav_todate, '%Y-%m') >=", $from_month)
			->get('master_leaves_tbl')
			->result();

		// Process leave count for each employee
		$leave_map = [];
		foreach ($leaves_data as $leave) {
			$emp_id = $leave->m_leav_empname;
			$start_date = new DateTime($leave->m_leav_fromdate);
			$end_date = new DateTime($leave->m_leav_todate);
			$days = $start_date->diff($end_date)->days + 1;

			if (!isset($leave_map[$emp_id])) {
				$leave_map[$emp_id] = 0;
			}
			$leave_map[$emp_id] += $days;
		}

		// Build the final result
		foreach ($emp_list as $emp) {
			if ($emp->m_emp_rest != 'none') {
				$restdays = $this->countWeekdaysInMonth($from_month, $emp->m_emp_rest);
			} else {
				$restdays = 0;
			}

			$emp_id = $emp->m_emp_id;
			$emp->total_days = $total_days;
			$emp->working_days = ($total_days - $restdays - $holidays);
			$emp->leave_count = $leave_map[$emp_id] ?? 0;
			$emp->present_count = $attendance_map[$emp_id] ?? 0;
			$result[] = $emp;
		}

		return $result;
	}


	function countWeekdaysInMonth($month, $weekdayNumber)
	{
		$count = 0;
		$daysInMonth = date('t', strtotime("$month-01")); // Get total days in the month

		for ($day = 1; $day <= $daysInMonth; $day++) {
			if (date('N', strtotime("$month-$day")) == $weekdayNumber) {
				$count++;
			}
		}

		return $count;
	}
	//======================================================= salary employee =================================================//

}
