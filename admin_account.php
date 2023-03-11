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
?>

<?php 
    if(isset($_GET['quanly'])){
        $quanly = $_GET['quanly'];
    }else{
        $quanly = '';
    }
    if(isset($user['username'])){
    $delete_ac=mysqli_query($con,"delete from account where accountID='$id'");
    }else{
        echo '<script>alert("Bạn phải đăng nhập để thực hiện chức năng!")</script>';
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
              integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/ad.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/account.css">
</head>
<style>
.content-account {
    width: 75%;
    padding: 40px 40px 0px;
    margin: 0 auto;
    height: auto;
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
.content-account {
    width: 75%;
    overflow-x: scroll;
    padding: 40px 40px 0px;
    margin: 0 auto;
    height: auto;
}
</style>
<?php 
      if($quanly=='timkiem'){
        include('timkiem_account.php');
    }else{
      ?>  
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
            
<div class="content-account">
                <h1>DANH SÁCH TÀI KHOẢN</h1>
                <form action="admin_account.php?quanly=timkiem" class="search-account-bar" method="POST">
                    <input type="text" placeholder="Tìm kiếm tên tài khoản..." name="tukhoa">
                    <button type="submit" name="timkiem" value="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Tên tài khoản</th>
                            <th>Password</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Quyền</th>
                            <th>Ngày đăng ký</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                         $item_page=!empty($_GET['per_page'])?$_GET['per_page']:10;
                         $current_page=!empty($_GET['page'])?$_GET['page']:1;
                         $offset=($current_page - 1)* $item_page;
                         $sql="SELECT * FROM account ORDER BY accountID ASC LIMIT ".$item_page." offset " .$offset ;
                         $sql_pd=mysqli_query($con,"select * from account");
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
                                // kiểm kết nối
                                $i=1;
                                $sql="SELECT * FROM account";
                                $result=mysqli_query($con,$sql);
                                while($row=mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                        <td><?php echo $i++?></td>
                                        <td><?php echo$row['fullname']?></td>
                                        <td><?php echo$row['username']?></td>
                                        <td><?php echo$row['password']?></th>
                                        <td><?php echo$row['phone']?></th>
                                        <td><?php echo$row['email']?></td>
                                        <td><?php echo$row['address']?></td>
                                        <td><?php echo$row['role']?></td>
                                        <td><?php echo$row['reg_date']?></td>
                                        <td>
                                            <div class='account-function'>
                                                <a onclick="return confirm('Bạn có muốn xóa tài khoản này?');" href="?pagelayout=delete&id=<?php echo$row['accountID']?>"><i class='fa-solid fa-trash-can'></i></a>
                                                <a onclick="return confirm('Bạn có muốn sửa tài khoản này?');" href="admin_edit_account.php?id=<?php echo$row['accountID']?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
<?php }?>
</html>