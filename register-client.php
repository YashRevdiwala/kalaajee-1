<?php
include("components/connection.php");

if(!isset($_SESSION)){
    session_start();

    $r_name = $_POST['register_first_name'];
    $r_lname = $_POST['register_last_name'];
    $r_email = $_POST['register_email'];
    $r_password = $_POST['register_password'];

    if(isset($_POST['register_client'])){
        $query = mysqli_query($conn,"INSERT INTO tbl_client (name, last_name, email, password) VALUES ('$r_name', '$r_lname', '$r_email', '$r_password')");
    }

    header("Location:login.php");
    exit();
}
?>