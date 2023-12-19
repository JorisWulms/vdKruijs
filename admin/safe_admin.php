<?php

if( isset($_GET["logout"])) {
	session_unset();
	session_destroy();
	header("Location: index.php");
} 

if(isset($_SESSION['user_id'])) {
	// Inloggen correct, updaten laatst actief in db
	$sql = "UPDATE gebruikers SET lastactive=NOW() WHERE id='".$_SESSION['user_id']."'";
	mysqli_query($res1 ,$sql);
}