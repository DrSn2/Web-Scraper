<?php
 	require_once('code/required_files.php');
 ?>

 	<!--START HEADER AREA-->
<?php include('header.php'); ?>
<!-- END HEADER AREA-->

<!--START CONTENT AREA-->
 <div class="row">
 <div class="large-12 columns">

<?php

  $product_name = $_GET['product_name'];
			$product_sql = 'SELECT * FROM `products` WHERE `product_name` = "'.$product_name.'"';
			$product_query = $db->query($product_sql);
			$products = $product_query->fetchAll(PDO::FETCH_ASSOC);

      $date_sql = 'SELECT `date_last_checked` FROM `products_to_monitor` WHERE `product_name` = "'.$product_name.'" AND `business_name` = "'.$_SESSION['user_id'].'"';
      $date_query = $db->query($date_sql);
      $dates = $date_query->fetchAll(PDO::FETCH_ASSOC);
?>
</div>
	<table border="1">
    <thead>
    <tr>
      <th>Business</th>
      <th>Their Price</th>
      <th>Product Name</th>
      <th>URL</th>
      <th>Search Result</th>
      <th>Last Checked</th>
      <th>Check Now!</th>
    </tr>
  </thead>
  <tbody>
      
      <tr>
        <?php
    	
    	 foreach($products as $product){
        echo '<td>'.ucwords($product['competitor']).'</td>';
    	 	echo '<td>'.$product['price'].'</td>';
    	 	echo '<td>'.ucwords($product['product_name']).'</td>';
    	 	echo '<td><a href="'.$product['url'].'">View This Product</a></td>';
    	 	echo '</tr>';
    	 }
      ?>
        
      </tr>
      

      <?php
      //echo "Your Keyword: ".$rank['search_phrase']." is number ".$rank['rank']. " on page number ".$rank['serp_page']. "on Google as of ".$rank['date']." <br><br>";
   
    ?>
    </tbody>
    </table>
    <p> This pricing information was last checked on <?php echo $dates[0]['date_last_checked'] ;?>. Please click the "Update Now" button below to get current product prices.</p>
    <p style="color:red;">* Please be patient while we update your product pricing information. The prices can take a few minutes to load depending on how many items you are tracking.</p>

    <?php
       $date = date("Y/m/d");
       if($dates[0]['date_last_checked'] == $date){
        echo 'NOTE:You have already checked your product prices today. Your current plan allows you to check once per day. Please check back in 24 hours and you will have the option to check again.';
       }else{
    ?>

    <form method="post" action="code/get_product_prices.php">
    <input type="hidden" name="product" value=<?php echo '"'.$product['product_name'].'"'; ?>/>
    <input type="hidden" name="business_name" value=<?php echo '"'.$_SESSION['user_id'].'"'; ?>/>
    <input type="submit" value="Update Now"/>
    </form>
    <?php
      }
    ?>

    </div>
    <!--END CONTENT AREA-->

   <!--START FOOTER AREA-->
   <?php include_once('footer.php'); ?>
   <!-- END FOOTER AREA-->