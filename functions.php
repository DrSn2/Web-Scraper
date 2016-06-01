<?php
	function is_admin($db){

		$current_user = $_SESSION['user_id'];
		$sql = 'SELECT `role` FROM `users` WHERE `business_name` = "'.$current_user.'"';
		$query = $db->query($sql);
		$user_check = $query->fetchAll(PDO::FETCH_ASSOC);

		if($user_check[0]['role'] == "admin"){
			return true;
		}else{
			return false;
		}

	}

	function get_all_business_li($db,$page){
		$sql = 'SELECT * FROM `business`';
		$query = $db->query($sql);
		$businesses = $query->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($businesses as $business){

		echo '<li><a href="index.php?page='.$page.'&business='.$business['business_name'].'">'.ucwords($business['business_name']).'</a></li>';

		}
	}

?>