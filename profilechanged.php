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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css?h=03ab36d1dde930b7d44a712f19075641">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css?h=07b31b2e3e960ff70213ac8794601ef7">
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css"> 
</head>
<style type="text/css">
    

</style>

<div id="WAButton"></div>

     <div class="col text-right"><a class="btn btn-dark border rounded-0 border-dark" role="button" href="home.php" style="margin: 10px;"><i class="fa fa-home"></i>&nbsp; Home</a></div>
    <div style="margin-top: 20px;"></div>
    <div class="container text-center" style="background-color: #ffffff;padding: 30px;padding-bottom: 0pz;">
        <div class="row text-center">
            <div class="col-md-4 col-lg-12 col-xl-3 offset-lg-0 offset-xl-5 text-center" style="margin-top: -40px;">
                <h3 class="text-center border rounded-0" style="padding: 20px;font-family: ABeeZee, sans-serif;margin-top: 50px;">Your Profile</h3><img class="img-thumbnail" src="profile_pic/<?php echo $row['profile']; ?>" style="width: 288px;margin-top: 20px;margin-bottom: 10px">
<?php
              if(!isset($_SESSION['changed']))
              echo ' <div class="alert alert-success  style="position: fixed; z-index: 10; top: 3px;>Your Profile has been edited 
   
  </div>';
?>
            
</div>
            <div class="col-md-4 col-lg-12 col-xl-3 offset-lg-0 offset-xl-5 text-center"><a class="btn btn-dark" role="button" href="profileedit.php" style="margin-top: 10px;"><i class="fas fa-pen-fancy"></i>&nbsp; Edit Profile</a></div>
        </div>
    </div>
    <div style="margin-top: -34px;">
        <div class="container text-center" style="margin-top: 20px;">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                           
                        </tr>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div></div>
    <div></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/script.min.js?h=82d712d5e0811380f26d2753ca68c860"></script>
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){$('.alert').alert('close');}, 6000);
    });
  </script>
</body>

</html>

<?php ob_end_flush(); ?>