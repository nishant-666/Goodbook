<!-- Don't change PHP code -->
<?php
    include('dbconfig.php');
    
    $rstatus=0;
    $pstatus=0;
    $value=null;
    if(isset($_GET['email']) && isset($_GET['token']))
    {
        $email=mysqli_real_escape_string($GLOBALS['conn'], $_GET['email']);
        $token=mysqli_real_escape_string($GLOBALS['conn'], $_GET['token']);

        $query="SELECT * FROM `email_verification` WHERE `email`='$email' AND `token`='$token'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false && mysqli_num_rows($res)==1)
        {
            $row=mysqli_fetch_assoc($res);
            if($row['email']==$email && $row['token']==$token)
            {
                $GLOBALS['value']=$email;
                $GLOBALS['rstatus']=1;
            }
        } 
    }

    else if(isset($_POST['pass']) && isset($_POST['cpass']))
    {
        $pass=mysqli_real_escape_string($GLOBALS['conn'], $_POST['pass']);
        $cpass=mysqli_real_escape_string($GLOBALS['conn'], $_POST['cpass']);
        $email=mysqli_real_escape_string($GLOBALS['conn'], $_POST['email']);

        if($pass!=$cpass)
            $GLOBALS['pstatus']=-1;

        else
        {
            $pass=md5($pass);
            $query="UPDATE `users` SET `password`='$pass' WHERE `email`='$email'";
            $res=mysqli_query($GLOBALS['conn'], $query);
            if($res!=false && mysqli_affected_rows($GLOBALS['conn'])==1)
            {
                $GLOBALS['pstatus']=1;
                $query="DELETE FROM `email_verification` WHERE `email`='$email'";
                $res=mysqli_query($GLOBALS['conn'], $query);
            }
        }
    }
?>

<?php
    if($GLOBALS['rstatus']==0 && $GLOBALS['pstatus']==0)
        echo '<script>window.location.href="."</script>';
?>

<!-- You can use alerts here like you used in login page -->
<?php
    if($GLOBALS['pstatus']==1)
        echo '<div class="col-lg-4 offset-lg-4 text-center" style="margin-top: 20px;">
    <div style="background-color: rgba(0,0,0,0.34);color: #ffffff;padding:20px;text-align:"center";justify-content:"center";display:"flex";align-content:"center">
    Password has been changed. Login with new password.
    </div></div>';
    else if($GLOBALS['pstatus']==-1)
        echo '<div class="col-lg-4 offset-lg-4 text-center" style="margin-top: 20px;">
    <div style="background-color: rgba(0,0,0,0.34);color: #ffffff;padding:20px;text-align:"center";justify-content:"center";display:"flex";align-content:"center">
    Password do not match
    </div></div>';
?>


<!-- Don't change the action and method attribute of form -->
            <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Reset Password</title>
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
    <link rel="stylesheet" href="assets/css/News-Cards.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/text-box.css">
</head> 
            <body style="background-image: url(&quot;assets/img/blur.png&quot;);">
                <div class="col-lg-4 offset-lg-4 text-center" style="margin-top: 20px;">
                    <div class="card" style="background-color: rgba(0,0,0,0.34);">
                         <div class="card-body">
                            <p style="color: #ffffff;">Enter your new Password</p>
                              <div class="form-group">
                                <form action="resetpass.php" method="post">
                        <input class="border rounded-0 form-control" style="padding:  20px" type="password" name="pass" required="" placeholder="New Password">
                        <input class="border rounded-0 form-control" style="padding:  20px" type="password" name="cpass" placeholder="Confirm Password" required="">
                         <?php
                            echo '<input type="hidden" name="email" value="'.$value.'" />';
                            ?>  
                            <button class="btn btn-dark btn-sm" style="margin-top: 20px" type="submit">Reset Password</button>
                            <div style="margin-top: 20px">
                            <a class="btn btn-dark btn-sm" role="button"  href="login.php">Already a member? Sign in</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>