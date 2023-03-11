<?php

    include('../db/connect.php');
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
    }else{
        $user=[];
    }
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id="";
    }
    if(isset($_GET['accountid'])){
        $accountid=$_GET['accountid'];
    }else{
        $accountid="";
    }
?>

<?php
    if(isset($user['username'])){
    //Thêm sản phẩm vào giỏ hàng 
        if(isset($_POST['addProductToCart'])){
            $productID=$_POST['productID'];
            $productName=$_POST['productName'];
            $productImage=$_POST['productImage'];
            $productPrice=$_POST['productPrice'];
            $productQuantity=$_POST['productQuantity'];
            
            $select_cart=mysqli_query($con,"select * from cart where productID='$productID' AND accountID=".$user['accountID']);
            $select_quantity_product=mysqli_query($con,"select * from product where productID='$id'");
            $count_cart=mysqli_num_rows($select_cart);
            if($count_cart>0){
                $row_pro_cart=mysqli_fetch_array($select_cart);
                $row_quantity=mysqli_fetch_array($select_quantity_product);
                $quantity=$row_pro_cart['cartQuantity']+1;
                $sql_cart_query="update cart set cartQuantity ='$quantity' where productID='$productID'";
            }else{
                $quantity=$productQuantity;
                $sql_cart_query="insert into cart(productID,productName,productImage,productPrice,cartQuantity,accountID) values ('$productID','$productName','$productImage','$productPrice','$productQuantity','$user[accountID]')";
            }
            $insert_cart=mysqli_query($con,$sql_cart_query);
            if(!$insert_cart){

                header('location:productdetail.php?id='.$productID);
            }
        }
    }else{
        $user['accountID']=0;
    }
?>

<?php
//Xóa sản phẩm khỏi giỏ hàng
    $sql_delete=mysqli_query($con,"delete from cart where cartID='$id'");

?>

