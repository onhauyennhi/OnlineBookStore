<?php
    include('db/connect.php');
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
    }else{
        $user=[];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/information.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script defer src="js/javaScript.js"></script>
</head>
<style type="text/css">
    a{
        text-decoration: none;
    }
    .information-user-text {
        margin: 20px 20px;
        display: flex;
        justify-content: space-between;
    }
    .information-user-text a{
        color:black;
    }
    .information-user-text a:hover{
        color:red;
        transition: ease-in-out 0.2s;
    }
    .information-user {
        padding: 20px 50px;
        margin: 0 auto;
    }  
    .information-user-content {
        width: 100%;
        height: auto;
    }
    h2.user-content-text {
        width: 100%;
        margin: 20px 0;
    }
    .user-content input {
        width: 50%;
        height: 40px;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        border-radius: 5px;
        outline: none;
        border: 1px solid #333;
    }    
    .user-content button {
        margin: 20px 0;
        width: 200px;
        height: 50px;
        color: white;
        cursor: pointer;
        background: #281E5D;
    }   
    .user-content-detail {
        margin: 20px 0px;
    }
    .user-content {
        margin: 20px 0;
        padding: 20px;
        --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }
    .has-error {
        color: red;
    }
</style>
<body>
<div class="grid header">
            <div class="grid wide container">
            <div class="row">
                <div class="col l-4">
                    <div class="row no-gutters">
                        <div class="col l-8">
                            <div class="logo">
                                <h2>
                                    <span style="color: #281E5D;">DVN</span>
                                    <span style="color: #B90E0A;">CellphoneS</span>
                                </h2>
                            </div>
                        </div>
                        <div class="col l-4">
                            <div class="check-price-at">
                                <i class="fa-solid fa-location-dot"></i>
                                <div>
                                    <p style="font-size: 12px; margin-bottom: 3px;">Xem giá tại</p>
                                    <p style="margin-bottom: 0; display: inline;">Miền Nam</p>
                                    <i class="fa-solid fa-caret-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l-4">
                    <form action="" class="search-bar">
                        <input type="text" placeholder="Tìm kiếm sản phẩm..." name="text">
                        <button type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                <div class="col l-4">
                    <div class="row">
                        <div class="col l-4 hide-on-mobile-tablet">
                            <div class="hotline">
                                <i class="fa-solid fa-phone"></i>
                                <div>
                                    <p>Hotline</p>
                                    <p class="phone-number">1800.2366</p>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($user['username'])){ ?>
                        <div class="col l-4 hide-on-mobile-tablet">
                            <div class="login1">
                                <a id="btndn"><i class="fa-solid fa-circle-user"></i></a>
                                <p><?php echo $user['username']; ?></p>
                                <p><a onclick="return confirm('Bạn có chắc muốn đăng xuất?');" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></p>
                            </div>
                        </div>
                        <?php
                        }
                        else{
                        ?>
                            <div class="col l-4 hide-on-mobile-tablet">
                                <div class="login1">
                                    <a id="btndn" href="login.php"><i class="fa-solid fa-circle-user"></i></a>
                                    <p><a href="login.php">Đăng nhập</a></p>
                                </div>
                            </div>

                        <?php
                        }
                        ?>
                        <div class="col l-4">
                            <div class="shopping-cart">
                                <a href="pages/cart.php"><i class="fa-solid fa-2x fa-cart-shopping"></i></a>
                                <p><a href="pages/cart.php">Giỏ hàng</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row navigation-box">             
                    <div class="col l-8" style="margin: 20px auto;" >
                        <div class="row">
                            <div class="col l-2">
                                <div class="home" href="home.html">
                                    <a href="index.php"><h4>TRANG CHỦ</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="introduction">
                                    <a href="pages/introduce.php"><h4>GIỚI THIỆU</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="product">
                                    <a href="index.php"><h4>SẢN PHẨM</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="news">
                                    <a href="index.php"><h4>TIN TỨC</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="contact">
                                    <a href="pages/contact.php"><h4>LIÊN HỆ</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="branch">
                                    <a href="index.php"><h4>CHI NHÁNH</h4></a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            

            </div>
        </div>

    <div class="information-user">
        <div class="information-user-text">
            <a href="user.php"><h1>Hồ sơ tài khoản</h1></a>
            <a href="user-bill.php"><h1>Đơn hàng</h1></a>
        </div>
        <?php
        $err=[]; 
        if(isset($_POST['change-password'])){
            $password=$_POST['password'];
            if(empty($password)){//nếu password trống
                $err['password'] ='Bạn chưa nhập mật khẩu!';
            }else if(empty($err)){ //nếu không có lỗi nào
                $sql="update account set password='$password' where accountID='$user[accountID]'";
                $sql_query=mysqli_query($con,$sql);
                if($sql_query){//thực thi câu lệnh thành công
                    echo '<script>alert("Bạn đã đổi mật khẩu thành công!")</script>';
                }
            }
        }
        ?>
        <div class="information-user-content">
            <form method="POST">
                <div class="user-content">
                    <?php 
                        $infor=mysqli_query($con,"select * from account where accountID='$user[accountID]'");
                        $infor_row=mysqli_fetch_array($infor);
                    ?>
                    <h2 class="user-content-text">Tài Khoản</h2>
                    <div class="user-content-detail">
                        <label for="username" >Tên Tài Khoản</label> <br>
                        <input name="username" type="text" disabled="" value="<?php echo $infor_row['username']; ?>">
                    </div>
                    <div class="user-content-detail">
                        <label for="password" >Mật Khẩu</label> <br>
                        <input  type="password" name="password" value="<?php echo $infor_row['password']; ?>">
                        <div class="has-error">
                            <span>
                                <?php 
                                    if(isset($err['password'])){
                                        echo $err['password'];
                                    }else{
                                        echo '';
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                    <button type="submit" name="change-password">Cập Nhật</button>
                </div>
            </form>
        </div>
        <?php
        $err=[]; 
        if(isset($_POST['change-information'])){
            $fullname=$_POST['fullname'];
            $phone=$_POST['phone'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            if(empty($fullname)){//nếu họ tên trống
                $err['fullname'] ='Bạn chưa nhập Họ và tên!';
            }
            if(empty($phone)){//nếu sđt trống
                $err['phone'] ='Bạn chưa nhập số điện thoại!';
            }else if(strlen($phone)!=10 || is_integer($phone)){
                $err['phone'] ='Số điện thoại không hợp lệ!';
            }
            if(empty($address)){//nếu địa chỉ trống
                $err['address'] ='Bạn chưa nhập địa chỉ!';
            }
            $regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
            if(empty($email)){//nếu email trống
                $err['email'] ='Bạn chưa nhập email!';
            }else if(!preg_match($regex,$email)){
                $err['email'] ='Email không đúng định dạng!';
            }
            else if(empty($err)){ //nếu không có lỗi nào
                $sql="update account set fullname='$fullname',phone='$phone',address='$address',email='$email' where accountID='$user[accountID]'";
                $sql_query=mysqli_query($con,$sql);
                if($sql_query){//thực thi câu lệnh thành công
                    echo '<script>alert("Bạn đã cập nhật thông tin thành công!")</script>';
                    echo "<script>window.location.href = 'user.php';</script>";
                }
            }
        }
        ?>
        <div class="information-user-content">
            <form method="POST">
                <div class="user-content">
                    <h2 class="user-content-text">Thông tin cá nhân</h2>
                    <div class="user-content-detail">
                        <label for="fullname" >Họ và tên</label> <br>
                        <input name="fullname" type="text" value="<?php echo $infor_row['fullname']; ?>">
                        <div class="has-error">
                        <span>
                            <?php 
                                if(isset($err['fullname'])){
                                    echo $err['fullname'];
                                }else{
                                    echo '';
                                }
                            ?>
                        </span>
                    </div>
                    <div class="user-content-detail">
                        <label for="phone" >Số điện thoại</label> <br>
                        <input  type="input" name="phone" value="<?php echo $infor_row['phone']; ?>">
                        <div class="has-error">
                        <span>
                            <?php 
                                if(isset($err['phone'])){
                                    echo $err['phone'];
                                }else{
                                    echo '';
                                }
                            ?>
                        </span>
                    </div>
                    <div class="user-content-detail">
                        <label for="email" >Email</label> <br>
                        <input name="email" type="text" value="<?php echo $infor_row['email']; ?>">
                        <div class="has-error">
                        <span>
                            <?php 
                                if(isset($err['email'])){
                                    echo $err['email'];
                                }else{
                                    echo '';
                                }
                            ?>
                        </span>
                    </div>
                    <div class="user-content-detail">
                        <label for="address" >Địa chỉ</label> <br>
                        <input  type="input" name="address" value="<?php echo $infor_row['address']; ?>">
                        <div class="has-error">
                        <span>
                            <?php 
                                if(isset($err['address'])){
                                    echo $err['address'];
                                }else{
                                    echo '';
                                }
                            ?>
                        </span>
                    </div>
                    <button type="submit" name="change-information">Cập Nhật</button>
                </div>
            </form>
        </div>

    



       
    <!----footer-->
    </div>
        </div>
                            </div>
                            </div>
                            </div>
                            <div class="grid" style="margin-top: 60px; background-color: #281E5D; padding: 10px 25px;">
            <div class="grid wide">
                <div class="row no-gutters">
                    <div class="col l-3">
                        <div class="media">
                            <i class="fa-brands fa-2x fa-facebook"></i>
                            <i class="fa-brands fa-2x fa-instagram"></i>
                            <i class="fa-brands fa-2x fa-youtube"></i>
                            <i class="fa-brands fa-2x fa-tiktok"></i>
                        </div>
                    </div>
                    <div class="col l-3 l-o-1 special-discount">
                        <i class="fa-solid fa-envelope"></i>
                        <p>Khuyến mãi đặc biệt ? Đăng kí ngay</p>
                    </div>
                    <div class="col l-4 l-o-1">
                        <form action="" class="form-get-input-email">
                            <input type="text" placeholder="Nhập email nhận ngay ưu đãi..." name="text">
                            <button type="button">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid wide container">
            <div class="row" style="align-items: flex-start;">
                <div class="col l-4 location">
                    <div class="logo">
                        <h2>
                            <span style="color: #281E5D;">DVN</span>
                            <span style="color: #B90E0A;">CellphoneS</span>
                        </h2>
                    </div>
                    <p>Công ty TNHH Thương Mại Công Nghệ DVN</p>
                    <div style="margin-top: 12px;">
                        <div class="location-footer">
                            <i class="fa-solid fa-location-dot"></i>
                            <p style="font-weight: bold; font-size: 15px;">Địa chỉ: </p>
                            <p> 18 Trần Hưng Đạo, phường 5, quận 10, TP</p>
                            <p style="margin-top: 5px; margin-left: 25px;">Hồ Chí Minh</p>
                        </div>
                        <div class="phone-number-footer">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            <p style="font-weight: bold; font-size: 15px;">Số điện thoại:</p>
                            <p>1800.2366</p>
                        </div>
                        <div class="email-footer">
                            <i class="fa-solid fa-envelope"></i>
                            <p style="font-weight: bold; font-size: 15px;">Email:</p>
                            <p>dvncellphones@gmail.com.co</p>
                        </div>
                    </div>
                </div>
                <div class="col l-2">
                    <div class="info-footer">
                        <h3>Thông tin</h3>
                        <div>
                            <p>Hướng dẫn mua hàng online</p>
                            <p>Hướng dẫn mua hàng trả góp</p>
                            <p>Tìm hiểu thêm DVN CellphoneS</p>
                            <p>Tích điểm đổi quà</p>
                        </div>
                    </div>
                </div>
                <div class="col l-2">
                    <div class="policy-footer">
                        <h3>Chính sách</h3>
                        <div>
                            <p>Chính sách bảo hành</p>
                            <p>Quy định và hình thức thanh toán</p>
                            <p>Chính sách vận chuyển, giao nhận</p>
                            <p>Chính sách đổi trả hàng</p>
                            <p>Chính sách bảo mật</p>
                        </div>
                    </div>
                </div>
                <div class="col l-4">
                    <div class="row">
                        <div class="col l-12 online-order-footer">
                            <h3>Đặt hàng online giao hàng tận nơi</h3>
                            <div>
                                <p>HOTLINE:</p>
                                <p style="font-weight: bold; color: #0082F0; font-size: 16px;">1800.2366</p>
                                <p>(8h - 21h)</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l-12 payment-method">
                            <h3>Phương thức thanh toán</h3>
                            <div>
                                <img src="images/visa-logo.png" alt="">
                                <img src="images/mastercard_logo.png" alt="">
                                <img src="images/MoMo_Logo.png" alt="">
                                <img src="images/vnpay_logo.jpg" alt="">
                            </div>
                            <img src="images/dathongbaobct.png" alt="" width=50%>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>