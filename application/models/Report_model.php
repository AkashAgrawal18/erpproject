<?php date_default_timezone_set('Asia/Kolkata');
class Report_model extends CI_model
{

	public function get_emp_salary($from_month)
	{

		$total_days = '(DAY(LAST_DAY(STR_TO_DATE(CONCAT("01-", ' . $this->db->escape($from_month) . '), "%d-%m-%Y"))))';

		$this->db->select("
			master_employee_tbl.m_emp_id, 
			master_employee_tbl.m_emp_name, 
			master_employee_tbl.m_emp_salary,
			master_emp_attendance.m_std_id,
			$total_days AS attendance_count,  
			COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 1 THEN 1 ELSE 0 END), 0) AS present_count,
			($total_days - COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 1 THEN 1 ELSE 0 END), 0)) AS absent_count, 
			COALESCE(SUM(CASE WHEN master_leaves_tbl.m_leav_type IS NOT NULL THEN 1 ELSE 0 END), 0) AS leave_count,
			FORMAT((master_employee_tbl.m_emp_salary / $total_days) * 
			COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 1 THEN 1 ELSE 0 END), 0), 2) AS payable_salary
		", false);

		$this->db->from('master_employee_tbl');
		$this->db->join(
			'master_emp_attendance',
			'master_employee_tbl.m_emp_id = master_emp_attendance.m_emp_id 
			AND DATE_FORMAT(master_emp_attendance.m_date, "%m-%Y") = ' . $this->db->escape($from_month),
			'left'
		);
		$this->db->join(
			'master_leaves_tbl',
			'master_employee_tbl.m_emp_id = master_leaves_tbl.m_leav_empname 
			AND DATE_FORMAT(master_leaves_tbl.m_leav_date, "%m-%Y") = ' . $this->db->escape($from_month),
			'left'
		);

		$this->db->group_by('master_employee_tbl.m_emp_id');

		return $this->db->get()->result();
	}

	public function get_salary_by_emp_id($emp_id)
	{
		$this->db->where('m_salinst_empid', $emp_id);
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



	public function get_empslaary($from_month = '')
	{
		$this->db->select('*');
		$this->db->from('master_salaryinst_tbl');

		if (!empty($from_month)) {
			$this->db->where('DATE_FORMAT(master_salaryinst_tbl.m_salinst_date, "%m-%Y") =', $from_month);
		}
		return $this->db->get()->result();
	}

	public function get_emp_add_salary($from_month)
	{

		$total_days = '(DAY(LAST_DAY(STR_TO_DATE(CONCAT("01-", ' . $this->db->escape($from_month) . '), "%d-%m-%Y"))))';

		$this->db->select("
			master_employee_tbl.m_emp_id, 
			master_employee_tbl.m_emp_name, 
			master_employee_tbl.m_emp_salary,
			master_emp_attendance.m_std_id,
			$total_days AS attendance_count,  
			COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 1 THEN 1 ELSE 0 END), 0) AS present_count,
			($total_days - COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 1 THEN 1 ELSE 0 END), 0)) AS absent_count, 
			COALESCE(SUM(CASE WHEN master_leaves_tbl.m_leav_type IS NOT NULL THEN 1 ELSE 0 END), 0) AS leave_count,  
			FORMAT((master_employee_tbl.m_emp_salary / $total_days) * 
			COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 1 THEN 1 ELSE 0 END), 0), 1) AS payable_salary
		", false);

		$this->db->from('master_employee_tbl');
		$this->db->join(
			'master_emp_attendance',
			'master_employee_tbl.m_emp_id = master_emp_attendance.m_emp_id 
			AND DATE_FORMAT(master_emp_attendance.m_date, "%m-%Y") = ' . $this->db->escape($from_month),
			'left'
		);
		$this->db->join(
			'master_leaves_tbl',
			'master_employee_tbl.m_emp_id = master_leaves_tbl.m_leav_empname 
			AND DATE_FORMAT(master_leaves_tbl.m_leav_date, "%m-%Y") = ' . $this->db->escape($from_month),
			'left'
		);

		$this->db->group_by('master_employee_tbl.m_emp_id');

		return $this->db->get()->result();
	}


	public function get_emp_attd($from_month = '')
	{
		$total_days = '(DAY(LAST_DAY(STR_TO_DATE(CONCAT("01-", ' . $this->db->escape($from_month) . '), "%d-%m-%Y"))))';
		$this->db->select('
			master_employee_tbl.m_emp_id, 
			master_employee_tbl.m_emp_name, 
			master_emp_attendance.m_date, 
			master_emp_attendance.m_status, 
			' . $total_days . ' AS total_days, 
			 ');
		$this->db->from('master_emp_attendance');
		$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = master_emp_attendance.m_emp_id', 'left');
		$this->db->join('master_leaves_tbl', 'master_employee_tbl.m_emp_id = master_leaves_tbl.m_leav_empname', 'left');
		$this->db->group_by('master_employee_tbl.m_emp_id, master_employee_tbl.m_emp_name');
		return $this->db->get()->result();
	}


	public function get_empatt_detail($id, $from_month = '')
	{
		$this->db->select('*');
		$this->db->from('master_emp_attendance');
		$this->db->where('master_emp_attendance.m_emp_id', $id);

		if (!empty($from_month)) {
			$this->db->where('DATE_FORMAT(master_emp_attendance.m_date, "%m-%Y") =', $from_month);
		}
		return $this->db->get()->result();
	}
}
