<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Adaugare acte asociatie - e-Asociatie</title>
  
  <style>
  	h1, h3, h4 {
	  text-align: center;
	}
  </style>
  
</head>

<?php session_start(); ?>
<body>

<?php include 'header.php'; ?>

<?php

// Get the values from the form
$id_asociatie = $_POST["idAsociatieField"];

// Check if a file was uploaded
if ($_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
	$uploadedFileName = $_FILES['pdf_file']['name'];
	$targetDirectory = 'pdf/';
	$targetFilePath = $targetDirectory . $uploadedFileName;

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetFilePath)) {
        // File uploaded successfully, insert file path into the database
		// Connect to the database
		$db = new mysqli("127.0.0.1", "root", "", "my_users");

		// Check the connection
		if ($db->connect_error) {
		  die("Connection failed: " . $db->connect_error);
		}

		$finalFilePath = '/edsa-asociatieProprietari/' . $targetFilePath;
        $sql = "INSERT INTO tbpdf (pdf_file_path, id_asociatie) 
				VALUES ('$finalFilePath' , '$id_asociatie')";
		
		// Check if the query was successful
		if ($db->query($sql)) {
			echo "<h1>Record inserted and stored successfully.</h1><br>";
		} else {
			echo "<h1>Error inserting record: " . $db->error . "</h1>";
		}

        // Display success message
        echo "<h1>File uploaded successfully.</h1>";
		
		// Close the database connection
		$db->close();		
    } else {
        // Failed to move the uploaded file
        echo "Error occurred while moving the uploaded file.";
    }
} else {
    // File upload failed
    echo "Error: " . $_FILES['pdf_file']['error'];
}

echo '<a href="creator_addDocuments.php">';
echo '<h3>Inapoi la Adaugare acte asociatie</h3>';
echo '</a>';

?>

</div>

<!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
