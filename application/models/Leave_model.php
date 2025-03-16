<?php date_default_timezone_set('Asia/Kolkata');
class Leave_model extends CI_model
{

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
