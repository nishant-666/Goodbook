<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['login-id']))
        header('Location:login.php');
        include('dbconfig.php');
        include('emailVerification.php');


    function checkLike($post)
    {
        $query="SELECT * FROM `likes` WHERE `post`='$post' AND `email`='".$_SESSION['login-id']."'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false && mysqli_num_rows($res)==1)
            return true;
        return false;
    }

    function likeCount($post)
    {
        $query="SELECT `sno` FROM `likes` WHERE `post`='$post'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
            return  mysqli_num_rows($res);
    }
  

    function getUserDetail($token)
    {
        $query="SELECT * FROM `users` WHERE `email`='$token'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
            return $res;
    }

    function showTextFeeds()
    {
        $query="SELECT * FROM `feeds` ORDER BY `additionDate` DESC";
        $res=mysqli_query($GLOBALS['conn'], $query);
        $carousel=1;
        if($res!=false)
            if(mysqli_num_rows($res)>0)
                while($row=mysqli_fetch_assoc($res))
                {
                    $resProfile=getUserDetail($row['user']);
                    $rowProfile=mysqli_fetch_assoc($resProfile);
                    $name=$rowProfile['name'];

                    
                    $text=$row['text'];

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

                        $image.='        </ol>
                            </div>';
                    }
                       

                    echo '<div class="row text-left" style="padding-bottom: 20px;">
                    <div class="col-md-6 col-lg-6 offset-lg-3 text-left" style="padding: 20px;padding-top: 0px;margin-top: -20px;">
                        <div class="card border rounded-0">
                            <div class="card-body text-center" style="background-color: #f9f9f9;padding: 15px;">
                               <h6 class="text-left text-dark border rounded-0" style="margin-top: 8px;padding: 10px;margin-bottom: 0px;">
                               <a href="exploreuser.php?user='.$rowProfile['email'].'"><img class="img-fluid border rounded-circle" style="width: 40px;height: 40px;margin-right:5px" src="profile_pic/'.$rowProfile['profile'].'"><strong>'.$name.'</a></h6></strong>
                                <p class="text-left border rounded-0" style="margin: 0px;padding: 0px;margin-top: 0px;margin-bottom: 0px;font-size: 15px;"></p>'
                                ;
                                if($row['images']!=null && $text==null)
                        echo $image;
                    else
                        echo '<p class="text-justify border rounded-0 card-text" style="padding: 10px;margin-bottom: 10px;background-color: rgba(0,0,0,0.04);font-size: 15px;">'.$text.'</p>'.$image.'

                            

                            ';

                    if(checkLike($row['sno']))
                        echo '<div class="ui labeled button like-btn" id="postid'.$row['sno'].'" data-like="1" tabindex="0">
                        <div class="ui button ui red button">
                          <i class="heart icon"></i> Like
                        </div>
                        <a class="ui basic label">
                          '.likeCount($row['sno']).'
                        </a>
                      </div>


                      <a class="ui facebook button" href="comments.php?id=postid'.$row['sno'].'">
                        <i class="comment icon"></i>
                        Comment
                      </a>';
                    else
                        echo '<div class="ui labeled button like-btn" id="postid'.$row['sno'].'" data-like="0" tabindex="0">
                        <div class="ui button ui facebook button">
                          <i class="heart icon"></i> Like
                        </div>
                        <a class="ui basic label">
                        '.likeCount($row['sno']).'
                        </a>
                      </div>


                      <a class="ui facebook button" href="comments.php?id=postid'.$row['sno'].'">
                        <i class="comment icon"></i>
                        Comment
                      </a>';
                   
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
    <link rel="shortcut icon" href="assets/img/favicon.jpg"/>
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

    <div class="btn-group" role="group"></div>
    <div>
        <div class="container">
            <div class="row" style="margin-top: -20px;padding-bottom: 20px;">
                <div class="col-md-6 col-lg-4 offset-lg-4" style="padding: 10px;background-color: rgba(0,0,0,0.51);padding-top: 0px;margin-top: 10px;">
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-body text-center" style="background-color: #f9f9f9;padding: 15px;">
                             <?php
                            if(!isset($_SESSION['first-login']))
                            echo ' <div class="alert alert-success style="position: fixed; z-index: 10; top: 3px;>Welcome to Goodbook! 😄 &nbsp;&nbsp;
   
                            </div>';
                            if(isset($_SESSION['first-update']))
                            {
                                unset($_SESSION['first-update']);
                                echo ' 
                                
                                <div class="alert alert-success style="position: fixed; z-index: 10; top: 3px;>Your Post has been updated! &nbsp;&nbsp;
                    
                                    </div>';
                                    }
                            ?>
                            
                                <div class="col" style="margin-bottom: 15px;">
                                <a class="btn btn-outline-primary btn-sm" role="button" style="margin-top:8px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;margin-right: 5px;" href="profile.php">
                                <i class="fa fa-user"></i>&nbsp; Profile</a>

                                <a class="btn btn-outline-primary btn-sm" role="button" style="margin-top:8px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;margin-right: 5px;" href="qna.php">
                                <i class="fa fa-question"></i>&nbsp; Questions</a>

                                <a class="btn btn-outline-primary btn-sm" role="button" style="margin-top:8px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;margin-right: 5px;" href="feedback.php">
                                <i class="wpforms icon"></i>&nbsp; Feedback</a>

                                <a class="btn btn-outline-primary btn-sm" role="button" style="padding: 10px;margin-top:8px;padding-top: 10px;padding-right: 8px;padding-bottom: 10px;padding-left: 8px;margin-left: 0px;" href="logout.php">
                                <i class="fa fa-sign-out"></i>&nbsp;Log out</a></div>


                                <img class="img-fluid border rounded-circle" src="assets/img/cooltext346756811188319.png" style="width: 150px;background-color: #ffffff;margin: 25px;margin-left: 25px;margin-top: 0px;padding: 20px;">
                            <div
                                class="col text-center">
                                <form class="text-left" method="POST" action="post.php">
                                    <textarea class="form-control" placeholder="Something on your mind?" name="post-text" style="margin-bottom: 10px;" required=""></textarea>
                                    <div class="col text-center" style="margin-bottom: 10px;margin-top: 10px;">
                                    <button class="btn btn-outline-primary btn-sm" type="submit"
                                        style="padding: 5px;padding-top: 5px;"><i class="far fa-paper-plane"></i>&nbsp; Post Status</button></form></div>
                        </div>
                        <div class="col text-center" style="margin-bottom: 10px;margin-top: 10px;"><a class="btn btn-outline-primary btn-sm" role="button" style="padding: 5px;padding-top: 5px;" href="upload.php"><i class="fa fa-file-photo-o"></i>&nbsp; Upload Picture</a></div>
                        <div class="col text-center" style="margin-bottom: 10px;margin-top: 10px;"><a class="btn btn-outline-primary btn-sm" role="button" style="padding: 5px;padding-top: 5px;" href="posts.php"><i class="fa fa-heart"></i>&nbsp; My Posts</a>

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
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){$('.alert').alert('close');}, 6000);
    });

    $(document).on('click', '.like-btn', function(){
        var post=$(this).attr('id').substr(6);
        var like=$(this).attr('data-like');
        var btn=$(this);
        $.ajax({
            type: 'POST',
            url: 'like.php',
            data: {post: post, like: like},
            success: function(response)
            {
                
                if(response==true)
                {
                    if(like==0)
                    {
                        $('#postid'+post+' div').removeClass('facebook');
                        $('#postid'+post+' div').addClass('red');
                        $('#postid'+post).attr('data-like', '1');
                        btn.children('a').text(parseInt(btn.children('a').text())+1);
                    }
                    else
                    {
                        $('#postid'+post+' div').removeClass('red');
                        $('#postid'+post+' div').addClass('facebook');
                        $('#postid'+post).attr('data-like', '0');
                        btn.children('a').text(parseInt(btn.children('a').text())-1);
                    }
                }
            }
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