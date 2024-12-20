<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div name="role_id">
        <div name="3" class="student"><a href="add_user.php">Student</a></div>
        <div name="2" class="instructor"><a href="add_user.php">Instructor</a></div>
        <div name="1" class="admin"><a href="add_user.php">Admin</a></div>
    </div>
</body>
<style>
    body{
        font-family: Arial, sans-serif;
        padding: 0;
        margin: 0;
    }
    div{
        display: flex;
        align-items: center;
        flex-direction: column;
        gap: 20px;
    }
    .student{
        width: 300px;
        height: 45px;
        padding-top: 25px;
        background-color: hsl(240, 57%, 51%);
        border-radius: 10px;
    }
    .student:hover{
        background-color: hsla(240, 57%, 51%, 0.575);
    }
    .instructor{
        width: 300px;
        height: 45px;
        padding-top: 25px;
        background-color: hsl(120, 82%, 33%);
        border-radius: 10px;
    }
    .instructor:hover{
        background-color: hsla(120, 82%, 33%, 0.637);
    }
    .admin{
        width: 300px;
        height: 45px;
        padding-top: 25px;
        background-color: hsl(0, 80%, 54%);
        border-radius: 10px;
    }
    .admin:hover{
        background-color: hsla(0, 80%, 54%, 0.507);
    }
    a{
        color: white;
        text-decoration: none;
    }
</style>
</html>