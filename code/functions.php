<?php
	function is_admin($db){
		if(isset($_SESSION['admin'])){
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

	
	function get_color($page_rank,$serp_page_color){
    if($page_rank==1 && $serp_page_color ==1){
      echo 'style="color:red;"';
    }
  }

?>