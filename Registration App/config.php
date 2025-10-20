<?php
$DB_HOST = 'localhost';  
$DB_USER = 'root';  // default mySQL user
$DB_PASS = '';
$DB_NAME = 'registration';  // database name
$DB_CHARSET = 'utf8mb4';  // ensures full Unicode support (ex: emojis)

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // Handle connection error (script stops immediately and shows error message)
}
?>