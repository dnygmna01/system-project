<?php
include('auth.php');
include('db.php');
check_auth(3); // Student role only

$student_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'];

// Check if already enrolled
$query = "SELECT * FROM enrollments WHERE student_id = $student_id AND course_id = $course_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Already enrolled!";
} else {
    $query = "INSERT INTO enrollments (student_id, course_id) VALUES ($student_id, $course_id)";
    if (mysqli_query($conn, $query)) {
        header("Location: my_enrollments.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
