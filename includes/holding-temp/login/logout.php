<?php
session_start();
if (isset($_SESSION["username"])){
	require_once("../src/backend.php");
	$bd = new Backend();

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$username = test_input($_SESSION["username"]);

	$bd->db->userLogout($username);

	//destroy session
	if(session_destroy()){
		header("Location: ../index.php");
		die();
	}
}
else {
	header("Location: ../index.php");
	die();
}
?>