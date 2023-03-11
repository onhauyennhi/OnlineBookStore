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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Open+Sans:wght@400;600;800&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/cart.css">
    <title>Check out</title>
</head>
<style>
a{
    text-decoration: none;
   
}
.checkout-content-text {
    width: 100%;
    font-size: 25px;
    height: 150px;
    color: #B90E0A;
    line-height: 150px;
    text-align: center;
}
.checkout-content-bill span {
    color: #B90E0A;
}
.checkout-content-bill {
    width: 100%;
    text-align: center;
    font-size: 25px;
}
.checkout-content-button {
    text-align: center;
    margin-top: 50px;
    width: 100%;
}
.checkout-content-button button {
    width: 200px;
    height: 40px;
    border: none;
    outline: none;
    /* color: white; */
    background: #B90E0A;
}
.checkout-content-button button a{
    color:white;
    font-size: 20px;
    font-weight: bold;
}
.checkout-content-button button a:hover{
    color:black;
    transition: ease-in-out 0.2s;
}
</style>

<body>
    <div class="wrapper">
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
                                <a id="btndn" href="user.php"><i class="fa-solid fa-circle-user"></i></a>
                                <p><a href="user.php"><?php echo $user['username']; ?></a></p>
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
        <div class="checkout-content">
            <div class="checkout-content-text">
                <h1>CẢM ƠN BẠN ĐÃ ĐẶT HÀNG</h1>
            </div>
            <div class="checkout-content-bill">
                <?php 
                    $checkout_bill=mysqli_query($con,"select * from bill order by billID DESC limit 1");
                    while($row=mysqli_fetch_array($checkout_bill)){
                ?>
                <h4>Mã đơn hàng của bạn là:<span> #<?php echo $row['billID'];  ?></span></h4>
                <?php 
                    }
                ?>
            </div>
            <div class="checkout-content-button">
                <button><a href="index.php">Trở về trang chủ</a></button>
            </div>
        </div>
        
    </div>
    <?php
        include('include/footer.php');
    ?>

    
</body>

</html>