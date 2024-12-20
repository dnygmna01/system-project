<?php
// Start the session to check for an existing session
session_start();

// Include database connection
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    }
    // Validate password (minimum 8 characters)
    elseif (strlen($password) < 8) {
       // echo "Password must be at least 8 characters long.";
       $notvalid ="Password must be at least 8 characters long.";
    }else {
        // Prepare the SQL statement
        $query = "SELECT user_id, username, password_hash, role_id FROM users WHERE email = ?";

        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind the parameters to the query
            mysqli_stmt_bind_param($stmt, "s", $email);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Store the result
            mysqli_stmt_store_result($stmt);

            // Check if the email exists
            if (mysqli_stmt_num_rows($stmt) > 0) {
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $user_id, $username, $password_hash, $role_id);

                // Fetch the result
                mysqli_stmt_fetch($stmt);

                // Verify the password
                if (password_verify($password, $password_hash)) {
                    // if password is correct, create session variables
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['role_id'] = $role_id;

                    if ($role_id == 1) {
                        header("Location: admin/admin_dashboard.php");
                    } elseif ($role_id == 2) {
                        header("Location: instructor_dashboard.php");
                    } else {
                        header("Location: ../student_dashboard.php");
                    }
                    exit;
                } else {
                    $error = "Incorrect password!";
                }
            } else {
                $nouser = "No user found with that email!";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing query.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="content">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password" required>
            
            <button type="submit">Login</button>
            <p>Don't have an account? | <a href="signup.php">Sign up</a></p>           
            <?php if (isset($nouser)) echo "<p style='color: red;'>$nouser</p>"; ?>
            <?php if (isset($notvalid)) echo "<p style='color: red;'>$notvalid</p>"; ?>
            <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        </form>
    </div>

    <style>
        body{
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: hsl(0, 80%, 40%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .content{
            background-color: hsl(0, 39%, 95%);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
        }
        h1{
            text-align: center;
        }
        form{
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            padding: 0.5rem;
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
        p{
            text-align: center;
        }

    </style>
</body>
</html>