<?php
    include('dbconfig.php');
    function isRegisterd($token)
    {
        $query="SELECT `email`, `phone` FROM `users` WHERE `email`='$token' OR `phone`='$token'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
        {
            if(mysqli_num_rows($res)>0)
            {
                $row=mysqli_fetch_assoc($res);
                if($token===$row['email'] || $token===$row['phone'])
                    return true;
            }
        }
        return false;
    }

    
    if(isset($_POST['query']))
    {
        if($_POST['query']=='is-registered')
        {
            $token=mysqli_real_escape_string($GLOBALS['conn'], $_POST['token']);
            echo isRegisterd($token);
        }
    }
?>