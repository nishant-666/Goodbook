<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['login-id']))
        header('Location:login.php');
    include('dbconfig.php');
    include('emailVerification.php');
  

    function getUserDetail($token)
    {
        $query="SELECT * FROM `users` WHERE `email`='$token'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
            return $res;
    }

    function showTextFeeds()
    {
        $query="SELECT * FROM `questions` ORDER BY `additionDate` DESC";
        $res=mysqli_query($GLOBALS['conn'], $query);
        $carousel=1;
        if($res!=false)
            if(mysqli_num_rows($res)>0)
                while($row=mysqli_fetch_assoc($res))
                {
                    $resProfile=getUserDetail($row['user']);
                    $rowProfile=mysqli_fetch_assoc($resProfile);
                    $name=$rowProfile['name'];

                    
                    $text=$row['question'];

                    $image='';
                    if($row['images']!=null)
                    {
                        $images=explode(',', $row['images']);


                        $image='<div class="carousel slide" data-ride="carousel" id="carousel-'.$carousel.'">
                                <div class="carousel-inner" role="listbox">';
                        
                        $active='active';
                        $count=0;
                        foreach($images as $img)
                        {
                            $image.='<div class="carousel-item '.$active.'">
                            <img class="img-thumbnail w-100 d-block" src="uploads/'.$img.'" alt="Slide Image"></div>';
                            $active='';
                            $count++;
                        }
        
                        $image.='</div>
                                <div></div>
                                <ol class="carousel-indicators">';

                        $active='class="active"';
                        $i=0;
                        while($i<$count)
                        {
                            $image.='<li data-target="#carousel-'.$carousel.'" data-slide-to="'.$i++.'" '.$active.'></li>';
                            $active='';
                        }

                        $image.='</ol>
                            </div>';
                    }
                       

                    echo '<div class="row text-left" style="padding-bottom: 20px;">
                    <div class="col-md-6 col-lg-6 offset-lg-3 text-left" style="padding: 20px;padding-top: 0px;margin-top: -20px;">
                        <div class="card border rounded-0">
                            <div class="card-body text-center" style="background-color: #f9f9f9;padding: 15px;">
                               <h6 class="text-left text-dark border rounded-0" style="margin-top: 8px;padding: 10px;margin-bottom: 0px;"><a href="exploreuser.php?user='.$rowProfile['email'].'"><img class="img-fluid border rounded-circle" style="width: 40px;height: 40px;margin-right:5px" src="profile_pic/'.$rowProfile['profile'].'"><strong>'.$name.'</a></h6></strong>
                                <p class="text-left border rounded-0" style="margin: 0px;padding: 0px;margin-top: 0px;margin-bottom: 0px;font-size: 15px;"></p>'
                                ;
                                if($row['images']!=null && $text==null)
                        echo $image;
                    else
                        echo '<p class="text-justify border rounded-0 card-text" style="padding: 10px;margin-bottom: 10px;background-color: rgba(0,0,0,0.04);font-size: 15px;">'.$text.'</p>'.$image.'

                            <a class="ui facebook button" href="answers.php?id=postid'.$row['sno'].'">
                              <i class="comment icon"></i>
                              Answers
                            </a>

                            ';
                   
                    echo '</div>

                        </div>
                    </div>
                </div>';
                
            
                               
                
                } 
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>The Goodbook</title>
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
    <style>
body {
  background-image: url('assets/img/blur.png');
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;
}
</style>
</head>

<body>
    <div></div>
    <div></div>
    <div></div>

     <div id="WAButton"></div>
       
    
    <div class="btn-group" role="group">
    </div>
    <div>
        <div class="container">
            <div class="row" style="margin-top: -20px;padding-bottom: 20px;">
                <div class="col-md-6 col-lg-4 offset-lg-4" style="padding: 10px;background-color: rgba(0,0,0,0.51);padding-top: 0px;margin-top: 10px;">
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-body text-center" style="background-color: #f9f9f9;padding: 15px;">
                            
                            <div class="col" style="margin-bottom: 15px;">
                                <a class="btn btn-outline-primary btn-sm" role="button" style="margin-top:8px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;margin-right: 5px;" href="home.php">
                                <i class="fa fa-feed"></i>&nbsp; Feed</a>

                                <a class="btn btn-outline-primary btn-sm" role="button" style="margin-top:8px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;margin-right: 5px;" href="profile.php">
                                <i class="fa fa-user"></i>&nbsp; Profile</a>
                                
                                <a class="btn btn-outline-primary btn-sm" role="button" style="margin-top:8px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;margin-right: 5px;" href="feedback.php">
                                <i class="wpforms icon"></i>&nbsp; Feedback</a>
                                
                                <a class="btn btn-outline-primary btn-sm" role="button" style="margin-top:8px;padding: 10px;padding-top: 10px;padding-right: 8px;padding-bottom: 10px;padding-left: 8px;margin-left: 0px;" href="logout.php">
                                <i class="fa fa-sign-out"></i>&nbsp;Log out</a></div>

                                <img class="img-fluid border rounded-circle" src="assets/img/cooltext346756811188319.png" style="width: 150px;background-color: #ffffff;margin: 25px;margin-left: 25px;margin-top: 0px;padding: 20px;">
                            <div
                                class="col text-center">
                                <form class="text-left" method="POST" action="qnapost.php">
                                    <textarea class="form-control" placeholder="Ask a question" name="post-question" style="margin-bottom: 10px;" required=""></textarea>
                                    <div class="col text-center" style="margin-bottom: 10px;margin-top: 10px;">
                                    <button class="btn btn-outline-primary btn-sm" type="submit"
                                        style="padding: 5px;padding-top: 5px;">
                                        <i class="far fa-paper-plane"></i>&nbsp; Ask</button></form></div>
                        </div>
                        
                        <div class="col text-center" style="margin-bottom: 10px;margin-top: 10px;">
                            <a class="btn btn-outline-primary btn-sm" role="button" style="padding: 5px;padding-top: 5px;" href="myanswers.php">
                            <i class="fa fa-question"></i>&nbsp; My Questions</a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br>
   
        <?php echo showTextFeeds(); ?>

    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){$('.alert').alert('close');}, 6000);
    });
  </script>
  
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

<?php
    ob_start();
?>

<?php
    $_SESSION['first-login']='1';
?>