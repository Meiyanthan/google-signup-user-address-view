<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Validate_Session
{
    public function __construct()
    {
        $this->load->library('authenticate');
    }

    public function __get($property)
    {
        if ( ! property_exists(get_instance(), $property))
        {
                show_error('property: <strong>' .$property . '</strong> not exist.');
        }
        return get_instance()->$property;
    }

    public function validate()
    {

        $current_class=$this->router->fetch_class();
       
        if($current_class !='ChangePassword' && $current_class !='ForgetPassword')
        {
            $urirequest = parse_url($_SERVER['REQUEST_URI']);
            $uripath = $urirequest["path"];
            $uriresult = trim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $uripath), '/');
            $uriresult = explode('/', $uriresult);

            if(isset($_SESSION['user_path']) && $_SESSION['user_path'] != $uriresult[0])
            {
                session_unset();
                redirect('Login/login','refresh');
            }
            else if(!isset($_SESSION['user_path']) && $current_class !='Login'){
                redirect('Login/login','refresh');
            }
        }
    }
}