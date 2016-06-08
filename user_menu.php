      <li><a href="index.php">Home</a></li>
      
      <!-- SEO Tools -->
      <li class="has-submenu"><a href="index.php?page=rankings">SEO Tools</a>
      <ul class="submenu menu vertical" data-submenu>
      <li class="has-submenu"><a href="#">Technology Profile</a>
      <ul class="submenu menu vertical" data-submenu>
      <ul class="submenu menu vertical" data-submenu>
          <?php
          $sql = 'SELECT * FROM `competitors` WHERE `business_name` = "'.$_SESSION['user_id'].'"';
          $query = $db->query($sql);
          $competitors = $query->fetchAll(PDO::FETCH_ASSOC);
    
          foreach($competitors as $competitor){

            echo '<li class="has-submenu"><a href="tech-profile.php?business_name='.$competitor['competitor'].'">'.ucwords($competitor['competitor']).'</a>';
              
    

              echo '</li>';

          }
        ?>
        </ul>
      </ul>
      </li>
      </ul>
      </li>
      <!-- End SEO Tools -->
      <li><a href="index.php?page=keywords">Your Keywords</a></li>
      <!-- Your rankings menu -->
      <li class="has-submenu"><a href="index.php?page=rankings">Your Rankings</a>
      <ul class="submenu menu vertical" data-submenu>
      <?php
        $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$_SESSION['user_id'].'"';
        $target_area_query = $db->query($target_area_sql);
        $target_areas = $target_area_query->fetchAll(PDO::FETCH_ASSOC);
        foreach($target_areas as $target_area){
          echo '<li><a href="index.php?page=rankings&area='.$target_area['area'].'">'.ucwords(str_replace("+"," ",$target_area['area'])).'</a></li>';
        }
      ?>
      </ul>
      </li>
      <!-- End your rankings menu -->
      <!-- Competitors rankings menu -->
      <li class="has-submenu">
        <a href="#">Your Competitors Rankings</a>
        <ul class="submenu menu vertical" data-submenu>
          <?php
          $sql = 'SELECT * FROM `competitors` WHERE `business_name` = "'.$_SESSION['user_id'].'"';
          $query = $db->query($sql);
          $competitors = $query->fetchAll(PDO::FETCH_ASSOC);
    
          foreach($competitors as $competitor){

            echo '<li class="has-submenu"><a href="index.php?page=rankings&business='.$competitor['competitor'].'">'.ucwords($competitor['competitor']).'</a>
              <ul class="submenu menu" data-submenu>';
              $target_area_sql = 'SELECT * FROM `target_areas` WHERE `business_name` = '.'"'.$competitor['competitor'].'"';
              $target_area_query = $db->query($target_area_sql);
              $target_areas = $target_area_query->fetchAll(PDO::FETCH_ASSOC);
              foreach($target_areas as $target_area){
                echo '<li><a href="index.php?page=rankings&business='.$competitor['competitor'].'&area='.$target_area['area'].'">'.ucwords(str_replace('+',' ',$target_area['area'])).'</a></li>';
              }

              echo '</ul></li>';

          }
        ?>
        </ul>
      </li>
      <!-- End Competitors rankings menu -->
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