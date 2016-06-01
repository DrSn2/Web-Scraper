<li><a href="index.php">Home</a></li>
      <li class="has-submenu">
        <a href="#">Business Rankings</a>
        <ul class="submenu menu vertical" data-submenu>
          <?php
          $sql = 'SELECT * FROM `business`';
          $query = $db->query($sql);
          $businesses = $query->fetchAll(PDO::FETCH_ASSOC);
    
          foreach($businesses as $business){

            echo '<li class="has-submenu"><a href="index.php?page=rankings&business='.$business['business_name'].'">'.ucwords($business['business_name']).'</a>
              <ul class="submenu menu" data-submenu>';
              $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$business['business_name'].'"';
              $target_area_query = $db->query($target_area_sql);
              $target_areas = $target_area_query->fetchAll(PDO::FETCH_ASSOC);
              foreach($target_areas as $target_area){
                echo '<li><a href="index.php?page=rankings&business='.$business['business_name'].'&area='.$target_area['area'].'">'.ucwords(str_replace('+',' ',$target_area['area'])).'</a></li>';
              }

              echo '</ul></li>';

          }
        ?>
        </ul>
      </li>
      <li class="has-submenu">
        <a href="#">Business Keywords</a>
        <ul class="submenu menu vertical" data-submenu>
          <?php
            get_all_business_li($db,'keywords');
          ?>
        </ul>
      </li>
      <li>
        <?php if(!isset($_SESSION['user_id'])){
          ?>
        <a href="login.php">Login</a>

        <?php }else{

          ?>
          <a href="logout.php">Logout</a>

          <?php 

            }

          ?>

      </li>