<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "demo");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$first_name = mysqli_real_escape_string($link, $_POST['fname']);
$last_name = mysqli_real_escape_string($link, $_POST['lname']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$dateOfTravel = mysqli_real_escape_string($link, $_POST['dateOfTravel']);
$phone = mysqli_real_escape_string($link, $_POST['phone']);
$persons = mysqli_real_escape_string($link, $_POST['persons']);
$city = mysqli_real_escape_string($link, $_POST['city']);
$place = mysqli_real_escape_string($link, $_POST['place']);
$days = mysqli_real_escape_string($link, $_POST['daysSpend']);
//$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$privacy = mysqli_real_escape_string($link, $_POST['privacy']);

// Attempt insert query execution
$sql = "INSERT INTO customers(first_name, last_name, email, dateOfTravel, phone, persons, city, place, days, privacy) VALUES ('$first_name', '$last_name', '$email', '$dateOfTravel', '$phone', '$persons', '$city', '$place', '$days', '$privacy')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
