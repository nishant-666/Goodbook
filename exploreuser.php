<?php session_start();

    include('dbconfig.php');
    $rowUser=null;

    function getUserDetail($token)
    {
        $query="SELECT * FROM `users` WHERE `email`='$token'";
        $res=mysqli_query($GLOBALS['conn'], $query);
        if($res!=false && mysqli_num_rows($res)==1)
            return mysqli_fetch_assoc($res);            
        return null;
    }

    function showFeeds($user)
    {
        $query="SELECT * FROM `feeds` WHERE `user`='".$user."' ORDER BY `additionDate` DESC";
        $res=mysqli_query($GLOBALS['conn'], $query);
        $carousel=1;
        if($res!=false)
            if(mysqli_num_rows($res)>0)
                while($row=mysqli_fetch_assoc($res))
                {
                    $name=$GLOBALS['rowUser']['name'];

                    $text=$row['text'];

                    $image='';
                    if($row['images']!=null)
                    {   
                        $images=explode(',', $row['images']);


                        $image='<div class="carousel slide" data-ride="carousel" id="carousel-'.$carousel.'">
                                <div class="carousel-inner" role="listbox">';
                        
                        $active='active';
                        $count=0;
                        foreach($images as $img)
                        {
                            $image.='<div class="carousel-item '.$active.'"><img class="img-thumbnail w-100 d-bloc k" src="uploads/'.$img.'" alt="Slide Image"></div>';
                            $active='';
                            $count++;
                        }
        
                        $image.='</div>
                                <div></div>
                                <ol class="carousel-indicators">';

                        $active='class="active"';
                        $i=0;
                        while($i<$count)
                        {
                            $image.='<li data-target="#carousel-'.$carousel.'" data-slide-to="'.$i++.'" '.$active.'></li>';
                            $active='';
                        }

                        $image.='        </ol>
                            </div>';
                    }

                    echo '<div class="card border rounded-0" style="margin-top: 10px;">
            <div class="card-body text-center" style="background-color: #f9f9f9;padding: 15px;">
                <h6 class="text-left text-dark border rounded-0" style="font-family: ABeeZee, sans-serif;margin-top: 8px;padding: 10px;margin-bottom: 0px;margin-right: 20px;margin-left: 20px;"><img class="rounded-circle img-fluid border border-light" style="width: 20px;height: 20px;" src="profile_pic/'.$GLOBALS['rowUser']['profile'].'"><strong>&nbsp;'.$name.'</strong></h6>
                <p class="text-left border rounded-0 card-text" style="margin-left: 20px;padding: 10px;margin-right: 20px;margin-bottom: 10px;background-color: rgba(0,0,0,0.04);font-size: 16px;">'.$text.'</p>'.$image.'</div>
        </div>';
                }        
    }

    if(isset($_GET['user']))
    {
        $rowUser=getUserDetail(mysqli_real_escape_string($GLOBALS['conn'], $_GET['user']));
    }

    if($rowUser==null)
        echo '<script>window.location.href="."</script>';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $rowUser['name'].'\'s'; ?> Profile</title>
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
    <link rel="stylesheet" href="assets/css/News-Cards.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/text-box.css">
</head>

<body style="background-image: url(&quot;assets/img/blur.png&quot;);">
    <div class="col-xl-12 offset-xl-9 text-center" style="margin-left: 0px;padding: 10px;padding-right: 0px;padding-left: 0px;background-color: rgba(0,0,0,0.34);">
    	<a class="btn btn-dark btn-sm text-right" role="button" style="margin: 0px;padding: 10px;padding-top: 10px;padding-bottom: 10px;padding-right: 8px;padding-left: 8px;margin-left: 10px;" href="home.php"><i class="fa fa-feed"></i>&nbsp; Feed</a>
        <a
            class="btn btn-dark btn-sm" role="button" style="padding: 10px;padding-top: 10px;padding-right: 8px;padding-bottom: 10px;padding-left: 8px;margin-left: 10px;" href="logout.php"><i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>&nbsp;Log out</a>
    </div>
    <div></div>
    <div></div>
    <div class="col-md-6 col-lg-4 offset-lg-4 text-center">
        <div class="card" style="padding: 10px;margin-top: 10px;">
            <div class="card-body" style="padding: 15px;">
                <h4 class="card-title"><?php echo $rowUser['name'].'\'s'; ?> Profile Card<br></h4><img class="img-thumbnail" src="profile_pic/<?php echo $rowUser['profile']; ?>" style="width: 288px;margin-top: 20px;">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $rowUser['username']; ?></td>
                                <td><?php echo $rowUser['name']; ?></td>
                                <td><?php echo $rowUser['email']; ?></td>
                            </tr>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   <div class="col-xl-12 offset-xl-9 text-center" style="margin-left: 0px;margin-top:10px;padding: 10px;padding-right: 0px;padding-left: 0px;background-color: rgba(0,0,0,0.34);">
        <h4 style="padding: 10px;color: #ffffff;">
        	<?php echo $rowUser['name'].'\'s'; ?> Posts</h4>
    </div>
    <div class="col-md-6 col-lg-4 offset-lg-4" style="margin-bottom: 10px;">
        <?php showFeeds($rowUser['email']); ?>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>