<?php
//Thanh toán đơn hàng
    if(isset($_POST['thanhtoan'])){
        $customerName=$_POST['customerName'];
        $customerPhone=$_POST['customerPhone'];
        $customerAddress=$_POST['customerAddress'];
        $customerEmail=$_POST['customerEmail'];
        $customerThanhToan=$_POST['customerThanhToan'];

        $totalprice=$_POST['total_price'];
        $customer_query=mysqli_query($con,"insert into customer(customerName,customerPhone,customerAddress,customerEmail,accountID,customerThanhToan) values ('$customerName','$customerPhone','$customerAddress','$customerEmail','$user[accountID]','$customerThanhToan') ");
        $customer_select=mysqli_query($con, "SELECT * from customer order by customerID DESC LIMIT 1");
        $row_cus=mysqli_fetch_array($customer_select);
        $customer_id=$row_cus['customerID'];

        $bill_query=mysqli_query($con,"insert into bill(accountID,customerID,totalprice,billStatus) values('$user[accountID]','$customer_id','$totalprice','Đang xử lý')");
        $bill_select=mysqli_query($con,"SELECT * FROM bill order by billID DESC LIMIT 1");
        $row_bill=mysqli_fetch_array($bill_select);
        $bill_id=$row_bill['billID'];
        if($customer_query && $bill_query){
            for($i=0;$i<count($_POST['product_id']);$i++){
                $pd_id=$_POST['product_id'][$i];
                $pd_quantity=$_POST['product_quantity'][$i];
                $pd_image=$_POST['product_image'][$i];
                $pd_price=$_POST['product_price'][$i];
                $pd_name=$_POST['product_name'][$i];
                $billdetails_query=mysqli_query($con,"insert into billdetails(billID,productID,productName,productImage,productPrice,productQuantity) values ('$bill_id','$pd_id','$pd_name','$pd_image','$pd_price','$pd_quantity')");
            }
        }

        if($customer_query && $bill_query && $billdetails_query){
            $thanhtoan_delete=mysqli_query($con,"delete from cart where accountID=$user[accountID]");
        }
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
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/cart.css">
    <script defer src="js/javaScript.js"></script>
    <title>Giỏ hàng</title>
</head>
<style type="text/css">
.product-delivery {
    width: 80%;
    margin: 40px auto;
}
.product-delivery input[type="text"],input[type="email"] {
    display: block;
    height: 43px;
    outline: none;
    width: 100%;
    margin: 30px 0px;
}

.product-delivery input[type="submit"]{
    color: white;
    cursor: pointer;
    width: 200px;
    height: 50px;
    background: #281E5D;
    border: none;
}
.product-delivery input[type="submit"]:hover{
    background-color: #B90E0A;
    border: none;
}
.delivery-infor {
    margin: 20px 0;
}
.delivery-infor select{
    width: 100%;
    outline: none;
    height: 43px;
}
.delivery-infor-text {
    margin-bottom: 30px;
    font-size: 20px;
}
a{
    color: black;
    text-decoration: none;
}
.cart-empty {
    width: 100%;
    height: 400px;
    line-height: 400px;
    justify-content: center;
    text-align: center;
}
.content-cart-content-continuebuy button a {
    color: white;
}
.no-login {
    width: 100%;
    height: 400px;
    text-align: center;
    line-height: 400px;
}
.login-text{
    color: red;
}
.login-text:hover{
    color: #281E5D;
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
                                <a id="btndn" href="../user.php"><i class="fa-solid fa-circle-user"></i></a>
                                <p><a href="../user.php"><?php echo $user['username']; ?></a></p>
                                <p><a onclick="return confirm('Bạn có chắc muốn đăng xuất?');" href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></p>
                            </div>
                        </div>
                        <?php
                        }
                        else{
                        ?>
                            <div class="col l-4 hide-on-mobile-tablet">
                                <div class="login1">
                                    <a id="btndn" href="../login.php"><i class="fa-solid fa-circle-user"></i></a>
                                    <p><a href="../login.php">Đăng nhập</a></p>
                                </div>
                            </div>

                        <?php
                        }
                        ?>
                        <div class="col l-4">
                            <div class="shopping-cart">
                                <a href="cart.php"><i class="fa-solid fa-2x fa-cart-shopping"></i></a>
                                <p><a href="cart.php">Giỏ hàng</a></p>
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
                                    <a href="../index.php"><h4>TRANG CHỦ</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="introduction">
                                    <a href="introduce.php"><h4>GIỚI THIỆU</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="product">
                                    <a href="../index.php"><h4>SẢN PHẨM</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="news">
                                    <a href="../index.php"><h4>TIN TỨC</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="contact">
                                    <a href="contact.php"><h4>LIÊN HỆ</h4></a>
                                </div>
                            </div>
                            <div class="col l-2">
                                <div class="branch">
                                    <a href="../index.php"><h4>CHI NHÁNH</h4></a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            

            </div>
        </div>
        <?php
            $cart_query=mysqli_query($con,"SELECT * FROM cart ORDER BY cartID ASC");
            $cart_check=mysqli_query($con,"SELECT * FROM cart where accountID=".$user['accountID']);
            $row_check=mysqli_num_rows($cart_check);
        ?>
        <div class="content">
            <div class="content-cart">
                <div class="content-cart-top">
                    <p><a href="../index.php" class="fa-solid fa-house"></a></p><span
                        class="fa-solid fa-angle-right"></span><a href="#">Giỏ Hàng</a>
                </div>
        
        <?php
            if(isset($user['username'])){
        ?>
        <?php
                    if($row_check<=0){
                ?>
                    <div class="cart-empty">
                        <h2>Chưa có sản phẩm nào trong giỏ hàng</h2>
                    </div>
                <?php 
                    }else{
                ?>
                <div class="content-cart-content">
                    <div class="content-cart-content-left">
                        <div class="content-cart-content-text">
                            <?php 
                                $cart_account=mysqli_fetch_array($cart_check); 
                                $delete_cart=mysqli_query($con,"delete from cart where accountID='$accountid'");
                            ?>
                        <a href="cart.php?function=deleteall&accountid=<?php echo $cart_account['accountID']; ?> "><p>Xoá tất cả</p></a>
                        </div>

                        <div class="content-cart-content-table">
                            <div class="cart-content-table-top">
                                <div class="cart-content-title">
                                    <h2>Giỏ hàng</h2>
                                </div>
                            </div>
                            <?php 
                                $totalprice=0;
                                while($cart_product=mysqli_fetch_array($cart_query)){
                                    if($user['accountID']==$cart_product['accountID']){
                                    $productprice=$cart_product['cartQuantity']*$cart_product['productPrice'];
                                    $totalprice+=$productprice;
                            ?>
                            <div class="cart-content-table-product">
                                <div class="img-product-cart">
                                    <img src="../images/<?php echo $cart_product['productImage']; ?>" alt="">
                                </div>
                                <div class="name-product-cart">
                                    <p class="name-product"><?php echo $cart_product['productName']; ?></p>
                                    <p style="color: grey;">ID: <?php echo $cart_product['productID']; ?></p>
                                </div>
                                <div class="quantity-product-cart">
                                    <a onclick="return confirm('Bạn muốn trừ số lượng sản phẩm này?');" href="minusCart.php?id=<?php echo $cart_product['productID']; ?>"><i class="fa-solid fa-minus"></i></a>
                                    <input type="text" name="" min="0" value="<?php echo $cart_product['cartQuantity'];?>" disabled>
                                    <a onclick="return confirm('Bạn muốn thêm số lượng sản phẩm này?');" href="plusCart.php?id=<?php echo $cart_product['productID']; ?>"><i class="fa-solid fa-plus"></i></a>
                                </div>
                                <div class="price-product-cart">
                                    <p><?php echo number_format($cart_product['productPrice']); ?><span>VNĐ</span></p>
                                </div>
                                <div class="price-product-cart">
                                    <p><?php echo number_format($productprice); ?><span>VNĐ</span></p>
                                </div>
                                <div class="product-cart-function">
                                    <a onclick="return deleteCart();" href="cart.php?function=delete&id=<?php echo $cart_product['cartID'];?>"><span class="fa-solid fa-trash"></span></a>
                                </div>
                            </div>
                            
                            <?php 
                            }
                                }
                            ?>
                            <div class="cart-content-table-bottom">
                                <div class="cart-content-title">
                                    <h2>Tổng tiền</h2>
                                </div>
                                <div class="cart-content-total-price">
                                    <p><?php echo number_format($totalprice); ?><span>VNĐ</span></p>
                                </div>
                            </div>

                            
                        </div>

                    </div>

                    <div class="content-cart-content-right">
                        <div class="content-cart-content-right-bill">
                            <div class="content-cart-content-right-bill-title">
                                <h2>Hoá đơn tạm tính</h2>
                            </div>
                            <div class="content-bill">
                                <p class="temp-bill">Tạm tính</p>
                                <p id="temp-bill"><?php echo number_format($totalprice); ?><span>VNĐ</span></p>
                            </div>
                            <div class="content-bill">
                                <p class="total-bill">Thành tiền</p>
                                <p id="total-bill"><?php echo number_format($totalprice); ?><span>VNĐ</span></p>
                            </div>
                        </div>
                        <div class="content-cart-content-continuebuy">
                            <button><a href="../index.php">TIẾP TỤC MUA HÀNG</a></button>
                            <button><a href="../thanhtoan.php">TIẾP TỤC THANH TOÁN</a></button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        
        <?php 
            }
        ?>
        <?php 
        }else{
        ?>
        <div class="no-login">
            <h1>
                Vui lòng <a class="login-text" href="../login.php">đăng nhập</a> để xem giỏ hàng
            </h1>
        </div>
        <?php 
        }
        ?>

        
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
                                <img src="../images/visa-logo.png" alt="">
                                <img src="../images/mastercard_logo.png" alt="">
                                <img src="../images/MoMo_Logo.png" alt="">
                                <img src="../images/vnpay_logo.jpg" alt="">
                            </div>
                            <img src="../images/dathongbaobct.png" alt="" width=50%>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script type="text/javascript">
        function plusCart(){
            confirm("Bạn có muốn thêm số lượng sản phẩm này?");
        }
        function minusCart(){
            confirm("Bạn muốn trừ số lượng sản phẩm này?");
        }
        function deleteCart(){
            confirm("Bạn muốn xóa sản phẩm này khỏi giỏ hàng?");
        }
    </script>
</body>

</html>