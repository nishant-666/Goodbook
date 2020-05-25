<?php session_start();
session_unset();
session_destroy();
session_start();
$_SESSION['logout']='true';
echo '<script>window.location.href="login.php"</script>';
?>