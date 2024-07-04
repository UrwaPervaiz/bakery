<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {  
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['LOGIN_TIME'] = time();
            header("Location: index-2.php");
            exit();
        } else {
            echo "<script>alert('Invalid password'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('You are not registered. Redirecting to register page.'); window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <h2>Login</h2>
        
        <form method="post" action="">
            <h5>Email </h5><input type="email" name="email" required><br>
            <h5>Password</h5> <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
        <div><h4>Don't have an Account?  <a href="index.php">SignUp Here</a></h4></div>
</div>


  
</body>
</html>
