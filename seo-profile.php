<?php
 	require_once('code/required_files.php');
 ?>

 	<!--START HEADER AREA-->
<?php include('header.php'); ?>
<!-- END HEADER AREA-->

<!--START CONTENT AREA-->
 <div class="row">

 	<?php
 	
 	

 	

    		$business_name = $_GET['business_name'];
    		
    		
    		$html = get_html_single($business_name,$db); 

			$title = $html->find('title');
			$desc = $html->find("meta[name='description']");

			$your_html = get_html_single($_SESSION['user_id'],$db);

			$your_title = $your_html->find('title');
			$your_desc = $your_html->find("meta[name='description']");
			?>
<div class="large-6 columns">
<h4 style="margin:20px;"><?php echo 'SEO Profile For: '.ucwords($business_name); ?></h4>

<table border="1">
   <thead>
    <tr>
      <th>Title Tag</th>
      <th>Meta Description</th>
      
    </tr>
  </thead>
  <tbody>
      <tr>
        <td>
        <?php echo $title[0]->plaintext; ?></td>
        <td><?php if(!empty($desc)){
				echo $desc[0]->content;
		    }else{
		    	echo 'This Business is not using a Meta Description Tag.';
		    } ?></td>  
    </tr>
  </tbody>
 </table>
 </div>

 <div class="large-6 columns">
<h4 style="margin:20px;"><?php echo ' Your SEO Profile: '.ucwords($_SESSION['user_id']); ?></h4>

<table border="1">
   <thead>
    <tr>
      <th>Your Title Tag</th>
      <th>Your Meta Description</th>
      
    </tr>
  </thead>
  <tbody>
      <tr>
        <td>
        <?php echo $your_title[0]->plaintext; ?></td>
        <td><?php if(!empty($your_desc)){
				echo $your_desc[0]->content;
		    }else{
		    	echo 'This Business is not using a Meta Description Tag.';
		    } ?></td>  
    </tr>
  </tbody>
 </table>
 </div>
   </div>
    <!--END CONTENT AREA-->

   <!--START FOOTER AREA-->
   <?php include_once('footer.php'); ?>
   <!-- END FOOTER AREA-->