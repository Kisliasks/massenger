<?php include "functions.php";  ?>


<?php   

try {
    $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
} catch (PDOException $e) {

    print "Can't connect: ". $e->getMessage();
    exit();

}


if(isset($_GET)) {

    $my_id = $_GET['my_id'];
    $friend_id = $_GET['friend_id'];

    $stmt = $db->prepare('DELETE FROM my_friends WHERE my_id = ? AND friend_id = ?');  
    $stmt->execute(array($my_id, $friend_id));
    

    redirect('friends_page.php');
} else {

    redirect('friends_page.php');
}




?>