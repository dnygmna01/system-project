<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'rbac_system';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
