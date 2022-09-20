
<?php 


function get_messege_from_user() {


    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }
    

    $stmt = $db->prepare('SELECT messege_text FROM messeges WHERE `id_user_another` = ? AND id_user_from = ?');
    $stmt->execute(array(get_user_id(),$_SESSION['another_user_id']));

        while($row = $stmt->fetch()) {

            if(empty($row['messege_text'])) {
                $messege_from_another_user = '';
            } else {
                $messege_from_another_user = $row['messege_text'];
            }
            
            // return $messege_from_another_user;


            echo  <<<DELIMETER

            <div class="p-3 border bg-light">
            $messege_from_another_user
             </div>
            
    
    DELIMETER; 
        }

}


function get_my_messege_for_another_user() {

    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }


    $stmt = $db->prepare('SELECT messege_text FROM messeges WHERE `id_user_another` = ? AND id_user_from = ? ORDER BY messege_id DESC');
    $stmt->execute(array($_SESSION['another_user_id'],get_user_id()));

    while($row = $stmt->fetch()) {

        if(empty($row['messege_text'])) {
            $messege_from_me_for_another_user = '';
        } else {
            $messege_from_me_for_another_user = $row['messege_text'];
        }
        
        // return $messege_from_me_for_another_user;

        echo  <<<DELIMETER

        <div class="p-3 border bg-light">
         $messege_from_me_for_another_user
         </div>
        

DELIMETER; 
    }   
}


function user_search_validate() {

   
    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }

      
    $another_user_name = trim($_POST['another_user_name'] ?? ''); 

    if(empty($another_user_name)){
        $error = 'Вы не ввели имя пользователя!';
        return $error;
     } else {

        $stmt = $db->prepare('SELECT `user_id` FROM users WHERE `user_name` = ?');
        $stmt->execute(array($another_user_name));
        $row = $stmt->fetch();
      
        // Если в таблице нет искомого пользователя, id вывести не получилось
        if (!$row) {
            $error = 'Данного пользователя не существует';
            return $error;
             } elseif($row['user_id'] === get_user_id()) {
             $error = 'Вы не можете отправлять сообщения самому себе.';
             return $error;
             } else {
                 if(!empty($_SESSION['another_user_id'])) {
                    unset($_SESSION['another_user_id']);
                 }          
               $_SESSION['another_user_id'] = $row['user_id']; 
                 
               
             }
     }

}


function  user_search_friends_list() {

    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }

      
    $another_user_name = trim($_POST['another_user_name'] ?? ''); 

    if(empty($another_user_name)){
        $error = 'Вы не ввели имя пользователя!';
        return $error;
     } else {

        $stmt = $db->prepare('SELECT `user_id` FROM users WHERE `user_name` = ?');
        $stmt->execute(array($another_user_name));
        $row = $stmt->fetch();
      
        // Если в таблице нет искомого пользователя, id вывести не получилось
        if (!$row) {
            $error = 'Данного пользователя не существует';
            return $error;
             } elseif($row['user_id'] === get_user_id()) {
             $error = 'Вы не можете добавить себя в список друзей.';
             return $error;
             } else {
              $another_user_name = get_another_user_name($row['user_id']);
                 return $another_user_name;
               
             }
     }

}


function messages_now_read() {

    if(isset($_SESSION['another_user_id'])) {
        $url_now = $_SERVER['REQUEST_URI'];
        $url_index = '/messenger/index.php';
        $url_after_unread_page = '/messenger/index.php?another_user_id=';
       if($url_now === $url_index OR strpos($url_now, 'index.php?another_user_id=')) {

        try {
            $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
        } catch (PDOException $e) {
        
            print "Can't connect: ". $e->getMessage();
            exit();
        }
        $stmt = $db->prepare('UPDATE messeges SET messege_status = "read" WHERE id_user_from = ? AND id_user_another = ?');
        $stmt->execute(array($_SESSION['another_user_id'],get_user_id()));
        
       }

    } 
    
}




