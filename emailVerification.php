<?php
    if(session_status()==PHP_SESSION_NONE)
        session_start();
    
    function emailVerified()
    {
        $email=$_SESSION['login-id'];
        $query="SELECT * FROM `email_verification` WHERE `email`='$email' AND `flag`=1";
        $res=mysqli_query($GLOBALS['conn'], $query);
        // echo $query;
        if($res!=false && mysqli_num_rows($res)!=0)
        {
            $row=mysqli_fetch_assoc($res);
            if($row['email']==$email && $row['flag']==1)
                return false;
        }
        return true;
    }

    if(isset($_SESSION['login-id']))
        if(!emailVerified())
            echo '<script>window.location.href="unverified.html"</script>';
?>