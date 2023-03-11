
<!--Xoá-->
<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id="";
    }

    if(isset($user['username'])){
        $sql_delete="delete from product where productID='$id'";  
        $sql_delete_query=mysqli_query($con,$sql_delete);
    }
    else{
        echo '<script>alert("Bạn phải đăng nhập để thực hiện chức năng!")</script>';
    }  
?>
