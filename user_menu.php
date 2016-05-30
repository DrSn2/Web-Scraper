      <li><a href="index.php">Home</a></li>
      <li><a href="index.php?page=keywords">Your Keywords</a></li>
      <li><a href="index.php?page=rankings">Your Rankings</a></li>
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