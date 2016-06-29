<div class="row">
  <div class="medium-12 medium large-12 large columns">


<?php

  $business = $_SESSION['user_id'];
  $sql = 'SELECT * FROM `alerts` WHERE `business_name` = "'.$business.'" AND `status` = "unread"';
  $query = $db->query($sql);
  $results = $query->fetchAll(PDO::FETCH_ASSOC);

  $i = 0;

  foreach($results as $result){
    $i++;
  }
  
?>
<p style="margin-top:20px; color:red;"><?php echo $i;?> of your rankings have changed since you last logged in. Please see below.</p>
<table border="1">
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
  <tbody>
    <?php
    foreach($results as $result){
        $keyword_formatted = ucwords(str_replace("+"," ",$result['keyword']));
        $target_area_formatted = ucwords(str_replace("+"," ",$result['target_area']));
      ?>
      
      <tr>
        <td ><?php echo $keyword_formatted ?></td>
        <td ><?php echo $target_area_formatted ?></td>
        <td style="color:red;" class="text-center"><?php echo $result['new_rank'] ?></td>
        <td style="color:red;" class="text-center"><?php echo $result['new_serp'] ?></td>
        <td ><?php echo $result['old_rank'] ?></td>
        <td ><?php echo $result['old_serp'] ?></td>
        <td ><?php echo $result['search_title'] ?></td>


        
        
      </tr>
      

      <?php
      //echo "Your Keyword: ".$result['search_phrase']." is number ".$result['rank']. " on page number ".$result['serp_page']. "on Google as of ".$result['date']." <br><br>";
    }
    ?>
    </tbody>
    </table>
<?php
  if(!is_admin($db)){
    $sql = 'UPDATE `alerts` SET `status` = "read" WHERE `business_name` = "'.$business.'"';
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
  }
  
?>
	
  </div>
  </div>




