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

// Get number of rows from hidden field in form
$num_rows = $_POST["num_rows"];

// Get current month number
$month = date('m');

// Get DISTINCT id_contor from query which has the same number of rows as in the php file
$query = "SELECT DISTINCT
				tbconsum.id_contor
			FROM
				tbconsum
			INNER JOIN tbcontoare ON tbconsum.id_contor = tbcontoare.id_contor
			WHERE
				tbconsum.id_user = $id_user
			ORDER BY
				tbcontoare.Denumire;";
					
$result = mysqli_query($db, $query);

// Initialize an array to store the distinct contor names
$rows = array();

// Loop through each row in the result set and store it in the array 
while ($row = mysqli_fetch_assoc($result)) {
	$rows[] = $row;
}

for ($i = 0; $i < $num_rows; $i++) {
  $valoareCurenta = $_POST['value' . $i];
  $idContor = $rows[$i]['id_contor'];
  //echo $valoareCurenta . " " . $id_user . " " . $month . " " . $idContor;
  
  // use $valoareCurenta, $id_user, $month and $idContor to update the MySQL table as needed
  $query = "UPDATE tbconsum SET Valoare = $valoareCurenta WHERE id_user = $id_user AND id_luna = $month AND id_contor = $idContor;";
  
  $result = mysqli_query($db, $query);
  
  //echo $valoareCurenta;
  //echo "<br>";
}

header("Location: myCounters.php");

$db->close();
?>
