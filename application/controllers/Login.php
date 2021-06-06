<?php

class Login extends CI_Controller
{
	public function __construct(){
    	parent::__construct();
    	$this->load->model('Login_Model');
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
    }

	public function index(){
		$this->load->view('Login_View');
	}
	public function userlogin(){

   		$data = $this->Login_Model->User_login($this->input->post('emailld'), md5($this->input->post('password')));
	   	if(isset($data[0])){


	   		$user_data = array(
		      'first_name'  => $data[0]['first_name'],
		      'last_name'   => $data[0]['last_name'],
		      'usertype'  => $data[0]['usertype'],
		      'email_address'  => $data[0]['email_address'],
		      'profile_picture' => $data[0]['profile_picture'],
		      'mobile' => $data[0]['mobile'],
		      'address'  => $data[0]['address']
		     );
	   		if($data[0]['usertype'] == 'admin'){
	   			$this->session->set_userdata('user_data', $user_data);
	    		redirect('/UserLists/index', 'refresh');
	   		}else{
	   			$this->session->set_userdata('user_data', $user_data);
	    		redirect('/UserInfo/index', 'refresh');
	   		}
	   	}
   		else{
		    $this->session->set_flashdata('errormsg','Invalid username and password!');
		    redirect('Login/login', 'refresh');
   		}
	}
	public function login(){
	 
	  include_once APPPATH . "libraries/vendor/autoload.php";

	  $google_client = new Google_Client();
	  $google_client->setClientId('416853405189-eln5nb4n1d18jek4naa0n2276elbfnp3.apps.googleusercontent.com'); 
	  $google_client->setClientSecret('-AXWOnT2RkCKXt3Vwn_xELmZ');
	  $google_client->setRedirectUri('http://localhost/googlemap/Login/login'); 
	  $google_client->addScope('email');
	  $google_client->addScope('profile');

		if(isset($_GET["code"])){
		   	$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

		   	if(!isset($token["error"])){
			    $google_client->setAccessToken($token['access_token']);
			    $this->session->set_userdata('access_token', $token['access_token']);
			    $google_service = new Google_Service_Oauth2($google_client);
			    $data = $google_service->userinfo->get();
			    $current_datetime = date('Y-m-d H:i:s');

			    if($this->Login_Model->existing_register($data['id'])){
				     //update data
				     $user_data = array(
				      'first_name' => $data['given_name'],
				      'last_name'  => $data['family_name'],
				      'email_address' => $data['email'],
				      'profile_picture'=> $data['picture'],
				      'usertype' => 'user',
				      'mobile' => '',
				      'address'  => 'Gmailuser',
				      'updated_on' => $current_datetime
				     );

			     	$this->Login_Model->update_existing_user($user_data, $data['id']);
			    }
			    else{
				     //insert data
				     $user_data = array(
				      'login_oauth_uid' => $data['id'],
				      'first_name'  => $data['given_name'],
				      'last_name'   => $data['family_name'],
				      'email_address'  => $data['email'],
				      'profile_picture' => $data['picture'],
				      'usertype' => 'user',
				      'mobile' => '',
				      'address'  => 'Gmailuser',
				      'created_on'  => $current_datetime
				     );

			     	$this->Login_Model->creeate_user($user_data);
			    }
		    	$this->session->set_userdata('user_data', $user_data);
		   	}
		}

		
		$login_button = '';
		
		if(!$this->session->userdata('access_token')){
		   $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url().'assets/img/google-logo-icon-sign-in.svg" /> Sign Up With Google</a>';
		   $loginbtnurl = $google_client->createAuthUrl();
		   $data['login_button'] = $login_button;
		   $this->load->view('Login_View',$data);
		}
		else{
		   redirect('/UserInfo/index', 'refresh');
		}
	}

	public function Register(){	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');	
		 // Validation rule
		 $this->form_validation->set_rules('firstname', 'First Name', 'required');
		 $this->form_validation->set_rules('lastname', 'Last Name', 'required');
		 $this->form_validation->set_rules('mailid', 'Email', 'trim|required|valid_email|callback_check_customer');
		 $this->form_validation->set_rules('address', 'Address', 'required');
		 $this->form_validation->set_rules('mobile', 'Mobile', 'required');
		 $this->form_validation->set_rules('userpassword', 'Password', 'required|min_length[6]|max_length[15]');

				
	         if ($this->form_validation->run() == FALSE) { 
	         	// $this->session->set_flashdata('regerrormsg','Fill All Required fileds!');
	           	$this->load->view('Login_View');
	         } 
	         else {
	         	
	         	//insert user
	         	$user_data = array(
				      'first_name'  => $this->input->post('firstname'),
				      'last_name'   => $this->input->post('lastname'),
				      'email_address'  => $this->input->post('mailid'),
				      'address'  => $this->input->post('address'),
				      'mobile'  => $this->input->post('mobile'),
				      'password' => md5($this->input->post('userpassword')),
				      'usertype' => 'user',
				      'created_on'  => date('Y-m-d H:i:s')
				     );
	         	
			    $this->Login_Model->creeate_user($user_data);
			    $this->session->set_flashdata('successmsg','Your account has been successfully created!');
	            $this->load->view('Login_View'); 
	         } 
	}

	

	public function check_customer($email){
	    $query = $this->db->where('email_address', $email)->get("users");
		if ($query->num_rows() > 0){
			$this->form_validation->set_message('check_customer','The '.$email.' belongs to an existing account');
		    return FALSE;
		}
		else{ 
			return TRUE;
		}
	  }	

	public function logout(){
	  $this->session->unset_userdata('access_token');
	  $this->session->unset_userdata('user_data');
	  $this->session->sess_destroy();
	  redirect('Login/login', 'refresh');
	  
	}
	

}
?>
