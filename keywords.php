    <?php
    if(is_admin($db)){

      $business_name = ucwords($_GET['business']);
      $sql = 'SELECT * FROM `keywords` WHERE `business_name` = '.'"'.$business_name.'"';
      $h1_text = "Keywords ".$business_name." Is Tracking.";
      $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$business_name.'"';

    }else{

      $sql = 'SELECT * FROM `keywords` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"';
      $h1_text = "Keywords You Are Tracking.";
      $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"';

    }

    $query = $db->query($sql);
    $my_keywords = $query->fetchAll(PDO::FETCH_ASSOC);

    //$target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"';
    $target_area_query = $db->query($target_area_sql);
    $target_areas = $target_area_query->fetchAll(PDO::FETCH_ASSOC);

      /* BEGING TARGET AREA FOREACH*/
      foreach($target_areas as $target_area){
    ?>
    <row>
    <div class="medium-6 medium large-6 large columns">
    <h4 id="kwtitle"><?php echo "Keywords You Area Tracking In ".ucwords(str_replace("+"," ",$target_area['area'])); ?></h4>
    <table border="1">
    <thead>
    <tr>
      <th>Keyword</th>
      <th>Business</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($my_keywords as $my_keyword){
        $my_keyword_formatted = ucwords(str_replace("+"," ",$my_keyword['keyword']));
      ?>
      
      <tr>
        <td><?php echo $my_keyword_formatted ?></td>
        <td><?php echo ucwords($my_keyword['business_name']) ?></td>
        <!--<td class="text-center"><?php echo $rank['serp_page'] ?></td>
        <td><?php echo $rank['search_result'] ?></td>
        <td><?php echo $rank['date'] ?></td>-->
        
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
    } /* END TARGET AREA FOREACH*/
  ?>
