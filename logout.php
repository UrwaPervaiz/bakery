<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Sweet Delights Bakery</title>
    <link rel="stylesheet" href="style.css">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f8f9fa;
    }
    
    .logout-container {
        text-align: center;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 40px;
        max-width: 400px;
        width: 100%;
    }
    
    .logout-message h1 {
        color: #d9534f;
        margin-bottom: 20px;
    }
    
    .logout-message p {
        color: #5a5a5a;
        margin-bottom: 30px;
    }
    
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        background-color: #d9534f;
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
    
    .btn:hover {
        background-color: #c9302c;
    }
    
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-message">
            <h1>Goodbye!</h1>
            <p>Hope to see you soon again!</p>
            <a href="login.php" class="btn">Log out</a>
        </div>
    </div>
</body>
</html>
<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>