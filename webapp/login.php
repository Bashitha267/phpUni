<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "", "user_details");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if username and password are set
if (isset($_POST['username']) && isset($_POST['password'])) {

    // Sanitize user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM user_details WHERE username = '$username' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // If you stored plain text password (NOT secure, but works for testing)
        if ($password === $row['password']) {
            $_SESSION['username'] = $row['username']; // save session
            $message = "✅ Login successful! Welcome " . $row['username'];
        } else {
            $message = "❌ Invalid password.";
        }

        /* 
        👉 If you used password_hash() during registration:
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $message = "✅ Login successful! Welcome " . $row['username'];
        } else {
            $message = "❌ Invalid password.";
        }
        */
    } else {
        $message = "❌ No such user found.";
    }
    // Query the users table
    // The rest of the query is not visible in the image.
    // It likely starts like this:
    // $sql = "SELECT * FROM users WHERE username = '$username' ...";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body style="display:grid;place-items: center;">
    <div class="login-title" style="font-size:larger; font-weight: 600; margin-bottom: 15px;">Login</div>
    <form action="login.php" method="post" style="border:solid;border-color: black; padding: 15px;">
        <div class="login-section"
            style="display: flex;justify-content: center;flex-direction: column; height: 100%; width:80%;">
            <div> <label>Username:</label>
                <input type="text" name="username">
            </div>
            <div> <label>Password:</label>
                <input type="password" name="password">
            </div>
            <div class="" style="margin-top: 10px;">
                <input type="submit" value="Login">
            </div>
        </div>





    </form>
</body>

</html>