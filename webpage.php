<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">School Hub</div>
        <nav>
           <ul>
            <li><a href="about.html" class="a">About</a></li>
            <li><a href="login.php" class="a">Log in</a></li>
            <li><a href="signup.php" class="signup-btn">Sign up</a></li>
           </ul>
        </nav>
        </div>
    </header>
   
    <main class="content">
        <div>
            <h1>Welcome to <span>School hub </span> online portal</h1>
            <button class="explore-btn">Explore</button>
        </div>
    </main>
</body>
<style>
    body{
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: hsl(0, 80%, 40%);
    }
    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background-color: hsl(0, 13%, 92%);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }
    .logo{
        font-size: 1.2rem;
        font-weight: bold;
    }
    .navbar ul{
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .navbar li{
        margin-left: 1.5rem;
    }
    .navbar a{
        text-decoration: none;
        color: hsl(0, 0%, 3%);
        font-size: 500;
    }
    .signup-btn{
        background-color: hsl(0, 80%, 40%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-weight: bold;
    }
    .signup-btn:hover{
        background-color: hsla(0, 80%, 40%, 0.562);
    }
    .a:hover{
        text-decoration: underline;
    }
    .content{
        display: flex;
        flex-direction: column;
        text-align: center;
        padding: 5rem 2rem;
        padding-top: 15rem;
    }
    .content h1{
        font-size: 2.3rem;
        margin-bottom: 1.5rem;
    }
    span{
        color: white;
        font-weight: bold;
    }
    .explore-btn{
        padding: 0.75rem 2rem;
        font-size: 1rem;
        font-weight: bold;
        color: white;
        background-color: hsl(0, 0%, 3%);
        border: none;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
        cursor: pointer;
    }
    .explore-btn:hover{
        background-color: hsla(0, 0%, 3%, 0.781);
    }

    
</style>
</html>