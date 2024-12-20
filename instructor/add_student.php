<?php
include('auth.php');
include('db.php');
check_auth(2); // Instructor role only

// Fetch courses taught by the instructor
$instructor_id = $_SESSION['user_id'];
$query_courses = "SELECT course_id, course_name FROM courses WHERE instructor_id = ?";
$stmt_courses = $conn->prepare($query_courses);
$stmt_courses->bind_param("i", $instructor_id);
$stmt_courses->execute();
$result_courses = $stmt_courses->get_result();

// Fetch students
$query_students = "SELECT user_id, username FROM users WHERE role_id = 3";
$result_students = $conn->query($query_students);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $student_id = $_POST['student_id'];

    // Check if the student is already enrolled in the course
    $check_enrollment = "SELECT * FROM enrollments WHERE course_id = ? AND student_id = ?";
    $stmt_check = $conn->prepare($check_enrollment);
    $stmt_check->bind_param("ii", $course_id, $student_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "The student is already enrolled in the course.";
    } else {
        // Enroll the student in the course
        $insert_enrollment = "INSERT INTO enrollments (course_id, student_id) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($insert_enrollment);
        $stmt_insert->bind_param("ii", $course_id, $student_id);

        if ($stmt_insert->execute()) {
            $message = "Student successfully added to the course.";
        } else {
            $message = "Error enrolling student: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student to Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content2">
        <div class="instructor">
             <h1>Instructor Dashboard</h1>
             <a href="manage_enrollment.php">Manage Enrollments</a>
             <a href="create_course.php">Create Course</a>
             <a href="add_student.php">Add Student</a>
             <a href="logout.php">Logout</a>
        </div>

        <div class="container">
                <h1>Add Student to Course</h1>
                <?php if (isset($message)): ?>
                <p><?= $message; ?></p>
                <?php endif; ?>

                <form action="" method="POST">
                  <label for="course_id">Select Course:</label>
                  <select name="course_id" id="course_id" required>
                        <option value="">Select a Course</option>
                        <?php while ($course = $result_courses->fetch_assoc()): ?>
                            <option value="<?= $course['course_id']; ?>"><?= $course['course_name']; ?></option>
                        <?php endwhile; ?>
                  </select>

                <label for="student_id">Select Student:</label>
                <select name="student_id" id="student_id" required>
                    <option value="">Select a Student</option>
                    <?php while ($student = $result_students->fetch_assoc()): ?>
                        <option value="<?= $student['user_id']; ?>"><?= $student['username']; ?></option>
                    <?php endwhile; ?>
                </select>

                <button type="submit">Add Student</button>
            </form>
        </div>
        
    </div>
   
    <style>
        .container{
            background-color: white;
            width: 400px;
            height: 450px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            margin-top: 50px;
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
        select{
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