<?php
	function is_admin($db){

		$current_user = $_SESSION['user_id'];
		$sql = 'SELECT `username` FROM `users` WHERE `username` = '.$current_user;
		$query = $db->query($query);
		$user_check = $query->fetchAll(PDO::FETCH_ASSOC);

		if($user_check[0]['username'] == 'admin'){

			return true;

		}else{

			return false;
		}


	}
?>