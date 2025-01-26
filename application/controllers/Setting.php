<?php 

 
 class Setting extends CI_Controller
 {
 	
 	 public function index()
 	 {
      $data = $this->login_details();
 	  $data['pagename'] = 'My Profile';
      $data['user_dtl'] = $this->Login_model->get_user_profile_details();
    //   echo "<pre>";print_r($data['user_dtl']);die();
 	 	$this->load->view('profile',$data);
 	 }


  public function update_profile(){ 
    if ($this->ajax_login() === false) { return; }
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $_POST["kh_userid"] = $this->session->userdata('user_id');
        if($data = $this->Setting_model->update_profile()){
          $info = array( 'status'=>'success',
            'message'=>'Admin Profile has been Updated successfully!'
          );
        }else{ $info = array( 'status'=>'fail',
            'message'=>'Some problem Occurred!! please try again'
          );
        } echo json_encode($info);
      }
    }

 

    //---------------------- profile update----------------------\\


     public function app_setting()
     {  
		// print_r('hii'); die();
        $data = $this->login_details();
        $data['pagename'] = 'Application Setting';
        $data['app_details'] = $this->Setting_model->get_application_settings();
	 
        $this->load->view('app_setting',$data);
     }
 

    public function update_application_settings(){
     if ($this->ajax_login() === false) { return; }
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($data = $this->Setting_model->update_application_settings()){
          $info = array( 'status'=>'success',
            'message'=>'Application Settings has been update successfully!'
          );
        }else{ $info = array( 'status'=>'error',
            'message'=>'Some problem Occurred!! please try again'
          );
        } echo json_encode($info);
      }
    }


  //==========================Details===========================//
    protected function login_details(){ $this->require_login();
      $data['log_user_dtl'] = $this->Login_model->user_details();
      return $data;
    }
    //=========================/Details===========================//
      
    //======================Login Validation======================//
    protected function require_login(){
      $is_user_in = $this->session->userdata('is_user_in');
      if(isset($is_user_in) || $is_user_in == true){ return;
      } else { redirect('Login'); }
    }

    protected function ajax_login($nav_id=''){
      $is_user_in = $this->session->userdata('is_user_in');
      if(isset($is_user_in) || $is_user_in == true){ return true;
      } else { echo json_encode(array( 'status'=>'error', 'message'=>'You are not Logged in Now!! Please login again.')); return false; 
      }
    }
//=====================/Login Validation======================//


 }
?>
