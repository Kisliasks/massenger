
<?php


function get_user_id_2() {

    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }

    $stmt = $db->prepare('SELECT `user_id` FROM users WHERE `user_name` = ?');
    $stmt->execute(array($_SESSION['user_name']));

    while($row = $stmt->fetch()) {
        $user_id = $row['user_id'];

    }
    
    return $user_id;


}

function get_messege_from_user_ajax() {

if(isset($_GET['messege'])) {
    

        session_start();

        if(another_user_id_in_session_2()) {

        try {
            $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
        } catch (PDOException $e) {
        
            print "Can't connect: ". $e->getMessage();
            exit();
        }
        
    
        $stmt = $db->prepare('SELECT messege_text FROM messeges WHERE `id_user_another` = ? AND id_user_from = ?');
        $stmt->execute(array(get_user_id_2(),$_SESSION['another_user_id']));
    
            while($row = $stmt->fetch()) {
    
                if(empty($row['messege_text'])) {
                    $messege_from_another_user = '';
                } else {
                    $messege_from_another_user = $row['messege_text'];
                }
                
                             
                 echo <<<DELIMETER
    
                <div class="p-3 border bg-light">
                $messege_from_another_user
                 </div>
                
        
        DELIMETER; 
                
            }
            
    }
}
}


get_messege_from_user_ajax();
    


function another_user_id_in_session_2() {

    if (array_key_exists('another_user_id', $_SESSION)) {
        return true;

} else {
    return false;
}
  
}
?>