<?php date_default_timezone_set('Asia/Kolkata');
class Hr_model extends CI_model
{

//========================== dept  =============================//

public function get_dept($type,$status='')
{
	$this->db->select('*');
	if(!empty($status)){
		$this->db->where('m_dept_status',$status);
	}
	$this->db->order_by('m_dept_id','desc');
	$res = $this->db->where('m_dept_type',$type)->get('master_department_tbl')->result();
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
    $dept_type = $this->input->post('m_dept_type');
    $check = $this->db->where('m_dept_name', $dept_name)->where('m_dept_type', $dept_type)->where('m_dept_id !=', $id)->get('master_department_tbl')->num_rows();
    if ($check > 0) {
      return 3;
    }
	$s_data = array(
		"m_dept_name" => $dept_name,
		"m_dept_code" => $this->input->post('m_dept_code'),
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
 
public function get_active_design()
{
	$this->db->select('dept.m_dept_name,dept.m_dept_id');
	$this->db->where('m_dept_type', 2);
	$this->db->where('m_dept_status', 1);
	$this->db->order_by('m_dept_name');
	$res = $this->db->get('master_department_tbl dept')->result();
	return $res;
}
public function get_active_company()
{
	$this->db->select('dept.m_dept_name,dept.m_dept_id');
	$this->db->where('m_dept_type', 4);
	$this->db->where('m_dept_status', 1);
	$this->db->order_by('m_dept_name');
	$res = $this->db->get('master_department_tbl dept')->result();
	return $res;
}
//=========================================== dept ===============================================//


	//=======================================================employee=================================================//

 
	public function get_emp_list(){
		$this->db->where('m_login_type!=', 1);
		$res = $this->db->get('master_employee_tbl')->result();
		return $res;	
	}
	 
	public function get_Active_emp()
	{
		$res = $this->db->select('m_emp_name,m_emp_mobile,m_emp_code,m_emp_id')->where('is_out_of_job', 0)->get('master_employee_tbl')->result();
		return $res;
	}

	public function get_emp_design_list($design)
	{
		$res = $this->db->select('m_emp_name,m_emp_mobile,m_emp_code,m_emp_id')->where_in('m_emp_design', $design)->where('is_out_of_job', 0)->get('master_employee_tbl')->result();
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
		// $this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left');
		// $this->db->join('master_designation_tbl', 'master_designation_tbl.m_design_id = master_employee_tbl.m_emp_design', 'left');
		// $this->db->join('master_company_tbl','master_company_tbl.m_company_id = master_employee_tbl.m_emp_company','left');
		$res = $this->db->get('master_employee_tbl')->row();

		return $res;
	}

	public function insert_emp()
	{

		$emp_id = $this->input->post('m_emp_id');

		if ($this->input->post('is_esic_applicable')) {
			$is_esic_applicable = 1;
		} else {
			$is_esic_applicable = 0;
		}
		if ($this->input->post('is_tds_applicable')) {
			$is_tds_applicable = 1;
		} else {
			$is_tds_applicable = 0;
		}
		// if ($this->input->post('is_out_of_job')) {
		// 	$is_out_of_job = 1;
		// } else {
		// 	$is_out_of_job = 0;
		// }

		if ($this->input->post('is_epf_applicable')) {
			$is_epf_applicable = 1;
		} else {
			$is_epf_applicable = 0;
		}
		// if ($this->input->post('m_emp_leadact')) {
		// 	$m_emp_leadact = 1;
		// } else {
		// 	$m_emp_leadact = 0;
		//}


		$data = array(

			"m_emp_code" => 		$this->input->post('m_emp_code'),
			"m_emp_name" => 		$this->input->post('m_emp_name'),
			"m_emp_fhname" => 		$this->input->post('m_emp_fhname'),
			"m_emp_doj" => 			$this->input->post('m_emp_doj'),
			"m_emp_dob" => 			$this->input->post('m_emp_dob'),
			"m_emp_mobile" => 		$this->input->post('m_emp_mobile'),
			"m_emp_company" => 		$this->input->post('m_emp_company'),
			"m_emp_dept" => 		$this->input->post('m_emp_dept')?:'',
			"m_emp_design" => 		$this->input->post('m_emp_design')?:'',
			// "m_emp_hq" => 			$this->input->post('m_emp_hq') ?:'',
			"m_emp_altmobile" =>	$this->input->post('m_emp_altmobile'),
			"m_emp_email" => 		$this->input->post('m_emp_email') ?:'',
			"m_emp_altemail" => 	$this->input->post('m_emp_altemail') ?:'',
			// "m_emp_bg" => 			$this->input->post('m_emp_bg') ,
			"m_emp_dshift" => 		$this->input->post('m_emp_dshift') ,
			"m_emp_dtype" => 		$this->input->post('m_emp_dtype') ,
			"m_emp_rest" => 		$this->input->post('m_emp_rest'),
			// "m_emp_ottype" => 		$this->input->post('m_emp_ottype'),
			"m_emp_salary" => 		$this->input->post('m_emp_salary') ?:'',
			// "m_emp_cca" => 			$this->input->post('m_emp_cca') ?:'',
			// "m_emp_medic_allow" =>	$this->input->post('m_emp_medic_allow') ?:'',
			// "m_emp_ta" => 			$this->input->post('m_emp_ta') ?:'',
			// "m_emp_spl_allow" => 	$this->input->post('m_emp_spl_allow') ?:'',
			// "m_emp_medicliam_ded" => $this->input->post('m_emp_medicliam_ded') ?:'',
			// "m_emp_hra" => 			$this->input->post('m_emp_hra') ?:'',
			// "m_emp_educ_allow" => 	$this->input->post('m_emp_educ_allow') ?:'',
			// "m_emp_gross_salary" => $this->input->post('m_emp_gross_salary') ?:'',
			"m_emp_epfno" => 		$this->input->post('m_emp_epfno') ?:'',
			"m_emp_esicno" => 		$this->input->post('m_emp_esicno') ?:'',
			"m_emp_accno" => 		$this->input->post('m_emp_accno') ?:'',
			"m_emp_panno" => 		$this->input->post('m_emp_panno') ?:'',
			"m_emp_uanno" => 		$this->input->post('m_emp_uanno') ?:'',
			"m_emp_bankname" => 	$this->input->post('m_emp_bankname') ?:'',
			"m_emp_bankbranch" => 	$this->input->post('m_emp_bankbranch') ?:'',
			"m_emp_adharno" => 		$this->input->post('m_emp_adharno') ?:'',
			"m_emp_ifsc" => 		$this->input->post('m_emp_ifsc') ?:'',
			"m_emp_prev_empr" => 	$this->input->post('m_emp_prev_empr') ?:'',
			"m_emp_prev_dept" => 	$this->input->post('m_emp_prev_dept') ?:'',
			"m_emp_prev_design" => 	$this->input->post('m_emp_prev_design') ?:'',
			"m_emp_prev_duration" => $this->input->post('m_emp_prev_duration') ?:'',
			"m_emp_laddress" => 	$this->input->post('m_emp_laddress') ?:'',
			"m_emp_paddress" => 	$this->input->post('m_emp_paddress') ?:'',
			"m_emp_password" => 	$this->input->post('m_emp_password') ?:'',
			"m_emp_login_type" => 	$this->input->post('m_emp_login_type') ?:'',
			"m_emp_qualification" => $this->input->post('m_emp_qualification') ?:'',
			"m_emp_dol" => 			$this->input->post('m_emp_dol') ?:'',
			"m_emp_salmode" => 			$this->input->post('m_emp_salmode') ?:'',
			// "m_emp_leadact" => 			$m_emp_leadact,
			"is_esic_applicable" => $is_esic_applicable,
			"is_tds_applicable" => 	$is_tds_applicable,
			// "is_out_of_job" => 		$is_out_of_job,
			"is_epf_applicable" => 	$is_epf_applicable,

		);

		if (!empty($emp_id)) {
			$emp_detail = $this->db->where('m_emp_id', $emp_id)->get('master_employee_tbl')->row();

			$data["m_emp_salary"] = 		$this->input->post('m_emp_salary') ?: $emp_detail->m_emp_salary;
			// $data["m_emp_cca"] = 			$this->input->post('m_emp_cca') ?: $emp_detail->m_emp_cca;
			// $data["m_emp_medic_allow"] =	$this->input->post('m_emp_medic_allow') ?: $emp_detail->m_emp_medic_allow;
			// $data["m_emp_ta"] = 			$this->input->post('m_emp_ta') ?: $emp_detail->m_emp_ta;
			// $data["m_emp_spl_allow"] = 	$this->input->post('m_emp_spl_allow') ?: $emp_detail->m_emp_spl_allow;
			// $data["m_emp_medicliam_ded"] = $this->input->post('m_emp_medicliam_ded') ?: $emp_detail->m_emp_medicliam_ded;
			// $data["m_emp_hra"] = 			$this->input->post('m_emp_hra') ?: $emp_detail->m_emp_hra;
			// $data["m_emp_educ_allow"] = 	$this->input->post('m_emp_educ_allow') ?: $emp_detail->m_emp_educ_allow;
			// $data["m_emp_gross_salary"] = $this->input->post('m_emp_gross_salary') ?: $emp_detail->m_emp_gross_salary;
			$data["m_emp_epfno"] = 		$this->input->post('m_emp_epfno') ?: $emp_detail->m_emp_epfno;
			$data["m_emp_esicno"] = 		$this->input->post('m_emp_esicno') ?: $emp_detail->m_emp_esicno;
			$data["m_emp_accno"] = 		$this->input->post('m_emp_accno') ?: $emp_detail->m_emp_accno;
			$data["m_emp_panno"] = 		$this->input->post('m_emp_panno') ?: $emp_detail->m_emp_panno;
			$data["m_emp_uanno"] = 		$this->input->post('m_emp_uanno') ?: $emp_detail->m_emp_uanno;
			$data["m_emp_bankname"] = 	$this->input->post('m_emp_bankname') ?: $emp_detail->m_emp_bankname;
			$data["m_emp_bankbranch"] = 	$this->input->post('m_emp_bankbranch') ?: $emp_detail->m_emp_bankbranch;
			$data["m_emp_adharno"] = 		$this->input->post('m_emp_adharno') ?: $emp_detail->m_emp_adharno;
			$data["m_emp_ifsc"] = 		$this->input->post('m_emp_ifsc') ?: $emp_detail->m_emp_ifsc;
			$data["m_emp_prev_empr"] = 	$this->input->post('m_emp_prev_empr') ?: $emp_detail->m_emp_prev_empr;
			$data["m_emp_prev_dept"] = 	$this->input->post('m_emp_prev_dept') ?: $emp_detail->m_emp_prev_dept;
			$data["m_emp_prev_design"] = 	$this->input->post('m_emp_prev_design') ?: $emp_detail->m_emp_prev_design;
			$data["m_emp_prev_duration"] = $this->input->post('m_emp_prev_duration') ?: $emp_detail->m_emp_prev_duration;
			$data["m_emp_laddress"] = 	$this->input->post('m_emp_laddress') ?: $emp_detail->m_emp_laddress;
			$data["m_emp_paddress"] = 	$this->input->post('m_emp_paddress') ?: $emp_detail->m_emp_paddress;
			$data["m_emp_password"] = 	$this->input->post('m_emp_password') ?: $emp_detail->m_emp_password;
			$data["m_emp_login_type"] = 	$this->input->post('m_emp_login_type') ?: $emp_detail->m_emp_login_type;
			$data["m_emp_qualification"] = $this->input->post('m_emp_qualification') ?: $emp_detail->m_emp_qualification;
			$data["m_emp_dol"] = 			$this->input->post('m_emp_dol') ?: $emp_detail->m_emp_dol;
			$data["m_emp_salmode"] = 			$this->input->post('m_emp_salmode') ?: $emp_detail->m_emp_salmode;
		
			$this->db->where('m_emp_id', $emp_id)->update('master_employee_tbl', $data);
			return 2;
		} else {
			$data['m_emp_added_on'] = date('Y-m-d H:i:s');
			$this->db->insert('master_employee_tbl', $data);
			return 1;
		}
	}

	public function delete_emp()
	{
		$this->db->where('m_emp_id', $this->input->post('delete_id'));
		$this->db->delete('master_employee_tbl');
		return true;
	}
	//=======================================================employee=================================================//


}
