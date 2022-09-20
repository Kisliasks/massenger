<?php session_start(); ?>
<?php include "functions.php";  ?>

<?php include "all_messeges_in_window.php";  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>MassMy</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main_2.css">
<!--===============================================================================================-->
</head>
<body>


<li class="cta"><a href="logout.php">Log out</a> <?php 
               $username_session = session_user_validate();
               echo $username_session = substr($username_session, 0, 14);
                ?></li>
	
	
	<div class="limiter">
		<div class="container-login100">
		<div class="icons_right">
		<a href="index.php"><span id="icon1"><img src="https://img.icons8.com/ultraviolet/40/000000/return.png"/></span> </a>	
			<span id="icon2"><img src="https://img.icons8.com/fluency/48/000000/user-group-man-woman.png"/></span>
		</div>


<div class="wrap-login100">
			
<!--  window for messages   -->
<form class="login100-form validate-form p-l-55 p-r-55 p-t-178"  method="post">
				
<div class="container_message_unread">
<div class="all_messeges_in_window" id="ads"><?php all_unread_messeges_for_me();   ?></div>

</div>

<!--    OFF  -->

					<span class="login100-form-title">
						MassMy
					</span>	
				</form>
			</div>
		</div>
	</div>
</div>