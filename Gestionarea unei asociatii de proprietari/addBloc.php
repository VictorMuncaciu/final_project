<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
     
  <title>Add Bloc - e-Asociatie</title>
  
  <style>
    h1, h3, h4 {
	  text-align: center;
	}
  </style>
  
</head>

<body>

<?php

// Get the values from the form
$descriere = $_POST["descriereField"];
$numeBloc = $_POST["numeBlocField"];
$nrScari = $_POST["nrScariField"];
$adresa = $_POST["adresaField"];

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Insert the new bloc into the database
$query = "INSERT INTO tbbloc (Descriere, nume_bloc, nr_scari, Adresa)
		  VALUES ('$descriere', '$numeBloc', '$nrScari', '$adresa')";

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