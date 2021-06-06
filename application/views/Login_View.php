<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta content="Login Page" name="description">
    <link rel="shortcut icon" href="<?php echo base_url().'assets/';?>/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login-style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url();?>assets/css/font-awesome.min.css">
</head>

<style type="text/css">
  .mei{
    display: block;
  }
</style>
<body>

							 <?php
								   echo validation_errors();
								   
							    ?>
	<div class="login-wrapper">
		<div class="login-input-section">
						<div class="login-input-div">
							<div class="login-sec-logo">
								<b>User Login</b>
							</div>
						
							<div class="login-input-div">
								<form action="<?php echo base_url();?>Login/userlogin" class="mei1" method="post">
                                	<?php 
                                   	if ($this->session->flashdata('successmsg') != ''){
                                     echo '<span class="login-success-msg text-center">'.$this->session->flashdata('successmsg').'</span>';
                                    }
                                    if ($this->session->flashdata('errormsg') != ''){
                                     echo '<span class="login-error-msg text-center">'.$this->session->flashdata('errormsg').'</span>';
                                    }
                                    ?>
									<div class="fieldset">
										<input class="form-control-lg" type="text" name="emailld" placeholder="Email ID">
										<div class="form-control-position">
	                                    	<img src="<?php echo base_url().'assets/';?>img/user.png">
	                                	</div>
									</div>
									<div class="fieldset">
										<input class="form-control-lg" id="password" type="password" name="password" placeholder="Password">
										<span toggle="#password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
										<div class="form-control-position">
		                                    <img src="<?php echo base_url().'assets/';?>img/lock.png">
		                                </div>
									</div>
									
									<div class="login-button-sec">
										<button class="login-button" type="submit">Login</button>
									</div>

									<div class="forgot-div">
										<a href="#register" class="forgot-txt">New User? Register here</a>
									</div>
							 	</form>
							</div>
					</div>
			</div>
	</div>

	<div class="login-wrapper" id="register">
		<div class="login-input-section">
						<div class="login-input-div">
							<div class="login-sec-logo">
								<b>User Registration</b>
							</div>
								<?php 
                                   	if ($this->session->flashdata('regerrormsg') != ''){
                                     echo '<span class="login-success-msg text-center">'.$this->session->flashdata('regerrormsg').'</span>';
                                    }
                                    ?>
							  <?php
								   echo validation_errors();
								   if (isset($success))
								   echo '<p class="login-success-msg">'.$success.'</p>';
							    ?>
							<div class="login-input-div">
								 <form action="<?php echo base_url();?>Login/Register" class="mei1" method="post">
								<div class="fieldset">
									<input class="form-control-lg" type="text" name="firstname" placeholder="First Name">
									<input class="form-control-lg" type="text" name="lastname" placeholder="Last Name">
									<div class="form-control-position">
                                    	<img src="<?php echo base_url().'assets/';?>img/user.png">
                                	</div>
								</div>
								<div class="fieldset">
									<input class="form-control-lg" type="text" name="mailid" placeholder="Email ID">
									<div class="form-control-position">
                                    	<i class="fa fa-envelope" aria-hidden="true"></i>
                                	</div>
								</div>
								<div class="fieldset">
									<input class="form-control-lg" type="text" name="address" placeholder="Address (Enter City)">
									<div class="form-control-position" >
                                    	<i class="fa fa-address-card" aria-hidden="true"></i>
                                	</div>
								</div>
								<div class="fieldset">
									<input class="form-control-lg" type="text" name="mobile" placeholder="Mobile">
									<div class="form-control-position" >
                                    	<i class="fa fa-mobile" aria-hidden="true"></i>
                                	</div>
								</div>
								<div class="fieldset">
									<input class="form-control-lg"  type="password" name="userpassword" placeholder="Enter Password">
									<span toggle="#password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
									<div class="form-control-position">
	                                    <img src="<?php echo base_url().'assets/';?>img/lock.png">
	                                </div>
								</div>
								
								<div class="login-button-sec">
									<button class="login-button" type="submit">Register</button>
								</div>
								 </form> 

								<div class="fieldset">
								  <?php
								   if(isset($login_button)){
								    echo '<div align="center">'.$login_button . '</div>';
								   }
								   ?>
								</div>
							</div>
					</div>
			</div>
	</div>

	

<script src="<?php echo base_url().'assets/';?>js/jquery-1.11.3.min.js"></script>
    
    <script type="text/javascript">
      $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    </script>

    <script type="text/javascript">
    $(document ).ready(function() {
	  if ($(window).width() <= 1100) {
	    $('.login-left').remove().insertAfter($('.login-right'));
	  } else {
	    $('.login-left').remove().insertBefore($('.login-right'));
	  }
	})
    </script>




</body>
</html>