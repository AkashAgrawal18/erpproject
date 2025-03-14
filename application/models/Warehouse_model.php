<?php date_default_timezone_set('Asia/Kolkata');
class Warehouse_model extends CI_model
{


  //========================== Warehouse  =============================//
  public function get_all_warehouse()
  {
    $this->db->select('*');
    $this->db->order_by('m_ware_id','desc');
    $res = $this->db->get('master_warehouses_tbl')->result();
    return $res;
  }
  public function get_edit_warehouse($edid)
  {
    $this->db->select('*');
    $this->db->where('m_ware_id', $edid);
    $res = $this->db->get('master_warehouses_tbl')->row();
    return $res;
  }
  public function insert_warehouse()
  {
    $id = $this->input->post('m_ware_id');
    $name = $this->input->post('m_ware_name');
    $check = $this->db->where('m_ware_name', $name)->where('m_ware_id !=', $id)->get('master_warehouses_tbl')->num_rows();
    if ($check > 0) {
      return 3;
    }
    $s_data = array(
      "m_ware_name" => $name,
      "m_ware_location" => $this->input->post('m_ware_location'),
      "m_ware_status" => $this->input->post('m_ware_status'), 
			"m_ware_addedon"=> date('Y-m-d H:i'),
    );
    if (!empty($id)) {
      $this->db->where('m_ware_id', $id)->update('master_warehouses_tbl', $s_data);
      return 2;
    } else {
      $this->db->insert('master_warehouses_tbl', $s_data);
      return 1;
    }
  }

  public function delete_warehouse()
  {
    $this->db->where('m_ware_id', $this->input->post('delete_id'));
    return $this->db->delete('master_warehouses_tbl');
  }
  //========================== Warehouse  =============================//




}
