<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['login-id']))
        header('Location:login.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Goodbook</title>
      <link rel="shortcut icon" href="assets/img/favicon.jpg" />
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
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css"> 
    <link rel="stylesheet" href="assets/css/text-box.css">
</head>
<style type="text/css">
    #upload {
    opacity: 0;
}

#upload-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
}

.image-area {
    border: 2px dashed rgba(255, 255, 255, 0.7);
    padding: 1rem;
    position: relative;
}

.image-area::before {
    content: 'Uploaded image result';
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.8rem;
    z-index: 1;
}

.image-area img {
    z-index: 2;
    position: relative;
}

/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
body {
    min-height: 100vh;
    
}



</style>

<body style="background-size: cover;background-repeat: no-repeat;filter: blur(0px);background-position: auto;background-image: url(&quot;assets/img/blur.png&quot;);">

    <div class="col text-right">
    <a class="btn btn-dark border rounded-0 border-dark" role="button" href="home.php" style="margin: 10px;">
    <i class="fa fa-home"></i>&nbsp; Home</a></div>
    <div class="col-lg-6 offset-lg-3 text-center" ;>
    <div id="WAButton"></div>   
        <div class="card" style="background-color: rgba(0,0,0,0.54);">
        
             <div class="card-body">
    <!-- For demo purpose -->
    <header class="text-white text-center">
        
        <img src="https://res.cloudinary.com/mhmd/image/upload/v1564991372/image_pxlho1.svg" alt="" width="150" class="mb-4">
    </header>

    <form action="post.php" method="POST" enctype="multipart/form-data">
    
        <div class="col-lg-6 mx-auto">

            <!-- Upload image input-->
            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                <input id="upload"  name="upload[]" type="file" accept="image/*" onchange="readURL(this);" required="" class="form-control border-0" multiple="">
                <label id="upload-label" for="upload" class="font-weight-bold text-dark">Choose File</label> 
                <div class="input-group-append">
                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                </div>
            </div>
         
                <textarea class="form-control" name="post-text" placeholder="Enter a Caption"></textarea>
        				
    
            <br>
            <p class=" text-white text-center">Your Selected Picture</p>
            
            <div class="col text-center" style= "margin-top: 20px" "padding: 20px;"><button class="btn btn-outline-light" style="padding: 10px;" multiple="" type="submit"><i class="fa fa-file-picture-o"></i>&nbsp; Upload</button></div>
        </div>
    </div>
</div>
  

</div>
</form>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
</body>

</html>

<?php ob_end_flush(); ?>