<?php date_default_timezone_set('Asia/Kolkata');
class General_model extends CI_model
{
	//========================== entity  =============================//

	public function get_all_entity($type = "", $status = "")
	{
		$this->db->select('master_entities_tbl.*,(Case when m_entity_type = 1 then "Customer" when m_entity_type = 2 then "Dealer" when m_entity_type = 3 then "Retailer" when m_entity_type = 4 then "Supplier" Else "Wholeseller" end) as Entity_type');
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
			"m_entity_gstno" => $this->input->post('m_entity_gstno'),
			"m_entity_discount" => $this->input->post('m_entity_discount'),
			"m_entity_state" => $this->input->post('m_entity_state'),
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

	//========================== store  =============================//

	public function get_all_store($type = '', $status = '')
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
			"m_str_opening_time" => $this->input->post('m_str_opening_time') ?: '',
			"m_str_closing_time" => $this->input->post('m_str_closing_time') ?: '',
			"m_str_manage_name" => $this->input->post('m_str_manage_name') ?: '',
			"m_str_mobile" => $this->input->post('m_str_mobile') ?: '',
			"m_str_address" => $this->input->post('m_str_address'),
			"m_state" => $this->input->post('m_state'),
			"m_city" => $this->input->post('m_city'),
			"m_str_lat" => $this->input->post('m_str_lat'),
			"m_str_long" => $this->input->post('m_str_long'),
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
