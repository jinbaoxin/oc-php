<?php
$servername = $_ENV['MYSQL_SERVICE_HOST'];
$username = $_ENV['MYSQL_USERNAME'];
$password = $_ENV['MYSQL_PASSWORD'];

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    mysql_select_db($_ENV['MYSQL_DATABASE'], $conn);
    print_r(mysql_fetch_assoc(mysql_query("select * from emails")));
} 

echo "Connected successfully";
?>
