<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLists extends CI_Controller {

	public function __construct(){
  		parent::__construct();
   		$this->load->database(); 
   		$this->load->model('UserLists_Model');
   		ini_set('memory_limit', '256M');
	}
	
	public function index(){
      $this->load->view('UserLists_View');
    }

	public function get_user_details(){
		$data = $this->UserLists_Model->get_user_details_model();
		echo json_encode($data);
    }

}
?>