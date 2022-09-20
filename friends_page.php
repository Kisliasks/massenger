<?php session_start(); ?>
<?php include "functions.php";  ?>



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
	
	<!--  иконка с количеством непрочитанных мною сообщений -->
	<div class="limiter">
		<div class="container-login100">
		<div class="icons_right">
		<a href="unread_messeges.php"><span id="icon1"><img src="https://img.icons8.com/fluency/48/000000/secured-letter.png"/><?php  all_count_unread_messeges_for_me(); ?></span> </a>	
		<a href="index.php"><span id="icon1"><img src="https://img.icons8.com/ultraviolet/40/000000/return.png"/></span> </a>	
	</div>


		<div class="wrap-login100">
					
<!--  window for messages   -->
<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post">
				
<div class="container_message">
<?php  friends_list_if();  ?>

</div>

<!--  END   -->

					<span class="login100-form-title">
						MassMy
					</span>

					<!-- <form action="" method="post"> -->
					<input type="submit"  name="search" value="search user" id="search_button">
        <input type="text"  name="another_user_name" id="input_search_user">
        
      <!-- </form> -->
					
						<div class="input_login">
							
						<!-- <span class="input_window_btn"></span> -->
						<!-- <div class="fon_input_btn"></div> -->
							<div class="wrap-input100 validate-input" >
								<input class="input100" id="" type="text" name="new_user" value="    
									<?php 

									append_new_user_on_friends_list();
									if(error_in_session())
									{echo $_SESSION['error'];
									} else {

									}
									
									
									?>" >
								<span class="focus-input100"></span>
							</div>
							<input class="login100-form-btn" type="submit" value="append" id="button_send" name="append_friend">
														
						</div>					
				</form>


<?php 

unset($_SESSION['error']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['search'])) {
    
		$_SESSION['error'] = user_search_friends_list(); 
		redirect('friends_page.php');   
   }      
}
  
?>
			</div>
		</div>
	</div>
	
<!--  Выводим имя пользователя, с которым я сейчас веду диалог  -->
<div class="p-3 border bg-light">
<?php 
	if(another_user_id_in_session()) {
		echo get_another_user_name($_SESSION['another_user_id']);
	}
?> 
</div> 
<!--  END    -->

</div>  


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/secondjs.js"></script>
</body>
</html>