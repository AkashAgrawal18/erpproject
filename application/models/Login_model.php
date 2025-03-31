<?php date_default_timezone_set('Asia/Kolkata');
class Login_model extends CI_model
{

	public function validate_user()
	{
		$pass = $this->input->post('login_pass');
		$login_email = $this->input->post('login_email');
		$sql1 = $this->db->where('m_emp_email', $this->input->post('login_email'))
			->get('master_employee_tbl')->num_rows();
		if ($sql1 == 0) {
			return 'not_found';
		}
		
		$sql2 = $this->db->select('m_emp_id,m_login_type,m_emp_store,m_emp_roll')
		->where('m_emp_email', $this->input->post('login_email'))
		->where('m_emp_password', $pass)
		->get('master_employee_tbl');
		if ($sql2->num_rows() == 1) {
			return $sql2->result();
		} else {
			return 'pass_worng';
		}
	}

	public function user_details()
	{

		// $this->db->select('m_admin_id, m_admin_name, m_admin_img');

		$this->db->where('m_emp_id', $this->session->userdata('user_id'));

		return $this->db->get('master_employee_tbl')->result();
	}



	public function get_user_profile_details()
	{

		// $this->db->select('m_admin_id, m_admin_name, m_admin_login_id, m_admin_email, m_admin_pass, m_admin_contact, m_admin_img');

		$this->db->where('m_emp_id', $this->session->userdata('user_id'));

		return $this->db->get('master_employee_tbl')->result();
	}

	//===========================/Login===========================//

	public function get_city($district)
	{;
		$sql = $this->db->join("master_district_tbl", "master_district_tbl.m_district_id = master_city_tbl.m_city_district");
		if ($district != '') {
			$sql = $this->db->where('m_city_district', $district);
		}
		$sql = $this->db->get('master_city_tbl');
		$res = $sql->result();
		return $res;
	}
	public function get_district($state)
	{
		$sql = $this->db->join("master_state_tbl", "master_state_tbl.m_state_id  = master_district_tbl.m_district_state");
		if ($state != '') {
			$sql = $this->db->where('m_district_state', $state);
		}
		$sql = $this->db->get('master_district_tbl');
		$res = $sql->result();
		return $res;
	}


	public function today_student_register()
	{
		//  if(!empty($from_date) && !empty($to_date)){
		//    $this->db->where('DATE_FORMAT(m_std_added_on,"%Y-%m-%d")>=', $from_date);
		//    $this->db->where('DATE_FORMAT(m_std_added_on,"%Y-%m-%d")<=', $to_date);
		//  }

		// if($pstatus){
		//     $this->db->where('m_std_pstatus', $pstatus);
		//  }

		$this->db->select('master_student_tbl.*,master_affiliation_tbl.*,master_affiliation_type_tbl.*,master_courses_tbl.m_course_title');
		$this->db->from('master_student_tbl');
		$this->db->join('master_affiliation_tbl', 'master_affiliation_tbl.m_af_id  = master_student_tbl.m_std_academy', 'left');
		$this->db->join('master_affiliation_type_tbl', 'master_affiliation_type_tbl.m_affiliation_type_id  = master_affiliation_tbl.m_af_sector', 'left');
		$this->db->join('master_courses_tbl', 'master_courses_tbl.m_course_id  = master_student_tbl.m_std_course', 'left');
		$this->db->where('m_std_date', date('Y-m-d'));
		$res = $this->db->get()->result();
		return $res;
	}

	public function today_affiliation_register()
	{
		$this->db->select("*");
		$this->db->join('master_affiliation_type_tbl', 'master_affiliation_type_tbl.m_affiliation_type_id =
			     master_affiliation_tbl.m_af_sector', 'left');
		$this->db->where('m_af_date', date('Y-m-d'));
		$res = $this->db->get('master_affiliation_tbl')->result();
		return $res;
	}
}
