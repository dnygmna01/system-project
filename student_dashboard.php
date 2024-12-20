<?php
include('auth.php');
check_auth(3); // Student role only

// Start session for session management and timeout functionality
//session_start();

// Set session timeout duration (e.g., 1 hour)
$timeout_duration = 3600;

// Check if the session has been inactive for too long
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    // If the session has been inactive for too long, destroy it
    session_unset();    // Clear session variables
    session_destroy();  // Destroy the session
    header("Location: login.php"); 
    exit;
}

// Update last activity time to prevent session timeout
$_SESSION['last_activity'] = time();

// DB connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'rbac_system';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$student_id = $_SESSION['user_id'];

$query = "SELECT enrollments.enrollment_id, courses.course_name 
          FROM enrollments 
          JOIN courses ON enrollments.course_id = courses.course_id 
          WHERE enrollments.student_id = $student_id";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    
    <div class="content">
        <div class="student">
            <h1 class="h1">Student Dashboard</h1>
            <a href="view_courses.php">View Courses</a>
            <a href="my_enrollments.php">My Enrollments</a>
            <a href="logout.php">Logout</a>
        </div>
    
        <div class="intro">
            <h1>Welcome to Student Dashboard</h1>
            <h2>This is the Dashboard</h2>
            <p>Explore more to learn</p>
        </div>

        
    </div>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: hsl(0, 0%, 98%);
        }
        .content{
            display: flex;
            gap: 60px;
        }
        .student{
            box-shadow: 0 6px 8px rgba(0, 0, 0, 20);
            background-color: hsl(0, 80%, 40%);
            height: 100vh;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .h1{
            color: white;
            padding: 10px;
        }
        a{
            font-size: 20px;
            color: white;
            text-decoration: none;
            padding-left: 1rem;
        }
    </style>
</body>
</html>