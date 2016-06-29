<?php

require_once('required_files.php');

$business_sql = 'SELECT * FROM `business` WHERE `role` = "client"';
$business_query = $db->query($business_sql);
$businesses = $business_query->fetchAll(PDO::FETCH_ASSOC);

foreach($businesses as $business){

	$sql = 'SELECT * FROM `alerts` WHERE `business_name` = "'.$business['business_name'].'" AND `email_status` = "unsent"';
	$query = $db->query($sql);
	$results = $query->fetchAll(PDO::FETCH_ASSOC);

	$email_body = '<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
  <meta name="robots" content="noindex" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Rank Tracker</title>
    <link rel="stylesheet" href="http://artisanwebcraft.com/foundation/css/foundation.css">
    <link rel="stylesheet" href="http://artisanwebcraft.com/foundation/css/app.css">
    <link rel="stylesheet" href="http://artisanwebcraft.com/foundation/css/custom-styles.css">
  </script>
  </head>
  <div class="row">
  <div class="medium-12 medium large-12 large columns">
  <img style="width:20rem" ;="" src="http://artisanwebcraft.com/images/artisanwebcraft copy.png">
  <p>Hi: '.ucwords($business['business_name']).'</br></br> We have just finished gathering your rankings from Google and noticed that some rankings have changed. Here is an overview of the changes.</p></br></br>
  <body><table border="1">
    <thead>
    <tr>
      <th>Keyword</th>
      <th>Target Area</th>
      <th style="color:red;">New Rank</th>
      <th style="color:red;">New Serp Page</th>
      <th>Old Rank</th>
      <th>Old Serp Page</th>
      <th>Search Result</th>
    </tr>
  </thead>
  <tbody>';

    foreach($results as $result){
        $keyword_formatted = ucwords(str_replace("+"," ",$result['keyword']));
        $target_area_formatted = ucwords(str_replace("+"," ",$result['target_area']));

      
      $email_body .= '<tr>
        <td > '.$keyword_formatted.'</td>
        <td >'.$target_area_formatted.'</td>
        <td style="color:red;" class="text-center">'.$result['new_rank'].'</td>
        <td style="color:red;" class="text-center">'. $result['new_serp'] .'</td>
        <td > '.$result['old_rank'].'</td>
        <td > '.$result['old_serp'].'</td>
        <td >'.$result['search_title'].'</td>


        
        
      </tr>';
  }
      

    $email_body .= '</tbody>
    </table>
    </br></br> For more information on your rankings please login to <a href="http://artisanwebcraft.com">www.artisanwebcraft.com</a>
    </div>
    </div>
    <script src="http://artisanwebcraft.com/foundation/js/vendor/jquery.js"></script>
    <script src="http://artisanwebcraft.com/foundation/js/vendor/what-input.js"></script>
    <script src="http://artisanwebcraft.com/foundation/js/vendor/foundation.js"></script>
    <script src="http://artisanwebcraft.com/foundation/js/app.js"></script>
  </body>
</html>';

	if(!empty($results)){

			$user_sql = 'SELECT * FROM `users` WHERE `business_name` = "'.$business['business_name'].'" LIMIT 1';
			$user_query = $db->query($user_sql);
			$user_email = $user_query->fetchAll(PDO::FETCH_ASSOC);
			$email_body_final = str_replace('+',' ',$email_body);

			$headers = "From: seo@artisanwebcraft.com" . "\r\n" .
			"CC: gringisimo@hotmail.com,esteban.a.valdez@gmail.com"."\r\n";
			$headers .= "Content-type: text/html; charset=\"UTF-8\"; format=flowed \r\n";

			mail($user_email[0]['email'],'New Alerts',$email_body_final,$headers);

			$status_sql = 'UPDATE `alerts` SET `email_status` = "sent" WHERE `business_name` = "'.$business['business_name'].'"';
			$status_query = $db->query($status_sql);

	}
}
?>