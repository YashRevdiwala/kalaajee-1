<?php
include("components/connection.php");

if(!isset($_SESSION)){
    session_start();
    if(isset($_SESSION['client_email'])){
        $client_email = $_SESSION['client_email'];
        if(isset($_GET["id"]) && isset($_GET["page"])){
            $product_id = $_GET["id"];
            $pagename = urldecode($_REQUEST["page"]);
            $c_query = mysqli_query($conn,"SELECT * FROM tbl_product WHERE id = '$product_id' ");
            $c_row = mysqli_fetch_array($c_query);
            $product_name = $c_row["pro_name"];
            $final_price = $c_row["final_price"];
            $query = mysqli_query($conn,"SELECT * FROM tbl_cart WHERE product_id = '$product_id'");
            if(mysqli_num_rows($query) > 0){
                $quantity_row = mysqli_fetch_array($query);
                $quantity_count = $quantity_row["quantity"]+1;
                $query = mysqli_query($conn,"UPDATE tbl_cart SET quantity = '$quantity_count' WHERE product_id = '$product_id'");
            }else{
                $query = mysqli_query($conn,"INSERT INTO tbl_cart (email, product_id, product_name, quantity, final_price) VALUES ('$client_email', '$product_id', '$product_name', 1, $final_price)");
            }
        }
        if(isset($_GET["product_id_inc"]) && isset($_GET["page"])){
            $product_id = $_GET["product_id_inc"];
            $pagename = $_GET["page"];
            $query = mysqli_query($conn,"SELECT * FROM tbl_cart WHERE product_id = '$product_id'");
            $quantity_row = mysqli_fetch_array($query);
            $quantity_count = $quantity_row["quantity"]+1;
            $query = mysqli_query($conn,"UPDATE tbl_cart SET quantity = '$quantity_count' WHERE product_id = '$product_id'");
        }elseif(isset($_GET["product_id_dec"]) && isset($_GET["page"])){
            $product_id = $_GET["product_id_dec"];
            $pagename = $_GET["page"];
            $query = mysqli_query($conn,"SELECT * FROM tbl_cart WHERE product_id = '$product_id'");
            $quantity_row = mysqli_fetch_array($query);
            if($quantity_row["quantity"] == 1){
                $query = mysqli_query($conn,"DELETE FROM tbl_cart WHERE product_id = '$product_id'"); 
            }elseif($quantity_row["quantity"] > 1){
                $quantity_count = $quantity_row["quantity"] - 1;
                $query = mysqli_query($conn,"UPDATE tbl_cart SET quantity = '$quantity_count' WHERE product_id = '$product_id'"); 
            }
        }elseif(isset($_GET["dropProduct"]) && isset($_GET["page"])){
            $product_id = $_GET["dropProduct"];
            $pagename = $_GET["page"];
            $query = mysqli_query($conn,"DELETE FROM tbl_cart WHERE product_id = '$product_id'");
        }elseif(isset($_POST["AddToCart"])){
            $product_id = $_GET["id"];
            $cart_quantity = $_POST["cart_quantity"];
            $pagename = urldecode($_REQUEST["page"]);
            $c_query = mysqli_query($conn,"SELECT * FROM tbl_product WHERE id = '$product_id' ");
            $c_row = mysqli_fetch_array($c_query);
            $product_name = $c_row["pro_name"];
            $final_price = $c_row["final_price"];
            $query = mysqli_query($conn,"SELECT * FROM tbl_cart WHERE product_id = '$product_id'");
            if(mysqli_num_rows($query) > 0){
                $quantity_row = mysqli_fetch_array($query);
                $quantity_count = $quantity_row["quantity"]+$cart_quantity-1;
                $query = mysqli_query($conn,"UPDATE tbl_cart SET quantity = '$quantity_count' WHERE product_id = '$product_id'");
            }else{
                $query = mysqli_query($conn,"INSERT INTO tbl_cart (email, product_id, product_name, quantity, final_price) VALUES ('$client_email', '$product_id', '$product_name', $cart_quantity, $final_price)");
            }
        }
        header("Location:".$pagename);
        exit();
    }elseif(!isset($_SESSION['client_email'])){
        header("Location:login.php");
        exit();
    }
}


?>