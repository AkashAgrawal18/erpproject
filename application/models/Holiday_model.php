<?php date_default_timezone_set('Asia/Kolkata');
class Holiday_model extends CI_model
{

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

}
