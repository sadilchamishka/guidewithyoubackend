<?php
    $servername   = "remotemysql.com";
    $database = "6MSA77OUlh";
    $username = "6MSA77OUlh";
    $password = "wMxh7pcg0l";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);
// Check connection
if ($connection->connect_error) {
   die("Connection failed: " . $connection->connect_error);
}
?>