<?php
    include('../db/connect.php');
    $id=$_GET['id'];
    $minus_cart=mysqli_query($con,"SELECT * FROM cart where productID='$id'");
    $row_minus=mysqli_fetch_array($minus_cart);
    $quantity=$row_minus['cartQuantity']-1;
    $sql_minus=mysqli_query($con,"update cart set cartQuantity='$quantity' where productID='$id'");
    if($row_minus['cartQuantity']==1){
        $row_delete=mysqli_query($con,"delete from cart where productID='$id'");
    }
    header('location:cart.php');
?>
