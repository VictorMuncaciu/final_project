<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Contoarele mele - e-Asociatie</title>
  
  <style>
    h3, h4 {
		text-align: center;
	}
  
	table, th, td {
		margin: 0 auto;
		text-align: center;
		border: 1px solid black;
	}
  
  	tr:first-child {
		background-color: #1C98FF;
	}
	
	tr:nth-child(even) {
		background-color: lightblue;
	}
	
	input[type=submit] {
		padding: 14px 20px;
		color: white;
		border: none;
	}
  </style>
</head>

<?php session_start(); ?>
<body>

  <?php include 'header.php'; ?>
  
  <?php
	if (isset($_SESSION["username"])) {
		$username = $_SESSION["username"];
	}
	else {
		if (isset($_COOKIE["username"])) {
			$username = $_COOKIE["username"];
		}
	}
	echo "<h3>Salut $username! Bine ai venit pe pagina contoarelor tale!</h3> <hr><br>"; 
	?>  

  <?php
	// Connect to the database
	$db = new mysqli("127.0.0.1", "root", "", "my_users");

	// Check the connection
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}  
	
	if (isset($_SESSION["id_user"])) {
		$id_user = $_SESSION["id_user"];
	}
	else {
			if (isset($_COOKIE["id_user"])) {
				$id_user = $_COOKIE["id_user"];
			}
	}			
		
	$query = "SELECT
				apartamente.nr_apartament
			  FROM
				tbcarteaimobilului
			  INNER JOIN apartamente ON tbcarteaimobilului.id_apartament = apartamente.id_apartament
			  WHERE
				tbcarteaimobilului.id_user = $id_user
			  LIMIT 1;";
					
	$result = mysqli_query($db, $query);	

	if ($result->num_rows > 0) {	
		$row = $result->fetch_assoc();
		$nr_ap = $row["nr_apartament"];
		
		// Gets the current month in words
		$month = date('F');

		$ro_month_names = array(
			"January" => "ianuarie",
			"February" => "februarie",
			"March" => "martie",
			"April" => "aprilie",
			"May" => "mai",
			"June" => "iunie",
			"July" => "iulie",
			"August" => "august",
			"September" => "septembrie",
			"October" => "octombrie",
			"November" => "noiembrie",
			"December" => "decembrie"
		);

		// Translate the month name to Romanian
		$ro_month = $ro_month_names[$month];

		echo "<h4><b>Valorile pentru " . $nr_ap . " din luna " . $ro_month . " sunt :</b></h4><br>";
	}
	else {
		echo "<h4>Se pare ca acest cont nu are asociat niciun apartament!<br>
			  Trimiteti o solicitare creatorului pentru a va adauga date acestui cont!<br>
			  <b>(Vezi mai multe detalii in sectiunea Contul meu)</b></h4><br>";
	}

	// Check the number of distinct contoare 
	$query = "SELECT 
				COUNT(DISTINCT id_contor) AS count_contors
			  FROM
				tbConsum
			  WHERE
				id_user = $id_user;";
					
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
	$contorsCount = $row['count_contors'];
	
	// Check if any rows were returned (check if account is configured)
	if ($contorsCount > 0) {
		// Get current month from date() function
		$month = date('m');
		if ($month == 1)
		{
			$previousMonth = 12;
		}
		else{
			$previousMonth = $month - 1;			
		}
		
		// If contoare exists, get their distinct names and values from the previous month
		$queryForPrevMonth = "SELECT DISTINCT
								tbcontoare.Denumire,
								tbconsum.Valoare
							FROM
								tbconsum
							INNER JOIN tbcontoare ON tbconsum.id_contor = tbcontoare.id_contor
							WHERE
								tbconsum.id_user = $id_user AND tbconsum.id_luna = $previousMonth
							ORDER BY
								tbcontoare.Denumire;";
					
		$result = mysqli_query($db, $queryForPrevMonth);
		
		$queryForCurrentMonth = "SELECT
									tbconsum.Valoare as valoare_luna_curenta
								FROM
									tbconsum
								INNER JOIN tbcontoare ON tbconsum.id_contor = tbcontoare.id_contor
								WHERE
									tbconsum.id_user = $id_user AND tbconsum.id_luna = $month AND tbconsum.Valoare IS NOT NULL
								ORDER BY
									tbcontoare.Denumire;";
					
		$result2 = mysqli_query($db, $queryForCurrentMonth);
		
		// Initialize an array to store the distinct contor names and previous month values
		$rows = array();

		// Loop through each row in the result set and store it in the array 
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		
		// If data from current month is found, then print it in the table. 
		// If none is found, transfrom the table in a form and column "Valoare curenta contor" acts as input text
		if ($result2->num_rows > 0) {
			// Initialize an array to store the current month value 
			$valoareCurentaRows = array();
		
			// Loop through each row in the result2 set and store it in the array 
			while ($row = mysqli_fetch_assoc($result2)) {
				$valoareCurentaRows[] = $row;
			}	

			echo "<table>";
			echo "<tr>";
			echo "<th>Denumire contor</th>";
			echo "<th>Valoare precedenta contor</th>";
			echo "<th>Valoare curenta contor</th>";
			echo "<th>Consum</th>";
			echo "</tr>";
			
			for ($i = 0; $i < count($rows); $i++) {
				echo "<tr>";
				echo "<td>" . $rows[$i]['Denumire'] . "</td>";
				echo "<td>" . $rows[$i]['Valoare'] . "</td>";
				//echo "<td><input type='text' name='value" . $i . "' id='input" . $i . "' class='input-field'></input></td>";		
				echo "<td>" . $valoareCurentaRows[$i]['valoare_luna_curenta'] . "</td>";
				$consum = $valoareCurentaRows[$i]['valoare_luna_curenta'] - $rows[$i]['Valoare'];
				echo "<td>" . $consum . "</td>";
				echo "</tr>";
			} 	
			
			echo "</table><br>";
			
		} else {
			echo "<form action='saveData.php' method='post'>";
			echo "<table>";
			echo "<tr>";
			echo "<th>Denumire contor</th>";
			echo "<th>Valoare precedenta contor</th>";
			echo "<th>Valoare curenta contor</th>";
			echo "<th>Consum</th>";
			echo "</tr>";
			
			for ($i = 0; $i < count($rows); $i++) {
				echo "<tr>";
				echo "<td>" . $rows[$i]['Denumire'] . "</td>";
				echo "<td>" . $rows[$i]['Valoare'] . "</td>";
				// If valoare from previous month = NULL, we assume the user enters data 1st time so don't let the user introduce a value lower than 0,
				// otherwise the user can introduce a value higher than previous month value
				if ($rows[$i]['Valoare'] == NULL)
				{
					echo "<td><input type='number' name='value" . $i . "' id='input" . $i . "' step='any' class='input-field' min='0'></input></td>";
				} else {
					echo "<td><input type='number' name='value" . $i . "' id='input" . $i . "' step='any' class='input-field' min='" . $rows[$i]['Valoare'] . "'></input></td>";
				}
				echo "<td>Valoarea va fi afisata <b>dupa</b> introducerea si salvarea consumului!</td>";
				echo "</tr>";
			} 	
			
			echo "</table><br>";
			echo "<input type='hidden' name='num_rows' value='" . count($rows) . "'></input>";
			echo "<div style='text-align:center;'>";
			echo "<input type='submit' id='save-btn' value='Salvati citirea contoarelor' disabled></input>";
			echo "</div>";
			echo "</form><br>";
			
			// INSERT SCRIPT
			echo '  <script>
					  var inputs = document.getElementsByClassName("input-field");
					  var submitBtn = document.getElementById("save-btn");

					  submitBtn.style.backgroundColor = "#b8d1e1";

					  for (var i = 0; i < inputs.length; i++) {
						inputs[i].addEventListener("input", function() {
						  var isFilled = true;
						  for (var j = 0; j < inputs.length; j++) {
							if (inputs[j].value === "") {
							  isFilled = false;
							  break;
							}
						  }

						  if (isFilled) {
							submitBtn.disabled = false;
							submitBtn.style.backgroundColor = "#1C98FF";
							submitBtn.style.cursor = "pointer";
						  } else {
							submitBtn.disabled = true;
							submitBtn.style.backgroundColor = "#b8d1e1";
							submitBtn.style.cursor = "default";
						  }
						});
					  }
					</script>	';
		}
	} else {
		echo "<h4>Va rugam sa va configurati contul. Adaugati contoarele care se potrivesc cu apartamentul dvs. . <br>"; 
		echo "Daca unul sau mai multe dintre acestea nu se afla in lista, contactati administratorul pentru adaugarea acestora!</h4>";
		
		// Create the form table so the user can configure his account
		echo "<form method='post' action='process_form.php' onsubmit='return confirmForm()'>";
		echo "<table>";
		echo "<tr>";
		echo "<th>Denumire contor</th>";
		echo "<th>Adaugare la cont</th>";
		echo "</tr>";
		
		// Query the tbContoare table to retrieve the Denumire column
        $query = "SELECT id_contor, Denumire FROM tbContoare";
		$result = mysqli_query($db, $query);
		
		// Loop through the result set and populate the table rows
        while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["Denumire"] . "</td>";
            //echo "<td><input type='checkbox' name='idContor[]' value='" . $row["id_contor"] . "'></td>";
			echo "<td><input type='checkbox' name='idContor[]' value='" . $row["id_contor"] . "' class='my-checkbox'></td>";
            echo "</tr>";
		}
		
		echo "</table><br>";
		echo "<div style='text-align:center;'>";
		echo "<input type='submit' id='add-contors-btn' value='Adaugare contoare la cont' disabled>";
		echo "</div>";
		echo "</form><br>";
		
		// INSERT SCRIPT
		echo '
				<script>
					var checkboxes = document.getElementsByClassName("my-checkbox");
					var submitBtn = document.getElementById("add-contors-btn");

					submitBtn.style.backgroundColor = "lightblue";

					for (var i = 0; i < checkboxes.length; i++) {
						checkboxes[i].addEventListener("click", function() {
							var isChecked = false;
							for (var j = 0; j < checkboxes.length; j++) {
								if (checkboxes[j].checked) {
									isChecked = true;
									break;
								}
							}

							if (isChecked) {
								submitBtn.disabled = false;
								submitBtn.style.backgroundColor = "blue";
								submitBtn.style.cursor = "pointer";
							} else {
								submitBtn.disabled = true;
								submitBtn.style.backgroundColor = "lightblue";
								submitBtn.style.cursor = "default";
							}
						});
					}
				</script>
				
				<script>
					function confirmForm()
					{
						var confirmationMessage = "Sunteti sigur ca doriti sa adaugati aceste contoare la cont? Odata introduse nu vor mai putea fi schimbate, decat prin intermediul unei cereri catre administrator!";
						var confirmation = confirm(confirmationMessage);
						
						return confirmation;
					}
				</script>
		';

	}
	
	$db->close();
  ?>

<?php include 'footer.php'; ?>

  </div>
  
  <!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>