<html>

<head>
    <title>My first PHP Website</title>
</head>

<body>
    <h2>Registration Page</h2>
    <a href="index.php">Click here to go back</a><br /><br />
    <form action="register.php" method="POST">
        Enter Username: <input type="text" name="username" required="required" /> <br />
        Enter password: <input type="password" name="password" required="required" /> <br />
        <input type="submit" value="Register" />
    </form>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to database
    $conn = new mysqli("localhost", "root", "", "first_db");
    $bool = true;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // echo "Username entered is: " . $username . "<br />";
    // echo "Password entered is: " . $password;

    // Check if username already exists
    $query = mysqli_query($conn, "SELECT * from users where username='$username'");

    if (mysqli_num_rows($query) > 0) {
        $bool = false;
        echo '<script>alert("Username has been taken!");</script>';
        echo '<script>window.location.assign("register.php");</script>';
    }

    if ($bool) {
        $insert = mysqli_query($conn, "INSERT INTO users () VALUES ()");
        if ($insert) {
            echo '<script>alert("Successfully Registered!");</script>';
            echo '<script>window.location.assign("register.php");</script>';
        } else {
            echo '<script>alert("Error registering user.");</script>';
        }
    }

    $conn->close();
}
?>