<?php
    ob_start();
    session_start();
    if(isset($_SESSION['login-id']))
        echo '<script>window.location.href="home.php";</script>';
?>



<!DOCTYPE html>
<html style="width: 100%;height: 100vh;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>The Goodbook</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/text-box.css">
    <link rel="stylesheet" href="assets/css/modalanim.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
</head>

<body style="background-image: url(&quot;assets/img/blur.png&quot;);background-size: auto;background-repeat: no-repeat;filter: blur(0px);background-color: rgba(0,0,0,0.34);">

    <div class="text-center login-clean" style="background-color: rgba(241,247,252,0);">
        <form id="signup-form" class="shadow-lg" method="post" style="opacity: 1;width: 600px;background-color: rgba(0,0,0,0.34);margin-top: 50px;margin-bottom: 0px;" action="register.php">
            <h2 class="sr-only">Login Form</h2><img class="rounded-circle img-fluid" src="assets/img/cooltext346756811188319.png" style="width: 200px;background-color: #ffffff;margin: 25px;margin-left: 20px;padding: 10px;margin-top: -10px;">

            <div class="alert alert-danger" role="alert" id="signup-alert" style="display:none"></div>

            <?php
              if(isset($_SESSION['logout']))
              {
                echo ' <div class="alert alert-success style="position: fixed; z-index: 10; top: 3px;>Tata Bye! 😁 &nbsp;
   
  </div>';
                    unset($_SESSION['logout']);
              }
              
?>
            
            <div class="form-group border rounded-0" style="background-color: #ffffff;"><input class="form-control form-control-sm" type="text" name="name" placeholder="Name" required="" style="background-color: #ffffff;"></div>
            <div class="form-group border rounded-0" style="background-color: #ffffff;"><input class="form-control form-control-sm" type="email" style="background-color: #ffffff;" name="email" required="" placeholder="Email"></div>
            <div class="form-group"><input class="border rounded-0 form-control form-control-sm" type="password" style="background-color: #ffffff;" name="password" required="" placeholder="Password"></div>
            <div class="form-group text-center"><button id="signup-btn" class="btn btn-primary btn-block border-dark" type="submit" style="background-color: #000000;margin-top: 0px;">Create account</button></div>
            <a class="btn btn-outline-primary btn-block border-dark shadow" role="button" data-bs-hover-animate="pulse" href="login.php" style="background-color: #ffffff;margin-top: 10px;color: #000000;font-family: ABeeZee, sans-serif;">Already a member? Sign in</a>
            <div
                class="col" style="padding-top: 5px;margin-bottom: -30px;">
                <p class="text-center" style="font-size: 14px;color: rgba(255,255,255,0.73);font-family: ABeeZee, sans-serif;margin-top: 10px;">Goodbook© 2019<br></p>
    </div>
    </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="semantic/dist/semantic.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>

<?php ob_end_flush(); ?>