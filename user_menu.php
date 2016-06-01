      <li><a href="index.php">Home</a></li>
      <li><a href="index.php?page=keywords">Your Keywords</a></li>
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