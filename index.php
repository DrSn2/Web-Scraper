<?php include('header.php'); ?>
<!-- END HEADER AREA-->

<!--START CONTENT AREA-->
 <div class="row">
    <?php
      if(isset($_GET['page'])){

        $page_url = $_GET['page'];
      }

      if(empty($_GET['page'])){

        include_once('home.php');

      }else if($page_url == "keywords"){
    ?>

      <div class="large-12 columns">
        <?php include_once('keywords.php'); ?>
      </div>
      <?php
    }else if($page_url == "rankings"){
      ?>
      <div class="large-12 columns">
        <?php include_once('rankings.php'); ?>
      </div>

      <?php
    }

    ?>

    </div>
    <!--END CONTENT AREA-->

   <!--START FOOTER AREA-->
   <?php include_once('footer.php'); ?>
   <!-- END FOOTER AREA-->
