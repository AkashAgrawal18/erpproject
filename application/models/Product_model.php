<?php date_default_timezone_set('Asia/Kolkata');
class Product_model extends CI_model
{


		//========================== Category  =============================//

		public function get_cate($type, $status = '')
		{
			$this->db->select('*');
			if (!empty($status)) {
				$this->db->where('m_cat_status', $status);
			}
			$this->db->order_by('m_cat_id', 'desc');
			$res = $this->db->where('m_cat_type', $type)->get('master_cate_tbl')->result();
			return $res;
		}
		public function getsubcate(){
			$this->db->select('*');		 
			$this->db->order_by('m_cat_id', 'desc');
			$res = $this->db->where('m_cat_type', 1)->get('master_cate_tbl')->result();
			return $res;
		}
		public function get_cate_dtl($edid)
		{
			$this->db->select('*');
			$this->db->where('m_cat_id', $edid);
			$res = $this->db->get('master_cate_tbl')->row();
			return $res;
		}
		public function insert_cate()
		{
			if (!empty($_FILES['m_cat_img']['name'])) {
	
				$name1 = $_FILES['m_cat_img']['name'];
				$fileNameParts = explode(".", $name1); // explode file name to two part
				$fileExtension = end($fileNameParts); // give extension
				$fileExtension = strtolower($fileExtension);
				$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
				$config['file_name'] = $encripted_pic_name;
				$config['file_name'] = $_FILES['m_cat_img']['name'];
				$config['upload_path'] = 'uploads/cate/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = $_FILES['m_cat_img']['name'];
				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('m_cat_img')) {
					$uploadData = $this->upload->data();
					if (!empty($update_data['m_cat_img'])) {
						if (file_exists($config['m_cat_img'] . $update_data['m_cat_img'])) {
							unlink($config['upload_path'] . $update_data['m_cat_img']); /* deleting Image */
						}
					}
					$m_cat_img = $uploadData['file_name'];
				}
			} else {
				$m_cat_img = $this->input->post('catimg');
			}
		
			$id = $this->input->post('m_cat_id');
			$cate_name = $this->input->post('m_cat_name');
			$cate_type = $this->input->post('m_cat_type');
		 
		
			// Check if category already exists
			$check = $this->db->where('m_cat_name', $cate_name)
							  ->where('m_cat_type', $cate_type)
							  ->where('m_cat_id !=', $id)
							  ->get('master_cate_tbl')
							  ->num_rows();
			
			if ($check > 0) {
				return 3;
			}
		
			$s_data = array(
				"m_cat_name" => $cate_name,
				"m_cat_status" => $this->input->post('m_cat_status'),
				"m_catsub_id" => $this->input->post('m_catsub_id'),
				"m_cat_img" => $m_cat_img,
				"m_cat_type" => $cate_type,
				"m_cat_addedon" => date('Y-m-d H:i'),
			);
		
			if (!empty($id)) {
				$this->db->where('m_cat_id', $id)->update('master_cate_tbl', $s_data);
				return 2;
			} else {
				$this->db->insert('master_cate_tbl', $s_data);
				return 1;
			}
		}
		
	
		public function delete_cate()
		{
			$this->db->where('m_cat_id', $this->input->post('delete_id'));
			return $this->db->delete('master_cate_tbl');
		}
	
		//========================== Category  =============================//


}	
