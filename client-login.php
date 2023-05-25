<?php
include("components/connection.php");
if(!isset($_SESSION)){
  session_start();
  if(isset($_SESSION['client_email'])){
    $client_email = $_SESSION['client_email'];
  }else{
    $email = $_POST['customer_email'];
    $password = $_POST['customer_password'];

    $query = mysqli_query($conn,"SELECT * FROM tbl_client where email = '$email' AND password = '$password'");
    if(mysqli_num_rows($query) > 0){
        $_SESSION['client_email'] = $email;
        header("Location:index.php");
        exit();
    }else{
        header("Location:login.php");
        exit();
    }
  }
}
?>