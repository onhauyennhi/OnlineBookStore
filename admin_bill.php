<?php 
    include('db/connect.php');
    include('include/useradmin.php');
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
    }else{
        $user=[];
    }
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id='';
    }
    $delete_bill=mysqli_query($con,"delete from bill where billID='$id'");
    if($delete_bill){
        $delete_billdetails=mysqli_query($con,"delete from billdetails where billID='$id'");
    }

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
    
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="css/bill.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/grid.css">
</head>
<style>
.content-bill {
    width: 75%;
    padding: 40px 40px 0px;
    margin: 0 auto;
    height: auto;
}
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
                <div class="content-bill">
                <h1>DANH SÁCH ĐƠN HÀNG</h1>
                <form action="" class="search-bill-bar">
                    <input type="text" placeholder="Tìm kiếm đơn hàng..." name="text">
                    <button type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã hóa đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Tổng giá</th>
                            <th>Ngày lập hóa đơn</th>
                            <th>Trạng thái</th>
                            <th>Đã xác nhận</th>
                            <th>Đã thanh toán</th>
                            <th>Chi tiết</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_GET['confirm'])){
                            $confirm_id=$_GET['confirm'];
                            $cf_sql=mysqli_query($con,"update bill set billStatus='Đã xác nhận' where billID='$confirm_id'");
                        }
                        if(isset($_GET['thanhtoan'])){
                            $thanhtoan_id=$_GET['thanhtoan'];
                            $cf_sql=mysqli_query($con,"update bill set billStatus='Đã thanh toán' where billID='$thanhtoan_id'");
                        }

                        $item_page=!empty($_GET['per_page'])?$_GET['per_page']:10;
                        $current_page=!empty($_GET['page'])?$_GET['page']:1;
                        $offset=($current_page - 1)* $item_page;
                        $sql="SELECT * FROM bill ORDER BY billID ASC LIMIT ".$item_page." offset " .$offset ;
                        $sql_pd=mysqli_query($con,"select * from bill");
                        $totalRecord=mysqli_num_rows($sql_pd);
                        $totalPage=ceil($totalRecord/$item_page);                     
                               if($current_page == 1){
                                   $i = 1;
                               }
                               if($current_page == 2){
                                   $i = 11;
                               }
                               if($current_page == 3){
                                   $i = 21;
                               }
                               if($current_page == 4){
                                   $i = 31;
                              } 
                        $i=1;
                        $bill_query=mysqli_query($con,"select * from bill order by billID ASC");
                        while($row_bill=mysqli_fetch_array($bill_query)){
                        ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row_bill['billID'];?></td>
                            <td><?php echo $row_bill['customerID'];?></td>
                            <td><?php echo $row_bill['totalPrice'];?></td>
                            <td><?php echo $row_bill['billDate'];?></td>
                            <td><?php echo $row_bill['billStatus'];?></td>
                            <td><a href='admin_bill.php?confirm=<?php echo $row_bill['billID']?>'>Đã xác nhận</a></td>
                            <td><a href='admin_bill.php?thanhtoan=<?php echo $row_bill['billID']?>'>Đã thanh toán</a></td>
                            <td><a href="admin_billdetails.php?id=<?php echo $row_bill['billID']; ?>">Xem</a></td>
                            <td>
                                <div class="bill-function">
                                    <a onclick="return confirm('Bạn có muốn xóa hóa đơn này?');" href="admin_bill.php?id=<?php echo $row_bill['billID']?>"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
                
                <div class="pagination">
                        <ul id="paging">
                            <?php for($number=1;$number<=$totalPage;$number++){
                            ?>
                            <li><a href="?admin_account&&per_page=10&page=<?php echo $number;?>"><?php echo $number;?></a></li>
                            <?php 
                            }
                            ?>
                        </ul>

                </div>
        </div>
</div>
            

            

      
</body>
</html>