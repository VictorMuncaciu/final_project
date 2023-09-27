<?php
  // Connect to the database
  $db = new mysqli("127.0.0.1", "root", "", "my_users");

  // Check the connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // Retrieve the email and token from the URL parameters
  $email = $_GET['email'];
  $token = $_GET['token'];

  // Check if the email and token match
  $query = "SELECT * FROM users WHERE new_email = '$email' AND token = '$token'";
  $result = mysqli_query($db, $query);
  
  if (mysqli_num_rows($result) == 1) {
    // Update the user's email address in the database and set NULL both token and new_email variables from the database
    $query = "UPDATE users SET email = '$email', new_email = '', token = '' WHERE token = '$token'";
    mysqli_query($db, $query);

    // Display a confirmation message to the user
	echo "Adresa dumneavoastra de email a fost updatata la $email.<a href='testMainPage.php'>Dati click aici pentru a va intoarce pe pagina principala.</a>";
	
	// Change the session and email variables so the text updates to the new address in the main screen and myAccount page
	session_start();
	$_SESSION["email"] = $email;
	setcookie("email", $email, time() + (30 * 24 * 60 * 60), "/");
	
  } else {
    // Display an error message to the user
    echo "Invalid email address or token.";
  }
  
  $db->close();
?>
