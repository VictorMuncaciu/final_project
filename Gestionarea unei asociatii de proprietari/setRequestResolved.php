<?php
// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}  

// Retrieve the username and action from the GET parameters
$id_request = $_GET['id_request'];

$query = "UPDATE tbuserrequests SET is_resolved = 1 WHERE id_request = '$id_request'";
$result = $db->query($query);


// Redirect back to the page displaying the user accounts
header("Location: creator_userRequests.php");

?>
