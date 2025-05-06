<?php date_default_timezone_set('Asia/Kolkata');
class Lead_model extends CI_model
{
	//========================== Status  =============================//
	public function get_status_list($type, $status = '')
	{
		$this->db->select('*');
		if (!empty($status)) {
			$this->db->where('m_status_status', $status);
		}
		$this->db->order_by('m_status_order');
		$res = $this->db->where('m_status_type', $type)->get('master_status_tbl')->result();
		return $res;
	}
	public function get_status_dtl($edid)
	{
		$this->db->select('*');
		$this->db->where('m_status_id', $edid);
		$res = $this->db->get('master_status_tbl')->row();
		return $res;
	}
	public function insert_status()
	{
		$id = $this->input->post('m_status_id');
		$status_name = $this->input->post('m_status_name');
		$status_type = $this->input->post('m_status_type');
		$check = $this->db->where('m_status_name', $status_name)->where('m_status_type', $status_type)->where('m_status_id !=', $id)->get('master_status_tbl')->num_rows();
		if ($check > 0) {
			return 3;
		}
		$s_data = array(
			"m_status_name" => $status_name,
			"m_status_type " => $status_type,
			"m_status_order" => $this->input->post('m_status_order'),
			"m_status_followup" => $this->input->post('m_status_followup') ?: 0,
			"m_status_status" => $this->input->post('m_status_status'),
			"m_status_added_on" => date('Y-m-d H:i'),
		);
		if (!empty($id)) {
			$this->db->where('m_status_id', $id)->update('master_status_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_status_tbl', $s_data);
			return 1;
		}
	}


	public function delete_status()
	{
		$this->db->where('m_status_id', $this->input->post('delete_id'));
		return $this->db->delete('master_status_tbl');
	}
	//========================== Status  =============================//

	//========================== Leads  =============================//
	public function get_all_lead()
	{
		$this->db->select('master_lead_tbl.*,m_state_name,m_city_name,addedby.m_emp_name as added_by,assigned.m_emp_name as assigned_to,status.m_status_name as status_name,source.m_status_name as source_name,(Case when m_lead_type = 1 then "Customer" when m_lead_type = 2 then "Dealer" when m_lead_type = 3 then "Retailer" when m_lead_type = 4 then "Supplier" Else "Wholeseller" end) as lead_type')
			->join('master_state_tbl', 'master_state_tbl.m_state_id = master_lead_tbl.m_lead_state', 'left')
			->join('master_city_tbl', 'master_city_tbl.m_city_id = master_lead_tbl.m_lead_city', 'left')
			->join('master_status_tbl status', 'status.m_status_id = master_lead_tbl.m_lead_status', 'left')
			->join('master_status_tbl source', 'source.m_status_id = master_lead_tbl.m_lead_source', 'left')
			->join('master_employee_tbl addedby', 'addedby.m_emp_id = master_lead_tbl.m_lead_addedby', 'left')
			->join('master_employee_tbl assigned', 'assigned.m_emp_id = master_lead_tbl.m_lead_assigned', 'left')
			->order_by('m_lead_id', 'desc');
		return $this->db->get('master_lead_tbl')->result();
	}

	public function get_lead_details($leadid)
	{
		$this->db->select('master_lead_tbl.*,m_state_name,m_city_name,addedby.m_emp_name as added_by,assigned.m_emp_name as assigned_to,status.m_status_name as status_name,source.m_status_name as source_name,(Case when m_lead_type = 1 then "Customer" when m_lead_type = 2 then "Dealer" when m_lead_type = 3 then "Retailer" when m_lead_type = 4 then "Supplier" Else "Wholeseller" end) as lead_type')
			->join('master_state_tbl', 'master_state_tbl.m_state_id = master_lead_tbl.m_lead_state', 'left')
			->join('master_city_tbl', 'master_city_tbl.m_city_id = master_lead_tbl.m_lead_city', 'left')
			->join('master_status_tbl status', 'status.m_status_id = master_lead_tbl.m_lead_status', 'left')
			->join('master_status_tbl source', 'source.m_status_id = master_lead_tbl.m_lead_source', 'left')
			->join('master_employee_tbl addedby', 'addedby.m_emp_id = master_lead_tbl.m_lead_addedby', 'left')
			->join('master_employee_tbl assigned', 'assigned.m_emp_id = master_lead_tbl.m_lead_assigned', 'left')
			->where('m_lead_id', $leadid);
		return $this->db->get('master_lead_tbl')->row();
	}

