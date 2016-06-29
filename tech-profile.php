<?php
 	require_once('code/required_files.php');
 ?>

 	<!--START HEADER AREA-->
<?php include('header.php'); ?>
<!-- END HEADER AREA-->

<!--START CONTENT AREA-->
 <div class="row">


 	<?php
 	
 	$proxies = array();
			$proxies[] = '23.80.151.117:29842';  
			$proxies[] = '104.251.89.91:29842';
			$proxies[] = '23.80.151.229:29842';
			$proxies[] = '104.251.89.128:29842';
			$proxies[] = '23.80.151.127:29842';
		
 			  // If the $proxies array contains items, then
    		$proxy = $proxies[array_rand($proxies)]; 
    		$proxyauth = 'dgalye:8VLXPm3D';   // Select a random proxy from the array and assign to $proxy variable

 	

    		$business_name = $_GET['business_name'];
    		$sql = 'SELECT `url` FROM `business` WHERE `business_name` = "'.$business_name.'"';
    		$url_query = $db->query($sql);
    		$get_url = $url_query->fetchAll(PDO::FETCH_ASSOC);

    		$url_str = $get_url[0]['url'];
			$business_url = preg_replace('#^https?://#', '', rtrim($url_str,'/'));

 			$url = 'http://builtwith.com/'.$business_url;

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

			$elements = array(
				'div.navbar-fixed-top',
				'div.breadcrumb',
				'footer',
				'ul.nav-tabs',
				'span.tl',
				'div.span4',
				'li.pull-right',
				'script'
				); 
 
			$html= str_get_html($str); 
			$hrefs = $html->find('a');
			foreach($hrefs as $href){
				$href->href = '#';
			}

			foreach($elements as $element){
				$items = $html->find($element);
					foreach($items as $item){
						$item->outertext = '';
					}
			}
			
			echo $html;
			?>
   </div>
    <!--END CONTENT AREA-->

   <!--START FOOTER AREA-->
   <?php include_once('footer.php'); ?>
   <!-- END FOOTER AREA-->