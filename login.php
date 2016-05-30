<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
    <link rel="stylesheet" href="foundation/css/foundation.css">
    <link rel="stylesheet" href="foundation/css/app.css">
  </head>
  <body>
    <div class="row">
      <div class="large-12 columns">
        <h2 style="margin-bottom:3rem; margin-top:3rem;" class="text-center">Welcome to Local Rank Tracker! Courtesy of <img style="width:40rem"; src="images/artisanwebcraft copy.png"/></h2>

      <div class="row">
  <div class="medium-6 medium-centered large-4 large-centered columns">

    <form method="post" action="code/user_session.php">
      <div class="row column log-in-form">
        <h4 class="text-center">Please Login To Continue</h4>
        <label>Username
          <input type="text" name = "username" placeholder="Your Username">
        </label>
        <label>Password
          <input type ="password" name = "password" placeholder="Your Password">
        </label>
        <p><input type="submit" class="button expanded" />
        <p class="text-center"><a href="#">Forgot your password?</a></p>   
      </div>
    </form>

  </div>
</div>
      </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>