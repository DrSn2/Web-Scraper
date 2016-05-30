    <?php
    if(is_admin($db)){

      $business_name = ucwords($_GET['business']);
      $sql = 'SELECT * FROM `keywords` WHERE `business_name` = '.'"'.$business_name.'"';
      $h1_text = "Keywords ".$business_name." Is Tracking.";

    }else{

      $sql = 'SELECT * FROM `keywords` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"';
      $h1_text = "Keywords You Are Tracking.";

    }

    $query = $db->query($sql);
    $my_keywords = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!--<link rel="stylesheet" href="/wp-content/foundation/css/foundation.css">
    //<link rel="stylesheet" href="/wp-content/foundation/css/app.css">-->
    <h1 id="kwtitle" class="text-center"><?php echo $h1_text; ?></h1>
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
        $my_keyword_formatted = str_replace("+"," ",$my_keyword['keyword']);
      ?>
      
      <tr>
        <td><?php echo $my_keyword_formatted ?></td>
        <td><?php echo $my_keyword['business_name'] ?></td>
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
