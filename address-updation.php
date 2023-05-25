<?php
include("components/connection.php");

if(!isset($_SESSION)){
  session_start();
  if(isset($_SESSION['client_email'])){
    $client_email = $_SESSION['client_email'];

    $name = $_POST['update_first_name'];
    $last_name = $_POST['update_last_name'];
    $phone = $_POST['update_phone'];
    $address = $_POST['update_address'];
    $city = $_POST['update_city'];
    $zip = $_POST['update_zip'];
    $province = $_POST['update_province'];

    if(isset($_POST['edit_address'])){
        $query = mysqli_query($conn,"UPDATE tbl_client SET name = '$name', last_name = '$last_name', address = '$address', city = '$city', postal_code = '$zip', state = '$province', telephone = '$phone' WHERE email = '$client_email'");
        header("Location:address.php");
        exit();
    }else if(isset($_POST['delete_address'])){
        $address = '';
        $city = '';
        $zip = '';
        $province = '';

        $query = mysqli_query($conn,"UPDATE tbl_client SET address = '$address', city = '$city', postal_code = '$zip', state = '$province' WHERE email = '$client_email'");
        header("Location:address.php");
        exit();
    }
  }else{
    
  }
}
?>