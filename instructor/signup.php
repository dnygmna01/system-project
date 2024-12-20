<?php
// Include database connection
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role_id = $_POST['role_id'];

    // Validate username (min 3 characters, max 20 characters)
    if (strlen($username) < 3 || strlen($username) > 20) {
        $notusername = "Username must be between 3 and 20 characters.";
    }
    // Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $notemail = "Invalid email format.";
    }
    // Validate password (minimum 8 characters)
    elseif (strlen($password) < 8){
        $notpassword = "Password must be at least 8 characters long.";
    }
    // Check if passwords match
    elseif ($password !== $confirm_password) {
        $notmatch = "Passwords do not match!";
    } else {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL statement
        $query = "INSERT INTO users (username, email, password_hash, role_id) 
                  VALUES (?, ?, ?, ?)";

        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind the parameters to the query
            mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $password_hash, $role_id);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page on success

                header("Location: login.php");
                exit;
            }else {
                // Display error message on failure
                echo "Error: " . mysqli_error($conn);
            }

            // Close the prepared statement
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
    <title>Signup</title>
</head>
<body>
    <div class="content">
        <h1>Sign up</h1>

        <form action="signup.php" method="POST">
            <label for="username">Name:</label>
            <input type="text" name="username" placeholder="Username" required>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            
            <label for="role_id"></label>
            <button name="role_id" value="3" type="submit">Signup</button>cho "<p style='color: red;'>$already</p>"; ?>
            <?php if (isset($notusername)) echo "<p style='color: red;'>$notusername</p>"; ?>
            <?php if (isset($notpassword)) echo "<p style='color: red;'>$notpassword</p>"; ?>
            <?php if (isset($notemail)) echo "<p style='color: red;'>$notemail</p>"; ?>
            <?php if (isset($notmatch)) echo "<p style='color: red;'>$notmatch</p>"; ?>
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
    <script src="signup.js"></script>
</body>
</html>