<?php 

session_start();
session_unset();
session_destroy();
setcookie("email", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");
setcookie("logged_in", "", time() - 3600, "/");
setcookie("creator_logged_in", "", time() - 3600, "/");
header("Location: testMainPage.php");

?>

