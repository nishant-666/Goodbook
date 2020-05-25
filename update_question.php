<?php session_start();
    include('dbconfig.php');

    function updatePost($sno, $text)
    {
        $user=$_SESSION['login-id'];
        $query="UPDATE `questions` SET `question`='$text' WHERE `sno`=$sno AND `user`='$user'";
        
        if(mysqli_query($GLOBALS['conn'], $query)!=false)
        {
            if(mysqli_affected_rows($GLOBALS['conn'])==1)
                return true;
        }

        return false;
    }

    function showPostText($sno)
    {
        $user=$_SESSION['login-id'];
        $query="SELECT `question` FROM `questions` WHERE `sno`=$sno AND `user`='$user'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
        return mysqli_fetch_assoc($res)['question'];
        return null;  
    }

    function deleteFiles($files)
    {
        $files=explode($files, ',');
        $path='uploads/';
        foreach($files as $file)
        {
            unlink($path.$file);
        }
    }

    function deletePost($sno)
    {
        $user=$_SESSION['login-id'];
        $query="SELECT `images` FROM `questions` `sno`='$sno' AND `user`='$user'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
        {
            $row=mysqli_fetch_assoc($res);
            if($row['images']!=null || str($row['images'])==0)
                deleteFiles($row['images']);
        }

        $query="DELETE FROM `questions` WHERE `sno`=$sno AND `user`='$user'";

        if(mysqli_query($GLOBALS['conn'], $query)!=false)
        {
            if(mysqli_affected_rows($GLOBALS['conn'])==1)
                return true;
        }

        return false;
    }

    if(isset($_POST['search']))
    {
        if($_POST['search']=='fetch-post')
        {
            $sno=mysqli_real_escape_string($GLOBALS['conn'], $_POST['sno']);
            echo showPostText($sno);
            
        }

        if($_POST['search']=='update-question')
        {
            $sno=mysqli_real_escape_string($GLOBALS['conn'], $_POST['sno']);
            $text=mysqli_real_escape_string($GLOBALS['conn'], $_POST['question']);
            echo updatePost($sno, $text);
        }

        if($_POST['search']=='delete-question')
        {
            $sno=mysqli_real_escape_string($GLOBALS['conn'], $_POST['sno']);
            echo deletePost($sno);
        }
    }
?>