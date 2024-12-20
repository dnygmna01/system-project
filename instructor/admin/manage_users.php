<?php
include('auth.php');
include('db.php');
check_auth(1); // Admin role only

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
    <title>Manage Users</title>
</head>
<body>
    <div class="content">

         <div class="admin">
             <h1>Admin Dashboard</h1>
                <a href="manage_users.php">Manage Users</a>
                <a href="add_user.php">Add User</a>
                <a href="logout.php">Logout</a>
          </div>

        <div class="user">
           <div class="table">
             <h2>Manage Users</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $user['user_id']; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['role_name']; ?></td>
                        <td>
                            <a href="edit_user.php?user_id=<?= $user['user_id']; ?>" class="edit">Edit</a>
                            <a href="delete_user.php?user_id=<?= $user['user_id']; ?>" class="delete">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
           </div>
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
            gap: 100px;
        }
        .admin{
            box-shadow: 0 6px 8px rgba(0, 0, 0, 20);
            background-color: hsl(0, 80%, 40%);
            height: 100vh;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .admin a{
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
        h2{
            color: hsl(0, 0%, 20%);
        }
        table{
            width: 120%;
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
        .edit{
            background-color: hsl(122, 73%, 37%);
            color: white;
        }
        .delete{
            background-color: hsl(4, 67%, 45%);
            color: white;
        }
    </style>
</body>
</html>