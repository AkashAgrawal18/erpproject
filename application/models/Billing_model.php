<?php date_default_timezone_set('Asia/Kolkata');
class Billing_model extends CI_model
{


	//========================== entity  =============================//

	public function get_all_entity($type = "", $status = "")
	{
		$this->db->select('*');
		if (!empty($type)) {
			$this->db->where('m_entity_type', $type);
		}
		if (!empty($status)) {
			$this->db->where('m_entity_status', $status);
		}
		$this->db->order_by('m_entity_id', 'desc');
		$res = $this->db->get('master_entities_tbl')->result();
		return $res;
	}
	public function get_edit_entity($edid)
	{
		$this->db->select('*');
		$this->db->where('m_entity_id', $edid);
		$res = $this->db->get('master_entities_tbl')->row();
		return $res;
	}

	public function insert_entity()
	{
		$id = $this->input->post('m_entity_id');
		$check = $this->db->where('m_entity_mobile', $this->input->post('m_entity_mobile'))
			->where('m_entity_id !=', $id)->get('master_entities_tbl')->num_rows();
		if ($check > 0) {
			return 3;
		}
		$s_data = array(
			"m_entity_name" => $this->input->post('m_entity_name'),
			"m_entity_type" => $this->input->post('m_entity_type'),
			"m_entity_mobile" => $this->input->post('m_entity_mobile'),
			"m_entity_address" => $this->input->post('m_entity_address'),
			"m_entity_status" => $this->input->post('m_entity_status'),
			"m_entity_addedon" => date('Y-m-d H:i'),
		);
		// print_r($s_data); die();

		if (!empty($id)) {
			$this->db->where('m_entity_id', $id)->update('master_entities_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_entities_tbl', $s_data);
			return 1;
		}
	}

	public function delete_entity()
	{
		$this->db->where('m_entity_id', $this->input->post('delete_id'));
		return $this->db->delete('master_entities_tbl');
	}
	//========================== entity  =============================//


}
