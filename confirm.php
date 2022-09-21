<?php 

    function redirect(){
        header("Location: login.php");
        exit();
    }

    if(!isset($_GET['email']) || !isset($_GET['token'])){

        redirect();

    } else { 
            require 'utilities/data-base.php';
    
            $email = $_GET['email'];
            $token = $_GET['token'];
    
            $records = $conn->prepare('SELECT id_user, email, token, token_expire FROM user_info WHERE email = :email');
            $records->bindParam(':email', $email);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
    
            $user = null;
    
            if(count($results) > 0){
                $user = $results;
            }
    
            if($user['token'] !== $token){
                echo "Sorry, your token is not valid";
                redirect();
            }else {
                $records = $conn->prepare('UPDATE user_info SET isEmailConfirmed = 1 WHERE email = :email');
                $records->bindParam(':email', $email);
                $records->execute();
                
                echo "Your email has been confirmed";
            }
    }

?>
