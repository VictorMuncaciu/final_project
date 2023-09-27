<?php

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

session_start();
// Get id_user from session or cookie
if (isset($_SESSION["id_user"])) {
	$id_user = $_SESSION["id_user"];
}
else {
		if (isset($_COOKIE["id_user"])) {
			$id_user = $_COOKIE["id_user"];
		}
}

// Get the selected idContor values from the form
$idContor = $_POST["idContor"];

// Loop through the selected idContor values and through each month and insert them into the tbConsum table
foreach ($idContor as $contor) {
	for ($i = 1; $i <= 12; $i++)
	{
		$sql = "INSERT INTO tbConsum (id_contor, id_luna, id_user) VALUES ('$contor', '$i', '$id_user')";
		$db->query($sql);
	}
}

// Close the database connection
$db->close();

// Redirect the user back to the form
header("Location: myCounters.php");

?>
