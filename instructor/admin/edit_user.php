<?php
include('auth.php');
include('db.php');
check_auth(1); // Admin role only

$user_id = $_GET['user_id'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    
    $query = "UPDATE users SET username='$username', email='$email', role_id='$role_id' 
              WHERE user_id = $user_id";
    
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
    <title>Edit User</title>
</head>
<body>
    <div class="content">
            <form action="edit_user.php?user_id=<?= $user_id; ?>" method="POST">
                <h1>Edit User</h1>
                <label for="text">Name:</label>
                <input type="text" name="username" value="<?= $user['username']; ?>" required>
                
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= $user['email']; ?>" required>
                
                <label for="option">Role Option</label>
                <select name="role_id" required>
                    <option value="3" <?= $user['role_id'] == 3 ? 'selected' : ''; ?>>Student</option>
                    <option value="2" <?= $user['role_id'] == 2 ? 'selected' : ''; ?>>Instructor</option>
                    <option value="1" <?= $user['role_id'] == 1 ? 'selected' : ''; ?>>Admin</option>
                </select>
        
                <button type="submit">Update User</button>
            </form>
    </div>
    <style>
        body{
            font-family: Arial, sans-serif;
            background-color: hsl(0, 80%, 40%);
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .content{
            width: 50%;
            display: flex;
            justify-content: center;
            background-color: hsl(0, 20%, 94%);
            border-radius: 10px;
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
            width: 400px;
            padding: 7px;
           
        }
        label{
            padding-top: 15px;
        }
        select{
            padding: 7px;
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
    </style>
</body>
</html>
