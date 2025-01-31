<?php date_default_timezone_set('Asia/Kolkata');
class Report_model extends CI_model
{
	public function get_emp_attd($from_month = '')
{
    $this->db->select('
        master_employee_tbl.m_emp_id, 
        master_employee_tbl.m_emp_name, 
		master_emp_attendance.m_date,
		master_emp_attendance.m_status,
        COALESCE(COUNT(master_emp_attendance.m_emp_id), 0) AS attendance_count,
        COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 1 THEN 1 ELSE 0 END), 0) AS present_count,
        COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 0 THEN 1 ELSE 0 END), 0) AS absent_count
    ');    
    $this->db->from('master_employee_tbl');  
    $this->db->join('master_emp_attendance', 'master_employee_tbl.m_emp_id = master_emp_attendance.m_emp_id', 'left');
    // if (!empty($from_month)) {
    //     $this->db->where('DATE_FORMAT(master_emp_attendance.m_date, "%m-%Y") =', $from_month);  
    // }    
    $this->db->group_by('master_employee_tbl.m_emp_id, master_employee_tbl.m_emp_name');   

    return $this->db->get()->result();
}

public function get_empatt_detail($id){
    $this->db->select('*');    
    $this->db->from('master_emp_attendance');   
    $this->db->where('master_emp_attendance.m_emp_id', $id);   
    return $this->db->get()->result();
}


public function get_emp_salary($from_month) { 
	$this->db->select('
	master_employee_tbl.m_emp_id, 
	master_employee_tbl.m_emp_name, 
	master_emp_attendance.m_date,
	master_emp_attendance.m_status,
	COALESCE(COUNT(master_emp_attendance.m_emp_id), 0) AS attendance_count,
	COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 1 THEN 1 ELSE 0 END), 0) AS present_count,
	COALESCE(SUM(CASE WHEN master_emp_attendance.m_status = 0 THEN 1 ELSE 0 END), 0) AS absent_count
');    
$this->db->from('master_employee_tbl');  
$this->db->join('master_emp_attendance', 'master_employee_tbl.m_emp_id = master_emp_attendance.m_emp_id', 'left');
// if (!empty($from_month)) {
//     $this->db->where('DATE_FORMAT(master_emp_attendance.m_date, "%m-%Y") =', $from_month);  
// }    
$this->db->group_by('master_employee_tbl.m_emp_id, master_employee_tbl.m_emp_name');   

return $this->db->get()->result();
}

	

}
