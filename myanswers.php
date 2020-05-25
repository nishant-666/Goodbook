<?php
    ob_start();
    session_start();


    if(!isset($_SESSION['login-id']))
        header('Location:login.php');
    include('dbconfig.php');

   
    function getUserDetail($token)
    {
        $query="SELECT * FROM `users` WHERE `email`='$token'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
            return $res;
    }

    function showTextFeeds()
    {
        $query="SELECT * FROM `questions` WHERE `user`='".$_SESSION['login-id']."' ORDER BY `additionDate` DESC";
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
                            <img class="img-thumbnail w-100 d-bloc k" src="uploads/'.$img.'" 
                            alt="Slide Image">
                            </div>';
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
                            $image.='<li data-target="#carousel-'.$carousel.'" data-slide-to="'.$i++.'" '.$active.'>
                            </li>';
                            $active='';
                        }

                        $image.='        
                            </ol>
                            </div>';
                    }
                       

                    echo '<div class="row text-left" style="padding-bottom: 0px;">
                    <div class="col-md-6 col-lg-6 offset-lg-3 text-left" style="padding: 20px;padding-top: 0px;margin-top: -20px;">
                        <div class="card border rounded-0">
                            <div class="card-body text-center" style="background-color: #f9f9f9;padding: 15px;">
                               <h6 class="text-left text-dark border rounded-0" style="margin-top: 8px;padding: 10px;margin-bottom: 0px;">
                               <img class="img-fluid border rounded-circle" style="width: 40px;height: 40px;" 
                               src="profile_pic/'.$rowProfile['profile'].'">
                               <strong>&nbsp;&nbsp;'.$name.'</h6>
                               </strong>
                                <p class="text-left border rounded-0" style="margin: 0px;padding: 0px;margin-top: 0px;
                                margin-bottom: 0px;font-size: 15px;"></p>';
                                if($row['images']!=null && $text==null)
                        echo $image;
                    else
                        echo '<p class="text-justify border rounded-0 card-text" style="padding: 10px;
                        background-color: rgba(0,0,0,0.04);font-size: 15px;">'.$text.'</p>'.$image.
                        '<br>';
                        echo '<div class="col text-center">
                        
            <button class="ui facebook button edit-post-btn" type="button" value="'.$row['sno'].'"> 
            <i class="fas fa-pencil-alt"></i>
            &nbsp;&nbsp;Edit Question&nbsp;</button>
            <button class="ui facebook button delete-post-btn" type="button" value="'.$row['sno'].'" style="margin-left: 5px;">
            <i class="far fa-trash-alt">&nbsp;&nbsp;Delete Question&nbsp;</i>
            </button>
            </div>';
            
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
    <title>Your Posts</title>
      <link rel="shortcut icon" href="assets/img/favicon.jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css?h=03ab36d1dde930b7d44a712f19075641">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css?h=07b31b2e3e960ff70213ac8794601ef7">
    
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

<div id="WAButton"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" >
      
        
        <div class="modal-header">
          <h4 class="modal-title">Edit Your Question</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        
        <div class="modal-body">
          <textarea id="post-edit-ta" class="form-control" style="height: 30vh;"></textarea>
        </div>
        
        
        <div class="modal-footer">
          <button type="button" class="ui red button" data-dismiss="modal">Close</button>
          <button type="button" class="ui green button" id="update-post-btn">Update Question</button>
        </div>
        
      </div>
    </div>
  </div>
    <div class="col-lg-6 offset-lg-3" style="margin-top: 20px; margin-bottom:20px;  ">

        <div class="card " >


            <div class="card-body" align="center" style="margin-top : 10px; ">
                <img class="img-fluid border rounded-circle" src="assets/img/cooltext346756811188319.png" 
                style="width: 150px;background-color: #ffffff;margin: 25px;margin-left: 25px;margin-top: 0px;margin-top:5px;padding: 20px;">
                <div class="col-lg-5 offset-lg-0 text-center">
                 <h5 class="border rounded-0 border-dark" style="padding: 10px;color: #000000;">My Questions</h5>
                 <a class="btn btn-outline-primary btn-sm" role="button" style="padding: 10px;margin-top:5px;padding-top: 10px;
                 padding-bottom: 10px;padding-right: 10px;padding-left: 10px;" href="home.php">
                 <i class="fa fa-feed"></i>&nbsp; Feed</a>
                 <a class="btn btn-outline-primary btn-sm" role="button" style="padding: 10px;margin-top:5px;padding-top: 10px;
                 padding-bottom: 10px;padding-right: 10px;padding-left: 10px;" href="qna.php">
                 <i class="fa fa-question"></i>&nbsp; Ask a Question</a>
                    <a class="btn btn-outline-primary btn-sm" role="button" style="margin-top:5px;padding: 10px;padding-top: 10px;padding-bottom: 10px;
                    padding-right: 10px;padding-left: 10px;" href="profile.php"><i class="fa fa-user"></i>&nbsp; Profile</a>
                    <a class="btn btn-outline-primary btn-sm" role="button" style="padding: 10px;margin-top:5px;padding-top: 10px;padding-right: 8px;padding-bottom: 10px;padding-left: 8px; " href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;Log out</a>
             </div>
                <div class="col-lg-5 offset-lg-0 text-center" align="center" style="margin-bottom: 15px; margin-top: 20px "></div></div>

                 <?php echo showTextFeeds(); ?>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/script.min.js?h=82d712d5e0811380f26d2753ca68c860"></script>
    <script src="assets/js/custom.js"></script>
    
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.edit-post-btn', function(){
            var sno=$(this).val();
            $.ajax({
                type: 'POST',
                url: 'update_question.php',
                data: {sno: sno, search: 'fetch-post'},
                success: function(response)
                {
                    if(response!=null && response.length==0)
                    {
                        alert("Question doesn't contains text.");
                    }                    
                    else if(response!=null)
                    {
                        $('#post-edit-ta').text(response);
                        $('#update-post-btn').attr('value', sno);
                        $('.modal').modal('show');
                    }
                    else if(response==null)
                    {
                        alert("Question doesn't exists/you don't have right to edit this post.");
                    }
                }
            });
        });

        $(document).on('click', '#update-post-btn', function(){
            var sno=$(this).val();
            var text=$('#post-edit-ta').val().trim();
            if(text.length==0)
            {
                alert('Text cannot be blank');
                return;
            }
            $.ajax({
                type: 'POST',
                url: 'update_question.php',
                data: {sno: sno, question: text, search: 'update-question'},
                success: function(response)
                {
                    if(response==true)
                    {
                        alert("Question updated!");
                        location.reload();
                    }                    
                    else
                    {
                        alert("Question doesn't exits/you don't have right to edit this post.");
                    }
                }
            });
        });

        $(document).on('click', '.delete-post-btn', function(){
            var sno=$(this).val();
            $.ajax({
                type: 'POST',
                url: 'update_question.php',
                data: {sno: sno, search: 'delete-question'},
                success: function(response)
                {
                    if(response==true)
                    {
                        alert("Question deleted!");
                        location.reload();
                    }                    
                    else
                    {
                        alert("Question doesn't exits/you don't have right to edit this post.");
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