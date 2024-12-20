<?php
include('auth.php');
include('db.php');
check_auth(1); // Admin role only

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, email, password_hash, role_id) 
              VALUES ('$username', '$email', '$password_hash', '$role_id')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
        <div class="content">
            <h1>Add User</h1>
            <form action="add_user.php" method="POST">   
                <label for="usernmae">Name:</label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role_id" required>
                <option value="3">Student</option>
                <option value="2">Instructor</option>
                </select>
                <button type="submit">Add</button>
            </form>
        </div>
</body>
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
    </style>
</html>
