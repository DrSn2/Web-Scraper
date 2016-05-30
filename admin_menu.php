<li><a href="index.php">Home</a></li>
      <li class="has-submenu">
        <a href="#">Business Rankings</a>
        <ul class="submenu menu vertical" data-submenu>
          <?php
            get_all_business_li($db,'rankings');
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