	public function get_edit_lead($edid)
	{
		return $this->db->select('*')->where('m_lead_id', $edid)->get('master_lead_tbl')->row();
	}

	public function insert_lead()
	{

		$s_data = array(
			"m_lead_name" => $this->input->post('m_lead_name'),
			"m_lead_type" => $this->input->post('m_lead_type'),
			"m_lead_mobile" => $this->input->post('m_lead_mobile'),
			"m_lead_source" => $this->input->post('m_lead_source'),
			"m_lead_contname" => $this->input->post('m_lead_contname'),
			"m_lead_area" => $this->input->post('m_lead_area'),
			"m_lead_subarea" => $this->input->post('m_lead_subarea'),
			"m_lead_city" => $this->input->post('m_lead_city'),
			"m_lead_state" => $this->input->post('m_lead_state'),
			"m_lead_address" => $this->input->post('m_lead_address'),
			"m_lead_assigned" => $this->input->post('m_lead_assigned') ?: '',
			"m_lead_status" => $this->input->post('m_lead_status') ?: 1,

		);
		$id = $this->input->post('m_lead_id');
		if (!empty($id)) {
			$s_data['m_lead_updatedby'] = $this->session->userdata('user_id');
			$s_data['m_lead_updatedon'] = date('Y-m-d H:i');
			$this->db->where('m_lead_id', $id)->update('master_lead_tbl', $s_data);
			return 2;
		} else {
			$s_data['m_lead_addedby'] = $this->session->userdata('user_id');
			$s_data['m_lead_addedon'] = date('Y-m-d H:i');
			$this->db->insert('master_lead_tbl', $s_data);
			return 1;
		}
	}

	public function delete_lead()
	{
		$this->db->where('m_lead_id', $this->input->post('delete_id'));
		return $this->db->delete('master_lead_tbl');
	}
	//========================== Leads  =============================//
	//========================== follow up  =============================//
	public function get_all_followup()
	{
		$this->db->select('followup.*,lead.m_lead_name,lead.m_lead_mobile,addedby.m_emp_name as added_by,assigned.m_emp_name as assigned_to,status.m_status_name as status_name,product.m_pro_name')
			->join('master_lead_tbl lead', 'lead.m_lead_id = followup.m_follow_lead', 'left')
			->join('master_product_tbl product', 'product.m_pro_id = followup.m_follow_product', 'left')
			->join('master_status_tbl status', 'status.m_status_id = followup.m_follow_status', 'left')
			->join('master_employee_tbl addedby', 'addedby.m_emp_id = followup.m_follow_addedby', 'left')
			->join('master_employee_tbl assigned', 'assigned.m_emp_id = followup.m_follow_assigned', 'left')
			->order_by('m_follow_id', 'desc');
		return $this->db->get('master_followup_tbl followup')->result();
	}
	public function get_lead_followup($lead_id)
	{
		return $this->db->select('followup.*,addedby.m_emp_name as added_by,assigned.m_emp_name as assigned_to,status.m_status_name as status_name,product.m_pro_name')
			->join('master_product_tbl product', 'product.m_pro_id = followup.m_follow_product', 'left')
			->join('master_status_tbl status', 'status.m_status_id = followup.m_follow_status', 'left')
			->join('master_employee_tbl addedby', 'addedby.m_emp_id = followup.m_follow_addedby', 'left')
			->join('master_employee_tbl assigned', 'assigned.m_emp_id = followup.m_follow_assigned', 'left')
			->where('m_follow_lead', $lead_id)->order_by('m_follow_id', 'desc')->get('master_followup_tbl followup')->result();
	}
	public function get_edit_followup($edid)
	{
		return $this->db->select('*')->where('m_follow_id', $edid)->get('master_followup_tbl')->row();
	}

