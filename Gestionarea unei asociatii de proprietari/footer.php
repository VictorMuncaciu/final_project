<div class="container1" style="background-color: #FFD19D">
  <footer class="py-4">
    <div class="row border-bottom py-3 mx-auto justify-content-center">
      <div class="col-6 col-md-2 mb-3">
        <h5>Link-uri secundare</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="testMainPage.php" class="nav-link p-0 text-body-secondary">Acasa</a></li>
          <li class="nav-item mb-2"><a href="testMainPage.php#about-section" class="nav-link p-0 text-body-secondary">Despre noi</a></li>
          <li class="nav-item mb-2"><a href="testMainPage.php#contact-section" class="nav-link p-0 text-body-secondary">Contacteaza-ne</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Pagini importante</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="Termene+si+Conditii.pdf" class="nav-link p-0 text-body-secondary">Termeni si conditii</a></li>
        </ul>
      </div>

	<?php	
		if ($_SESSION["logged_in"] == "0" && $_COOKIE["logged_in"] == "0" && $_SESSION["creator_logged_in"] == "0" && $_COOKIE["creator_logged_in"] == "0") {
			echo '<div class="col-6 col-md-2 mb-3">';
				echo '<h5>Logare si inregistrare</h5>';
				echo '<ul class="nav flex-column">';
				  echo '<li class="nav-item mb-2"><a href="loginOrRegister.php" class="nav-link p-0 text-body-secondary">Logare in cont</a></li>';
				  echo '<li class="nav-item mb-2"><a href="register.html" class="nav-link p-0 text-body-secondary">Inregistrare cont</a></li>';
				echo '</ul>';
			  echo '</div>';
		}
	?>

    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between my-4">
	  <p class="text-body-secondary">© Copyright 2023 <a href="testMainPage.php"><b>e-Asociatie.ro</b></a>. Toate drepturile rezervate.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a href="https://www.facebook.com/"><img src="facebookLogo.png" alt="Calea catre Facebook" width="40" height="37"></a></li>
        <li class="ms-3"><a href="https://www.instagram.com/"><img src="instagramLogo.png" alt="Calea catre Instagram" width="40" height="35"></a></li>
        <li class="ms-3"><a href="https://www.reddit.com/"><img src="redditLogo.png" alt="Calea catre Reddit" width="35" height="35"></a></li>
      </ul>
    </div>
  </footer>
  
<p style="text-align: center;">Site creat si intretinut de <b>Victor Muncaciu</b>.</p>
<p style="text-align: center;">Pentru mai multe informatii, furnizare de feedback sau raportare de bug-uri : <b>muncaciuvictor@gmail.com</b></p>

</div>