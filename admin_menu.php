
      <li class="has-submenu">
        <a href="#">View Data As:</a>
        <ul class="submenu menu vertical" data-submenu>
          <?php
            $sql = 'SELECT * FROM `business` WHERE `role` = "client"';
            $query = $db->query($sql);
            $businesses = $query->fetchAll(PDO::FETCH_ASSOC); 

            foreach($businesses as $business){
            echo '<li><a href="code/login_as.php?&business='.$business['business_name'].'">'.ucwords(str_replace("+"," ",$business['business_name'])).'</a></li>';
        }
          ?>
        </ul>
      </li>