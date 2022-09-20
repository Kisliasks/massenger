<?php session_start(); ?>
<?php include "functions.php";  ?>
<!-- <?php include "messeges_for_me.php";  ?> -->
<?php include "all_messeges_in_window.php";  ?>



<?php 
if(error_in_session()){
  echo $_SESSION['error'];
}

unset($_SESSION['error']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['search'])) {
    

     $_SESSION['error'] = user_search_validate(); 
     redirect('index.php');
    
   }
   
   if(isset($_POST['send_messege'])) {

    if($_POST['messege'] !== '') {
      if(send_messege() == true) {
        unset($_POST['messege']);
        redirect('index.php');
      }
    } else { 
      redirect('index.php');
    }
   }
  }


  
?>

  <h2>My messeges: <span class="all_my_messeges"></span>  </h2>  

<?php



?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pisun</title>
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
			<div class="wrap-login100">
			



<!--  window for messages   -->
<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post">
				
<div class="container_message">
		
<div class="container_my_message">	<div class="my_message">Здесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщение</div> </div>
<div class="container_another_user_message">  <div class="another_user_message">Здесь располагается мое сообщение</div> </div>
<div class="container_my_message">	<div class="my_message">Здесь располагается мое сообщение</div> </div>
<div class="container_another_user_message">  <div class="another_user_message">Здесь располагается мое сообщение</div> </div>
<div class="container_my_message">	<div class="my_message">Здесь располагается мое сообщение</div> </div>
<div class="container_another_user_message">  <div class="another_user_message">Здесь располагается мое сообщение</div> </div><div class="container_my_message">	<div class="my_message">Здесь располагается мое сообщение</div> </div>
<div class="container_another_user_message">  <div class="another_user_message">Здесь располагается мое сообщение</div> </div><div class="container_my_message">	<div class="my_message">Здесь располагается мое сообщение</div> </div>
<div class="container_another_user_message">  <div class="another_user_message">Здесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщениеЗдесь располагается мое сообщение</div> </div>
</div>

<!--    OFF  -->

					<span class="login100-form-title">
						Pisun
					</span>

					
					
						<div class="input_login">
							
						<!-- <span class="input_window_btn"></span> -->
						<div class="fon_input_btn"></div>
							<div class="wrap-input100 validate-input" >
								<input class="input100" type="text" name="messege" placeholder="New message" >
								<span class="focus-input100"></span>
							</div>
							<input class="login100-form-btn" type="submit" value="send" id="button_send" name="send_messege">
							
							
						</div>
						
					
					
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->


</body>
</html>