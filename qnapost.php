<?php
    ob_start();
    session_start();
    include('dbconfig.php');

    function addPost($text=null, $image=null)
    {
        $user=$_SESSION['login-id'];
        $query="INSERT INTO `questions`(`user`, `question`) VALUES ('$user', '$text')";
        if($image!=null)
            $query="INSERT INTO `questions`(`user`, `question`, `images`) VALUES ('$user', '$text', '$image')";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false)
            header('Location:qna.php');
    }


    function upload()
    {
        $files='';
        if(isset($_FILES['upload']))
        {
            $upload_dir='uploads'.DIRECTORY_SEPARATOR;
            $allowed_types = array('jpg', 'png', 'jpeg', 'gif'); 
            $maxsize = 2000 * 1024 * 1024;

            foreach($_FILES['upload']['name'] as $key => $value)
            {
                $file_name=$_FILES['upload']['name'][$key];
                $file_type=$_FILES['upload']['type'][$key];
                $file_size=$_FILES['upload']['size'][$key];

                $ext = pathinfo($file_name, PATHINFO_EXTENSION); 

                if(!in_array($ext, $allowed_types))
                    die('Error: Please select a valid file format');

                if($file_size>$maxsize)
                    die('Error: Image is too big');

                if(file_exists($upload_dir.$file_name))
                    $file_name=time().$file_name;

                if(move_uploaded_file($_FILES['upload']['tmp_name'][$key], $upload_dir.$file_name))
                    $files.=$file_name.',';
            }
            $files=rtrim($files, ',');
            return $files; 
        }
    }


    if(isset($_POST['post-question']) || isset($_FILES['upload']))
    {
        $text=null;
        $image=null;

        $text=mysqli_real_escape_string($GLOBALS['conn'], $_POST['post-question']);

        if(isset($_FILES['upload']))
        { 
            $image=upload();
        }
        
        addPost($text, $image);
    }

    else
        echo '<script>window.location.href="home.php"</script>';
        

    ob_end_flush();
?>