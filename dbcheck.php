<?php
$servername = $_ENV['MYSQL_SERVICE_HOST'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    $db_selected = mysql_select_db($_ENV['MYSQL_DATABASE'], $conn);
} 

echo "Connected successfully";
?>
