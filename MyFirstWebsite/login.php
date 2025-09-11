<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Login Page</h2>
        <a href="index.php">Click here to go back</a><br/><br/>
        <form action="login.php" method="POST">
           Enter Username: <input type="text" 
           name="username" required="required" /> <br/>
           Enter password: <input type="password" 
           name="password" required="required" /> <br/>
           <input type="submit" value="Login"/>
        </form>
    </body>
</html>
<?php
    session_start();

    // Connect to database
    $conn = new mysqli("localhost", "root", "", "first_db");

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
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $table_users = $row['username'];
            $table_password = $row['password'];

            // Check if passwords match (Note: this assumes passwords are stored as plaintext — insecure!)
            if ($password === $table_password) {
                $_SESSION['user'] = $username;
                header("Location: home.php");
                exit();
            } else {
                echo '<script>alert("Incorrect password!");</script>';
                echo '<script>window.location.assign("login.php");</script>';
            }
        } else {
            echo '<script>alert("Incorrect username!");</script>';
            echo '<script>window.location.assign("login.php");</script>';
        }

    } 
    $conn->close();
?>