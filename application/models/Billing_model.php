<?php date_default_timezone_set('Asia/Kolkata');
class Billing_model extends CI_model
{


//========================== entity  =============================//

		public function get_all_entity()
		{
			$this->db->select('*');
			$this->db->order_by('m_entity_id', 'desc');
			$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = master_entities_tbl.m_entity_type', 'left');
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
			$s_data = array(
				"m_entity_name" => $this->input->post('m_entity_name'),
				"m_entity_type" => $this->input->post('m_entity_type'),
				"m_entity_mobile" => $this->input->post('m_entity_mobile'),
				"m_entity_address" => $this->input->post('m_entity_address'),
				"m_entity_status" => $this->input->post('m_entity_status'), 
				"m_entity_addedon" => date('Y-m-d H:i'),
			);
			// print_r($s_data); die();
			$id = $this->input->post('m_entity_id');
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
 ///===============stock tansfer=========================///
 public function get_batch_list(){
	$this->db->select('*');
	$this->db->order_by('m_batch_id', 'desc');
	$res = $this->db->get('master_batch_tbl')->result();
	return $res;
 }

 public function get_all_warehouse(){
	$this->db->select('*');
	$this->db->order_by('m_ware_id', 'desc');
	$res = $this->db->get('master_warehouses_tbl')->result();
	return $res;
 }

 public function insert_stock_transfe()
 { 
	 $s_data = array(
		 "stk_trans_batch" =>  implode(',', $this->input->post('stk_trans_batch')),
		 "stk_trans_from" => $this->input->post('stk_trans_from'),
		 "stk_trans_to" => $this->input->post('stk_trans_to'),
		 "stk_trans_entity" => $this->input->post('stk_trans_entity'),
		 "stk_trans_qty" =>  $this->input->post('stk_trans_qty'),
		 "stk_trans_date" => $this->input->post('stk_trans_date'), 
		 "stk_trans_remark" => $this->input->post('stk_trans_remark'), 
		 "stk_trans_status" => $this->input->post('stk_trans_status'), 
		 "stk_trans_addedon" => date('Y-m-d H:i'),
	 );
	//  print_r($s_data); die();
	 $id = $this->input->post('stk_trans_id');
	 if (!empty($id)) {
		 $this->db->where('stk_trans_id', $id)->update('stock_transfers', $s_data);
		 return 2;
	 } else {
		 $this->db->insert('stock_transfers', $s_data);
		 return 1;
	 }
 }

 public function get_all_stocktransf(){
	
 }

 public function delete_stock_transfe()
 {
	 $this->db->where('stk_trans_id', $this->input->post('delete_id'));
	 return $this->db->delete('stock_transfers');
 }

}
