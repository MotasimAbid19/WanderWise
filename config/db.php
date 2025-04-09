<?php
// Database info
$host = "localhost";
$username = "root"; 
$password = "";
$database = "wanderwise_db";

// Create connection (actually creating a mysqli object)
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
