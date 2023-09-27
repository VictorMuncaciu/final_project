<?php
session_start();
//if (isset($_SESSION["email"]) || isset($_COOKIE["email"])) {
    //$_SESSION["logged_in"] = true;
//} else {
    //$_SESSION["logged_in"] = false;
//}
if(!isset($_SESSION["logged_in"])) {
	$_SESSION["logged_in"] = "0";
	//echo "Setting session logged in!<br>";
	//echo '$_SESSION["logged_in"] este : <b><u>' . $_SESSION["logged_in"] . '</u></b><br>';
}

if(!isset($_SESSION["creator_logged_in"])) {
	$_SESSION["creator_logged_in"] = "0";
	//echo "Setting session creator logged in!<br>";
	//echo '$_SESSION["creator_logged_in"] este : <b><u>' . $_SESSION["creator_logged_in"] . '</u></b><br>';
}

if(!isset($_COOKIE["logged_in"])) {
	setcookie("logged_in", "0", time() + (30 * 24 * 60 * 60), "/");
	//echo "Setting cookie logged in!<br>";
	
	// If cookie isn't set , refresh the page so the cookie can apply correctly
	header("Location: testMainPage.php");
}

if(!isset($_COOKIE["creator_logged_in"])) {
	setcookie("creator_logged_in", "0", time() + (30 * 24 * 60 * 60), "/");
	//echo "Setting cookie creator logged in!<br>";
	
	// If cookie isn't set , refresh the page so the cookie can apply correctly
	header("Location: testMainPage.php");
}

?>
