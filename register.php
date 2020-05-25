<?php
ob_start();
session_start();
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 $link = mysqli_connect("localhost", "root", "", "goodbook");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_REQUEST['email'])){
// Escape user inputs for security
$name = mysqli_real_escape_string($link, $_POST['name']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$password = mysqli_real_escape_string($link, $_POST['password']);
$password= md5($password);
// Attempt insert query execution
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email','$password')";
if(mysqli_query($link, $sql)){
    
    $_SESSION['login-id']=$email;
    include('verifyEmail.php');
    echo true;
} else{
    echo false;
}}

mysqli_close($link);

ob_end_flush();

?>