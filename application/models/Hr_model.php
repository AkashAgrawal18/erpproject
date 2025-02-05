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
		$starttime = $this->input->post('m_start_time');
		$endtime = $this->input->post('m_end_time');
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
	public function get_active_store()
	{
		$this->db->select('*');
		$this->db->where('m_str_status', 1);
		$res = $this->db->get('master_store_tbl')->result();
		return $res;
	}
	//=========================================== dept ===============================================//
	//========================== Category  =============================//

	public function get_cate($type, $status = '')
	{
		$this->db->select('*');
		if (!empty($status)) {
			$this->db->where('m_cat_status', $status);
		}
		$this->db->order_by('m_cat_id', 'desc');
		$res = $this->db->where('m_cat_type', $type)->get('master_cate_tbl')->result();
		return $res;
	}
	public function getsubcate(){
		$this->db->select('*');		 
		$this->db->order_by('m_cat_id', 'desc');
		$res = $this->db->where('m_cat_type', 1)->get('master_cate_tbl')->result();
		return $res;
	}
	public function get_cate_dtl($edid)
	{
		$this->db->select('*');
		$this->db->where('m_cat_id', $edid);
		$res = $this->db->get('master_cate_tbl')->row();
		return $res;
	}
	public function insert_cate()
	{
		if (!empty($_FILES['m_cat_img']['name'])) {

			$name1 = $_FILES['m_cat_img']['name'];
			$fileNameParts = explode(".", $name1); // explode file name to two part
			$fileExtension = end($fileNameParts); // give extension
			$fileExtension = strtolower($fileExtension);
			$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
			$config['file_name'] = $encripted_pic_name;
			$config['file_name'] = $_FILES['m_cat_img']['name'];
			$config['upload_path'] = 'uploads/cate/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_cat_img']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('m_cat_img')) {
				$uploadData = $this->upload->data();
				if (!empty($update_data['m_cat_img'])) {
					if (file_exists($config['m_cat_img'] . $update_data['m_cat_img'])) {
						unlink($config['upload_path'] . $update_data['m_cat_img']); /* deleting Image */
					}
				}
				$m_cat_img = $uploadData['file_name'];
			}
		} else {
			$m_cat_img = $this->input->post('catimg');
		}
	
		$id = $this->input->post('m_cat_id');
		$cate_name = $this->input->post('m_cat_name');
		$cate_type = $this->input->post('m_cat_type');
	 
	
		// Check if category already exists
		$check = $this->db->where('m_cat_name', $cate_name)
						  ->where('m_cat_type', $cate_type)
						  ->where('m_cat_id !=', $id)
						  ->get('master_cate_tbl')
						  ->num_rows();
		
		if ($check > 0) {
			return 3;
		}
	
		$s_data = array(
			"m_cat_name" => $cate_name,
			"m_cat_status" => $this->input->post('m_cat_status'),
			"m_catsub_id" => $this->input->post('m_catsub_id'),
			"m_cat_img" => $m_cat_img,
			"m_cat_type" => $cate_type,
			"m_cat_addedon" => date('Y-m-d H:i'),
		);
	
		if (!empty($id)) {
			$this->db->where('m_cat_id', $id)->update('master_cate_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_cate_tbl', $s_data);
			return 1;
		}
	}
	

	public function delete_cate()
	{
		$this->db->where('m_cat_id', $this->input->post('delete_id'));
		return $this->db->delete('master_cate_tbl');
	}

	//========================== Category  =============================//

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

	//========================== store  =============================//

	public function get_all_store()
	{
		$this->db->select('*');
		$this->db->order_by('m_str_id', 'desc');
		$res = $this->db->get('master_store_tbl')->result();
		return $res;
	}
	public function get_edit_store($edid)
	{
		$this->db->select('*');
		$this->db->where('m_str_id', $edid);
		$res = $this->db->get('master_store_tbl')->row();
		return $res;
	}

	public function insert_store()
	{
		$s_data = array(
			"m_str_name" => $this->input->post('m_str_name'),
			"m_str_code" => $this->input->post('m_str_code'),
			"m_str_opening_time" => $this->input->post('m_str_opening_time'),
			"m_str_closing_time" => $this->input->post('m_str_closing_time'),
			"m_str_manage_name" => $this->input->post('m_str_manage_name'),
			"m_str_mobile" => $this->input->post('m_str_mobile'),
			"m_str_address" => $this->input->post('m_str_address'),
			"m_str_status" => $this->input->post('m_str_status'),
			"m_str_addedon" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_str_id');
		if (!empty($id)) {
			$this->db->where('m_str_id', $id)->update('master_store_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_store_tbl', $s_data);
			return 1;
		}
	}

	public function delete_store()
	{
		$this->db->where('m_str_id', $this->input->post('delete_id'));
		return $this->db->delete('master_store_tbl');
	}
	//========================== store  =============================//


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
			"m_leav_date" => $this->input->post('m_leav_date'),
			"m_leav_absence" => $this->input->post('m_leav_absence'),
			"m_leav_imgfile" => $m_leav_imgfile,
			"m_leav_status" => $this->input->post('m_leav_status'), 
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
		// $this->db->where('m_login_type!=', 1);
		$this->db->where('m_dept_type', 2);
		$this->db->join('master_department_tbl design', 'design.m_dept_id  = master_employee_tbl.m_emp_design', 'left');
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
			// "is_out_of_job" => 		$is_out_of_job,
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
