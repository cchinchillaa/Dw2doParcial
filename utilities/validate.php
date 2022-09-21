<?php 

    function validate_empty($username,$email, $password, $confirm_password) {
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            return true;
        } else {
            return false;
        }
    }

    function validate_empty2($email, $password){
        if (empty($email) || empty($password)) {
            return true;
        } else {
            return false;
        }
    }

    function validate_confirm_password($password, $confirm_password) {
        if ($password == $confirm_password) {
            return true;
        } else {
            return false;
        }
    }

    function validate_unique_username($username, $conn) {
        $sql = "SELECT * FROM user_info WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return false;
        } else {
            return true;
        }
    }

    function validate_email($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    function validate_email_exists($email, $conn) {
        $sql = "SELECT email FROM user_info WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return false;
        } else {
            return true;
        }
    }

    function validate_password($password,&$errormsg){
/* 1*/  if(strlen($password) < 6):
           $errormsg = "Password must be at least 6 characters";
           return false;
        endif;
        /*if(strlen($password) > 8):
           $errormsg = "Password must be less than 8 characters";
           return false;
        endif;*/
/* 2*/ if (!preg_match('`[a-z]`',$password)):
           $errormsg = "Password must include at least one letter";
           return false;
        endif;
 /* 3*/ if (!preg_match('`[A-Z]`',$password)):
           $errormsg = "Password must include at least one capital letter";
           return false;
        endif;
/* 4*/ if (!preg_match('`[0-9]`',$password)):
           $errormsg = "Password must include at least one number";
           return false;
        endif;
 /* 5*/ if(!preg_match('`[~!@#$%^&*()_+|<>?:{};.,]`',$password)):
           $errormsg = "Password must include at least one special character";
           return false;
        endif;
        $errormsg = "";
        return true;
    } 


    function validate_isEmailConfirmed($email, $conn) {
        $sql = "SELECT isEmailConfirmed FROM user_info WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['isEmailConfirmed'] == 1) {
            return true;
        } else {
            return false;
        }
    }

?>
