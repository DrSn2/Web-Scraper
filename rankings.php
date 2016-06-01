<?php

    $area = $_GET['area'];
    /*if(is_admin($db)){
      $business_name = ucwords($_GET['business']);
      $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$business_name.'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'"';
    }else{
      $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'"';
    }

    $target_area_query = $db->query($target_area_sql);
    $target_areas = $target_area_query->fetchAll(PDO::FETCH_ASSOC);*/
  
      /* BEGING TARGET AREA FOREACH*/
      
    if(is_admin($db)){

      $business_name = ucwords($_GET['business']);
      $sql = 'SELECT * FROM `page_rank` WHERE `business_name` = '.'"'.$business_name.'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'"';
      $h1_text = "Rankings For ".$business_name;

    }else{

      $sql = 'SELECT * FROM `page_rank` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'"';
      $h1_text = "Your Latest Rankings In ";

    }


    $query = $db->query($sql);
    $rankings = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!--<link rel="stylesheet" href="/wp-content/foundation/css/foundation.css">
    //<link rel="stylesheet" href="/wp-content/foundation/css/app.css">-->
    
    <h1 id="kwtitle" class="text-center"><?php echo $h1_text.' '.ucwords($area);?></h1>
    <table border="1">
    <thead>
    <tr>
      <th>Keyword</th>
      <th>Target Area</th>
      <th>Rank</th>
      <th>Serp Page</th>
      <th>Search Result</th>
      <th>Last Checked</th>
      <th>Check Now!</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($rankings as $rank){
        $search_phrase_formatted = ucwords(str_replace("+"," ",$rank['search_phrase']));
        $target_area_formatted = ucwords(str_replace("+"," ",$rank['target_area']));
      ?>
      
      <tr>
        <td><?php echo $search_phrase_formatted ?></td>
        <td><?php echo $target_area_formatted ?></td>
        <td class="text-center"><?php echo $rank['rank'] ?></td>
        <td class="text-center"><?php echo $rank['serp_page'] ?></td>
        <td><?php echo $rank['search_result'] ?></td>
        <td><?php echo $rank['date'] ?></td>
        <td><?php echo '<a target="_blank" href="https://www.google.com/search?q='.$rank['search_phrase'].'+'.$area.'">Check Your Current Rankings</a>';?></td>
        
      </tr>
      


      <?php
      //echo "Your Keyword: ".$rank['search_phrase']." is number ".$rank['rank']. " on page number ".$rank['serp_page']. "on Google as of ".$rank['date']." <br><br>";
    }
    ?>
    </tbody>
    </table>
   
    <?php

    ?>
