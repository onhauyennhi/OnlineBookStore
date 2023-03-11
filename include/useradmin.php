<?php
if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
    if($user['role']=="customer"){
        echo '<script>alert("Khách hàng không thể truy cập vào trang quản trị!")</script>';
        echo "<script>window.location.href = 'login.php';</script>";
    }
}
else{
    $user=[];
}
?>