function get_user_id() {

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



function get_another_user_name($another_user_id) {


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



function another_user_id_in_session() {

    if (array_key_exists('another_user_id', $_SESSION)) {
        return true;

} else {
    return false;
}
  
}





function redirect($location) {

    header("Location: $location");

}


function validate_form_log_in() {


    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }
    
        
        $errors = array();

        // В этой переменной устанавливается логическое значение true 
        // только в том случае, если предъявленный пароль подходит 
        $password_ok = false;
        $input['user_name'] = trim($_POST['user_name'] ?? ''); 
        $submitted_password = trim($_POST['user_password'] ?? '');

        $stmt = $db->prepare('SELECT user_password FROM users WHERE `user_name` = ?');
        $stmt->execute(array($input['user_name']));
        $row = $stmt->fetch();
        // Если в таблице отсутствует искомая строка, имя
        // пользователя не найдено ни в одной из строк таблицы 
        if ($row) {
                $password_ok = password_verify($submitted_password,
                                               $row['user_password']);
                           
        }
        if (!$password_ok) {
        $errors[] = 'Please enter a valid username and password.'; 
    }
        return array($errors, $input); 

}


function session_user_validate() {

    if (array_key_exists('user_name', $_SESSION)) {
       return $_SESSION['user_name'];
    } elseif($_SESSION['user_name'] == null) {
       redirect("register");
    }
}

function userInSession() {

    // проверка, есть ли пользователь в сессии
    if (array_key_exists('user_name', $_SESSION)) {
        redirect("../index.php");
     } 
}




function user_register_validate() {

    $user_name = trim($_POST['user_name']);
    $email    = trim($_POST['email']);
    $user_password = trim($_POST['user_password']);


    $errors = array();
    $input = array(); 


    if(strlen($user_name) < 4){

        $errors[] = 'Введите больше четырех символов в поле "Имя пользователя".';

    }


    if(strlen($user_name) > 14){

        $errors[] = 'Имя пользователя может содержать только 14 символов.';

    }

     if($user_name ==''){

        $errors[] = 'Поле имени пользователя не может быть пустым';

    }


    if(user_name_exists($user_name)) {

        $errors[] = 'Данное имя пользователя уже существует';
    }



    if($email ==''){

        $errors[] = 'Поле электронной почты не может быть пустым';


    }

    if (strpos($email, '@') === false) {
        $errors[] = 'Имя почтового ящика должно включать в себя символ "@".';
    }


     if(email_exists($email)) {
         $errors[] = 'Пользователь с данной электронной почтой уже зарегистрирован';
     }


    if($user_password == '') {


        $errors[] = 'Поле пароля не может быть пустым';

    }

    // если массив ошибок пуст, передать все значения в массив $input 
    if(empty($errors)) {
       $input['user_name'] = $user_name;
       $input['email'] = $email;
       $input['user_password'] = $user_password;
    }

    return array($errors, $input);

} 


function user_name_exists($user_name) {


    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }

    $stmt = $db->prepare('SELECT `user_name` FROM users WHERE `user_name` = ?');
    $stmt->execute(array($user_name));
    $row = $stmt->fetch();
    

    if(!empty($row)) {
        return true;
    } else {
        return false;
    }


}


function email_exists($email) {

   try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }

    $stmt = $db->prepare('SELECT email FROM users WHERE email = ?');
    $stmt->execute(array($email));
    $row = $stmt->fetch();
    

    if(!empty($row)) {
        return true;
    } else {
        return false;
    }



}


function user_register($input) {

    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }

    $input['user_password'] = password_hash($input['user_password'], PASSWORD_BCRYPT, array('cost' => 10));

    $stmt = $db->prepare('INSERT INTO users (`user_name`, user_password, email) VALUES (?,?,?) ');
    $stmt->execute(array($input['user_name'], $input['user_password'], $input['email']));
    
}



function send_messege() {

    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();
    }


    $messege = $_POST['messege'];
    $another_user_id = $_SESSION['another_user_id'];
    $my_user_id = get_user_id();

    date_default_timezone_set('Europe/Moscow');
    $d = new DateTime(); 
    $messege_time = $d->format('y/m/d/H/i/s');

    $stmt = $db->prepare('INSERT INTO messeges (`id_user_from`, id_user_another, messege_text, messege_time) VALUES (?,?,?,?) ');
    $stmt->execute(array($my_user_id, $another_user_id, $messege, $messege_time));
    
    return true;

}


function error_in_session() {
    if(array_key_exists('error', $_SESSION)) {
        return true;
    }
}


