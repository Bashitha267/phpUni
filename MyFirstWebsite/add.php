<?php
// Start session to verify the user is logged in
session_start();
if (!isset($_SESSION['user'])) {
    header("location: index.php"); // Redirect if the user is not logged in
    exit();
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "newDatabaseList");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $details = $_POST['details'];
    $public = isset($_POST['public']) ? 'yes' : 'no'; // Check if public checkbox is checked

    // Get current date and time
    $date_posted = date("Y-m-d");
    $time_posted = date("H:i:s");

    // Insert the new item into the database
    $stmt = $conn->prepare("INSERT INTO list (details, date_posted, time_posted, public) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $details, $date_posted, $time_posted, $public);
    
    if ($stmt->execute()) {
        // Redirect to the home page after successful insertion
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>