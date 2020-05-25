<?php
    ob_start();

    $flag=false;
    
    if(isset($_GET['result']) && $_GET['result']=='pass')
    {
        $flag=true;
    }
?>

<!DOCTYPE html>
<html style="width: 100%;height: 100vh;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Your Feedbacks</title>
    <link rel="shortcut icon" href="assets/img/favicon.jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <link rel="stylesheet" href="assets/css/News-Cards.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/text-box.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
</head>

<body style="background-image: url(&quot;assets/img/blur.png&quot;);background-size: auto;background-repeat: no-repeat;filter: blur(0px) contrast(199%);background-color: rgba(0,0,0,0);">
<div id="WAButton"></div>
    <div class="text-center login-clean" style="background-color: rgba(241,247,252,0);">
        <form class="shadow-lg" method="post" action="addFeedback.php" style="opacity: 1;width: 600px;background-color: rgba(0,0,0,0.34);margin-top: 5px;margin-bottom: -35px;" action="feedback.php">
         
            <?php if($flag) echo '<div class="alert alert-success">Feedback Sent</div>'; ?>
            <a class="ui primary button" role="button" href="home.php">
            <i class="fa fa-user"></i>&nbsp; Home</a>
            <a class="ui primary button" role="button" href="logout.php">
            <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>&nbsp;Log out</a>
            
            <h1 style="padding: 10px;background-color: rgba(249,249,249,0);color: #ffffff;">Your feedback!</h1>
            <div class="form-group border rounded-0" style="background-color: #ffffff;">
            <input class="form-control form-control-sm" type="text" name="name" placeholder="Name" required="" style="background-color: #ffffff;font-family: ABeeZee, sans-serif;"></div>
            <div class="form-group border rounded-0" style="background-color: #ffffff;">
            <input class="form-control form-control-sm" type="text" name="message" placeholder="Your Feedback" required="" style="background-color: #ffffff;font-family: ABeeZee, sans-serif;"></div>
            <div class="form-group">
          
            <div class="form-group text-center">
            <button class="ui secondary button" type="submit" style="margin-top: 0px;">Submit</button></div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
</body>

</html>

<?php ob_end_flush(); ?>