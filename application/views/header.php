<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link href="<?php echo base_url().'assets/';?>/img/favicon.ico" type="image/x-icon" rel="icon"/>
    <link href="<?php echo  base_url();?>assets/img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/';?>css/bootstrap.min.css">

     <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/';?>css/style-new.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login-style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url();?>assets/css/font-awesome.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="<?php echo base_url().'assets/';?>js/jquery-1.11.3.min.js"></script>
    
    
<div class="header-top">
    <div class="container-fluid">
        <div class="header-left">
            <div class="logo-sec">
               Demo
            </div>
        </div>
        <div class="header-right-top">
            <ul class="nav_right">
                <li class="logout">Hi <?php echo $this->session->userdata('user_data')['first_name'] ?>                
                </li>
                <li><a href="<?php echo base_url();?>Login/logout"><img src="<?php echo base_url();?>assets/img/off.png"> Logout <i class="fa fa-power-off" aria-hidden="true"></i></a></li>
                
            </ul>
        </div>
        
    </div>    
</div>






   
