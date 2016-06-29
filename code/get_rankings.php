<?php
	$business = $_POST['business_name'];
	shell_exec('php rankchecker.php "'.$business.'" &');
	header('location:../index.php');
?>