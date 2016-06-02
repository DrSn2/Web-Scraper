<?php
		$business = $_GET['business'];
        session_start();
		$_SESSION['user_id'] = $business;
		header('location:../index.php');

?>