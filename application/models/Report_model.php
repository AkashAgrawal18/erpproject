<?php date_default_timezone_set('Asia/Kolkata');
class Report_model extends CI_model
{

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

	public function get_salary_by_emp_id($emp_id,$date)
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
			if($emp->m_emp_rest != 'none'){
				$restdays = $this->countWeekdaysInMonth($from_month,$emp->m_emp_rest);
			}else{
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


	// query made by akash
	// public function get_emp_attd($from_month = '')
	// {
	// 	$result = array();
	// 	$emp_list = $this->db->select('m_emp_id,m_emp_name,m_emp_mobile,m_emp_rest,m_start_time')
	// 		->join('master_department_tbl shift', 'shift.m_dept_id = master_employee_tbl.m_emp_dshift', 'left')
	// 		->where('m_emp_status', 1)->get('master_employee_tbl')->result();
	// 	$monthdays = date('t', strtotime('01-' . $from_month));
	// 	if (!empty($emp_list)) {
	// 		foreach ($emp_list as $emp) {
	// 			for ($i = 1; $i <= $monthdays; $i++) {
	// 				$date = date('Y-m-d',strtotime($i . '-' . $from_month));
	// 				$present = $this->db->select('m_std_id,m_time_in,m_time_out')->where('m_date', $date)->where('m_emp_id', $emp->m_emp_id)->get('master_emp_attendance')->row();
	// 				$holiday = $this->db->select('m_hol_name')->where('m_hol_date', $date)->get('master_holiday_tbl')->row();
	// 				$leave = $this->db->select('m_leav_id')->where('m_leav_empname', $emp->m_emp_id)->where('m_leav_fromdate <=', $date)->where('m_leav_todate >=', $date)->get('master_leaves_tbl')->row();
	// 				if (!empty($present) && !empty($present->m_time_in) && !empty($present->m_time_out)) {
	// 					$status = 1;
	// 					$attd_id = $present->m_std_id;
	// 				}else if (!empty($present) && !empty($present->m_time_in)) {
	// 					$status = 2;
	// 					$attd_id = $present->m_std_id;
	// 				}else if (!empty($holiday) || date('N', strtotime($date)) == $emp->m_emp_rest) {
	// 					$status = 3;
	// 					$attd_id = !empty($holiday) ?$holiday->m_hol_name:"Week Off" ;
	// 				}else if (!empty($leave)) {
	// 					$status = 4;
	// 					$attd_id = $leave->m_leav_id;
	// 				}else if ($date <= date('Y-m-d')) {
	// 					$status = 5;
	// 					$attd_id = '';
	// 				}else {
	// 					$status = 0;
	// 					$attd_id = '';
	// 				}
	// 				$sub_res = (object) array(
	// 					"date" => $date,
	// 					"status" => $status,
	// 					"attd_id" => $attd_id?:'',
	// 				);
	// 				$emp->attdn_status[] = $sub_res;
	// 			}
	// 			$result[] = $emp;
	// 		}
	// 	}
	// 	return $result;
	// }

	//query optimize by chatgtp
	public function get_emp_attd($from_month = '')
	{
		$result = [];

		// Get list of employees
		$emp_list = $this->db->select('m_emp_id, m_emp_name, m_emp_mobile, m_emp_rest, m_start_time')
			->join('master_department_tbl shift', 'shift.m_dept_id = master_employee_tbl.m_emp_dshift', 'left')
			->where('m_emp_status', 1)
			->get('master_employee_tbl')
			->result();

		// Get month days count
		$monthdays = date('t', strtotime("01-$from_month"));

		if (!empty($emp_list)) {
			$start_date = date('Y-m-01', strtotime("01-$from_month"));
			$end_date = date('Y-m-t', strtotime("01-$from_month"));

			// Batch fetch attendance records
			$attendance_data = $this->db->select('m_std_id, m_emp_id, m_date, m_time_in, m_time_out')
				->where('m_date >=', $start_date)
				->where('m_date <=', $end_date)
				->get('master_emp_attendance')
				->result();

			// Convert attendance to an associative array for faster lookup
			$attendance_map = [];
			foreach ($attendance_data as $attd) {
				$attendance_map[$attd->m_emp_id][$attd->m_date] = $attd;
			}

			// Batch fetch holidays
			$holidays = $this->db->select('m_hol_date, m_hol_name')
				->where('m_hol_date >=', $start_date)
				->where('m_hol_date <=', $end_date)
				->get('master_holiday_tbl')
				->result();

			// Convert holidays to an associative array for fast lookup
			$holiday_map = [];
			foreach ($holidays as $hol) {
				$holiday_map[$hol->m_hol_date] = $hol->m_hol_name;
			}

			// Batch fetch leaves
			$leaves = $this->db->select('m_leav_id, m_leav_empname, m_leav_fromdate, m_leav_todate')
				->where('m_leav_fromdate <=', $end_date)
				->where('m_leav_todate >=', $start_date)
				->get('master_leaves_tbl')
				->result();

			// Convert leaves to an associative array for fast lookup
			$leave_map = [];
			foreach ($leaves as $leave) {
				for ($d = strtotime($leave->m_leav_fromdate); $d <= strtotime($leave->m_leav_todate); $d += 86400) {
					$leave_map[$leave->m_leav_empname][date('Y-m-d', $d)] = $leave->m_leav_id;
				}
			}

			// Process each employee
			foreach ($emp_list as $emp) {
				$emp->attdn_status = [];

				// Loop through each day in the month
				for ($i = 1; $i <= $monthdays; $i++) {
					$date = date('Y-m-d', strtotime("$i-$from_month"));

					$present = isset($attendance_map[$emp->m_emp_id][$date]) ? $attendance_map[$emp->m_emp_id][$date] : null;
					$holiday = isset($holiday_map[$date]) ? $holiday_map[$date] : null;
					$leave = isset($leave_map[$emp->m_emp_id][$date]) ? $leave_map[$emp->m_emp_id][$date] : null;

					if (!empty($present) && !empty($present->m_time_in) && !empty($present->m_time_out)) {
						$status = 1;
						$attd_id = $present->m_std_id;
					} elseif (!empty($present) && !empty($present->m_time_in)) {
						$status = 2;
						$attd_id = $present->m_std_id;
					} elseif (!empty($holiday) || date('N', strtotime($date)) == $emp->m_emp_rest) {
						$status = 3;
						$attd_id = $holiday ?: "Week Off";
					} elseif (!empty($leave)) {
						$status = 4;
						$attd_id = $leave;
					} elseif ($date <= date('Y-m-d')) {
						$status = 5;
						$attd_id = '';
					} else {
						$status = 0;
						$attd_id = '';
					}

					$emp->attdn_status[] = (object) [
						"date" => $date,
						"status" => $status,
						"attd_id" => $attd_id ?: '',
					];
				}

				$result[] = $emp;
			}
		}

		return $result;
	}


	public function get_empatt_detail($attd_id, $type)
	{
		if ($type == 1) {
			return $this->db->select('emp.m_emp_id,emp.m_emp_name,emp.m_emp_pic,emp.m_emp_mobile,emp.m_emp_rest,shift.m_start_time,shift.m_dept_name,m_time_in,m_time_out,m_date')
				->join('master_employee_tbl emp', 'emp.m_emp_id = master_emp_attendance.m_emp_id', 'left')
				->join('master_department_tbl shift', 'shift.m_dept_id = emp.m_emp_dshift', 'left')
				->where('m_std_id', $attd_id)->get('master_emp_attendance')->row();
		} else if ($type == 2) {
			return $this->db->select('master_leaves_tbl.*,emp.m_emp_id,emp.m_emp_name,emp.m_emp_pic,emp.m_emp_mobile,shift.m_start_time,shift.m_dept_name')
				->join('master_employee_tbl emp', 'emp.m_emp_id = master_leaves_tbl.m_leav_empname', 'left')
				->join('master_department_tbl shift', 'shift.m_dept_id = emp.m_emp_dshift', 'left')
				->where('m_leav_id', $attd_id)->get('master_leaves_tbl')->row();
		}
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
}
