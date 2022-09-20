
<?php


function get_user_id_3() {

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

function get_all_messeges_in_window() {

if(isset($_GET['all_messeges'])) {
    

        session_start();

        if(another_user_id_in_session_3()) {

        try {
            $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
        } catch (PDOException $e) {
        
            print "Can't connect: ". $e->getMessage();
            exit();
        }
        
    
        $stmt = $db->prepare('SELECT messege_text, id_user_from, id_user_another, messege_time FROM messeges WHERE `id_user_another` IN (?,?) AND id_user_from IN (?,?) ORDER BY messege_time');
        $stmt->execute(array(get_user_id_3(),$_SESSION['another_user_id'],$_SESSION['another_user_id'],get_user_id_3()));
    
            while($row = $stmt->fetch()) {
    
                if(empty($row['messege_text'])) {
                    $messege_text = '';
                    
                } elseif($row['id_user_from'] === get_user_id_3()) {
                
                    $messege_text_me = $row['messege_text'];
                    $message_time = $row['messege_time'];

                    echo <<<DELIMETER
    
                     <div class="container_my_message"><span class="message_time">$message_time</span><div class="my_message">$messege_text_me</div> </div>
            
            DELIMETER; 

                } elseif($row['id_user_from'] === $_SESSION['another_user_id']) {
                    $messege_text_another = $row['messege_text'] ;

                    $message_time = $row['messege_time'];


                    $another_user_name = get_another_user_name_2($_SESSION['another_user_id']);

                    echo <<<DELIMETER
    
                     <div class="container_another_user_message"><span class="message_time_another">$message_time</span><span class="another_user_name_message">$another_user_name</span><div class="another_user_message"> $messege_text_another  </div> </div>
            
            DELIMETER; 
                }
                                
            }          
    }
}
}


get_all_messeges_in_window();  // активация асинхронного запроса 
    


function another_user_id_in_session_3() {

    if (array_key_exists('another_user_id', $_SESSION)) {
        return true;

} else {
    return false;
}
  
}


function get_another_user_name_2($another_user_id) {


    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }


    $stmt = $db->prepare('SELECT `user_name` FROM users WHERE `user_id` = ?');
    $stmt->execute(array($another_user_id));

    while($row = $stmt->fetch()) {
        $another_user_name = $row['user_name'];

    }
    if(!empty($another_user_name)) {
       return $another_user_name;
    }
    
}
?>