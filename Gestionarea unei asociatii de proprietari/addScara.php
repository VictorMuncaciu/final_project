<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
     
  <title>Add Scara - e-Asociatie</title>
  
  <style>
    h1, h3, h4 {
	  text-align: center;
	}
  </style>
  
</head>

<body>

<?php

// Get the values from the form
$id_bloc = $_POST["idBlocField"];
$scara = $_POST["scaraField"];
$nrApScara = $_POST["nrApScaraField"];

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Insert the new scara into the database
$query = "INSERT INTO tbscara (id_bloc, Scara, nr_ap_scara)
		  VALUES ('$id_bloc', '$scara', '$nrApScara')";

// Check if the query was successful
if ($db->query($query)) {
    echo "<h1>Record inserted successfully</h1><br>";
} else {
    echo "<h1>Error inserting record: " . $db->error . "</h1>";
}

echo '<a href="setScariBlocuri.php">';
echo '<h3>Inapoi la Adaugare scara/bloc</h3>';
echo '</a>';

// Close the database connection
$db->close();
  
?>

</body>
</html>