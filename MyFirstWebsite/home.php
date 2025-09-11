<html>

<head>
    <title>My first PHP Website</title>
</head>
<?php
        session_start(); //starts the session
        if($_SESSION['user']){ // checks if the user is logged in  
        }
        else{
            header("location: index.php"); // redirects if user is not logged in
        }
        $user = $_SESSION['user']; //assigns user value
    ?>

<body>
    <h2>Home Page</h2>
    <p>Hello <?php echo "$user"?>!</p>
    <a href="logout.php">Click here to go logout</a><br /><br />
    <form action="add.php" method="POST">
        Add more to list: <input type="text" name="details" /> <br />
        Public post? <input type="checkbox" name="public[]" value="yes" /> <br />
        <input type="submit" value="Add to list" />
    </form>
    <h2 align="center">My list</h2>
    <table border="1px" width="100%">
        <tr>
            <th>Id</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Public Post</th>
        </tr>
        <?php
            // Connect to database
            $conn = new mysqli("localhost", "root", "", "newDatabaseList");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
                                                                             //database
            $query = mysqli_query($conn,"Select * from list");                      // SQL Query
            while($row = mysqli_fetch_array($query))
            {
                    echo "<tr>";
			        echo '<td align="center">'. $row['id'] . "</td>";
			        echo '<td align="center">'. $row['details'] . "</td>";
			        echo '<td align="center">'. $row['date_posted'] . 
                          " - " . $row['time_posted'] . "</td>";
			        echo '<td align="center">'. $row['date_edited'] . 
                          " - " . $row['time_edited'] ."</td>";
			        echo '<td align="center"><a href="edit.php">edit</a> </td>';
			        echo '<td align="center"><a href="delete.php">delete</a> </td>';
			        echo '<td align="center">'. $row['public'] . "</td>";
		            echo "</tr>";
            }
        ?>