<?php

class Login_Model extends CI_Model
{
	public function __construct(){
     	parent::__construct();
     	$this->load->database('default');

  	}

  	public function existing_register($id){
	 $this->db->where('login_oauth_uid', $id);
	 $query = $this->db->get('users');
		if($query->num_rows() > 0){
			return true;
		}else{
		  return false;
		}
	}

	public function update_existing_user($data, $id){
	 	$this->db->where('login_oauth_uid', $id);
	  	$res = $this->db->update('users', $data);
	  	return $res;
	}

	public function creeate_user($data){
	  $res = $this->db->insert('users', $data);
	  return $res;
	}

	public function User_login($user,$pass){
	 $this->db->where('email_address', $user);
	 $this->db->where('password', $pass);
	 $query = $this->db->get('users');
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
		  return false;
		}
	}
}
?>