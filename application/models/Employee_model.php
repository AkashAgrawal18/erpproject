<?php date_default_timezone_set('Asia/Kolkata');
class Employee_model extends CI_model
{

	

	//=======================================================employee=================================================//


	public function get_emp_list()
	{
		// $this->db->where('m_login_type!=', 1);
		$this->db->where('m_dept_type', 2);
		$this->db->join('master_department_tbl design', 'design.m_dept_id  = master_employee_tbl.m_emp_design', 'left');
		$res = $this->db->get('master_employee_tbl')->result();
		return $res;
	}

	public function get_Active_emp()
	{
		$res = $this->db->select('m_emp_name,m_emp_mobile,m_emp_code,m_emp_id')->where('m_emp_status', 1)->get('master_employee_tbl')->result();
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

	public function get_salarybk($id)
	{
		$this->db->select('*');
		$this->db->where('m_empid', $id);
		$res = $this->db->get('master_emp_salary_breakup')->result();
		return $res;
	}

	public function insert_emp()
	{


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
		if ($this->input->post('is_epf_applicable')) {
			$is_epf_applicable = 1;
		} else {
			$is_epf_applicable = 0;
		}


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
			"m_emp_login_type" => 	$this->input->post('m_emp_login_type') ?: '',
			"m_emp_qualification" => $this->input->post('m_emp_qualification') ?: '',
			"m_emp_dol" => 			$this->input->post('m_emp_dol') ?: '',
			"m_emp_salmode" => 			$this->input->post('m_emp_salmode') ?: '',
			"m_emp_status"       => $this->input->post('m_emp_status') ?: '',
			// "m_emp_leadact" => 			$m_emp_leadact,
			"is_esic_applicable" => $is_esic_applicable,
			"is_tds_applicable" => 	$is_tds_applicable,
			// "m_emp_status" => 		$m_emp_status,
			"is_epf_applicable" => 	$is_epf_applicable,
			"m_login_type" => 2,


		);
		$this->db->insert('master_employee_tbl', $data);
		$last_id = $this->db->insert_id();


		$key_feature = $this->input->post('m_sbreakup_id');
		$m_amounttype = $this->input->post('m_amounttype');
		$m_amount = $this->input->post('m_amount');;
		// print_r($data); die(); 

		if (!empty($key_feature)) {
			foreach ($key_feature  as $i => $key) {

				$upddata = array(
					"m_empid" => $last_id,
					"m_sbreakup_id" => $key,
					"m_amounttype" => $m_amounttype[$i],
					"m_amount" => $m_amount[$i],
					"m_status" => 1,
					"m_addedon" => date('Y-m-d H:i'),
				);
				$set = $this->db->insert('master_emp_salary_breakup', $upddata);
			}
		}

		//  $data2 = array(  
		//     "m_emp_salary" => 1, 
		//  );
		//  $this->db->where('m_emp_id', $last_id);
		//  $this->db->update('master_employee_tbl', $data2); 
		return true;
	}


