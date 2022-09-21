<?php


if (!empty($_POST["enter"])) {

    //require 'utilities/data-base.php';
    //require 'utilities/validate.php';
    require 'email/emailer.php';

    $message = '';
    //
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $token = mt_rand(100000, 999999);
    //
    $message = "Hi, $username. Click here to confirm your email http://localhost/Login-php/confirm.php?email=$email&token=$token";

    mailshot($email, $username, $message);

}

?>

<?php

    $message = '';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $token = mt_rand(100000, 999999);

    $errormsg = '';


    if (validate_empty($username, $email, $password, $confirm_password)) {
        $message = 'Please fill all fields';
    } elseif (!validate_confirm_password($password, $confirm_password)) {
        $message = 'Passwords do not match';
    } elseif (!validate_password($password, $errormsg)) {
        $message = $errormsg;
    } elseif (!validate_email($email)) {
        $message = 'Please enter a valid email';
    } elseif (!validate_unique_username($username, $conn)) {
        $message = 'Username already exists';
    } elseif (!validate_email_exists($email, $conn)) {
        $message = 'Email already exists';
    } else {
        $sql = "INSERT INTO user_info (username,email, password,token) VALUES (:username,:email, :password,:token)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':token', $token);
        if ($stmt->execute()) :

            //$subject = 'Email Confirmation';
            //$body = 'Hi, $username. Click here to confirm your email http://localhost/confirm.php?email=$email&token=$token';

            //send_Mail();


            $message = 'Registration successful, please check your email to confirm your account';

        else :
            $message = 'Sorry there must have been an issue creating your account';
        endif;
    }

?>


<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <div class="mx-auto" style="Height: 100px;">
    </div>
    <!-- PRINCIPAL CONTAINER -->
    <div class="container border rounded">
        <div class="row">
            <!-- IMG BLOCK -->
            <div class="col-sm-8">
                <div class="text-center">
                    <a href="index.php"> <img src="assets/img/img1.png" class="rounded" /> </a>
                </div>
            </div>
            <!-- FORM BLOCK -->
            <div class="bg-primary col">
                <div class="panel panel-default">
                    <br><br><br><br>
                    <div class="panel-heading text-center">
                        <h1><span class="bg-primary badge badge-secondary">SIGNUP</span></h1>
                    </div>

                    <blockquote class="blockquote text-center">
                        <span class="bg-primary text-dark font-weight-bold">or</span> <a href="index.php" class="bg-primary text-dark">Login</a>
                    </blockquote>

                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>

                    <div class="panel-body">
                        <form action="signup.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
                            </div>
                            <blockquote class="blockquote text-center">
                                <a href="signup.php" class="text-dark">Forgot password?</a>
                            </blockquote>
                            <div class="form-group">
                                <input type="submit" name="enter" class="btn btn-success  btn-lg btn-block rounded" value="SUBMIT">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
