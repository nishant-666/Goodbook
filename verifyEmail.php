<?php 
    ob_start();
    if(session_status()==PHP_SESSION_NONE)
        session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    require "PHPMailer/PHPMailer/PHPMailer.php";
    require "PHPMailer/PHPMailer/SMTP.php";
    require "PHPMailer/PHPMailer/Exception.php";

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

        $mail->setFrom("info.thegoodbook@gmail.com", "Goodbook");    
        $mail->addAddress($to);
        $mail->Subject = 'Goodbook: Email Verification';

        $mail->Body = '<a href="http://localhost/Goodbook/verifyEmail.php?email='.$to.'&token='.$token.'">
        Click here</a> to verify your Account
       ';
        $mail->isHTML(true);
        if($mail->send())
            return true;
        else
            return $mail->ErrorInfo;
    }

    if(isset($_GET['email']) && isset($_GET['token']))
    {
        include('dbconfig.php');
        $email=mysqli_real_escape_string($GLOBALS['conn'], $_GET['email']);
        $token=mysqli_real_escape_string($GLOBALS['conn'], $_GET['token']);

        $query="SELECT * FROM `email_verification` WHERE `email`='$email' AND `token`='$token' AND `flag`=1";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false && mysqli_num_rows($res)==1)
        {
            $row=mysqli_fetch_assoc($res);
            if($row['email']==$email && $row['token']==$token && $row['flag']==1)
            {
                $query="DELETE FROM `email_verification` WHERE `email`='$email' AND `flag`=1";
                $res=mysqli_query($GLOBALS['conn'], $query);
                $_SESSION['login-id']=$email;
                echo '<script>window.location.href="home.php"</script>';
            }
        } 
    }

    $token=md5(time());
    $query="INSERT INTO `email_verification` (`email`, `token`, `flag`) VALUE('$email', '$token', 1)";
    $res=mysqli_query($link, $query);
    if($res!=false && mysqli_affected_rows($link)==1)
        sendMail($email, $token);
    ob_end_flush();
?>