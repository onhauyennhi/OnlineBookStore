<?php 
    include_once('db/connect.php');
    include('include/useradmin.php');
    if($_GET['id']){
        $id=$_GET['id'];
    }else{
        $id='';
    }
    if($_GET['id']){
        $bill_id=$_GET['id'];
    }else{
        $bill_id='';
    }
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
    }else{
        $user=[];
    }
?>
<?php 
    $delete_billdetails=mysqli_query($con,"delete from billdetails where billDetailsID=$bill_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/ad.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
              integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="css/information.css">
        <link rel="stylesheet" href="css/billdetails.css">
</head>
<style>
    .billdetails-content {
    width: 75%;
    margin-bottom: 50px;
}
.information-content-left {
    width: 100%;
}
.admin-left a:hover {
    color: red;
    transition: 0.2s ease-in-out;
}
.admin-left a {
    text-decoration: none;
    color: black;
}
table.table.table-bordered.table-hover img {
    width: 50px;
    
}
table.table.table-bordered.table-hover {
    text-align: center;
}
.information-content-left-text {
    width: 100%;
    margin: 20px 0;
    font-weight: bold;
    font-size: 25px;
    padding: 0px 50px;
}
.information-content-right-title {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}
.information-content-right {
    width: 40%;
    /* text-align: center; */
    height: auto;
    box-shadow: 2px 2px 3px 1px grey;
    padding: 30px;
    margin: 0 auto;
}
    table#customer-bill img {
    width: 50px;
    height: 30px;
}
   
.flex {
    display: flex;
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
    margin: 30px auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 50px;
    height: auto;
}
.admin-right-col {
    width: 100%;
    height: 150px;
    box-shadow: 0 0 20px 2px rgb(0 0 0 / 50%);    /* font-weight: bold; */
    /* font-size: 15px; */
    padding: 20px;
    background: rgb(59 130 246 / 0.5);
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
            <div class="billdetails-content">
<div class="information-content-left">
                <?php 
                    $bill_q=mysqli_query($con,"select * from bill where billID='$bill_id'");
                    while($row_cus=mysqli_fetch_array($bill_q)){
                        $cus=mysqli_query($con,"select * from account where accountID=$row_cus[accountID]");
                        while($customer=mysqli_fetch_array($cus)){
                ?>
                <div class="information-content-left-text">
                    <h1>Thông tin chi tiết đơn hàng #<?php echo $row_cus['billID']; ?></h1>

                </div>
                <?php 
                }
                ?>

            <div class="information-content-left-table">
            <table class="table table-bordered table-hover">
            <thead>
                        <th>STT</th>
                        <th>Mã hóa đơn</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                    </thead>
                    
                    <tbody>
                        <?php 
                            $i=1;
                            $bill_query=mysqli_query($con,"select * from billdetails where billID='$bill_id'");
                            while($row_bill=mysqli_fetch_array($bill_query)){
                        ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row_bill['billID']; ?></td>
                            <td><?php echo $row_bill['productID']; ?></td>
                            <td><?php echo $row_bill['productName']; ?></td>
                            <td><img src="images/<?php echo $row_bill['productImage']; ?>"></td>
                            <td><?php echo $row_bill['productPrice']; ?></td>
                            <td><?php echo $row_bill['productQuantity']; ?></td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>

        
        <?php
            }
        ?>
</div>
</div>
            
    
</body>
</html>