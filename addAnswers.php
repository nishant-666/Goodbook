<?php 
    ob_start();
    session_start();

    if(!isset($_SESSION['login-id']))
        echo '<script>window.location.href="login.php"</script>';
        
    if(!isset($_POST['addComment']))
        echo '<script>window.location.href="home.php"</script>';
    include('dbconfig.php');

    $email=$_SESSION['login-id'];
    $id=mysqli_real_escape_string($GLOBALS['conn'], $_POST['addComment']);
    $id=substr($id, 6);
    $comment=mysqli_real_escape_string($GLOBALS['conn'], $_POST['comment']);
    $query="INSERT INTO `answers`(`email`, `question`, `answer`) VALUES ('$email', '$id', '$comment')";
    $res=mysqli_query($GLOBALS['conn'], $query);
    if($res!=false && mysqli_affected_rows($GLOBALS['conn'])==1)
        echo '<script>window.location.href="answers.php?id=postid'.$id.'"</script>';
    ob_end_flush();
?>