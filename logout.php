<?php 

	require('includes/config.php');

	//logout
	$user->logout(); 

	//logged in return to index page
	$user->redirect('login.php');

	exit;
?>