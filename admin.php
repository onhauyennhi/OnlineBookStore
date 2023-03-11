
<?php
    include('db/connect.php');
    include('include/useradmin.php');
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
    <title>Admin</title>
    <link rel="stylesheet" href="css/ad.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
              integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


</head>
<style>
.admin-left a:hover {
    color: red;
    transition: 0.2s ease-in-out;
}
.admin-left a {
    text-decoration: none;
    color: black;
}
.flex {
    display: flex;
}
.col-text-qt {
    margin-top: 3rem;
}
.admin-left {
    width: 25%;
    background: grey;
    height: auto;
}
.admin-left ul{
    padding: 2rem;
}
.admin-left ul li {
    margin-bottom: 1.4rem;
    background: antiquewhite;
    padding: 0.75rem;
    border-radius: 5px;
}
.admin-right {
  width: 75%;
  margin: 30px auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 50px;
    padding: 30px;
    height: auto;
}
.h3, h3 {
    font-size: 1.5rem;
}
.admin-right-col {
    width: 100%;
    height: 150px;
    box-shadow: 0 0 20px 2px rgb(0 0 0 / 50%);    /* font-weight: bold; */
    /* font-size: 15px; */
    padding: 20px;
    background: antiquewhite;
}
</style>

<body>
<header class="header">
      <div class="container">
        <div class="logo">
            <h2>
                <span style="color: #281E5D;">DVN</span>
               <span style="color: #B90E0A;">CellphoneS</span>
            </h2>
        </div>
        

        <?php
            if(isset($user['username'])){
        ?>
        <div class="accout" id="log-and-reg">
          <a href="" class="login"><i class="ti-user"> </i>Xin chào <?php echo $user['username'] ?></a>
          <a onclick="return confirm('Bạn có chắc muốn đăng xuất?');" href="logout.php">Đăng xuất</a>
        </div>
        <?php
            }
            else{
        ?>
        
                <a href="login.php" class="login"><i class="ti-user"> </i>Đăng Nhập</a>
        <?php
            }
        ?>
      </div>
    </header>
<div class="flex">
    <div class="admin-left">
    <ul>
            <li><a href="admin.php"><i class="fa-solid fa-chart-line"></i>Thống kê</a></li>
            <li><a href="admin_product.php"><i class="fa-brands fa-product-hunt"></i> Sản Phẩm</a>
                <ul>
                    <li><a href="admin_add_product.php">Thêm sản phẩm</a></li>
                </ul>
            </li>
            <li><a href="admin_account.php"><i class="fa-solid fa-users w-5 mr-2"></i> Người Dùng</a></li>
            <li><a href="admin_customer.php"><i class="fa-solid fa-users w-5 mr-2"></i> Khách Hàng</a></li>
            <li><a href="admin_bill.php"><i class="fa-solid fa-money-bill"></i> Đơn Hàng</a></li>
            <li><a href="admin_category.php">Danh mục</a></li>
        </ul>
    </div>
      
    <div class="admin-right">
            
            <div class="admin-right-col">
                <h3 class="col-text">SỐ KHÁCH HÀNG</h3>
                <div class="col-text-qt">
                    <?php 
                    $select_cus="select * from account where role='customer'";
                    $cus=mysqli_query($con,$select_cus);
                    $cus_row=mysqli_num_rows($cus);
                    ?>
                    <span class="col-text-qt-font"><?php echo $cus_row; ?></span>
                    
                </div>
            </div>
            
            
            <div class="admin-right-col">
                <h3 class="col-text">SỐ ĐƠN HÀNG</h3>
                <div class="col-text-qt">
                    <?php 
                    $select_bill="select * from bill";
                    $bill=mysqli_query($con,$select_bill);
                    $bill_row=mysqli_num_rows($bill);
                    ?>
                    <span class="col-text-qt-font"><?php echo $bill_row; ?></span>
                    
                </div>
            </div>
            
            
            <div class="admin-right-col">
                <h3 class="col-text">DOANH THU</h3>
                <div class="col-text-qt">
                    <?php 
                    $totalprice=0;
                    $select_price="select totalPrice from bill where billStatus='Đã thanh toán'";
                    $price_bill=mysqli_query($con,$select_price);
                    while($row=mysqli_fetch_array($price_bill)){
                        $totalprice+=(int)($row['totalPrice']);
                    }
                    ?>
                    <span class="col-text-qt-font"><?php echo number_format($totalprice); ?></span>VNĐ
                         
                </div>
            </div>
            
            <div class="admin-right-col">
                <h3 class="col-text">SỐ SẢN PHẨM</h3>
                <div class="col-text-qt">
                    <?php 
                    $select_pd="select * from product";
                    $pd=mysqli_query($con,$select_pd);
                    $pd_row=mysqli_num_rows($pd);
                    ?>
                    <span class="col-text-qt-font"><?php echo $pd_row; ?></span>
                </div>
            </div>

            <div class="admin-right-col">
                <h3 class="col-text">SỐ DANH MỤC</h3>
                <div class="col-text-qt">
                    <?php 
                    $select_cate="select * from category";
                    $cate=mysqli_query($con,$select_cate);
                    $cate_row=mysqli_num_rows($cate);
                    ?>
                    <span class="col-text-qt-font"><?php echo $cate_row; ?></span>
                </div>
            </div>

            <div class="admin-right-col">
                <h3 class="col-text">SỐ TÀI KHOẢN</h3>
                <div class="col-text-qt">
                    <?php 
                    $select_acc="select * from account";
                    $acc=mysqli_query($con,$select_acc);
                    $acc_row=mysqli_num_rows($acc);
                    ?>
                    <span class="col-text-qt-font"><?php echo $acc_row; ?></span>
                </div>
            </div>
    </div>
</div>
    </div>
    
</body>
</html>