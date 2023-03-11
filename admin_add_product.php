
<?php
    include('db/connect.php');
    include('include/useradmin.php');
    include('product/add.php');
    $sql="SELECT * FROM product ORDER BY productID";
    $sql_query=mysqli_query($con,$sql);
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
    }else{
        $user=[];
    }
?>
<?php
        
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
   
    <link rel="stylesheet" href="css/ad.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
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
    .table-bordered {
    border: 1px solid #dee2e6;
    margin: 20px 0;
}
.content-product-list {
    width: 100%;
    padding: 40px 40px 0px;
    height: auto;
}
.content-product-function {
    width: 100%;
    height: auto;
}
.content {
    width: 75%;
    height: auto;
    display: flex;
    flex-wrap: wrap;
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
textarea#productDetail {
    display: block;
    width: 100%;
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
                
<div class="content">
    <div class="add-product">
                            <h1>THÊM SẢN PHẨM</h1>

                        <form action="" method="POST">
                        <label for="productImage">Hình ảnh sản phẩm</label>
                        <input type="file" name="productImage" id="productImage">
                        <div class="has-error">
                            <span>
                                <?php  
                                    if(isset($err['productImage'])){
                                        echo $err['productImage'];
                                    }else{
                                        echo '';
                                    }
                                ?>               
                            </span>
                        </div>

                        <label for="productName">Tên sản phẩm</label>
                        <input type="text" name="productName" id="productName" value="<?php if(isset($productName)) echo $productName; ?>">
                        <div class="has-error">
                            <span>
                                <?php  
                                    if(isset($err['productName'])){
                                        echo $err['productName'];
                                    }else{
                                        echo '';
                                    }
                                ?>               
                            </span>
                        </div>

                        <label for="productPrice">Giá sản phẩm</label>
                        <input type="text" name="productPrice" id="productPrice" value="<?php if(isset($productPrice)) echo $productPrice; ?>">
                        <div class="has-error">
                            <span>
                                <?php  
                                    if(isset($err['productPrice'])){
                                        echo $err['productPrice'];
                                    }else{
                                        echo '';
                                    }
                                ?>               
                            </span>
                        </div>


                        <label for="productQuantity">Số lượng sản phẩm</label>
                        <input type="text" name="productQuantity" id="productQuantity" value="<?php if(isset($productQuantity)) echo $productQuantity; ?>">
                        <div class="has-error">
                            <span>
                                <?php  
                                    if(isset($err['productQuantity'])){
                                        echo $err['productQuantity'];
                                    }else{
                                        echo '';
                                    }
                                ?>               
                            </span>
                        </div>

                        <label for="productBrand">Brand sản phẩm</label>
                        <?php $cbx_query="SELECT * FROM category";
                              $cbx=mysqli_query($con,$cbx_query);
                         ?>
                        <select name="productBrand" id="productBrand">
                            <option value="" selected>Chọn danh mục sản phẩm</option>
                            <?php while($row_cbx=mysqli_fetch_assoc($cbx)){?>
                            <option value="<?php echo $row_cbx['categoryID']; ?>"><?php echo $row_cbx['categoryName'] ?></option>
                            <?php 
                              }
                            ?>   
                        </select>
                        <div class="has-error">
                            <span>
                                <?php  
                                    if(isset($err['productBrand'])){
                                        echo $err['productBrand'];
                                    }else{
                                        echo '';
                                    }
                                ?>               
                            </span>
                        </div>
                            </br>
                        <label for="productDetail"> Chi tiết sản phẩm</label>
                        <textarea type="text" name="productDetail" height="300" id="productDetail" rows="5" value="<?php if(isset($productDetail)) echo $productDetail; ?>">
                        </textarea>
                        <div class="has-error">
                            <span>
                                <?php  
                                    if(isset($err['productDetail'])){
                                        echo $err['productDetail'];
                                    }else{
                                        echo '';
                                    }
                                ?>               
                            </span>
                        </div>
                        
                        <button onclick="return addProduct();" type="submit" name="addProduct">Tạo sản phẩm</button>
                    
                        </form>

                </div>
            
        
                   
                  
            
        </div>


</div>
</div>

</div>

    
</body>
</html>