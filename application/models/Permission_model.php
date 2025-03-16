<?php date_default_timezone_set('Asia/Kolkata');
class Permission_model extends CI_model
{

	
	
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
	 
	public function rolls_permission_list(){
		$this->db->select('dept.m_dept_name,dept.m_dept_id,dept.m_dept_status');
		$this->db->where('m_dept_type', 5);
		$this->db->where('m_dept_status', 1);
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl dept')->result();
		return $res;
	}
	public function user_details($id){
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

  // public function insertuserperm()
  // {

  //   $m_userperm_permId = $this->input->post('m_userperm_permId');
  //   $m_userperm_userId = $this->input->post('m_userperm_userId');
  //   $m_userperm_module = $this->input->post('m_userperm_module');
  //   $m_userperm_submodule = $this->input->post('m_userperm_submodule');
  //   $m_userperm_list = $this->input->post('m_userperm_list');
  //   $m_userperm_add = $this->input->post('m_userperm_add');
  //   $m_userperm_edit = $this->input->post('m_userperm_edit');
  //   $m_userperm_delete = $this->input->post('m_userperm_delete');
  //   $m_userperm_export = $this->input->post('m_userperm_export');
  //   $m_userperm_filter = $this->input->post('m_userperm_filter');

  //   for ($i = 0; $i < count($m_userperm_permId); $i++) {
  //     if (!empty($m_userperm_list[$i]) || !empty($m_userperm_add[$i]) || !empty($m_userperm_edit[$i]) || !empty($m_userperm_delete[$i]) || !empty($m_userperm_export[$i]) || !empty($m_userperm_filter[$i])) {

  //       if (!empty($m_userperm_list[$i])) {
  //         $userperm_list = 1;
  //       } else {
  //         $userperm_list = 0;
  //       }

  //       if (!empty($m_userperm_add[$i])) {
  //         $userperm_add = 1;
  //       } else {
  //         $userperm_add = 0;
  //       }

  //       if (!empty($m_userperm_edit[$i])) {
  //         $userperm_edit = 1;
  //       } else {
  //         $userperm_edit = 0;
  //       }

  //       if (!empty($m_userperm_delete[$i])) {
  //         $userperm_delete = 1;
  //       } else {
  //         $userperm_delete = 0;
  //       }

  //       if (!empty($m_userperm_export[$i])) {
  //         $userperm_export = 1;
  //       } else {
  //         $userperm_export = 0;
  //       }

  //       if (!empty($m_userperm_filter[$i])) {
  //         $userperm_filter = 1;
  //       } else {
  //         $userperm_filter = 0;
  //       }
  //       $insert_data = array(
  //         "m_userperm_userId"    => $m_userperm_userId,
  //         "m_userperm_module"    => $m_userperm_module[$i],
  //         "m_userperm_submodule"    => $m_userperm_submodule[$i],
  //         "m_userperm_permId"    => $m_userperm_permId[$i],
  //         "m_userperm_list"    => $userperm_list,
  //         "m_userperm_add"    => $userperm_add,
  //         "m_userperm_edit"    => $userperm_edit,
  //         "m_userperm_delete"    => $userperm_delete,
  //         "m_userperm_export"    => $userperm_export,
  //         "m_userperm_filter"    => $userperm_filter,
  //         "m_userperm_added_on" => date('Y-m-d H:i:s'),

  //       );
  //       $this->db->insert('master_user_permission_tbl', $insert_data);
  //     }
  //   }

  //   //  return $indata ;

  // }


  public function get_userperm_userId($id)
  {
    $this->db->select('*');
    $this->db->where('m_userperm_userId', $id);
    $this->db->order_by('m_userperm_module')->order_by('m_userperm_permId');
    $data = $this->db->get('master_user_permission_tbl');
    return $data->result();
  }

  // public function delete_userperm()
  // {
  //   $this->db->where('m_userperm_id', $this->input->post('delete_id'));
  //   $this->db->delete('master_user_permission_tbl');
  //   return true;
  // }
  //===================== userperm =======================//



}
