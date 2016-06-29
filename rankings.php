<?php
    $area = $_GET['area'];
    if(isset($_POST['date'])){
    
  }
    /*if(is_admin($db)){
      $business_name = ucwords($_GET['business']);
      $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$business_name.'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'"';
    }else{
      $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'"';
    }

    $target_area_query = $db->query($target_area_sql);
    $target_areas = $target_area_query->fetchAll(PDO::FETCH_ASSOC);*/
  
      /* BEGING TARGET AREA FOREACH*/
      
    if(isset($_GET['business'])){
      $rank_check_date = $_POST['date'];
      $business_name = ucwords($_GET['business']);

      if(isset($_POST['date'])){

        $sql = 'SELECT * FROM `page_rank` WHERE `business_name` = '.'"'.$business_name.'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'" AND `date` = "'.$rank_check_date.'" ORDER BY date DESC LIMIT 100';
      }else{
        $sql = 'SELECT * FROM `page_rank` WHERE `business_name` = '.'"'.$business_name.'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'"ORDER BY date DESC LIMIT 100';
      }
      $date_sql = 'SELECT * FROM `rank_check_dates` WHERE `business_name` = '.'"'.$business_name.'" ORDER BY date DESC';
      $h1_text = "Rankings For ".$business_name;

    }else{

      if(isset($_POST['date'])){

      $rank_check_date = $_POST['date'];
      if(!isset($_GET['business'])){
         $sql = 'SELECT * FROM `page_rank` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'" AND `date` = "'.$rank_check_date.'" ORDER BY date DESC LIMIT 100 ';
       }

      }else{

      $sql = 'SELECT * FROM `page_rank` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"'.'AND `target_area` = "'.ucwords(str_replace(" ","+",$area)).'" ORDER BY date DESC LIMIT 100 ';

      }
      $date_sql = 'SELECT * FROM `rank_check_dates` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'" ORDER BY date DESC';

      $h1_text = "Your Latest Rankings In ";

    }


    $query = $db->query($sql);
    $rankings = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!--<link rel="stylesheet" href="/wp-content/foundation/css/foundation.css">
    //<link rel="stylesheet" href="/wp-content/foundation/css/app.css">-->
    
    <h3 id="kwtitle" class="text-center"><?php echo $h1_text.' '.ucwords($area);?></h3>
    
    <?php
      if(!isset($_GET['business'])){
        $last_check_sql = 'SELECT `date` FROM `rank_check_dates` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'" ORDER BY `date` DESC';
      }else{
        $last_check_sql = 'SELECT `date` FROM `rank_check_dates` WHERE `business_name` = '.'"'.$_GET['business'].'" ORDER BY `date` DESC';
      }
      
      $last_check_query = $db->query($last_check_sql);
      $check_dates = $last_check_query->fetchAll(PDO::FETCH_ASSOC);
      $date = date("Y/m/d");
      
        /**if($check_dates[0]['date'] == $date){
          echo '<p>Your rankings were last checked Today '.$check_dates[0]['date'].'. Your current plan allows you to check your rankings once per day. Please check back in 24 hours to refresh this list.</p>';
        }else{
    ?>
    <p>Your rankings were last checked on <?php  echo $check_dates[0]['date'] ;?> and have not been updated in the last 24 hours. Click "Update Now" to get a current list of your Rankings. After clicking update we will start to gather your rankings which can take awhile. Please allow at least 5 minutes for the data to be gathered. You are free to navigate the site as we gather your data in the background. Feel free to leave or refresh the page as this will not interrupt the program.</p>
    <form method="post" action="code/get_rankings.php">
    <input type="hidden" name="business_name" value=<?php echo '"'.$_SESSION['user_id'].'"'; ?>/>
    <input type="submit" value="Update Now"/>
    </form>
    </br>
    <?php
        }**/
      
    ?>
    <p style = "font-size:1.1rem; color:red;">*If any of your rankings are highlighted in red then congratulations! That means you are ranking in the #1 spot on the first page in Google.</p>
    <p style="font-weight:bold;">View your rankings by date:</p>
    <?php
    if(!isset($_GET['business'])){
     echo '<form id="rank_dates" method ="POST" action="index.php?page=rankings&area='.$area.'">';
    }else{
      echo '<form id="rank_dates" method ="POST" action="index.php?page=rankings&area='.$area.'&business='.$_GET['business'].'">';
    }
     echo '<select name="date">';
     $dates_query = $db->query($date_sql);
     $dates = $dates_query->fetchAll(PDO::FETCH_ASSOC);
    foreach($dates as $date){
      echo '<option value="'.$date['date'].'">'.$date['date'].'</option>';
    }
     echo '</select>';
     echo '<input type="submit"/>';
     echo '</form>';
    ?>


    <br>
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
      <th>View History For This Result</th>
      <th>Search Result Link</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($rankings as $rank){
        $search_phrase_formatted = ucwords(str_replace("+"," ",$rank['search_phrase']));
        $target_area_formatted = ucwords(str_replace("+"," ",$rank['target_area']));
        $serp_page_color = $rank['serp_page'];
        $serp_page = $rank['serp_page'] -1;
        $page_rank = $rank['rank'];
      ?>
      
      <tr>
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo $search_phrase_formatted ?></td>
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo $target_area_formatted ?></td>
        <td <?php get_color($page_rank,$serp_page_color); ?> class="text-center"><?php echo $rank['rank'] ?></td>
        <td <?php get_color($page_rank,$serp_page_color); ?> class="text-center"><?php echo $rank['serp_page'] ?></td>
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo $rank['search_result'] ?></td>
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo $rank['date'] ?></td>
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo '<a target="_blank" href="https://www.google.com/search?q='.$rank['search_phrase'].'+'.$area.'&start='.$serp_page.'0"'.'>Check Your Current Rankings</a>';?></td>
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo '<a href="keyword_history.php?search_result='.$rank['search_result'].'&target_area='.$rank['target_area'].'&search_phrase='.$rank['search_phrase'].'">View History</a>';?></td>
        <?php
        if(!empty($rank['link'])){
        ?>
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo '<a target="_blank" href="'.$rank['link'].'"'.'>View search result link</a>';?></td>
        <?php
        }else{
        ?>
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo 'No Link Available';?></td>
        <?php
        }
        ?>
      </tr>
      

      <?php
      //echo "Your Keyword: ".$rank['search_phrase']." is number ".$rank['rank']. " on page number ".$rank['serp_page']. "on Google as of ".$rank['date']." <br><br>";
    }
    ?>
    </tbody>
    </table>
   