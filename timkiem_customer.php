<?php 
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
    }else{
        $user=[];
    }
    if(isset($_POST['timkiem'])){
        $tukhoa = $_POST['tukhoa'];
    }
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id='';
    }
    $con = new mysqli("localhost","root","","dvn_cellphones");  
    $delete_customer=mysqli_query($con,"delete from customer where customerID='$id'");
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
        <link rel="stylesheet" href="css/customer.css">
</head>
<style>
.content-customer {
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
          <a href="logout.php">Đăng xuất</a>
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
            <li><a href="admin.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
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
    <div class="content-customer">
                <h1>DANH SÁCH KHÁCH HÀNG CẦN TÌM</h1>
                <form action="timkiem_customer.php?quanly=timkiem" class="search-customer-bar">
                    <input type="text" placeholder="Tìm kiếm tên khách hàng..." name="tukhoa">
                    <button type="submit" name="timkiem" value="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID Khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>ID Tài khoản</th>
                            <th>Phương thức thanh toán</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tukhoa=!empty($_GET['tukhoa'])?$_GET['tukhoa']:$tukhoa;
                            $item_page=!empty($_GET['per_page'])?$_GET['per_page']:8;
                            $current_page=!empty($_GET['page'])?$_GET['page']:1;
                            $offset=($current_page - 1)* $item_page;
                            $sql="SELECT * FROM customer WHERE customerName LIKE '%$tukhoa%' LIMIT ".$item_page." offset " .$offset ;
                            $sql_pd=mysqli_query($con,"SELECT * FROM customer WHERE customerName LIKE '%$tukhoa%'");
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
                            $i=0; 
                            $customer_query=mysqli_query($con,$sql);
                            while($row_customer=mysqli_fetch_array($customer_query)){
                        ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $row_customer['customerID'] ?></td>
                            <td><?php echo $row_customer['customerName'] ?></td>
                            <td><?php echo $row_customer['customerPhone'] ?></td>
                            <td><?php echo $row_customer['customerAddress'] ?></td>
                            <td><?php echo $row_customer['customerEmail'] ?></td>
                            <td><?php echo $row_customer['accountID'] ?></td>
                            <?php 
                                    $id_thanhtoan=$row_customer['customerThanhToan'];
                                    $row_pd_query=mysqli_query($con,"SELECT * from phuongthuc_tbl where thanhtoanID='$id_thanhtoan'");
                                    while($row_pd=mysqli_fetch_assoc($row_pd_query)){
                                        if($row_pd['thanhtoanID']==$id_thanhtoan){
                            ?>
                            <td><?php echo $row_pd['thanhtoanName']?></td>
                            <?php
                                }
                            }
                            ?>
                            <td>
                                <div class="customer-function">
                                    <a onclick="return confirm('Bạn có muốn xóa khách hàng này?');" href="?pagelayout=delete&&id=<?php echo $row_customer['customerID']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <a onclick="return confirm('Bạn có muốn sửa thông tin khách hàng này?');" href="admin_edit_customer.php?pagelayout=edit&&id=<?php echo $row_customer['customerID']; ?>?"><i class="fa-solid fa-pen-to-square"></i></a>
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
                            <li><a href="?quanly=timkiem&&tukhoa=<?php echo $tukhoa; ?>&&per_page=8&page=<?php echo $number;?>"><?php echo $number;?></a></li>
                            <?php 
                                if(isset($_POST['timkiem'])){
                                    $tukhoa = $_POST['tukhoa'];
                            }
                        }?>
                        </ul>

                </div>
        </div>            







        </div>
    </div>
</div>
            


    
</body>
</html>