    <?php

      $sql = 'SELECT * FROM `keywords` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"';
      $h1_text = "Keywords You Are Tracking.";
      $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"';

    $query = $db->query($sql);
    $my_keywords = $query->fetchAll(PDO::FETCH_ASSOC);

    //$target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"';
    $target_area_query = $db->query($target_area_sql);
    $target_areas = $target_area_query->fetchAll(PDO::FETCH_ASSOC);

      /* BEGING TARGET AREA FOREACH*/
      //foreach($target_areas as $target_area){
    ?>
    <row>
    <div class="medium-12 medium large-12 large columns">
    <h4 id="kwtitle"><?php echo "Keywords You Area Tracking"; ?></h4>

    <table border="1">
    <thead>
    <tr>
      <th>Keyword</th>
      <th>Business</th>
      <th>Change Keyword</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($my_keywords as $my_keyword){
        $my_keyword_formatted = ucwords(str_replace("+"," ",$my_keyword['keyword']));
      ?>
      
      <tr>
        <td>
        <?php echo $my_keyword_formatted ?></td>
        <td><?php echo ucwords($my_keyword['business_name']) ?></td>
        <td><a href="change_keyword.php?id=<?php echo $my_keyword['id'];?>&value=<?php echo $my_keyword_formatted ;?>">Change Keyword</a></td>
        
        
      </tr>
      


      <?php
      //echo "Your Keyword: ".$rank['search_phrase']." is number ".$rank['rank']. " on page number ".$rank['serp_page']. "on Google as of ".$rank['date']." <br><br>";
    }
    ?>
    </tbody>
    </table>
    </div>
    </row>
    <?php
   // } /* END TARGET AREA FOREACH*/
  ?>
