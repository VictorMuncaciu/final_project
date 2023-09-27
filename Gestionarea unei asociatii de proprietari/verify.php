<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Inregistrare</title>
</head>

<style>

.successText {
  text-align: center;
}

h1 {
  text-align: center;
}

</style>

<body bgcolor="#C5FBFF">

<?php
    // Connect to the database
    $db = new mysqli("127.0.0.1", "root", "", "my_users");

    // Get the token and email address from the query string
    $token = mysqli_real_escape_string($db, $_GET['token']);
    $email = mysqli_real_escape_string($db, $_GET['email']);

    // Look up the token and email address in the database
    $query = "SELECT * FROM users WHERE email='$email' AND token='$token'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update the user's account to active and set the token to NULL so the user cannot reactivate his account by clicking the link again in case it's set to inactive by admin
		$query = "UPDATE users SET is_active = 1, token = '' WHERE email = '$email'";
		mysqli_query($db, $query);

		// Update the user's account to active
        //$query = "UPDATE users SET is_active=1 WHERE email='$email'";
        //mysqli_query($db, $query);

        // Display a message to the user
        echo "<div class='successText'>
		      <h1>Adresa dumneavoastra de email a fost verificata cu succes. Puteti sa va logati in cont incepand de acum.</h1> <br>
		      <a href='loginOrRegister.php' style='font-size: 30px;'>Apasati aici pentru a fi redirectionat la pagina de logare.</a>
			  </div>";
    } else {
        // Display an error message
        echo "<h1>Token sau adresa de email invalida.</h1>";
    }
	
	$db->close();
?>

</body>
</html>