<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Invoice extends CI_Controller
{

//--------------------stock transfer-------------------//

public function stock_transfer_list()
{
    $data = $this->login_details();
    $data['pagename'] = "Stock Transfer List";
    $data['all_value'] = $this->Invoice_model->Stck_trans_group();
    // echo '<pre>'; print_r($data['all_value']); die ;
    $this->load->view('Invoice/stock_transfer_list', $data);
}
public function stock_transfe_add()
{
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
        $data['pagename'] = "Edit Stock Transfer Detail";
    } else {
        $data['pagename'] = "Add New Stock Transfer";
    }
    $data['batch_value'] = $this->Invoice_model->get_store_availble_batch(date('Y-m-d'));
    $data['store_value'] = $this->General_model->get_all_store(null,1);
    $data['edit_value'] = $this->Invoice_model->get_edit_stck_transfer($data['id']);
    //  echo '<pre>'; print_r($data['edit_value']); die ;
    $this->load->view('Invoice/stock_transfe_add', $data);
}

public function insert_stock_transfe()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($data = $this->Invoice_model->insert_stock_transfe()) {

            if ($data == 1) {
                $info = array(
                    'status' => 'success',
                    'message' => 'Stock has been Transfered successfully!'
                );
            } else if ($data == 2) {
                $info = array(
                    'status' => 'success',
                    'message' => 'Stock Transfer Detail Updated Successfully'
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

public function delete_stock_transfe()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($data = $this->Invoice_model->delete_stock_transfe()) {

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

//-------------------- stock transfer-------------------//
//-------------------- Invoice -------------------//

public function invoice_list()
{
    $data = $this->login_details();
    $data['pagename'] = "Invoice List";
    $data['all_value'] = $this->Invoice_model->invoice_group();
    // echo '<pre>'; print_r($data['all_value']); die ;
    $this->load->view('Invoice/invoice_list', $data);
}
public function invoice_add()
{
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
        $data['pagename'] = "Edit Invoice Detail";
    } else {
        $data['pagename'] = "Add New Invoice";
    }
    $data['store_batchvalue'] = $this->Invoice_model->get_store_availble_batch(date('Y-m-d'));
    $data['entities_value'] = $this->General_model->get_all_entity(null,1);
    $data['store_value'] = $this->General_model->get_all_store(null,1);
    $data['edit_value'] = $this->Invoice_model->get_edit_invoice($data['id']);
    //  echo '<pre>'; print_r($data['batch_value']); die ;
    //  echo '<pre>'; print_r($data['edit_value']); die ;
    $this->load->view('Invoice/invoice_add', $data);
}

public function insert_invoice()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($data = $this->Invoice_model->insert_invoice()) {

            if ($data == 1) {
                $info = array(
                    'status' => 'success',
                    'message' => 'Invoice has been Created successfully!'
                );
            } else if ($data == 2) {
                $info = array(
                    'status' => 'success',
                    'message' => 'Invoice Detail Updated Successfully'
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

public function delete_invoice()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($data = $this->Invoice_model->delete_invoice()) {

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

public function invoice_print()
{
    $data['id'] = $this->input->get('id');
    $data['edit_value'] = $this->Invoice_model->get_edit_invoice($data['id']);
    //  echo '<pre>'; print_r($data['edit_value']); die ;
    $this->load->view('Invoice/invoice_bil_print', $data);
}

//-------------------- Invoice -------------------//

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
