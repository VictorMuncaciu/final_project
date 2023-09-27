<?php
if($_SESSION["creator_logged_in"] == "1" || $_COOKIE["creator_logged_in"] == "1") {

	echo '<div class="mx-auto my-3 rounded border border-danger border-4 shadow p-1 bg-warning" style="width:70%; position: relative;">';
    echo '<span class="position-absolute top-0 start-0 bg-danger text-white p-2">CREATOR MODE</span>';
    echo '<span class="position-absolute top-0 end-0 bg-danger text-white p-2">CREATOR MODE</span>';
    echo '<span class="position-absolute bottom-0 start-0 bg-danger text-white p-2">CREATOR MODE</span>';
    echo '<span class="position-absolute bottom-0 end-0 bg-danger text-white p-2">CREATOR MODE</span>';
	
}
else {
	echo '<div class="mx-auto my-3 rounded border shadow p-1 bg-warning" style="width:70%;">';
}
?>
  <div class="d-flex p-2 align-items-center justify-content-evenly">
    <div class="p-2">
      <a href="testMainPage.php" class="logo">
		e-Asociatie.ro
	  </a>
    </div>
    <div class="p-2">
		<input type="button" class="btn btn-primary btn-lg" onclick="location.href='testMainPage.php';" value="Acasa" />
		<input type="button" class="btn btn-primary btn-lg" onclick="location.href='testMainPage.php#about-section';" value="Despre noi" />
		<input type="button" class="btn btn-primary btn-lg" onclick="location.href='testMainPage.php#contact-section';" value="Contactati-ne" />
    </div>
	<div class="p-2">
		<?php
		if ($_SESSION["logged_in"] == "0" && $_COOKIE["logged_in"] == "0" && $_SESSION["creator_logged_in"] == "0" && $_COOKIE["creator_logged_in"] == "0") {
			// DEBUG 
			//echo '$_SESSION["logged_in"] este : <b><u>' . $_SESSION["logged_in"] . '</u></b><br>';
			//echo '$_SESSION["creator_logged_in"] este : <b><u>' . $_SESSION["creator_logged_in"] . '</u></b><br>';
			//echo '$_COOKIE["logged_in"] este : <b><u>' . $_COOKIE["logged_in"] . '</u></b><br>';
			//echo '$_COOKIE["creator_logged_in"] este : <b><u>' . $_COOKIE["creator_logged_in"] . '</u></b><br>';			
			
			echo '<input type="button" class="btn btn-primary btn-lg" onclick="location.href=\'loginOrRegister.php\';" value="Logare / Inregistrare" />';
		} else {
			if($_SESSION["creator_logged_in"] == "1" || $_COOKIE["creator_logged_in"] == "1") {
				// DEBUG 
				//echo '$_SESSION["logged_in"] este : <b><u>' . $_SESSION["logged_in"] . '</u></b><br>';
				//echo '$_SESSION["creator_logged_in"] este : <b><u>' . $_SESSION["creator_logged_in"] . '</u></b><br>';
				//echo '$_COOKIE["logged_in"] este : <b><u>' . $_COOKIE["logged_in"] . '</u></b><br>';
				//echo '$_COOKIE["creator_logged_in"] este : <b><u>' . $_COOKIE["creator_logged_in"] . '</u></b><br>';
				
				echo '<div class="dropdown">
					  <button class="btn btn-primary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						  Optiuni administrare
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						  <a class="dropdown-item" href="creator_myAccount.php">Schimbare parola cont</a>
						  <a class="dropdown-item" href="creator_accountsManagement.php">Activare/dezactivare conturi</a>
						  <a class="dropdown-item" href="creator_carteImobilManagement.php">Gestionare carte imobil</a>
						  <a class="dropdown-item" href="creator_addAsociatie.php">Adauga asociatie noua</a>
						  <a class="dropdown-item" href="creator_addCounters.php">Adauga un nou contor</a>
						  <a class="dropdown-item" href="creator_scaraBlocManagement.php">Gestionarea scarilor/blocurilor</a>
						  <a class="dropdown-item" href="creator_addDocuments.php">Adauga acte la asociatie</a>
						  <a class="dropdown-item" href="creator_userRequests.php">Gestionare tabel request-uri useri</a>
						  <a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					  </div>';				
			} else {
				// DEBUG 
				//echo '$_SESSION["logged_in"] este : <b><u>' . $_SESSION["logged_in"] . '</u></b><br>';
				//echo '$_SESSION["creator_logged_in"] este : <b><u>' . $_SESSION["creator_logged_in"] . '</u></b><br>';
				//echo '$_COOKIE["logged_in"] este : <b><u>' . $_COOKIE["logged_in"] . '</u></b><br>';
				//echo '$_COOKIE["creator_logged_in"] este : <b><u>' . $_COOKIE["creator_logged_in"] . '</u></b><br>';
				
				echo '<div class="dropdown">
					  <button class="btn btn-primary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						  Contul meu
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						  <a class="dropdown-item" href="myAccount.php">Contul meu</a>
						  <a class="dropdown-item" href="myCounters.php">Contoarele mele</a>
						  <a class="dropdown-item" href="myDocuments.php">Actele mele</a>
						  <a class="dropdown-item" href="myRequests.php">Cererile mele</a>
						  <a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					  </div>';
			}
		}
		?>
	</div>
  </div>
  
<!-- VERY IMPORTANT: ADD </div> AFTER INCLUDING THIS FILE AND AFTER ADDING CORESPONDING CONTENT IS ADDED BEFORE CLOSING THE DIV -->