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


	


}
