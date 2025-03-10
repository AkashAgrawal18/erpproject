<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Product extends CI_Controller
{

	//-------------------------- category ------------------------//
	public function category_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Category List";
		$data['cattype'] = 1;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Product_model->get_cate($data['cattype']);
		$data['edit_value'] = $this->Product_model->get_cate_dtl($data['id']);
		$this->load->view('cate_list', $data);
	}

	public function sub_category_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Sub Category List";
		$data['cattype'] = 2;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Product_model->get_cate($data['cattype']);
		$data['all_subcate'] = $this->Product_model->getsubcate();
		$data['edit_value'] = $this->Product_model->get_cate_dtl($data['id']);
		$this->load->view('cate_list', $data);
	}
	public function product_package_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Product Package List";
		$data['cattype'] = 3;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Product_model->get_cate($data['cattype']);
		$data['all_subcate'] = $this->Product_model->getsubcate();
		$data['edit_value'] = $this->Product_model->get_cate_dtl($data['id']);
		$this->load->view('cate_list', $data);
	}
	public function product_size_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Product Size List";
		$data['cattype'] = 4;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Product_model->get_cate($data['cattype']);
		$data['all_subcate'] = $this->Product_model->getsubcate();
		$data['edit_value'] = $this->Product_model->get_cate_dtl($data['id']);
		$this->load->view('cate_list', $data);
	}
	public function product_brand_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Product Brand List";
		$data['cattype'] = 5;
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Product_model->get_cate($data['cattype']);
		$data['all_subcate'] = $this->Product_model->getsubcate();
		$data['edit_value'] = $this->Product_model->get_cate_dtl($data['id']);
		$this->load->view('cate_list', $data);
	}

	public function insert_cate()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$dept_type = $this->input->post('m_dept_type');
			switch ($dept_type) {
				case 1:
					$headname = "Category";
					break;
				case 2:
					$headname = "Sub Category";
					break;
				case 3:
					$headname = "Product Package";
					break;
				case 4:
					$headname = "Product Size";
					break;
				case 5:
					$headname = "Product Brand";
					break;
				default:
					$headname = "Data";
					break;
			}

			if ($data = $this->Product_model->insert_cate()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => $headname . ' has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => $headname . ' Updated Successfully'
					);
				} else if ($data == 3) {
					$info = array(
						'status' => 'error',
						'message' => $headname . ' with same name already exist'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_cate()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Product_model->delete_cate()) {
				$info = array(
					'status' => 'success',
					'message' => 'Data has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//-----------------category------------------------------------//

	//-----------------product------------------------------------//
	public function product_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Product List";
		$data['all_value'] = $this->Product_model->get_all_product();
		$this->load->view('product_list', $data);
	}
	public function product_add()
	{
		$data = $this->login_details(); 
		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Product Detail";
		} else {
			$data['pagename'] = "Add New Product";
		}
		$data['cate_value'] = $this->Product_model->get_cate_list();
		$data['subcate_value'] = $this->Product_model->get_sucat_list();
		$data['pack_value'] = $this->Product_model->get_pack_list();
		$data['size_value'] = $this->Product_model->get_size_list();
		$data['brand_value'] = $this->Product_model->get_brand_list();
		$data['edit_value'] = $this->Product_model->get_edit_product($data['id']);
		$this->load->view('product_add', $data);
	}

	public function insert_product()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Product_model->insert_product()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Product has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Product Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_product()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Product_model->delete_product()) {

				$info = array(
					'status' => 'success',
					'message' => 'Product has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	//-----------------product------------------------------------//
	//---------------batch---------------------------------------//
 
	public function batch_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Batch List";
		$data['all_value'] = $this->Product_model->get_all_batch();
		$this->load->view('batch_list', $data);
	}
	public function batch_add()
	{
		$data = $this->login_details(); 
		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Batch Detail";
		} else {
			$data['pagename'] = "Add New Batch";
		}
		$data['pro_value'] = $this->Product_model->get_all_product(); 
		$data['edit_value'] = $this->Product_model->get_edit_batch($data['id']);
		$this->load->view('batch_add', $data);
	}

	public function insert_batch()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Product_model->insert_batch()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Batch has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Batch Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_batch()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Product_model->delete_batch()) {

				$info = array(
					'status' => 'success',
					'message' => 'Batch has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//---------------batch---------------------------------------//

   //-------------stock--------------------------------//
   public function stock_list(){
	$data = $this->login_details();
	$data['pagename'] = "Stock List"; 
	$data['all_value'] = $this->Product_model->get_all_batch();
	$this->load->view('stock_list', $data);
   }


	//==========================Details===========================//
	protected function login_details()
	{
		$this->require_login();
		$data['log_user_dtl'] = $this->Login_model->user_details();
		return $data;
	}
	//=========================/Details===========================//

	//======================Login Validation======================//
	protected function require_login()
	{
		$is_user_in = $this->session->userdata('is_user_in');
		if (isset($is_user_in) || $is_user_in == true) {
			return;
		} else {
			redirect('Login');
		}
	}

	protected function ajax_login()
	{
		$is_user_in = $this->session->userdata('is_user_in');
		if (isset($is_user_in) || $is_user_in == true) {
			return true;
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'You are not Logged in Now!! Please login again.'));
			return false;
		}
	}
}
