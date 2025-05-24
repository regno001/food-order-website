<?php
session_start();

define('SITEURL', 'http://localhost:8080/coffie/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'coffiee');

// Database connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$db_select = mysqli_select_db($conn, DB_NAME);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>
