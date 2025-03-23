<?php date_default_timezone_set('Asia/Kolkata');
class Setting_model extends CI_model
{
	//============================User============================//

	//===========================Profile==========================//
	public function update_profile()
	{
		$update_data = array(
			"m_emp_name"    => $this->input->post('m_admin_name'),
			"m_emp_email"   => $this->input->post('m_admin_email'),
			// "m_admin_login_id"=> $this->input->post('m_admin_login_id'),
			"m_emp_password"    => $this->input->post('m_admin_pass'),
			"m_emp_mobile" => $this->input->post('m_admin_contact'),
			"m_emp_pic"     => $this->input->post('pre_m_admin_img'),

			"m_emp_laddress"     => $this->input->post('m_admin_address'),
			// "m_admin_state"     => $this->input->post('m_admin_state'),
			// "m_admin_city"     => $this->input->post('m_admin_city'),
			// "m_admin_pincode"     => $this->input->post('m_admin_pincode'),
		);

		if (!empty($_FILES['m_admin_img']['name'])) {

			$name1 = $_FILES['m_admin_img']['name'];
			$fileNameParts = explode(".", $name1); // explode file name to two part
			$fileExtension = end($fileNameParts); // give extension
			$fileExtension = strtolower($fileExtension);
			$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
			$config['file_name'] = $encripted_pic_name;
			$config['upload_path'] = 'uploads/emp/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_admin_img']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('m_admin_img')) {
				$uploadData = $this->upload->data();

				if (!empty($update_data['m_admin_img'])) {
					if (file_exists($config['upload_path'] . $update_data['m_admin_img'])) {
						unlink($config['upload_path'] . $update_data['m_admin_img']); /* deleting Image */
					}
				}

				$update_data['m_emp_pic'] = $uploadData['file_name'];
			}
		}

		// print_r($update_data); die();
		$this->db->where('m_emp_id', $this->session->userdata('user_id'));
		return $this->db->update('master_employee_tbl', $update_data);
	}



	public function get_application_settings()
	{
		$res = $this->db->get('application_settings')->result();
		return $res;
	}
	public function update_application_settings()
	{
		if (!empty($_FILES['m_app_logo']['name'])) {

			$name1 = $_FILES['m_app_logo']['name'];
			$fileNameParts = explode(".", $name1); // explode file name to two part
			$fileExtension = end($fileNameParts); // give extension
			$fileExtension = strtolower($fileExtension);
			$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
			$config['file_name'] = $encripted_pic_name;
			$config['file_name'] = $_FILES['m_app_logo']['name'];
			$config['upload_path'] = 'uploads/user/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_app_logo']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('m_app_logo')) {
				$uploadData = $this->upload->data();
				if (!empty($update_data['m_app_logo'])) {
					if (file_exists($config['m_app_logo'] . $update_data['m_app_logo'])) {
						unlink($config['upload_path'] . $update_data['m_app_logo']); /* deleting Image */
					}
				}
				$m_app_logo = $uploadData['file_name'];
			}
		} else {
			$m_app_logo = $this->input->post('applogo');
		}
		if (!empty($_FILES['m_app_icon']['name'])) {
			$name1 = $_FILES['m_app_icon']['name'];
			$fileNameParts = explode(".", $name1); // explode file name to two part
			$fileExtension = end($fileNameParts); // give extension
			$fileExtension = strtolower($fileExtension);
			$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
			$config['file_name'] = $encripted_pic_name;
			$config['file_name'] = $_FILES['m_app_icon']['name'];
			$config['upload_path'] = 'uploads/user/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_app_icon']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('m_app_icon')) {
				$uploadData = $this->upload->data();
				if (!empty($update_data['m_app_icon'])) {
					if (file_exists($config['m_app_icon'] . $update_data['m_app_icon'])) {
						unlink($config['upload_path'] . $update_data['m_app_icon']); /* deleting Image */
					}
				}
				$m_app_icon = $uploadData['file_name'];
			}
		} else {
			$m_app_icon = $this->input->post('appfavicon');
		}
		if (!empty($_FILES['m_app_black_logo']['name'])) {
			$name1 = $_FILES['m_app_black_logo']['name'];
			$fileNameParts = explode(".", $name1); // explode file name to two part
			$fileExtension = end($fileNameParts); // give extension
			$fileExtension = strtolower($fileExtension);
			$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
			$config['file_name'] = $encripted_pic_name;
			$config['file_name'] = $_FILES['m_app_black_logo']['name'];
			$config['upload_path'] = 'uploads/user/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_app_black_logo']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('m_app_black_logo')) {
				$uploadData = $this->upload->data();
				if (!empty($update_data['m_app_black_logo'])) {
					if (file_exists($config['m_app_black_logo'] . $update_data['m_app_black_logo'])) {
						unlink($config['upload_path'] . $update_data['m_app_black_logo']); /* deleting Image */
					}
				}
				$m_app_black_logo = $uploadData['file_name'];
			}
		} else {
			$m_app_black_logo = $this->input->post('app_black_logo');
		}

		if (!empty($_FILES['m_app_white_logo']['name'])) {
			$name1 = $_FILES['m_app_white_logo']['name'];
			$fileNameParts = explode(".", $name1); // explode file name to two part
			$fileExtension = end($fileNameParts); // give extension
			$fileExtension = strtolower($fileExtension);
			$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
			$config['file_name'] = $encripted_pic_name;
			$config['file_name'] = $_FILES['m_app_white_logo']['name'];
			$config['upload_path'] = 'uploads/user/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_app_white_logo']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('m_app_white_logo')) {
				$uploadData = $this->upload->data();
				if (!empty($update_data['m_app_white_logo'])) {
					if (file_exists($config['m_app_white_logo'] . $update_data['m_app_white_logo'])) {
						unlink($config['upload_path'] . $update_data['m_app_white_logo']); /* deleting Image */
					}
				}
				$m_app_white_logo = $uploadData['file_name'];
			}
		} else {
			$m_app_white_logo = $this->input->post('app_white_logo');
		}

		$data = array(
			"m_app_name" => $this->input->post('m_app_name'),
			// "m_app_title" => $this->input->post('m_app_title'),
			"m_app_email" => $this->input->post('m_app_mail'),
			"m_app_mobile" => $this->input->post('m_app_contact'),
			"m_app_alt_mobile" => $this->input->post('m_app_alt_contact'),
			"m_app_address" => $this->input->post('m_app_address'),
			"m_app_fb" => $this->input->post('m_app_fesbook'),
			"m_app_insta" => $this->input->post('m_app_instagram'),
			"m_app_youtube" => $this->input->post('m_app_youtude'),
			"m_app_linkedin" => $this->input->post('m_app_linkedin'),
			"m_app_whatsapp" => $this->input->post('m_app_whatsapp'),
			"m_app_twitter" => $this->input->post('m_app_twitter'),
			"m_app_logo" => "$m_app_logo",
			"m_app_icon" => "$m_app_icon",
			"m_app_black_logo" => "$m_app_black_logo",
			"m_app_white_logo" => "$m_app_white_logo",
		);
		// print_r($data);
		$this->db->where('m_app_id', 1);
		$this->db->update('application_settings', $data);
		return true;
	}
	//===========================/User============================//

	//--------clockin- clockout------------------// 

	public function insert_attendance($data)
	{
		return $this->db->insert('master_emp_attendance', $data);
	}
	public function update_attendance($employeeId, $data)
	{
		$this->db->where('m_emp_id', $employeeId);
		$this->db->where('m_date', date('Y-m-d'));
		$this->db->where('m_std_id', $this->get_std_id($employeeId));
		return $this->db->update('master_emp_attendance', $data);
	}

	public function get_last_status($employeeId)
{
    $this->db->select('m_status');
    $this->db->from('master_emp_attendance');
    $this->db->where('m_date', date('Y-m-d'));  
    $this->db->where('m_emp_id', $employeeId);
    $this->db->order_by('m_std_id', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get();
    
    return $query->row();
}

	public function get_std_id($employeeId)
	{
		$this->db->select('m_std_id');
		$this->db->from('master_emp_attendance');
		$this->db->where('m_emp_id', $employeeId);
		$this->db->order_by('m_std_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		return $result ? $result->m_std_id : null;
	}
}
