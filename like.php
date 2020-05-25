<?php
    ob_start();
    session_start();
    include('dbconfig.php');

    $email=$_SESSION['login-id'];
    $post=mysqli_real_escape_string($GLOBALS['conn'], $_POST['post']);
    $like=mysqli_real_escape_string($GLOBALS['conn'], $_POST['like']);

    $query=null;
    if($like==1)
        $query="DELETE FROM `likes` WHERE `post`='$post' AND `email`='$email'";
    else
        $query="INSERT INTO `likes` (`post`, `email`) VALUES('$post', '$email')";
    
    // echo $query;
    $res=mysqli_query($GLOBALS['conn'], $query);
    if($res!=false && mysqli_affected_rows($GLOBALS['conn'])==1)
        echo true;
    else
        echo false;

    ob_end_flush();
?>