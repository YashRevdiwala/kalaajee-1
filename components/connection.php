<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sitsoftwaresco_kalaji";
$imgpath = '/kalaajee_copy/img/';

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    echo("Error: ".mysqli_connect_error());
}
?>