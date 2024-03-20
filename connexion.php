<?php
$servername = "mysql-balladev.alwaysdata.net";
$username = "balladev_iam";
$password = "devweb2024@";
$dbname = "balladev_iam";

try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
