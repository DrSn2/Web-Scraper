 <?php

$username_upper = ucwords($_SESSION['user_id']);

 ?>

 <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="main-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">
      <?php
      if(isset($_SESSION['user_id'])){
       echo "Hi ".$username_upper;
     }else{
       echo "Welcome To Rank Tracker!";
     }
       ?>
       </li>
       <?php
       if(is_admin($db)){
          include('admin_menu.php');
       }
       ?>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu" data-responsive-menu="drilldown medium-dropdown">
      <?php
        
          include('user_menu.php');

      ?>
    </ul>
  </div>
</div>
