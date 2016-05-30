

        

    <?php

    if(is_admin($db)){

      $business_name = ucwords($_GET['business']);
      $sql = 'SELECT * FROM `page_rank` WHERE `business_name` = '.'"'.$business_name.'"'.' ORDER BY `date` DESC';
      $h1_text = "Rankings For ".$business_name;

    }else{

      $sql = 'SELECT * FROM `page_rank` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"'.' ORDER BY `date` DESC';
      $h1_text = "Your Latest Rankings";

    }


    $query = $db->query($sql);
    $rankings = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!--<link rel="stylesheet" href="/wp-content/foundation/css/foundation.css">
    //<link rel="stylesheet" href="/wp-content/foundation/css/app.css">-->
    <h1 id="kwtitle" class="text-center"><?php echo $h1_text;?></h1>
    <table border="1">
    <thead>
    <tr>
      <th>Keyword</th>
      <th>Rank</th>
      <th>Serp Page</th>
      <th>Search Result</th>
      <th>Last Checked</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($rankings as $rank){
        $search_phrase_formatted = str_replace("+"," ",$rank['search_phrase']);
      ?>
      
      <tr>
        <td><?php echo $search_phrase_formatted ?></td>
        <td class="text-center"><?php echo $rank['rank'] ?></td>
        <td class="text-center"><?php echo $rank['serp_page'] ?></td>
        <td><?php echo $rank['search_result'] ?></td>
        <td><?php echo $rank['date'] ?></td>
        
      </tr>
      


      <?php
      //echo "Your Keyword: ".$rank['search_phrase']." is number ".$rank['rank']. " on page number ".$rank['serp_page']. "on Google as of ".$rank['date']." <br><br>";
    }
    ?>
    </tbody>
    </table>
