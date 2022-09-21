<?php
if (!empty($_POST["enter"])) {
    $message = '';
    $email = $_POST['email'];
    $password = $_POST['password'];

    session_start();

    require 'utilities/data-base.php';
    require 'utilities/validate.php';


    if (validate_email_exists($email, $conn)) {
        $message = 'User does not exist';
    } elseif (!validate_isEmailConfirmed($email, $conn)) {
        $message = 'Please, confirm your email';
    } else {

        $records = $conn->prepare('SELECT username, email, password FROM user_info WHERE email = :email');

        $records->bindParam(':email', $email);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        if (count($results) > 0 && password_verify($password, $results['password'])) {
            $_SESSION['id'] = $results['id_user'];
            $_SESSION['user'] = $results['username'];
            $_SESSION['email'] = $results['email'];

            header("Location: login.php");
        } else {
            $message = 'Sorry, those credentials do not match';
        }
    }
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
                    <a href="index.php">  <img src="assets/img/img1.png" class="rounded"/>  </a>
                </div>
            </div>
            <!-- FORM BLOCK -->
            <div class="bg-primary col">
                <div class="panel panel-default">
                    <br><br><br><br>
                    <div class="panel-heading text-center">
                        <h1><span class="bg-primary badge badge-secondary">WELCOME</span></h1>
                    </div>
                    
                    <blockquote class="blockquote text-center">
                        <span class="bg-primary text-dark font-weight-bold">Login or</span> <a href="signup.php" class="bg-primary text-dark">SignUp</a>
                    </blockquote>

                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>

                    <div class="panel-body">
                        <form action="index.php" method="POST">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
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