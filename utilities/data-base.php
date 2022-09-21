<?php 

    $_SERVER = 'localhost';
    $_USER = 'root';
    $_PASSWORD = '';
    $_DATABASE = 'login_database';

    try {
        $conn = new PDO("mysql:host=$_SERVER;dbname=$_DATABASE", $_USER, $_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        #
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

?>
