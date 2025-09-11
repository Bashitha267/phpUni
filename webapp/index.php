<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "kingnimesh26", "user_details");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if username and password are set
if (isset($_POST['username']) && isset($_POST['password'])) {

    // Sanitize user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the users table
    // The rest of the query is not visible in the image.
    // It likely starts like this:
    // $sql = "SELECT * FROM users WHERE username = '$username' ...";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>My First PHP Website</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    // echo"Hello World";
    ?>
    <div class="menu">
        <a href="login.php" class="btn-login">click here to login</a>
        <a href="register.php" class="btn-login">click here to Register</a>
    </div>
    <div>
        <?php echo "username: $username" ?>
        <?php echo "password: $password" ?>

    </div>


</body>