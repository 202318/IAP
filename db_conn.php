<?php
$servername = "localhost";   // usually "localhost"
$username   = "root";        // your MySQL username
$password   = "0000";            // your MySQL password (often empty in XAMPP/WAMP)
$dbname     = "testdb";      // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Connected successfully to database!<br>";
}
?>