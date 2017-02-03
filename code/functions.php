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

  //This function gets a single result from th DOM
  function get_html_single($business_name,$db){
  	$proxies = array();
			$proxies[] = '23.80.151.117:29842';  
			$proxies[] = '104.251.89.91:29842';
			$proxies[] = '23.80.151.229:29842';
			$proxies[] = '104.251.89.128:29842';
			$proxies[] = '23.80.151.127:29842';
		
 			  // If the $proxies array contains items, then
    		$proxy = $proxies[array_rand($proxies)]; 
    		$proxyauth = 'dgalye:8VLXPm3D';   // Select a random proxy from the array and assign to $proxy variable

    		$sql = 'SELECT `url` FROM `business` WHERE `business_name` = "'.$business_name.'"';
    		$url_query = $db->query($sql);
    		$get_url = $url_query->fetchAll(PDO::FETCH_ASSOC);

 			$url = $get_url[0]['url'];
 			//$opts = array('http'=>array('header'=>random_uagent()));
 			/*$opts = array('http'=>array('header'=>random_user_agent()));

            $context = stream_context_create($opts);
            $html = file_get_html($url,false,$context);*/
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_PROXY, $proxy);
            curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxyauth);
			curl_setopt($curl, CURLOPT_URL, $url);  
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
			//curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); 
			curl_setopt($curl, CURLOPT_USERAGENT,random_user_agent()); 
			$str = curl_exec($curl);  
			curl_close($curl); 


 
			$html= str_get_html($str);
			return $html;
  }

?>