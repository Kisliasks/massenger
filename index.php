<?php session_start(); ?>
<?php include "functions.php";  ?>

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
<?php

messages_now_read();  // функция прочтения сообщений в основном окне

?>
<?php 	

?>
<li class="cta"><a href="logout.php">Log out</a> <?php 
               $username_session = session_user_validate();
               echo $username_session = substr($username_session, 0, 14);
                ?></li>
	
	
	<div class="limiter">
		
		<div class="container-login100">
		<div class="icons_right">
		<a href="unread_messeges.php"><span id="icon1"><img src="https://img.icons8.com/fluency/48/000000/secured-letter.png"/><?php  all_count_unread_messeges_for_me(); ?></span> </a>	
		<a href="friends_page.php"><span id="icon2"><img src="https://img.icons8.com/fluency/48/000000/user-group-man-woman.png"/></span></a>
		</div>

		<div class="wrap-login100">
					

	

<!--  window for messages   -->
<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post">
				
<div class="container_message">
<div class="all_messeges_in_window" id="ads"></div>

</div>

<!--    OFF  -->

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
								<input class="input100" type="text" name="messege" placeholder="New message" >
								<span class="focus-input100"></span>
							</div>
							<input class="login100-form-btn" type="submit" value="send" id="button_send" name="send_messege">
														
						</div>
				</form>
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/secondjs.js"></script>
</body>
</html>