<?php 
    session_start(); 
    if(isset($_SESSION['login-id']))
        header('Location:home.php');
    if(isset($_POST['email']))
    {
        include('dbcon.php');
        $email=$_POST['email'];
        $password=$_POST['password'];
        $query="SELECT * FROM `users` WHERE `email`='".$email."'";
        $result=mysqli_query($conn, $query);
        if($result!=false)
        {
            // echo mysqli_fetch_assoc($result)['password'];
            if(mysqli_num_rows($result)==1)
            {
                // while($row=mysqli_fetch_assoc($result))
                $row=mysqli_fetch_assoc($result);
                if(strcmp($email, $row['email']==0))
                {
                    
                    $query="SELECT * FROM `users` WHERE `email`='".$email."' AND `password`='".$password."'";
                    $result=mysqli_query($conn, $query);
                    if($result!=false)
                    {
                        if(mysqli_num_rows($result)==1)
                        {
                            
                            while($row=mysqli_fetch_array($result))
                            if(strcmp($password, $row['password'])==0)
                            {
                                
                                $_SESSION['login-id']=$email;
                                $name=$row['name'];
                                $_SESSION['name']=$name;
                                header("Location:home.php");
                                
                            }
                            else
                                header('Location:login_false.php?attempt=password');
                        }
                        else
                                header('Location:login_false.php?attempt=password');
                    }
                    else
                                header('Location:login_false.php?attempt=password');
                }
                else
                                header('Location:login_false.php?attempt=email');
            }
            else
                                header('Location:login_false.php?attempt=email');
        }
        else
                                header('Location:login_false.php?attempt=email');
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html style="width: 100%;height: 100vh;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>The Goodbook</title>
      <link rel="shortcut icon" href="assets/img/favicon.jpg" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="assets/css/-Login-form-Page-BS4-.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-1.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar-2.css">
    <link rel="stylesheet" href="assets/css/Dark-NavBar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/text-box.css">
</head>

<body style="background-image: url(&quot;assets/img/blur.png&quot;);background-size: auto;background-repeat: no-repeat;filter: blur(0px);background-color: rgba(0,0,0,0.34);">
    <div class="text-center login-clean" style="background-color: rgba(241,247,252,0);margin-top: 30px;">
        <form class="shadow-lg" method="post" style="opacity: 1;width: 600px;margin-bottom: -35px;margin-top: -10px;font-family: ABeeZee, sans-serif;background-color: rgba(0,0,0,0.34);color: #000000;" action="login.php">
            <h2 class="sr-only">Login Form</h2><img class="rounded-circle img-fluid" src="assets/img/cooltext346756811188319.png" style="width: 200px;background-color: #ffffff;margin: 25px;margin-left: 20px;margin-top: -10px;padding: 10px;">
            <?php
              if(!isset($_SESSION['first-login']))
              echo ' <div class="alert alert-warning">Wrong Email Id or Password. Please be careful.

  </div>';
?>
            <div class="form-group border rounded-0" style="background-color: #ffffff;"><input class="form-control form-control-sm" type="email" style="background-color: #ffffff;" name="email" required="" placeholder="Email"></div>
            <div class="form-group"><input class="border rounded-0 form-control form-control-sm" type="password" style="background-color: #ffffff;" name="password" required="" placeholder="Password"></div>
            <div class="form-group text-center"><button class="btn btn-primary btn-block border-dark" type="submit" style="background-color: #000000;margin-top: 0px;">Log In</button></div>
            <a class="text-center forgot"
                href="#" style="font-size: 15px;margin-top: 5px;color: rgba(255,255,255,0.498);"></a><a class="btn btn-outline-primary btn-block border-dark shadow" role="button" data-bs-hover-animate="pulse" href="index.php" style="background-color: #ffffff;margin-top: 10px;color: #000000;">Not a member yet? Join us</a>
            <div
                class="col" style="padding-top: 5px;margin-bottom: -30px;">
                <p class="text-center" style="font-size: 14px;color: rgba(255,255,255,0.73);margin-top: 10px;">Goodbook© 2019<br></p>
    </div>
    </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>