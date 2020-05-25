<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['login-id']))
        header('Location:login.php');
    include('dbconfig.php');

    // $_SESSION['login-id']="nishants4401@gmail.com";

    $query="SELECT * FROM `users` WHERE `email`='".$_SESSION['login-id']."'";
    $res=mysqli_query($GLOBALS['conn'], $query);
    $row=null;
    if($res!=false)
    {
        $row=mysqli_fetch_assoc($res);
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>The Goodbook</title>
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


</style>

<body style="background-size: cover;background-repeat: no-repeat;filter: blur(0px);">

    <div class="col text-right">
    
    <a class="btn btn-dark border rounded-0 border-dark" role="button" href="home.php" style="margin: 10px;"><i class="fa fa-home"></i>&nbsp; Home</a></div>
    
    <div class="col" style="margin-top: 5px;">
    
        <div class="container py-3">
    <div class="row">
        <div class="col-md-6 offset-md-3">
                    
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Your Profile</h4>
                        </div>

                        <div class="card-body">
                            
                            <form class="form" role="form" action="update_profile.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                    <input id="upload" name="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                                    <label id="upload-label" for="upload" class="font-weight-bold text-dark">Choose a Profile Picture</label>
                                    <div class="input-group-append">
                                        <label for="upload" name='imgname' class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose</small></label>
                                    </div>
                                </div>

                                <div class="image-area mt-4">
                                    <img id="imageResult" src="profile_pic/<?php echo $row['profile']; ?>" alt="No profile pic set" class="img-fluid rounded shadow-sm mx-auto d-block">
                                </div>

                                    <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="username" value="<?php echo $row['username']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="name" value="<?php echo $row['name']; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="email" name="email" value="<?php echo $row['email']; ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="password" name="password" value="<?php echo $row['password']; ?>"readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Repeat Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="Password" name="repeat-password" value="<?php echo $row['password']; ?>"readonly>
                                    </div>
                                </div>
                                 
                                
                                </div>
                                <div class="form-group row" align="center">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-12">
                                       
                                        <input type="hidden" name="update" value="update" />
                                        <input type="submit" class="btn btn-outline-dark btn btn-md border rounded-0" value="Save Changes">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->
        </div>
    </div>
</div>
    </div>
    <script type="text/javascript">
    
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}
</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
</body>

</html>


<?php ob_end_flush(); ?>