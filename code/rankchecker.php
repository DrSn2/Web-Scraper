<?php
 	require_once('required_files.php');
 	
 	$company = $argv[1];
 	$proxies = array();
			$proxies[] = '23.80.157.145:29842';  
			$proxies[] = '23.108.99.80:29842';
			$proxies[] = '23.80.157.74:29842';
			$proxies[] = '23.108.99.139:29842';
			$proxies[] = '23.80.157.224:29842';
		
 			  // If the $proxies array contains items, then
    		$proxy = $proxies[array_rand($proxies)]; 
    		$proxyauth = 'dgalye:8VLXPm3D';   // Select a random proxy from the array and assign to $proxy variable

 	//$company = "cary builders";

 	//echo $company;

 	//$sql = "SELECT * FROM `keywords` WHERE `business_name` = 'cary builders'";
 	$sql = "SELECT * FROM `keywords` WHERE `business_name` = "."'".$company."'";

	$query = $db->query($sql);
	$keywords = $query->fetchAll(PDO::FETCH_ASSOC);

	$search_term_sql = "SELECT * FROM `business` WHERE `business_name` = "."'".$company."'";
	$search_term_query = $db->query($search_term_sql);
	$search_term_keywords = $search_term_query->fetchAll(PDO::FETCH_ASSOC);

	$target_areas_sql = "SELECT * FROM `target_areas` WHERE `business_name` = "."'".$company."'";
	$target_areas_query = $db->query($target_areas_sql);
	$target_areas = $target_areas_query->fetchAll(PDO::FETCH_ASSOC);

foreach($target_areas as $target_area){
 	$start = 0;
 	foreach($keywords as $keyword){
 		$i = 1;
 		$pages_to_check = array('0','10','20','30','40','50');
 		$serp_page = 1;
 		foreach($pages_to_check as $page){

 			sleep ( rand ( 1, 5));
			

 			$url = 'https://www.google.com/search?q='.$keyword['keyword'].'+'.$target_area['area'].'&start='.$page;
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

			$i = 1;
			$linkObjs = $html->find('h3.r a');
			
			echo 'Page:'.$serp_page.'<br><br>';

				foreach($linkObjs as $linkObj){
					$date = date("Y/m/d");
					
					if(preg_match('/'.$search_term_keywords[0]['search_term'].'/', $linkObj)){

						$search_title = trim($linkObj->plaintext);
						$new_sql = 'INSERT INTO `page_rank` VALUES ("",'.$i.','.$serp_page.',"'.$target_area['area'].'","'.$keyword['business_name'].'","'.$keyword['keyword'].'","'.$search_title.'","'.$date.'")';
						$new_query = $db->query($new_sql);						
        			echo $keyword['keyword'].': '.$linkObj." Page Rank: ".$i.' '.$target_area['area'].'<br><br>';
    				}
    	
    				$i++;
    	
    			}
    		$serp_page++;
   		}
    	
 	}
 }	
 $date_sql = 'INSERT INTO `rank_check_dates` VALUES ("","'.$date.'","'.$company.'")';
 $date_sql_query = $db->query($date_sql);
?>