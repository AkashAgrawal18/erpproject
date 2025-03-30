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
				"m_catsub_id" => $this->input->post('m_catsub_id')?: '',
				"m_cat_img" => $m_cat_img ?: '',
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

		
	//========================== Product  =============================//

	public function get_all_product($status = '')
	{
		if (!empty($status)) {
			$this->db->where('m_pro_status', $status);
		}
		$this->db->select('master_product_tbl.*,cate.m_cat_name as category_name,subcate.m_cat_name as subcategory_name,pkg.m_cat_name as package_name,size.m_cat_name as size_name,brand.m_cat_name as brand_name');
		$this->db->join('master_cate_tbl as cate', 'master_product_tbl.m_pro_cate = cate.m_cat_id');
		$this->db->join('master_cate_tbl as subcate', 'master_product_tbl.m_pro_subcate = subcate.m_cat_id');
		$this->db->join('master_cate_tbl as pkg', 'master_product_tbl.m_pro_pack = pkg.m_cat_id');
		$this->db->join('master_cate_tbl as size', 'master_product_tbl.m_pro_size = size.m_cat_id');
		$this->db->join('master_cate_tbl as brand', 'master_product_tbl.m_pro_brand = brand.m_cat_id');
		$this->db->order_by('m_pro_id', 'desc');
		$res = $this->db->get('master_product_tbl')->result();
		return $res;
	}
	public function get_edit_product($edid)
	{
		$this->db->select('*');
		$this->db->where('m_pro_id', $edid);
		$res = $this->db->get('master_product_tbl')->row();
		return $res;
	}

	public function insert_product()
	{
		if (!empty($_FILES['m_pro_pic']['name'])) {

			$name1 = $_FILES['m_pro_pic']['name'];
			$fileNameParts = explode(".", $name1); // explode file name to two part
			$fileExtension = end($fileNameParts); // give extension
			$fileExtension = strtolower($fileExtension);
			$encripted_pic_name = md5(microtime() . $name1) . '.' . $fileExtension;
			$config['file_name'] = $encripted_pic_name;
			$config['file_name'] = $_FILES['m_pro_pic']['name'];
			$config['upload_path'] = 'uploads/productimg/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_pro_pic']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('m_pro_pic')) {
				$uploadData = $this->upload->data();
				if (!empty($update_data['m_pro_pic'])) {
					if (file_exists($config['m_pro_pic'] . $update_data['m_pro_pic'])) {
						unlink($config['upload_path'] . $update_data['m_pro_pic']); /* deleting Image */
					}
				}
				$m_pro_pic = $uploadData['file_name'];
			}
		} else {
			$m_pro_pic = $this->input->post('proimg');
		}
		$s_data = array(
			"m_pro_name" => $this->input->post('m_pro_name'),
			"m_pro_cate" => $this->input->post('m_pro_cate'),
			"m_pro_subcate" => $this->input->post('m_pro_subcate'),
			"m_pro_pack" => $this->input->post('m_pro_pack'),
			"m_pro_size" => $this->input->post('m_pro_size'),
			"m_pro_brand" => $this->input->post('m_pro_brand'),
			"m_pro_pic" => $m_pro_pic,
			// "m_pro_price" => $this->input->post('m_pro_price'),
			"m_pro_desc" => $this->input->post('m_pro_desc'),
			"m_pro_status" => $this->input->post('m_pro_status'), 
			"m_pro_addedon" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_pro_id');
		if (!empty($id)) {
			$this->db->where('m_pro_id', $id)->update('master_product_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_product_tbl', $s_data);
			return 1;
		}
	}

	public function delete_product()
	{
		$this->db->where('m_pro_id', $this->input->post('delete_id'));
		return $this->db->delete('master_product_tbl');
	}
	
	public function get_cate_list()
	{
		// $this->db->where('m_login_type!=', 1);
		$this->db->where('m_cat_type', 1); 
		$res = $this->db->get('master_cate_tbl')->result();
		return $res;
	}
	public function get_sucat_list()
	{
		// $this->db->where('m_login_type!=', 1);
		$this->db->where('m_cat_type', 2); 
		$res = $this->db->get('master_cate_tbl')->result();
		return $res;
	}
	public function get_pack_list()
	{
		// $this->db->where('m_login_type!=', 1);
		$this->db->where('m_cat_type', 3); 
		$res = $this->db->get('master_cate_tbl')->result();
		return $res;
	}
	public function get_size_list()
	{
		// $this->db->where('m_login_type!=', 1);
		$this->db->where('m_cat_type', 4); 
		$res = $this->db->get('master_cate_tbl')->result();
		return $res;
	}
	public function get_brand_list()
	{
		// $this->db->where('m_login_type!=', 1);
		$this->db->where('m_cat_type', 5); 
		$res = $this->db->get('master_cate_tbl')->result();
		return $res;
	}

	//========================== product  =============================//


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
			"m_batch_mrp" => $this->input->post('m_batch_mrp'), 
			"m_batch_price" => $this->input->post('m_batch_price'), 
			"m_batch_balqty" => $this->input->post('m_batch_quantity'), 
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

	
	//////////////////////////////batch///////////////////////////////

	
	public function get_stock_list(){
		$this->db->select('*');
		$this->db->order_by('m_pro_id', 'asc');
		$this->db->join('master_batch_tbl', 'master_batch_tbl.m_batch_pro_id = master_product_tbl.m_pro_id', 'left');
		$res = $this->db->get('master_product_tbl')->result();
		return $res;	
	}

}	
