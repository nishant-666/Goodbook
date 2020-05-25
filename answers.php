    <?php 
    ob_start();
    session_start();

    if(!isset($_SESSION['login-id']))
        echo '<script>window.location.href="login.php"</script>';
    
    if(!isset($_GET['id']))
        echo '<script>window.location.href="home.php"</script>';
    include('dbconfig.php');

    function showComments()
    {
        if($GLOBALS['commentRes']!=null && mysqli_num_rows($GLOBALS['commentRes'])>0)
        {
            while($row=mysqli_fetch_assoc($GLOBALS['commentRes']))
            {
                $query="SELECT * FROM `users` WHERE `email`='".$row['email']."'";
                $res=mysqli_query($GLOBALS['conn'], $query);
                $user=mysqli_fetch_assoc($res);
                echo '<div class="col">
                <h5 class="text-left text-dark border rounded-0" style="font-family: ABeeZee, sans-serif;margin-top: 8px;padding: 10px;margin-bottom: 0px;font-size: 15px;">
                <img class="rounded-circle img-fluid border border-light" style="width: 20px;height: 20px;font-size: 14px;" src="profile_pic/'.$user['profile'].'"><strong>&nbsp;'.$user['name'].'</strong></h5>
                <h5 class="text-left text-dark border rounded-0" style="font-family: ABeeZee, sans-serif;padding: 10px;margin-bottom: 0px;font-size: 13px;">'.$row['answer'].'</h5>
                <h6 class="text-left text-dark border rounded-0" style="font-family: ABeeZee, sans-serif;padding: 10px;margin-bottom: 0px;font-size: 10px;">'.date('Y-m-d h:i a', strtotime($row['additionTime'])).'</h6>
            </div>';
            }
        }
    }
    
    $email=$_SESSION['login-id'];
    $id=$_GET['id'];
    $id=substr($id, 6);
    $query="SELECT * FROM `questions` WHERE `sno`='$id'";
    $res=mysqli_query($GLOBALS['conn'], $query);
    $postRow=null;
    $commentRes=null;
    $userRow=null;
    if($res!=false && mysqli_num_rows($res)==1)
    {
        $postRow=mysqli_fetch_assoc($res);
        $query="SELECT * FROM `answers` WHERE `question`='$id' ORDER BY `additiontime` DESC";
        $commentRes=mysqli_query($GLOBALS['conn'], $query);
    }

    $query="SELECT * FROM `users` WHERE `email`='$email'";
    $res=mysqli_query($GLOBALS['conn'], $query);
    if($res!=false && mysqli_num_rows($res)==1)
    {
        $userRow=mysqli_fetch_assoc($res);
    }

    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Question and Answers</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/News-Cards.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
    <link rel="stylesheet" href="assets/css/text-box.css">
</head>

<body style="background-position: auto;background-size: cover;background-repeat: no-repeat;background-image: url(&quot;assets/img/blur.png&quot;);">

    <div id="WAButton"></div>
    <div class="col-lg-4 offset-lg-4">
        <div class="card" style="margin-top: 30px;background-color: #f9f9f9;">
            <div class="card-body">
                <div class="col-xl-12 offset-xl-9 text-center" style="margin-left: 0px;padding-right: 0px;padding-left: 0px;">
                    <a class="btn btn-outline-primary btn-sm text-right border rounded-0" role="button" style="margin: 0px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;" href="home.php">
                    <i class="fa fa-feed"></i>&nbsp; Feed</a>
                    <a class="btn btn-outline-primary btn-sm text-right border rounded-0" role="button" style="margin: 0px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;" href="qna.php">
                    <i class="fa fa-question"></i>&nbsp; Questions</a>
                    <a
                        class="btn btn-outline-primary btn-sm border rounded-0" role="button" style="padding: 10px;padding-top: 10px;padding-right: 8px;padding-bottom: 10px;padding-left: 8px;" href="logout.php">
                        <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>&nbsp;Log out</a>
                </div>
                <h6 class="text-left text-dark border rounded-0" style="font-family: ABeeZee, sans-serif;margin-top: 8px;padding: 10px;margin-bottom: 0px;"><img class="rounded-circle img-fluid border border-light" style="width: 20px;height: 20px;" src="profile_pic/<?php echo $userRow['profile']; ?>"><strong>&nbsp;<?php echo $userRow['name']; ?></strong></h6>
                <p class="text-left border rounded-0 card-text" style="padding: 10px;margin-bottom: 10px;background-color: rgba(0,0,0,0.04);font-size: 16px;"><?php echo $postRow['question']; ?></p>
               
                <?php showComments(); ?>
                <form method="POST" action="addAnswers.php">

                    <div class="col" style="margin-top: 40px">
                        <div class="form-group">
                            
                            <input class="form-control form-control-sm" type="text" name="comment" placeholder="Add an answer" name="comment" required="">
                        </div>
                    </div>
                    <div class="col">
                        <button class="ui facebook button" type="submit" name="addComment" value="postid<?php echo $postRow['sno']; ?>">Add Answer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
      <script type="text/javascript">
      
      $(function() {
    $('#WAButton').floatingWhatsApp({
    phone: '+917979077520', //WhatsApp Business phone number International format-
    //Get it with Toky at https://toky.co/en/features/whatsapp.
    headerTitle: 'Welcome to the Goodbook!', //Popup Title
    popupMessage: 'Hello, how can we help you?', //Popup Message
    showPopup: true, //Enables popup display
    buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image
    //headerColor: 'crimson', //Custom header color
    //backgroundColor: 'crimson', //Custom background button color
    position: "right"    
  });
});
  </script>
</body>

</html>

<?php ob_end_flush(); ?>