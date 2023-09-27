<?php

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get the id_user from hidden field from form
$id_user = $_POST["id_user"];

$message = $_POST["messageField"];;

$sql = "INSERT INTO tbuserrequests (Message, id_user) VALUES ('$message', '$id_user')";
$db->query($sql);

// Close the database connection
$db->close();

// Redirect the user back to the form
header("Location: myRequests.php");

?>
