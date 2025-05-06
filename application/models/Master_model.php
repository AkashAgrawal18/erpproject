<?php date_default_timezone_set('Asia/Kolkata');
class Master_model extends CI_model
{


  //========================== State  =============================//
  public function get_all_state()
  {
    $this->db->select('*');
    $this->db->order_by('m_state_id', 'desc');
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
    $this->db->order_by('m_city_id', 'desc');
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
    $this->db->select('city.m_city_name,city.m_city_id,m_city_state,state.m_state_name');
    $this->db->join('master_state_tbl state', 'state.m_state_id = city.m_city_state', 'left');
    $this->db->where('m_city_status', '1');
    $this->db->order_by('m_city_name');
    $res = $this->db->get('master_city_tbl city')->result();
    return $res;
  }


  public function get_city($m_state)
  {
    $sql = $this->db->join("master_state_tbl", "master_state_tbl.m_state_id= master_city_tbl.m_city_state");
    if ($m_state != '') {
      $sql = $this->db->where('m_city_state', $m_state);
    }
    $sql = $this->db->get('master_city_tbl');
    $res = $sql->result();
    return $res;
  }
  //=========================================== city ===============================================//
  //========================== Area  =============================//

  public function get_all_area($type)
  {
    $this->db->select('master_area_tbl.*,state.m_state_name as state_name,city.m_city_name as city_name,area.m_area_name as area_name');
    $this->db->join('master_state_tbl state', 'state.m_state_id = master_area_tbl.m_area_state', 'left');
    $this->db->join('master_city_tbl city', 'city.m_city_id = master_area_tbl.m_area_city', 'left');
    $this->db->join('master_area_tbl area', 'area.m_area_id = master_area_tbl.m_area_area', 'left');
    $this->db->where('master_area_tbl.m_area_type',$type);
    $this->db->order_by('master_area_tbl.m_area_name');
    $res = $this->db->get('master_area_tbl')->result();
    return $res;
  }
  public function get_edit_area($edid)
  {
    $this->db->select('*');
    $this->db->where('m_area_id', $edid);
    $res = $this->db->get('master_area_tbl')->row();
    return $res;
  }

  public function insert_area()
  {
    $id = $this->input->post('m_area_id');
    $area = $this->input->post('m_area_name');
    $state_id = $this->input->post('m_area_state');
    $city_id = $this->input->post('m_area_city');
    $area_id = $this->input->post('m_area_area');
    $type = $this->input->post('m_area_type');
    $check = $this->db->where('m_area_name', $area)->where('m_area_state', $state_id)->where('m_area_city', $city_id)->where('m_area_area', $area_id)->where('m_area_type', $type)->where('m_area_id !=', $id)->get('master_area_tbl')->num_rows();
    if ($check > 0) {
      return 3;
    }
    $s_data = array(
      "m_area_name" => $area,
      "m_area_state" => $state_id,
      "m_area_city" => $city_id,
      "m_area_area" => $area_id,
      "m_area_type" => $type,
      "m_area_status" => $this->input->post('m_area_status'),
    );
    if (!empty($id)) {
      $this->db->where('m_area_id', $id)->update('master_area_tbl', $s_data);
      return 2;
    } else {
      $s_data['m_area_addedon'] = date('Y-m-d H:i');
      $this->db->insert('master_area_tbl', $s_data);
      return 1;
    }
  }

  public function delete_area()
  {
    $this->db->where('m_area_id', $this->input->post('delete_id'));
    return $this->db->delete('master_area_tbl');
  }
 
  public function get_active_area($type)
  {
    $this->db->select('*');
    $this->db->where('m_area_type',$type);
    $this->db->where('m_area_status',1);
    $this->db->order_by('m_area_name');
    $res = $this->db->get('master_area_tbl')->result();
    return $res;
  }

  //=========================================== area ===============================================//




  //===================== perm =======================//
  public function all_perm()
  {
    $res = $this->db->select('*')->order_by('m_perm_module_slug')->order_by('m_perm_id')->get('master_permission_tbl')->result();
    return $res;
  }

  public function insert_perm()
  {

    $permid = $this->input->post('m_perm_id');
    $permname = $this->input->post('m_perm_submodule_slug');

    $check = $this->db->where('m_perm_submodule_slug', $permname)->get('master_permission_tbl')->result();

    if (!empty($check) && empty($permid)) {

      return false;
    } else {
      $insert_data = array(
        "m_perm_name"    => $this->input->post('m_perm_name'),
        "m_perm_status"    => $this->input->post('m_perm_status'),
        "m_perm_module"    => $this->input->post('m_perm_module'),
        "m_perm_module_slug"    => $this->input->post('m_perm_module_slug'),
        "m_perm_submodule_slug"    => $permname,
        "m_perm_added_on" => date('Y-m-d H:i:s'),

      );

      if (!empty($permid)) {
        $this->db->where('m_perm_id', $permid)->update('master_permission_tbl', $insert_data);
        return 2;
      } else {
        $this->db->insert('master_permission_tbl', $insert_data);
        return 1;
      }
    }
  }


