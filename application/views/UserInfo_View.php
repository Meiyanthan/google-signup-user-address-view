<!DOCTYPE html>
<html>
<head>
	<title>User Info</title>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta content="Login Page" name="description">
</head>

<body>
	 <?php $this->load->view('header.php'); ?>
	<div class="login-wrapper" id="register">
		<div class="login-input-section" style=" width: 50%; ">
						<div class="login-input-div">
							<div class="login-sec-logo">
								<img width = "90" max-width="100%" src="<?php echo base_url().'assets/';?>img/logo_menu.png">
							</div>
						
								<div class="fieldset">
								  <?php
								    $user_data = $this->session->userdata('user_data');
								    echo '<div class="panel-heading">Welcome '.$user_data["first_name"].'</div><div class="panel-body">';
								    echo '<img src="'.$user_data['profile_picture'].'" class="img-responsive img-circle img-thumbnail" />';
								    echo '<h4><b>Name : </b>'.$user_data["first_name"].' '.$user_data['last_name']. '</h4>';
								    echo '<h4><b>Email :</b> '.$user_data['email_address'].'</h4>';
								    echo '<h4><b>Mobile :</b> '.$user_data['mobile'].'</h4>';
								    echo '<h4><b>Address :</b> '.$user_data['address'].'</h4>';
								   ?>
								</div>
							</div>
					</div>	

					<iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?q=<?php echo $user_data['address'];?>&key=AIzaSyD7pGHZ25ZTwwHkqJve0trEPZdKTvN0Wk8"></iframe>
			</div>



<script src="<?php echo base_url().'assets/';?>js/jquery-1.11.3.min.js"></script>

   
<?php $this->load->view('footer.php'); ?>



</body>
</html>