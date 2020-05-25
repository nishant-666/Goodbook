
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require "PHPMailer/PHPMailer/PHPMailer.php";
    require "PHPMailer/PHPMailer/SMTP.php";
    require "PHPMailer/PHPMailer/Exception.php";

    include('dbconfig.php');

    $status=0;
    
    function sendMail($to, $token)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "info.thegoodbook@gmail.com";     
        $mail->Password = "goodbook123@#";                     
        $mail->Port = 465 ; 
        $mail->SMTPSecure = "ssl"; 

        $mail->setFrom("info.thegoodbook@gmail.com","The Goodbook");     
        $mail->addAddress($to);
        $mail->Subject = 'The Goodbook: Password Recovery';
       
        $mail->Body = '<a href="http://localhost/resetpass.php?email='.$to.'&token='.$token.'">
        Click here</a> to reset your password.';
        $mail->isHTML(true);
        if($mail->send())
            return true;
        else
            return $mail->ErrorInfo;
    }

    if(isset($_POST['reset-link']))
    {
        $email=mysqli_real_escape_string($GLOBALS['conn'], $_POST['email']);
        $email=strtolower($email);
        $query="SELECT * FROM `users` WHERE `email`='$email'";
        $res=mysqli_query($GLOBALS['conn'], $query);

        if($res!=false && mysqli_num_rows($res)==1)
        {
            $row=mysqli_fetch_assoc($res);
            if(strtolower($row['email'])==$email)
            {
                $GLOBALS['status']=2;
                $token=md5(time());
                if(sendMail($email, $token)==true)
                {
                    $query="INSERT INTO `email_verification` (`email`, `token`) VALUE('$email', '$token')";
                    $res=mysqli_query($GLOBALS['conn'], $query);
                    if($res!=false && mysqli_affected_rows($GLOBALS['conn'])==1)
                        $GLOBALS['status']=1;
                }
                else
                    $GLOBALS['status']=-1;
            }
        }
    }
?>



<?php
    if($GLOBALS['status']==1)
        echo '<div class="col-lg-4 offset-lg-4 text-center" style="margin-top: 20px;">
    <div style="background-color: rgba(0,0,0,0.34);color: #ffffff;padding:20px;
    text-align:"center";justify-content:"center";display:"flex";align-content:"center">
    An email containing reset link has been sent to your registerd email address.
    </div>
    </div>';
    else if($GLOBALS['status']==-1)
        echo 'Some error occurred while sending mail';
        else if($GLOBALS['status']==2)
        echo 'No account registerd with this email address';
?>


<!-- Don't change the action and method attribute of form -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Reset your password</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="assets/css/text-box.css">
</head>
<body style="background-image: url(&quot;assets/img/blur.png&quot;);">
<div class="col-lg-4 offset-lg-4 text-center" style="margin-top: 20px;">
    <form action="forget.php" method="post">
    <div class="card" style="background-color: rgba(0,0,0,0.34);">
        <div class="card-body">
        <p style="color: #ffffff;">Please enter your email to reset password.&nbsp;</p>
                <div class="form-group">
                    
                   <input class="border rounded-0 form-control" type="email" name="email" 
                   placeholder="Your Email here" required="">
                   </form>
                </div>
                <button class="ui primary button" type="submit" name="reset-link">Send Reset Link</button>
                <a class="ui primary button" href="login.php">Back</a>
                </div>
        
</form>
</div>
</div>
<script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>