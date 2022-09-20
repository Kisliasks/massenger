<?php session_start(); ?>
<?php include "functions.php";  ?>


<?php 
unset($_SESSION['another_user_id']);
$another_user_id_http = another_user_id_in_http();

if(empty($_SESSION['another_user_id'])) {

    $_SESSION['another_user_id'] = $another_user_id_http;
    redirect("index.php");
};


?>