<?php
 	require_once('code/required_files.php');
 ?>

 	<!--START HEADER AREA-->
<?php include('header.php'); ?>
<!-- END HEADER AREA-->

<!--START CONTENT AREA-->
 <div class="row">

<?php
  $target_area = str_replace(' ','+', $_GET['target_area']);
  $search_phrase = str_replace(' ','+', $_GET['search_phrase']);
	$sql = 'SELECT * FROM `page_rank` WHERE `search_result` = "'.$_GET['search_result'].'" AND `target_area` = "'.$target_area.'" AND `search_phrase` = "'.$search_phrase.'" ORDER BY date DESC LIMIT 100';

	$query = $db->query($sql);
    $rankings = $query->fetchAll(PDO::FETCH_ASSOC);
?>
</div>
    <!--END CONTENT AREA-->
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
        <td <?php get_color($page_rank,$serp_page_color); ?> ><?php echo '<a href="https://www.google.com/search?q='.$rank['search_phrase'].'+'.$rank['target_area'].'&start='.$serp_page.'0"'.'>Check Your Current Rankings</a>';?></td>
        
      </tr>
      

      <?php
      //echo "Your Keyword: ".$rank['search_phrase']." is number ".$rank['rank']. " on page number ".$rank['serp_page']. "on Google as of ".$rank['date']." <br><br>";
    }
    ?>
    </tbody>
    </table>
   <!--START FOOTER AREA-->
   <?php include_once('footer.php'); ?>
   <!-- END FOOTER AREA-->