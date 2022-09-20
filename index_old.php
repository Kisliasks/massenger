<?php session_start(); ?>
<?php include "functions.php";  ?>
<!-- <?php include "messeges_for_me.php";  ?> -->
<?php include "all_messeges_in_window.php";  ?> -->



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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" id="view_port">
    <title>Messenger</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  
</head>
<body>

<li class="cta"><a href="logout.php">Log out</a> <?php 
               $username_session = session_user_validate();
               echo $username_session = substr($username_session, 0, 14);
                ?></li>




<div class="container overflow-hidden" id="general_div">
  <div class="row gx-5">
    <div class="col">
      <!--  Форма отправки сообщений  -->
    <form class="form-floating p-3 border bg-light" method="post" >
        <input type="submit" class="btn btn-primary" name="send_messege">
        <input type="text" class="form-control col-3 bg-light p-3 " id="floatingInputValue" name="messege"  >

    </form>

<!-- <?php 
  if(another_user_id_in_session()) { get_my_messege_for_another_user(); }
?> -->

</div>
    <div class="col">
<!-- секция другого пользователя   -->
      <form action="" method="post">
      <input type="submit" class="btn btn-primary" name="search" value="Найти пользователя">
        <input type="text" class="form-control" name="another_user_name">
       
      </form>
     
      <div class="p-3 border bg-light"><?php 

      if(isset($_GET['another_user_id'])) {
        echo get_another_user_name(another_user_id_in_http());
        $_SESSION['another_user_id'] = another_user_id_in_http();
      } elseif(another_user_id_in_session()) {
      
      echo get_another_user_name($_SESSION['another_user_id']);
      
      }
      
      
      ?> 
      
    </div>
    
      

    
      <!-- <div class="messege_from_user"></div> -->
      
    </div>
    
  </div>
</div>
<div class="all_messeges_in_window" id="ads"></div>

<!-- 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/secondjs.js"></script>
</body>
</html> -->