<?php
include('auth.php');
include('db.php');
check_auth(2); // Instructor role only

$enrollment_id = $_GET['enrollment_id'];

$query = "DELETE FROM enrollments WHERE enrollment_id = $enrollment_id";

if (mysqli_query($conn, $query)) {
    header("Location: manage_enrollments.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>