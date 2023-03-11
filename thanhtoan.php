<?php
    include('db/connect.php');
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
    }else{
        $user=[];
    }
?>
<?php
//Thanh toán đơn hàng
    $err=[];
    if(isset($_POST['thanhtoan'])){
        $customerName=$_POST['customerName'];
        $customerPhone=$_POST['customerPhone'];
        $customerAddress=$_POST['customerAddress'];
        $customerEmail=$_POST['customerEmail'];
        $customerThanhToan=$_POST['customerThanhToan'];
        if(empty($customerName)){
            $err['customerName']="Phải nhập vào họ tên!";
        }
        if(empty($customerPhone)){
            $err['customerPhone']="Phải nhập vào số điện thoại!";
        }else if(is_integer($customerPhone) || strlen($customerPhone)!=10){
            $err['customerPhone']='Số điện thoại không hợp lệ!';
        }
        if(empty($customerAddress)){
            $err['customerAddress']="Phải nhập vào địa chỉ!";
        }
        $regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
        if(empty($customerEmail)){
            $err['customerEmail']="Phải nhập vào email!";
        }else if(!preg_match($regex,$customerEmail)){
                $err['customerEmail'] ='Email không đúng định dạng!';
        }
        if(empty($customerThanhToan)){
            $err['customerThanhToan']="Phải chọn phương thức thanh toán!";
        }
        if(empty($err)){
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
                    $pd_qtt_select=mysqli_query($con,"select * from product where productID='$pd_id'");
                    $row_qtt_select=mysqli_fetch_array($pd_qtt_select);
                    $update_product=mysqli_query($con,"update product set productQuantity=$row_qtt_select[productQuantity]-$pd_quantity where productID=$pd_id");
                    $billdetails_query=mysqli_query($con,"insert into billdetails(billID,productID,productName,productImage,productPrice,productQuantity) values ('$bill_id','$pd_id','$pd_name','$pd_image','$pd_price','$pd_quantity')");
                }
            }
            if($customer_query && $bill_query && $billdetails_query){
                $thanhtoan_delete=mysqli_query($con,"delete from cart where accountID=$user[accountID]");
                echo '<script>alert("Bạn đã thanh toán thành công!")</script>';
                echo "<script>window.location.href = 'checkout.php';</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Open+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Trang thanh toán</title>
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/trangthanhtoan.css">

</head>
<style type="text/css">
	input[type=submit]{
		    height: 35px;
    padding: 0 20px;
    font-size: 12px;
    color: black;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid black;
	}
    a{
        text-decoration: none;
    }
</style>
<body>
<div class="wrapper">
<!---------HEADER----------------->
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
<!---------PAYMENT------------->
    <section class="payment">
        <!-- Cho biết đang ở chức năng thanh toán -->
        <div class="container">
            <div class="payment-top-wrap">
                <div class="payment-top">
                    <div class="payment-top-delivery payment-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="payment-top-payment payment-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- ------------------------------------ -->
        <form action="" method="POST">
        <div class="container">
            <div id="done" class="payment-content row">
            
                <div class="payment-content-left">
                    <div class="payment-content-left-method-payment">
                        <h3 style="font-weight:bold;">PHƯƠNG THỨC THANH TOÁN</h3>
                        <p>Mọi giao dịch đều được bảo mật và mã hoá</p><br>
                        <?php
                            	$thanhtoan=mysqli_query($con,"select * from phuongthuc_tbl");
                            	while($row_thanhtoan=mysqli_fetch_array($thanhtoan)){
                        	?>                        
                        <div class="payment-content-left-method-payment-item">
                        	
                            <input name="customerThanhToan" type="radio" value="<?php echo $row_thanhtoan['thanhtoanID'];?>" >
                            <label><?php echo $row_thanhtoan['thanhtoanName'];?></label>
	                        
                        </div><br/>
                        <?php 
	                        }
	                    ?>
                        <div class="has-error">
                        <span>
                        <?php 
                            if(isset($err['customerThanhToan'])){
                                echo $err['customerThanhToan'];
                            }else{
                                echo '';
                            }
                        ?>
                        </span>
                </div>
                        
                    </div>
                    <!-- ------------------------------- -->
                </div>
                <!-- ------------------------------------ -->
                <div class="payment-content-right">
                    <div class="payment-content-right-button">
                        <h3 style="font-weight:bold;">THÔNG TIN KHÁCH HÀNG</h3>
                        <form id="thongtinkhachhang" onclick="Validate();">
                            <div class="form-group">
                                <label>Họ tên <span>*</span></label>
                                <input name="customerName" id="name" type="text" placeholder="Nguyễn Văn A" autocomplete="off" value="<?php if(isset($customerName)) echo $customerName; ?>">
                                <div class="has-error">
                                    <span>
                                    <?php 
                                        if(isset($err['customerName'])){
                                            echo $err['customerName'];
                                        }else{
                                            echo '';
                                        }
                                    ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại <span>*</span></label>
                                <input name="customerPhone"  id="phone" type="text" placeholder="" maxlength="10" autocomplete="off" value="<?php if(isset($customerPhone)) echo $customerPhone; ?>">
                                <div class="has-error">
                                    <span>
                                    <?php 
                                        if(isset($err['customerPhone'])){
                                            echo $err['customerPhone'];
                                        }else{
                                            echo '';
                                        }
                                    ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ <span>*</span></label>
                                <input name="customerAddress" id="address" type="text" placeholder="Số nhà, phường(xã), quận(huyện), thành phố(tỉnh)" autocomplete="off">
                                <div class="has-error" <?php if(isset($customerAddress)) echo $customerAddress; ?>>
                                    <span>
                                    <?php 
                                        if(isset($err['customerAddress'])){
                                            echo $err['customerAddress'];
                                        }else{
                                            echo '';
                                        }
                                    ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Email <span>*</span></label>
                                <input name="customerEmail" id="mail" type="text" placeholder="nguyenvana123@gmail.com" autocomplete="off" value="<?php if(isset($customerEmail)) echo $customerEmail; ?>">
                                <div class="has-error">
                                    <span>
                                    <?php 
                                        if(isset($err['customerEmail'])){
                                            echo $err['customerEmail'];
                                        }else{
                                            echo '';
                                        }
                                    ?>
                                    </span>
                                </div>
                            </div>
                    </div>
                    
                </div>
                <div class="payment-content-bill">
                    <div class="content-cart-content-table">
                            <div class="cart-content-table-top">
                                <div class="cart-content-title">
                                    <h2>Hóa đơn</h2>
                                </div>
                            </div>
                            	<?php 
                            	$totalprice=0;
                            	$cart_query=mysqli_query($con,"select * from cart where accountID=$user[accountID] order by cartID ASC");
                            	while($row_cart=mysqli_fetch_array($cart_query)){
                            		$productprice=$row_cart['cartQuantity']*$row_cart['productPrice'];
                                    $totalprice+=$productprice;
                            	?>
                                <div class="cart-content-table-product">
	                                <div class="img-product-cart">
	                                    <img src="images/<?php echo $row_cart['productImage']; ?>" alt="">
	                                </div>
	                                <div class="name-product-cart">
	                                    <p class="name-product"><?php echo $row_cart['productName']; ?></p>
	                                    <p style="color: grey;">ID: <?php echo $row_cart['productID']; ?></p>
	                                </div>
	                                <div class="quantity-product-cart">
	                                    <input type="text" name="" min="0" value="<?php echo $row_cart['cartQuantity']; ?>" disabled="">
	                                </div>
	                                <div class="price-product-cart">
	                                    <p><?php echo number_format($row_cart['productPrice']); ?><span>VNĐ</span></p>
	                                </div>
	                                <div class="price-product-cart">
	                                    <p><?php echo number_format($productprice); ?><span>VNĐ</span></p>
	                                </div>
                            	</div>
                            	<?php 
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
                            <?php 
                    $cart_thanhtoan_query=mysqli_query($con,"select * from cart where accountID=$user[accountID]");
                    while($cart_thanhtoan=mysqli_fetch_array($cart_thanhtoan_query)){
                ?>
                    <input type="hidden" name="product_id[]" value="<?php echo $cart_thanhtoan['productID']; ?>">
                    <input type="hidden" name="total_price" value="<?php echo $totalprice; ?>">
                    <input type="hidden" name="product_name[]" value="<?php echo $cart_thanhtoan['productName'];?>">
                    <input type="hidden" name="product_price[]" value="<?php echo $cart_thanhtoan['productPrice'];?>">
                    <input type="hidden" name="product_quantity[]" value="<?php echo $cart_thanhtoan['cartQuantity'];?>">
                    <input type="hidden" name="product_image[]" value="<?php echo $cart_thanhtoan['productImage'];?>">
                <?php 
                }
                ?>
                            
                        </div>
                </div>
            </div>
        </div>
        <div class="payment-content-right-contain-payment">
                <div class="payment-content-right-payment">
                        <input type="submit" name="thanhtoan" value="Thanh toán ngay"></button>
                </div>

        </div>
    	</form>
        </form>
    </section>
    
  </div>

</body>
</html>