	public function insert_followup()
	{
		$s_data = array(
			"m_follow_lead" => $this->input->post('m_follow_lead'),
			"m_follow_date" => $this->input->post('m_follow_date'),
			"m_follow_sample" => $this->input->post('m_follow_sample'),
			"m_follow_piece" => $this->input->post('m_follow_piece'),
			"m_follow_product" => $this->input->post('m_follow_product'),
			"m_follow_next" => $this->input->post('m_follow_next'),
			"m_follow_remark" => $this->input->post('m_follow_remark'),
			"m_follow_assigned" => $this->input->post('m_follow_assigned'),
			"m_follow_status" => $this->input->post('m_follow_status'),

		);
		$id = $this->input->post('m_follow_id');
		if (!empty($id)) {
			$s_data['m_follow_updatedby'] = $this->session->userdata('user_id');
			$s_data['m_follow_updatedon'] = date('Y-m-d H:i');
			$this->db->where('m_follow_id', $id)->update('master_followup_tbl', $s_data);
			$res = 2;
		} else {
			$s_data['m_follow_addedby'] = $this->session->userdata('user_id');
			$s_data['m_follow_addedon'] = date('Y-m-d H:i');
			$this->db->insert('master_followup_tbl', $s_data);
			$res = 1;
		}
		$this->db->set('m_lead_status', $this->input->post('m_follow_status'))->where('m_lead_id', $this->input->post('m_follow_lead'))->update('master_lead_tbl');
		return $res;
	}

	public function delete_followup()
	{
		$this->db->where('m_follow_id', $this->input->post('delete_id'));
		return $this->db->delete('master_followup_tbl');
	}
	//========================== follow up  =============================//

	//========================== Transfer lead  =============================//
	public function get_leadtrans_list($lead = '', $from = '', $to = '', $status = '')
	{
		$this->db->select('leadtrans.*,from.m_emp_name as transfrom,to.m_emp_name as transto,addedby.m_emp_name as addedby,m_lead_name,m_lead_type,m_lead_mobile,m_lead_source,status._m_status_name as status_name')
			->join('master_lead_tbl lead', 'lead.m_lead_id = leadtrans.l_trans_lead', 'left')
			->join('master_status_tbl status', 'status.m_status_id = leadtrans.l_trans_status', 'left')
			->join('master_employee_tbl from', 'from.m_emp_id = leadtrans.l_trans_from', 'left')
			->join('master_employee_tbl to', 'to.m_emp_id = leadtrans.l_trans_to', 'left')
			->join('master_employee_tbl addedby', 'addedby.m_emp_id = leadtrans.l_trans_addedby', 'left');
		if (!empty($lead)) {
			$this->db->where('l_trans_lead', $lead);
		}
		if (!empty($from)) {
			$this->db->where('l_trans_from', $from);
		}
		if (!empty($to)) {
			$this->db->where('l_trans_to', $to);
		}
		if (!empty($status)) {
			$this->db->where('l_trans_status', $status);
		}
		$this->db->order_by('l_trans_id', 'desc');
		$res = $this->db->get('lead_transfer_tbl leadtrans')->result();
		return $res;
	}

	public function insert_leadtrans()
	{
		$s_data = array(
			"l_trans_lead " => $this->input->post('l_trans_lead'),
			"l_trans_from" => $this->input->post('l_trans_from'),
			"l_trans_to" => $this->input->post('l_trans_to'),
			"l_trans_status" => $this->input->post('l_trans_status'),
			"l_trans_remark" => $this->input->post('l_trans_remark'),
			"l_trans_addedby" => $this->session->userdata('user_id'),
			"l_trans_addedon" => date('Y-m-d H:i'),
		);

		$this->db->insert('lead_transfer_tbl', $s_data);
	}


	public function delete_leadtrans()
	{
		$this->db->where('l_trans_id', $this->input->post('delete_id'));
		return $this->db->delete('lead_transfer_tbl');
	}
	//========================== Lead Transfer  =============================//

}
