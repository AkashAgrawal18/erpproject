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
		$starttime = $this->input->post('m_start_time')?: 0;
		$endtime = $this->input->post('m_end_time')?: 0;
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
	public function get_active_shiftroster()
	{
		$this->db->select('dept.m_dept_name,dept.m_dept_id');
		$this->db->where('m_dept_type', 4);
		$this->db->where('m_dept_status', 1);
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl dept')->result();
		return $res;
	}
	public function get_active_roll(){
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


	//========================== store  =============================//

	public function get_all_store($type='',$status='')
	{
		$this->db->select('*');
		if (!empty($type)) {
			$this->db->where('m_str_type', $type);
		}
		if (!empty($status)) {
			$this->db->where('m_str_status', $status);
		}
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
			"m_str_type" => $this->input->post('m_str_type'),
			"m_str_opening_time" => $this->input->post('m_str_opening_time') ?:'',
			"m_str_closing_time" => $this->input->post('m_str_closing_time') ?:'',
			"m_str_manage_name" => $this->input->post('m_str_manage_name') ?:'',
			"m_str_mobile" => $this->input->post('m_str_mobile') ?:'',
			"m_str_address" => $this->input->post('m_str_address'),
			"m_state" => $this->input->post('m_state'),
			"m_city" => $this->input->post('m_city'),
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

		
		


}
