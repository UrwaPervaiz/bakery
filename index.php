<?php
include 'db.php';
session_start();

// Check if the user is logged in and session has timed out
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ((time() - $_SESSION['login_time']) > 5) { // 5 seconds timeout
        session_unset();
        session_destroy();
        echo "<script>alert('Session expired. Please log in again.'); window.location.href='index.php';</script>";
        exit();
    }
}

$error = '';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $checkEmailSql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkEmailSql);

        if ($result->num_rows > 0) {
            $error = "Email already exists.";
        } else {
            // Insert new user into the database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                // Set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['login_time'] = time();

                echo "<script>alert('Registration successful'); window.location.href='login.php';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validatePassword(password) {
            const passwordRegex = /^(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,10}$/;
            return passwordRegex.test(password);
        }

        function validateForm(event) {
            const password = document.forms["registerForm"]["password"].value;
            const confirmPassword = document.forms["registerForm"]["confirm_password"].value;
            
            if (!validatePassword(password)) {
                alert("Password must be 6-10 characters long and include at least one special character.");
                event.preventDefault();
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="error-show">
    <?php if (!empty($error)): ?>
        <?php echo $error; ?>
    <?php endif; ?>
</div>

<div class="container">
    <h2>Register</h2>
    <form name="registerForm" method="post" action="" onsubmit="validateForm(event)">
        <h5>Username</h5>  <input type="text" name="username" required><br>
        <h5>Email</h5><input type="email" name="email" required><br>
        <h5>Password</h5> <input type="password" name="password" required><br>
        <h5>Confirm Password</h5> <input type="password" name="confirm_password" required><br>
        <input type="submit" value="Create Account">
    </form>
    <div><h4>Already have an Account? <a href="login.php">Login Here</a></h4></div>
</div>

</body>
</html>
