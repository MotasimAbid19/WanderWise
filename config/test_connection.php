<?php
// Include the database connection file
include('db.php');


// Check if the connection was successful
if ($conn) {
    echo "Successfully connected to the database!";
} else {
    echo "Failed to connect to the database.";
}
?>
