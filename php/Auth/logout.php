<?php
	session_start();
	session_unset();
	session_destroy();
	
	$root = '../..';

	header("Location: $root/index.php?logout=success");
?>