	public function update_emp()
	{
		$emp_id = $this->input->post('m_emp_id');

		if (!$emp_id) {
			return 0;
		}
		$is_esic_applicable = $this->input->post('is_esic_applicable') ? 1 : 0;
		$is_tds_applicable = $this->input->post('is_tds_applicable') ? 1 : 0;
		$is_epf_applicable = $this->input->post('is_epf_applicable') ? 1 : 0;

		// Employee Data Array
		$data = array(
			"m_emp_code"         => $this->input->post('m_emp_code'),
			"m_emp_name"         => $this->input->post('m_emp_name'),
			"m_emp_fhname"       => $this->input->post('m_emp_fhname'),
			"m_emp_doj"          => $this->input->post('m_emp_doj'),
			"m_emp_dob"          => $this->input->post('m_emp_dob'),
			"m_emp_mobile"       => $this->input->post('m_emp_mobile'),
			"m_emp_store"      => $this->input->post('m_emp_store'),
			"m_emp_roll"      => $this->input->post('m_emp_roll'),
			"m_emp_monthly" => 		$this->input->post('m_emp_monthly') ?: '',
			"m_emp_yearly" => 		$this->input->post('m_emp_yearly') ?: '',
			"m_emp_dept"         => $this->input->post('m_emp_dept') ?: '',
			"m_emp_design"       => $this->input->post('m_emp_design') ?: '',
			"m_emp_altmobile"    => $this->input->post('m_emp_altmobile'),
			"m_emp_email"        => $this->input->post('m_emp_email') ?: '',
			"m_emp_altemail"     => $this->input->post('m_emp_altemail') ?: '',
			"m_emp_dshift"       => $this->input->post('m_emp_dshift'),
			"m_emp_dtype"        => $this->input->post('m_emp_dtype'),
			"m_emp_rest"         => $this->input->post('m_emp_rest'),
			"m_emp_salary"       => $this->input->post('m_emp_salary') ?: '',
			"m_emp_gross"       => $this->input->post('m_emp_gross') ?: '',
			"m_emp_epfno"        => $this->input->post('m_emp_epfno') ?: '',
			"m_emp_esicno"       => $this->input->post('m_emp_esicno') ?: '',
			"m_emp_accno"        => $this->input->post('m_emp_accno') ?: '',
			"m_emp_panno"        => $this->input->post('m_emp_panno') ?: '',
			"m_emp_uanno"        => $this->input->post('m_emp_uanno') ?: '',
			"m_emp_bankname"     => $this->input->post('m_emp_bankname') ?: '',
			"m_emp_bankbranch"   => $this->input->post('m_emp_bankbranch') ?: '',
			"m_emp_adharno"      => $this->input->post('m_emp_adharno') ?: '',
			"m_emp_ifsc"         => $this->input->post('m_emp_ifsc') ?: '',
			"m_emp_prev_empr"    => $this->input->post('m_emp_prev_empr') ?: '',
			"m_emp_prev_dept"    => $this->input->post('m_emp_prev_dept') ?: '',
			"m_emp_prev_design"  => $this->input->post('m_emp_prev_design') ?: '',
			"m_emp_prev_duration" => $this->input->post('m_emp_prev_duration') ?: '',
			"m_emp_laddress"     => $this->input->post('m_emp_laddress') ?: '',
			"m_emp_paddress"     => $this->input->post('m_emp_paddress') ?: '',
			"m_emp_password"     => $this->input->post('m_emp_password') ?: '',
			"m_emp_login_type"   => $this->input->post('m_emp_login_type') ?: '',
			"m_emp_qualification" => $this->input->post('m_emp_qualification') ?: '',
			"m_emp_dol"          => $this->input->post('m_emp_dol') ?: '',
			"m_emp_salmode"      => $this->input->post('m_emp_salmode') ?: '',
			"m_emp_status"       => $this->input->post('m_emp_status') ?: '',
			"m_emp_added_on" => date('Y-m-d H:i'),
			"is_esic_applicable" => $is_esic_applicable,
			"is_tds_applicable"  => $is_tds_applicable,
			"is_epf_applicable"  => $is_epf_applicable,
			"m_login_type"       => 2,

		);

		$this->db->where('m_emp_id', $emp_id)->update('master_employee_tbl', $data);

		$key_feature  = $this->input->post('m_sbreakup_id');
		$m_amounttype  = $this->input->post('m_amounttype');
		$m_amount      = $this->input->post('m_amount');
		$last_id       = $this->input->post('m_emp_id');
		$this->db->where('m_empid', $last_id)->delete('master_emp_salary_breakup');

		if (!empty($key_feature)) {
			foreach ($key_feature  as $i => $key) {
				$salary_data[] = array(
					"m_empid"       => $last_id,
					"m_sbreakup_id" => $key,
					"m_amounttype"  => $m_amounttype[$i],
					"m_amount"      => $m_amount[$i],
					"m_status"      => 1,
					"m_addedon"     => date('Y-m-d H:i'),
				);
			}
			if (!empty($salary_data)) {
				$this->db->insert_batch('master_emp_salary_breakup', $salary_data);
			}
			// print_r($salary_data); die(); 
		}
		// $data2 = array(  
		//     "m_emp_salary" => 100, 
		//  );
		//  $this->db->where('m_emp_id', $last_id);
		//  $this->db->update('master_employee_tbl', $data2); 
		return true;
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


}
