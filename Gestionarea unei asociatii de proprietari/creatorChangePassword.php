<?php

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Get form data
$current_password = $_POST['currentPass'];
$new_password = $_POST['newPass'];

// Get email from session or cookie variables
session_start();
if (isset($_SESSION["email"])) {
	$email = $_SESSION["email"];
}
else {
	if (isset($_COOKIE["email"])) {
		$email = $_COOKIE["email"];
		}
	}

// Verify current password
$query = "SELECT password FROM users WHERE email = '$email'";
$result = $db->query($query);

$row = $result->fetch_assoc();
$hashed_password = $row['password'];

if (password_verify($current_password, $hashed_password)) {
	// Password is correct, it matches the one in the database
	// Update password
	$new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
	$query = "UPDATE users SET password = '$new_password_hash' WHERE email = '$email'";
	$result = $db->query($query);
	
	$_SESSION['succes_pass_change'] = true;
	header("Location: creator_myAccount.php");
	
} else {
    // Password is incorrect
	$_SESSION['incorrect_pass'] = true;
	header("Location: creator_myAccount.php");	
    }


$db->close();

?>