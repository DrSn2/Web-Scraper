<?php
	require_once('required_files.php');

	if(isset($_POST['product'])){
	 	$product_name = $_POST['product'];
	}else{
		$product_name = $argv[1];
	}

 	$proxies = array();
			$proxies[] = '23.80.151.117:29842';  
			$proxies[] = '104.251.89.91:29842';
			$proxies[] = '23.80.151.229:29842';
			$proxies[] = '104.251.89.128:29842';
			$proxies[] = '23.80.151.127:29842';
		
 			  // If the $proxies array contains items, then
    		$proxy = $proxies[array_rand($proxies)]; 
    		$proxyauth = 'dgalye:8VLXPm3D';   // Select a random proxy from the array and assign to $proxy variable

	


			$product_sql = 'SELECT * FROM `products` WHERE `product_name` = "'.$product_name.'"';
			$product_query = $db->query($product_sql);
			$products = $product_query->fetchAll(PDO::FETCH_ASSOC);

			foreach($products as $product){
    	 	$curl = curl_init(); 
            curl_setopt($curl, CURLOPT_PROXY, $proxy);
            curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxyauth);
			curl_setopt($curl, CURLOPT_URL, $product['url']);  
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
			//curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); 
			curl_setopt($curl, CURLOPT_USERAGENT,random_user_agent()); 
			$str = curl_exec($curl);  
			curl_close($curl); 
			
    	 	$html = str_get_html($str);
    	 	$prices = $html->find($product['code']);
    	 		foreach($prices as $price){
    	 		$updated_price = trim($price->plaintext);

    	 		$sql = 'UPDATE `products` SET `price` = "'.$updated_price.'" WHERE `id` = "'.$product['id'].'"';
				$query = $db->query($sql);
			}	
    	 }
    	 	$date = date("Y/m/d");
    	 	$date_sql = 'UPDATE `products_to_monitor` SET `date_last_checked` = "'.$date.'" WHERE `business_name` = "'.$_POST['business_name'].'"';
			$date_query = $db->query($date_sql);

    	 if(isset($_POST['product'])){
    	 	header('location:../product_compare.php?product_name='.$product_name);
    	 }
?>