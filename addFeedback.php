<?php

    $flag=false;
    
    if(isset($_POST['name']) && isset($_POST['message']))
    {
        include('dbconfig.php');
        $name=$_POST['name'];
        $message=$_POST['message'];
        $query="INSERT INTO `feedback` (`name`, `feedback`) VALUES('$name', '$message')";
        $res=mysqli_query($GLOBALS['conn'], $query);
        
        if($res!=false && mysqli_affected_rows($GLOBALS['conn'])==1)
            echo '<script>window.location.href="feedback.php?result=pass"</script>';
    }

    echo '<script>window.location.href="feedback.php"</script>'

?>