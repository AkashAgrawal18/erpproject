<?php date_default_timezone_set('Asia/Kolkata');
class Batch_model extends CI_model
{
		
	//========================== Batch  =============================//

	public function get_all_batch()
	{
		$this->db->select('*');
		$this->db->order_by('m_batch_id', 'desc');
		$this->db->join('master_product_tbl', 'master_product_tbl.m_pro_id = master_batch_tbl.m_batch_pro_id', 'left');
		$res = $this->db->get('master_batch_tbl')->result();
		return $res;
	}
	public function get_edit_batch($edid)
	{
		$this->db->select('*');
		$this->db->where('m_batch_id', $edid);
		$res = $this->db->get('master_batch_tbl')->row();
		return $res;
	}

	public function insert_batch()
	{
		 
		$s_data = array(
			"m_batch_number" => $this->input->post('m_batch_number'),
			"m_batch_pro_id" => $this->input->post('m_batch_pro_id'),
			"m_batch_quantity" => $this->input->post('m_batch_quantity'),
			"m_batch_date" => $this->input->post('m_batch_date'),
			"m_batch_expiry" => $this->input->post('m_batch_expiry'),
			"m_batch_ware_id" => $this->input->post('m_batch_ware_id'), 
			"m_batch_status" => $this->input->post('m_batch_status'), 
			"m_batch_addedon" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_batch_id');
		if (!empty($id)) { 
			$this->db->where('m_batch_id', $id)->update('master_batch_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_batch_tbl', $s_data);
			return 1;
		}
	}

	public function delete_batch()
	{
		$this->db->where('m_batch_id', $this->input->post('delete_id'));
		return $this->db->delete('master_batch_tbl');
	}

}
