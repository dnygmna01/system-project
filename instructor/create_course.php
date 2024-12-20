<?php
include('auth.php');
include('db.php');
check_auth(2); // Instructor role only

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
   // $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
    $instructor_id = $_SESSION['user_id'];

    // Insert course into the database
    $query = "INSERT INTO courses (course_id, course_name, instructor_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $course_id, $course_name, $instructor_id);

    if ($stmt->execute()) {
        $create = "Course created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content1">
         <div class="instructor">
                <h1>Instructor Dashboard</h1>
                <a href="manage_enrollment.php">Manage Enrollments</a>
                <a href="create_course.php">Create Course</a>
                <a href="add_student.php">Add Student</a>
                <a href="logout.php">Logout</a>
        </div>

        <div class="course">
            <div class="container">
                <h1>Create Course</h1>
                <form action="create_course.php" method="POST">
                    <label for="course_name">Course Name:</label>
                    <input type="text" name="course_name" id="course_name" required>
                    <?php if (isset($create)) echo "<p style='color: black;'>$create</p>"; ?>
                    <button type="submit">Create Course</button>
                </form>
            </div>
        </div>
    </div>
    <style>
        .container{
            background-color: white;
            width: 400px;
            height: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        form{
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }
        h1{
            padding-top: 30px;
            text-align: center;
        }
        input{
            padding: 10px;
           
        }
        label{
            padding-top: 15px;
        }
        button{
            margin-top: 20px;
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            border: none;
            color: black;
            font-size: 15px;
            background-color: hsl(120, 88%, 25%);
        }
        button:hover{
            background-color: hsla(120, 88%, 25%, 0.842);
        }
    </style>
</body>
</html>