  public function get_edit_perm($id)
  {
    $this->db->select('*');
    $this->db->where('m_perm_id', $id);
    $data = $this->db->get('master_permission_tbl');
    return $data->row();
  }

  public function delete_perm()
  {
    $this->db->where('m_perm_id', $this->input->post('delete_id'));
    $this->db->delete('master_permission_tbl');
    return true;
  }
  //===================== perm =======================//


  //===================== userperm =======================//

  public function rolls_permission_list()
  {
    $this->db->select('dept.m_dept_name,dept.m_dept_id,dept.m_dept_status');
    $this->db->where('m_dept_type', 5);
    $this->db->where('m_dept_status', 1);
    $this->db->order_by('m_dept_name');
    $res = $this->db->get('master_department_tbl dept')->result();
    return $res;
  }
  public function user_details($id)
  {
    $this->db->select('*');
    $this->db->where('m_emp_id', $id);
    $data = $this->db->get('master_employee_tbl');
    return $data->row();
  }
  public function all_userperm_list()
  {
    $res = $this->db->select('*')->get('master_user_permission_tbl')->result();
    return $res;
  }

  public function insert_userperm()
  {

    $permid = $this->input->post('permid');
    $modulee = $this->input->post('modulee');
    $submodule = $this->input->post('submodule');
    $userpermid = $this->input->post('userpermid');
    $userid = $this->input->post('userid');
    $name = $this->input->post('name');
    $value = $this->input->post('value');

    $check = $this->db->select('m_userperm_id')->where('m_userperm_userId', $userid)->where('m_userperm_module', $modulee)->where('m_userperm_submodule', $submodule)->where('m_userperm_permId', $permid)->where('m_userperm_id !=', $userpermid)->get('master_user_permission_tbl')->row();

    if (!empty($check)) {
      $userpermid = $check->m_userperm_id;
    }

    $insert_data = array(
      "m_userperm_userId"    => $userid,
      "m_userperm_module"    => $modulee,
      "m_userperm_submodule"    => $submodule,
      "m_userperm_permId"    => $permid,
      $name    => $value,

    );

    if (!empty($userpermid)) {
      $this->db->where('m_userperm_id', $userpermid)->update('master_user_permission_tbl', $insert_data);
      return 2;
    } else {
      $insert_data["m_userperm_added_on"] = date('Y-m-d H:i:s');
      $this->db->insert('master_user_permission_tbl', $insert_data);
      return 1;
    }
  }


  public function get_userperm_userId($id)
  {
    $this->db->select('*');
    $this->db->where('m_userperm_userId', $id);
    $this->db->order_by('m_userperm_module')->order_by('m_userperm_permId');
    $data = $this->db->get('master_user_permission_tbl');
    return $data->result();
  }

  public function all_permission_userperm($userid)
  {
    $all_perm = $this->db->select('*')->order_by('m_perm_id')->get('master_permission_tbl')->result();
    if(!empty($all_perm)){
      foreach ($all_perm as $value) {
       
        $check = $this->db->select('m_userperm_id')->where('m_userperm_userId', $userid)->where('m_userperm_module', $value->m_perm_module_slug)->where('m_userperm_submodule', $value->m_perm_submodule_slug)->where('m_userperm_permId', $value->m_perm_id)->get('master_user_permission_tbl')->row();

        if (!empty($check)) {
          $userpermid = $check->m_userperm_id;
        }
    
        $insert_data = array(
          "m_userperm_userId"    => $userid,
          "m_userperm_module"    => $value->m_perm_module_slug,
          "m_userperm_submodule"    => $value->m_perm_submodule_slug,
          "m_userperm_permId"    => $value->m_perm_id,
          "m_userperm_list"    => 1,
          "m_userperm_add"    => 1,
          "m_userperm_edit"    => 1,
          "m_userperm_delete"    => 1,
          "m_userperm_export"    => 1,
          "m_userperm_filter"    => 1,
          "m_userperm_status"    => 1,
       
        );
    
        if (!empty($userpermid)) {
          $this->db->where('m_userperm_id', $userpermid)->update('master_user_permission_tbl', $insert_data);
        } else {
          $insert_data["m_userperm_added_on"] = date('Y-m-d H:i:s');
          $this->db->insert('master_user_permission_tbl', $insert_data);
        }

      }
    }
   return true;
  }

  //===================== userperm =======================//





}
