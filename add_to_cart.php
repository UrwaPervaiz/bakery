<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cake";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$image = $_POST['image'];
$price = $_POST['price'];
$name = $_POST['name'];

$check_sql = "SELECT * FROM cart WHERE image = '$image' AND name = '$name'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    echo '<script>
            alert("Item already in the cart.");
            window.location.href = "cake.php";
          </script>';
} else {
    $sql = "INSERT INTO cart (image, price, name) VALUES ('$image', '$price', '$name')";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>
                alert("Item added to the cart.");
                window.location.href = "cake.php";
              </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