function all_count_unread_messeges_for_me() {    // выводит общее количество сообщений, адресованных мне
    
    
    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();

    }

    // выводим непрочитанные сообщения для меня
    $stmt = $db->prepare('SELECT COUNT(messege_text) FROM messeges WHERE `id_user_another` = ? AND `messege_status` = "unread" ');  
    $stmt->execute(array(get_user_id()));

        $row = $stmt->fetch();
        foreach($row as $count) {
            $messege_count = $count;
        }
      
        echo $messege_count;
    }






function all_unread_messeges_for_me() {

    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();

    }


    $stmt = $db->prepare('SELECT id_user_from, COUNT(DISTINCT messege_text) FROM messeges WHERE `id_user_another` = ? AND messege_status = ? AND NOT messege_text IN(SELECT messege_text FROM messeges 
    HAVING COUNT(DISTINCT id_user_from) > 1 ) GROUP BY id_user_from');  // выводим сообщения для меня без повторения иконок сообщений от одного и того же пользователя
    $stmt->execute(array(get_user_id(), 'unread'));

    while($row = $stmt->fetch()) {
        foreach($row as $message_count) {
            $message_count = $message_count;
        }
        $id_user_from = $row['id_user_from'];
        $another_user_name = get_another_user_name($id_user_from);
        $messege_text = "Новое сообщение от пользователя: " .  $another_user_name ."(" .  $message_count. ")";
        $go_to_user_window = "Перейти к диалогу";
        
    

    if($message_count != 0) {

    echo  <<<DELIMETER

   
    
    <a href="user_id_after_mess_page.php?another_user_id={$id_user_from}"><div class="container_my_message"><span class="message_time">$go_to_user_window</span><div class="my_message">$messege_text</div> </div></a>
    
        

DELIMETER; 
    
        }
    }
}


function another_user_id_in_http() {

    if(isset($_GET['another_user_id'])) {
        $another_user_id_in_http = $_GET['another_user_id'];
    }
    return $another_user_id_in_http;
}


function friends_list_if() {

    try {
        $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
    } catch (PDOException $e) {
    
        print "Can't connect: ". $e->getMessage();
        exit();

    }

    $stmt = $db->prepare('SELECT COUNT(friend_id) AS count_id FROM my_friends WHERE `my_id` = ?');  // выводим возможного сохраненного друга
    $stmt->execute(array(get_user_id()));
    $row_count = $stmt->fetch();
    if($row_count['count_id'] > 0) {
        
        $stmt = $db->prepare('SELECT * FROM my_friends WHERE `my_id` = ?');  // выводим сохраненного друга после проверки
        $stmt->execute(array(get_user_id()));

    while($row = $stmt->fetch()) {
       
        $friend_name = $row['friend_name'];
        $friend_id = $row['friend_id'];
        
        $my_id = get_user_id();
       
       //  выводим иконку с именем друга и возможностью удаления его из списка 
    echo  <<<DELIMETER
    
   <div class="container_my_message"><span class="message_time"></span><div class="my_message">$friend_name<a href="delete_friend.php?friend_id={$friend_id}&my_id={$my_id}"><i class="fa fa-minus-square" aria-hidden="true"></i> </a></div></div>
    
DELIMETER; 
}
    } else {

        echo  <<<DELIMETER

       <div class="not_users">У Вас пока нет сохраненных пользователей</div>

   DELIMETER; 

    }
}
    
       
    function append_new_user_on_friends_list() {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['append_friend'])) {

               $friend_name = trim($_POST['new_user']);


        try {
            $db = new PDO('mysql:host=localhost;dbname=messenger', 'root', '');
        } catch (PDOException $e) {
        
            print "Can't connect: ". $e->getMessage();
            exit();
    
        } 

        $stmt = $db->prepare('SELECT friend_name FROM my_friends WHERE `my_id` = ?');
        $stmt->execute(array(get_user_id()));
        $row_validate = $stmt->fetch(); 
        if($friend_name !== $row_validate['friend_name']) {


        $stmt = $db->prepare('SELECT `user_id` FROM users WHERE `user_name` = ?');
        $stmt->execute(array($friend_name));
        $row = $stmt->fetch(); 
        $friend_user_id = $row['user_id'];

        $stmt = $db->prepare('INSERT INTO my_friends (`my_id`, friend_id, friend_name) VALUES (?,?,?) ');
        $stmt->execute(array(get_user_id(), $friend_user_id, $friend_name));

        redirect('friends_page.php');
        } else {
            echo "Этот пользователь уже есть у вас в друзьях.";
        }
    }
    }
}
?>








