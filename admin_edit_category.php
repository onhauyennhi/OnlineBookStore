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
    $err=[];
    if(isset($_POST['editCategory'])){
        $categoryName=$_POST['categoryName'];
        if(empty($categoryName)){
            $err['categoryName']="Chưa nhập vào tên danh mục";
        }
        if(empty($err)){
            $cate=mysqli_query($con,"update category set categoryName='$categoryName' where categoryID='$id'");
            if($cate){//thực thi câu lệnh thành công
                echo '<script>alert("Bạn đã sửa danh mục thành công!")</script>';
                echo "<script>window.location.href = 'admin_category.php';</script>";
            }
        }
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
.add-category{
    padding-top: 10px;
    text-align: center;
    justify-content: center;

}
.has-error{
    color:red;
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
                <h1>DANH SÁCH DANH MỤC</h1>
                <form action="" method="POST">
                    <?php 
                        $sl_cate=mysqli_query($con,"select * from category where categoryID='$id'");
                        $row_sl_cate=mysqli_fetch_array($sl_cate);
                    ?>
                    <input class="add-category" type="text" placeholder="Nhập tên danh mục..." name="categoryName" value="<?php echo $row_sl_cate['categoryName']; ?>">
                    <button onclick="return confirm('Bạn muốn sửa danh mục này?');" type="submit" name="editCategory" class="btn btn-success" style="margin-bottom: 15px;">Sửa Danh Mục</button>                
                </form>

                    <div class="has-error">
                        <span>
                            <?php  
                                if(isset($err['categoryName'])){
                                    echo $err['categoryName'];
                                }else{
                                    echo '';
                                }
                            ?>               
                        </span>
                    </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã danh mục</th>
                            <th>Tên danh mục</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item_page=!empty($_GET['per_page'])?$_GET['per_page']:10;
                        $current_page=!empty($_GET['page'])?$_GET['page']:1;
                        $offset=($current_page - 1)* $item_page;
                        $sql="SELECT * FROM category ORDER BY categoryID ASC LIMIT ".$item_page." offset " .$offset ;
                        $sql_pd=mysqli_query($con,"select * from category");
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
                        $cate_query=mysqli_query($con,"select * from category order by categoryID ASC");
                        while($row_cate=mysqli_fetch_array($cate_query)){
                        ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row_cate['categoryID'];?></td>
                            <td><?php echo $row_cate['categoryName'];?></td>
                            <td>
                                <div class="bill-function">
                                    <a onclick="return confirm('Bạn có muốn xóa danh mục này?');" href="admin_category.php?pagelayout=delete&&id=<?php echo $row_cate['categoryID'];?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <a onclick="return confirm('Bạn có muốn sửa danh mục này?');" href="admin_edit_category.php?pagelayout=edit&&id=<?php echo $row_cate['categoryID'];?>"><i class="fa-solid fa-pen-to-square"></i></a>
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