<?php
function getDatabaseConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "login_register_salondb";

    $connection = new mysqli($servername, $username, $password, $database);
    if($connection->connect_error) {
    die("Error failed to connect to MySQL: " . $connection->connect_error);
    }

    return $connection;
    
}
?>