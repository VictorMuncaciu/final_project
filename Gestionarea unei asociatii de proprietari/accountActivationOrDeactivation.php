<?php
// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}  

// Retrieve the username and action from the GET parameters
$email = $_GET['email'];
$action = $_GET['action'];

// Perform the necessary database update based on the action
if ($action == 'activate') {
	// Code to activate the user account in the database
    $query = "UPDATE users SET is_active = 1 WHERE email = '$email'";
	$result = $db->query($query);
} elseif ($action == 'deactivate') {
    // Code to deactivate the user account in the database
	$query = "UPDATE users SET is_active = 0 WHERE email = '$email'";
	$result = $db->query($query);
}

// Redirect back to the page displaying the user accounts
header("Location: creator_accountsManagement.php");

?>
