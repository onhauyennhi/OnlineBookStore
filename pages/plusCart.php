<?php
    include('../db/connect.php');
    $id=$_GET['id'];
    $plus_cart=mysqli_query($con,"SELECT * FROM cart where productID='$id'");
    $row_plus=mysqli_fetch_array($plus_cart);
    $quantity=$row_plus['cartQuantity']+1;

    $select_pd=mysqli_query($con,"select * from product where productID='$id'");
    $row_pd=mysqli_fetch_array($select_pd);
    if($quantity>$row_pd['productQuantity']){
        echo '<script>alert("Số lượng trong kho không đủ")</script>';
    }
    else{
        $sql_plus=mysqli_query($con,"update cart set cartQuantity='$quantity' where productID='$id'");

    }
    echo "<script>window.location.href = 'cart.php';</script>";
?>