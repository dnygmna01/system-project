<?php
include('auth.php');
include('db.php');
check_auth(1); // Admin role only

$user_id = $_GET['user_id'];

mysqli_begin_transaction($conn);

try {
    // Delete related enrollments
    $delete_enrollments = "DELETE FROM enrollments WHERE student_id = ?";
    $stmt_enrollments = $conn->prepare($delete_enrollments);
    $stmt_enrollments->bind_param("i", $user_id);
    $stmt_enrollments->execute();

    // Delete the user
    $delete_user = "DELETE FROM users WHERE user_id = ?";
    $stmt_user = $conn->prepare($delete_user);
    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();

    mysqli_commit($conn);

    header("Location: manage_users.php");
    exit();
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error: Unable to delete user. " . $e->getMessage();
}
?>
