<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    require "PHPMailer/src/Exception.php";

    function token_gen(){
        $token = md5(time());
        return $token;
    }
    
    function sendMail($to,$subject,$message){
        
        $mail = new PHPMailer();
        //SMTP settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "info.thegoodbook@gmail.com";
        $mail->Password = "";
        $mail->Port = 465 ; 
        $mail->SMTPSecure = "ssl";
        

        
        $mail->setFrom("info.thegoodbook@gmail.com","The Goodbook"); 
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);
        if($mail->send())
            return true;
        else
            return "Error ->" . $mail->ErrorInfo;
    }
?>
