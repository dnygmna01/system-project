<?php
session_start();

function check_auth($role_id = null) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: signup.php");
        exit();
    }
    if ($role_id !== null && $_SESSION['role_id'] != $role_id) {
        header("Location: singnup.php");
        exit();
    }
}
?>