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
    <title>Thông tin đơn hàng</title>
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
    .information-content-left {
        width: 100%;
    }
    .information-user-text {
        padding: 20px 50px;
        display: flex;
        justify-content: space-between;
    }
    .information-user-text a{
        color:black;
    }
    .information-user-text a:hover{
        color:red;
    }
    table#customer-bill img {
        width: 50px;
        height: auto;
    }
    .information-content-left-table {
        width: 100%;
        margin: 50px 0;
        padding: 0 50px;
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



    <div class="information-content">
        
        <div class="information-content-left">
                        
            <?php if(isset($user['username'])){ ?>
                <div class="information-user-text">
                    <a href="user.php"><h1>Hồ sơ tài khoản</h1></a>
                    <a href="user-bill.php"><h1>Đơn hàng</h1></a>
                </div>
                <div class="information-content-left-text">
                    
                    <h2>Xin chào, <span style="color:red"><?php echo $user['fullname']; ?></span></h2>
                </div>
            <?php
            }else{
            ?>
            <div class="information-content-left-text">
                <h1>Trang khách hàng</h1>
                <h2>Vui lòng đăng nhập tài khoản</h2>
            </div>
            <?php 
            }
            ?>

            <?php 
                $sl_bill_user=mysqli_query($con,"select * from bill where accountID='$user[accountID]'");
                while($row_bill_user=mysqli_fetch_array($sl_bill_user)){
            ?>
            <div class="information-content-left-table">
            
                <div class="bill-content-text">
                    <h2>Mã đơn hàng: #<?php echo $row_bill_user['billID']; ?></h2>
                </div>
                
                <table id="customer-bill">
                    <thead>
                        <th>Hình sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                    </thead>
                    
                    <tbody>
                    <?php 
                        $bill_query=mysqli_query($con,"SELECT * from billdetails,bill WHERE bill.billID=billdetails.billID AND bill.billID='$row_bill_user[billID]' AND bill.accountID='$user[accountID]';");
                        while($row_bill=mysqli_fetch_array($bill_query)){
                    ?>    
                        <tr>
                            <td><img src='images/<?php echo $row_bill['productImage']; ?>'></td>
                            <td><?php echo $row_bill['productName']; ?></td>
                            <td><?php echo $row_bill['productQuantity'];?></td>
                            <td><?php echo number_format($row_bill['productPrice']); ?>VNĐ</td>
                        </tr>
                    <?php 
                            
                        }
                    ?>    
                    </tbody>
                    
                </table>
                <div class="bill-content-text">
                    <h2>Tổng tiền: <?php echo number_format($row_bill_user['totalPrice']); ?>VNĐ</h2>
                    <h2>Tình trạng: <?php echo $row_bill_user['billStatus']; ?></h2>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>

    </div>






    <!----footer-->
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