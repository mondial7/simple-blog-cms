<?php

	session_start();

	$_SESSION['username'] = "";
	$_SESSION['password'] = "";

	session_unset();

	session_destroy();

	echo "<script>window.location='index.php';</script>";
?>