<?php session_start();
    include('dbconfig.php');

    function updatePost($sno, $text)
    {
        $user=$_SESSION['login-id'];
        $query="UPDATE `feeds` SET `text`='$text' WHERE `sno`=$sno AND `user`='$user'";
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
        $query="SELECT `text` FROM `feeds` WHERE `sno`=$sno AND `user`='$user'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
            return mysqli_fetch_assoc($res)['text'];
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
        $query="SELECT `images` FROM `sno`='$sno' AND `user`='$user'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
        {
            $row=mysqli_fetch_assoc($res);
            if($row['images']!=null || str($row['images'])==0)
                deleteFiles($row['images']);
        }

        $query="DELETE FROM `feeds` WHERE `sno`=$sno AND `user`='$user'";

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

        if($_POST['search']=='update-post')
        {
            $sno=mysqli_real_escape_string($GLOBALS['conn'], $_POST['sno']);
            $text=mysqli_real_escape_string($GLOBALS['conn'], $_POST['text']);
            echo updatePost($sno, $text);
        }

        if($_POST['search']=='delete-post')
        {
            $sno=mysqli_real_escape_string($GLOBALS['conn'], $_POST['sno']);
            echo deletePost($sno);
        }
    }
?>