<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function index()
  {
    $data['pagename'] = "Log-in";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $rules = array(
        array('field' => 'login_email',   'label' => 'Email',   'rules' => 'trim|required'),
        array('field' => 'login_pass', 'label' => 'Password', 'rules' => 'trim|required')
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
      } else {
        $data = $this->Login_model->validate_user();
        if ($data == 'not_found') {
          $this->session->set_flashdata('status', '<div class="alert alert-danger"><i class="fa fa-warning"></i> Email-id not exists! Please try again </div>');
        } else if ($data == 'pass_worng') {
          $this->session->set_flashdata('status', '<div class="alert alert-danger"><i class="fa fa-warning"></i> Incorrect Password! Please try again </div>');
        } else if(!empty($data)) {
          $usrdata = array(
            'is_user_in' => true,
            'user_id' => $data[0]->m_emp_id,
            'user_type' => $data[0]->m_login_type,
            'designation' => $data[0]->m_emp_design,
          );
          // print_r($usrdata); die(); 
          $this->session->set_userdata($usrdata);
          redirect('Welcome');
        }else {
          $this->session->set_flashdata('status', '<div class="alert alert-danger"> <strong><i class="fa fa-warning"></i> &nbsp; Some Problem Occurred !...</strong> Please Try Again. </div>');

        }
      }
    }

    $this->load->view('login', $data);
  }
}
