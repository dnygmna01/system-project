<?php
// Include the authentication, session management, and database files
include('auth.php');
include('db.php');

// Start session for session management and timeout functionality
//session_start();

// Set session timeout duration (e.g., 1 hour)
$timeout_duration = 3600;

// Check if the session has been inactive for too long
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    // If the session has been inactive for too long, destroy it
    session_unset();    // Clear session variables
    session_destroy();  // Destroy the session
    header("Location: login.php");  // Redirect to the login page after session timeout
    exit;
}

// Update last activity time to prevent session timeout
$_SESSION['last_activity'] = time();

// Check if the user has the "admin" role (role ID = 1)
check_auth(1); // Admin role only

// Fetch all users with their role information
$query = "SELECT users.user_id, users.username, users.email, roles.role_name 
          FROM users 
          JOIN roles ON users.role_id = roles.role_id";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    
    <div class="content">
        <!-- Admin Navigation Sidebar -->
        <div class="admin">
            <h1>Admin Dashboard</h1>
            <a href="manage_users.php">Manage Users</a>
            <a href="add_user.php">Add User</a>
            <a href="logout.php">Logout</a>
        </div>
        
        <!-- Display User Information in a Table -->
        <div class="user">
            <div class="table">
                <h2>Role Users</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                    <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $user['user_id']; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['role_name']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
   
    <style>
        body{
            background-color: white;
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
            height: 100vh;
        }
        .content{
            display: flex;
            gap: 50px;
        }
        .admin{
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
        h1{
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 1rem;
            color: white;
        }
        table{
            width: 150%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
            overflow: scroll;
        }
        .table{
            padding-left: 60px;
        }
        th, td{
            border: 1px solid hsl(0, 8%, 90%);
            padding: 12px;
        }
        th{
            background-color: hsl(0, 11%, 91%);
            font-weight: bold;
        }
        tr:nth-child(even){
            background-color: hsl(0, 37%, 97%);
        }
        tr:hover{
            background-color: hsl(0, 20%, 90%);
        }
    </style>
</body>
</html>