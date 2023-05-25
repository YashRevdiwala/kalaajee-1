<?php
include("components/connection.php");

if(!isset($_SESSION)){
    session_start();
    if(isset($_POST['subscribe_mail'])){
        $contact_email = $_POST['contact_email'];
        $query = mysqli_query($conn,"INSERT INTO subscribe(email) VALUES ('$contact_email')");
        header("Location:index.php");
        exit();
}
}
?>