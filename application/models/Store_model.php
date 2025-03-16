<?php date_default_timezone_set('Asia/Kolkata');
class Store_model extends CI_model
{

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

}
