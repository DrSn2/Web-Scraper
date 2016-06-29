<?php
 	require_once('code/required_files.php');

 	$keyword_id = $_GET['id'];
	$keyword_value = $_GET['value'];
	
	if(isset($_POST['keyword'])){
	$keyword = trim(str_replace(" ","+",$_POST['keyword']));
	
	$change_sql = 'UPDATE `keywords` SET `keyword` ="'.$keyword.'" WHERE `id` ="'.$keyword_id.'"';
	$change_query = $db->query($change_sql);
	header('location:index.php?page=keywords');

	}
 ?>

 	<!--START HEADER AREA-->
<?php include('header.php'); ?>
<!-- END HEADER AREA-->

<!--START CONTENT AREA-->
 <div class="row">
 <div class="large-12 columns">


<?php
	
	$sql = 'SELECT * FROM `keywords` WHERE `id` = "'.$keyword_id.'"';
	$query = $db->query($sql);
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	?>
	<p>Your Current Keyword Is: "<?php echo $keyword_value ;?>". Change The Value Below.</p>
	<form method="post" action="change_keyword.php?id=<?php echo $keyword_id ;?>">
	<input type="text" name="keyword"/>
	<input type="submit">
	</form>
</div>

</div>
    <!--END CONTENT AREA-->

   <!--START FOOTER AREA-->
   <?php include_once('footer.php'); ?>
   <!-- END FOOTER AREA-->