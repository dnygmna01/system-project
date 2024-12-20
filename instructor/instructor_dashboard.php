<?php
include('auth.php');
include('db.php');

check_auth(2); // Instructor role only

// Start session for session management and timeout functionality
//session_start();

// Set session timeout duration (e.g., 1 hour)
$timeout_duration = 3600;

// Check if the session has been inactive for too long
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();    
    session_destroy();  
    header("Location: login.php"); 
    exit;
}

// Update last activity time to prevent session timeout
$_SESSION['last_activity'] = time();

// Fetch enrollments for this instructor
$instructor_id = $_SESSION['user_id'];
$query = "SELECT enrollments.enrollment_id, courses.course_name, users.username AS student_name 
          FROM enrollments 
          JOIN courses ON enrollments.course_id = courses.course_id 
          JOIN users ON enrollments.student_id = users.user_id 
          WHERE courses.instructor_id = $instructor_id";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
</head>
<body>   
    <div class="content">
        <div class="instructor">
            <h1>Instructor Dashboard</h1>
            <a href="manage_enrollment.php">Manage Enrollments</a>
            <a href="create_course.php">Create Course</a>
            <a href="add_student.php">Add Student</a>
            <a href="logout.php">Logout</a>
        </div>
        
        <div class="table">
            <h2>My Enrollments</h2>
            <table>
                <tr>
                    <th>Enrollment ID</th>
                    <th>Course Name</th>
                    <th>Student Name</th>
                </tr>
                <?php while ($enrollment = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $enrollment['enrollment_id']; ?></td>
                    <td><?= $enrollment['course_name']; ?></td>
                    <td><?= $enrollment['student_name']; ?></td>
                </tr>
                <?php } ?>
            </table>
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
            gap: 50px;
        }
        .instructor{
            box-shadow: 0 6px 8px rgba(0, 0, 0, 20);
            background-color: hsl(0, 80%, 40%);
            height: 100vh;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        a{
            font-size: 20px;
            color: white;
            text-decoration: none;
            padding-left: 1rem;
        }
        .instructor h1{
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 1rem;
            color: white;
        }
        table{
            width: 150%;
            border-collapse: collapse;
            margin: 20px auto;
            font-size: 16px;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            background-color: hsl(0, 0%, 100%);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td{
            border: 1px solid hsl(0, 0%, 87%);
            text-align: left;
            padding: 12px;
        }
        th{
            background-color: hsl(0, 0%, 96%);
            color: hsl(0, 0%, 20%);
            font-weight: bold;
        }
        tr:nth-child(even){
            background-color: hsl(0, 0%, 98%);
        }
        tr:hover{
            background-color: hsl(0, 0%, 95%);
        }
        td a{
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 13px;
            color: hsl(0, 0%, 0%);
        }
        td a:hover{
            opacity: 0.8;
        }
    </style>
</body>
</html>