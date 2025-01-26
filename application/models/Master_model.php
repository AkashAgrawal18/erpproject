<?php date_default_timezone_set('Asia/Kolkata');
class Master_model extends CI_model
{


  //========================== State  =============================//
  public function get_all_state()
  {
    $this->db->select('*');
    $this->db->order_by('m_state_id','desc');
    $res = $this->db->get('master_state_tbl')->result();
    return $res;
  }
  public function get_edit_state($edid)
  {
    $this->db->select('*');
    $this->db->where('m_state_id', $edid);
    $res = $this->db->get('master_state_tbl')->row();
    return $res;
  }
  public function insert_state()
  {
    $id = $this->input->post('m_state_id');
    $name = $this->input->post('m_state_name');
    $check = $this->db->where('m_state_name', $name)->where('m_state_id !=', $id)->get('master_state_tbl')->num_rows();
    if ($check > 0) {
      return 3;
    }
    $s_data = array(
      "m_state_name" => $name,
      "m_state_country" => 1,
      "m_state_status" => $this->input->post('m_state_status'), 
    );
    if (!empty($id)) {
      $this->db->where('m_state_id', $id)->update('master_state_tbl', $s_data);
      return 2;
    } else {
      $this->db->insert('master_state_tbl', $s_data);
      return 1;
    }
  }

  public function delete_state()
  {
    $this->db->where('m_state_id', $this->input->post('delete_id'));
    return $this->db->delete('master_state_tbl');
  }
  //========================== State  =============================//


  //========================== City  =============================//

  public function get_all_city()
  {
    $this->db->select('*');
    $this->db->join('master_state_tbl', 'master_state_tbl.m_state_id = master_city_tbl.m_city_state', 'left');
    $this->db->order_by('m_city_id','desc');
    $res = $this->db->get('master_city_tbl')->result();
    return $res;
  }
  public function get_edit_city($edid)
  {
    $this->db->select('*');
    $this->db->join('master_state_tbl', 'master_state_tbl.m_state_id = master_city_tbl.m_city_state', 'left');
    $this->db->where('m_city_id', $edid);
    $res = $this->db->get('master_city_tbl')->row();
    return $res;
  }

  public function insert_city()
  {
    $id = $this->input->post('m_city_id');
    $city = $this->input->post('m_city_name');
    $state_id = $this->input->post('m_city_state');
    $check = $this->db->where('m_city_name', $city)->where('m_city_state', $state_id)->where('m_city_id !=', $id)->get('master_city_tbl')->num_rows();
    if ($check > 0) {
      return 3;
    }
    $s_data = array(
      "m_city_name" => $city,
      "m_city_state" => $state_id, 
      "m_city_status" => $this->input->post('m_city_status'), 
    );
    if (!empty($id)) {
      $this->db->where('m_city_id', $id)->update('master_city_tbl', $s_data);
      return 2;
    } else {
      $this->db->insert('master_city_tbl', $s_data);
      return 1;
    }
  }

  public function insert_shortcut_city()
  {

    $check = $this->db->where("m_city_name", $this->input->post('m_city_name'))->where("m_city_state", $this->input->post('m_city_state'))->get('master_city_tbl')->row();

    if (empty($check)) {

      $s_data = array(
        "m_city_name" => $this->input->post('m_city_name'),
        "m_city_state" => $this->input->post('m_city_state'),
        "m_city_country" => 1,
        "m_city_status" => 1,
        "m_city_added_on" => date('Y-m-d H:i'),
      );

      $this->db->insert('master_city_tbl', $s_data);
      return $this->db->insert_id();
    } else {
      return $check->m_city_id;
    }
  }


  public function delete_city()
  {
    $this->db->where('m_city_id', $this->input->post('delete_id'));
    return $this->db->delete('master_city_tbl');
  }
  //Country State City
  public function get_active_country()
  {
    $this->db->select('*');
    $this->db->where('m_country_status', '1');
    $this->db->order_by('m_country_name');
    $res = $this->db->get('master_country_tbl')->result();
    return $res;
  }
  public function get_active_state()
  {
    $this->db->select('*');
    $this->db->where('m_state_status', '1'); 
    $this->db->order_by('m_state_name');
    $res = $this->db->get('master_state_tbl')->result();
    return $res;
  }
  public function get_active_city()
  {
    $this->db->select('city.m_city_name,city.m_city_id,state.m_state_name');
    $this->db->join('master_state_tbl state', 'state.m_state_id = city.m_city_state', 'left');
    $this->db->where('m_city_status', '1');
    $this->db->order_by('m_city_name');
    $res = $this->db->get('master_city_tbl city')->result();
    return $res;
  }
  //=========================================== city ===============================================//







}	
