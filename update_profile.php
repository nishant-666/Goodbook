<?php
    ob_start();
    session_start();
    include('dbconfig.php');
    if(!isset($_SESSION['login-id']))
        header('Location:login.php');
    // $_SESSION['login-id']="nishants4401@gmail.com";

    function upload()
    {
        if(isset($_FILES['upload']))
        {
            $upload_dir='profile_pic'.DIRECTORY_SEPARATOR;
            $allowed_types = array('jpg', 'png', 'jpeg', 'gif','JPG'); 
            $maxsize = 20000 * 1024 * 1024;
            
            $file_name=$_FILES['upload']['name'];
            $file_type=$_FILES['upload']['type'];
            $file_size=$_FILES['upload']['size'];

            $ext = pathinfo($file_name, PATHINFO_EXTENSION); 

            if(!in_array($ext, $allowed_types))
                die('Error: Please select a valid file format');

            if(file_exists($upload_dir.$file_name))
                $file_name=time().$file_name;

            if(move_uploaded_file($_FILES['upload']['tmp_name'], $upload_dir.$file_name))
                return $file_name;
        }
    }

    if(isset($_POST['update']))
    {
        $update_term='';

        if(strlen($_POST['password'])==0 || strlen($_POST['repeat-password'])==0)
        {
             header("Location:wrong_password.php");
        }

        else if(strcmp($_POST['password'], $_POST['repeat-password'])!=0)
        {
            header("Location:wrong_password.php");
        }

        else
        {
            foreach($_POST as $key => $value)
            {
                if($key=='repeat-password' || $key=='update' || $key=='email')
                    continue;
                $update_term.="`$key`='".$value."',";
            }

            $update_term=rtrim($update_term, ',');

            $query="UPDATE `users` SET $update_term WHERE `email`='".$_POST['email']."'";
            $res=mysqli_query($GLOBALS['conn'], $query);
            if($res!=false)
            {
                if($res===true || mysqli_affected_rows($res)==1)
                {
                    if(isset($_FILES['upload']) && $_FILES['upload']['name']!='')
                    {   
                        $profile=upload();
                        $query="UPDATE `users` SET `profile`='$profile' WHERE `email`='".$_POST['email']."'";
                        $res=mysqli_query($GLOBALS['conn'], $query);
                    }
                    header("Location:profilechanged.php");
                }
            }
        }
    }
    else
    {
        echo '<script>window.location.href="profileedit.php";</script>';
    }
?>


<?php ob_end_flush(); ?>