<?php
    if(isset($_GET['quanly'])){
        $quanly = $_GET['quanly'];
    }else{
        $quanly = '';
    }
    include_once('db/connect.php');
    if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
        if($user['role']=="admin"){
            echo '<script>alert("Admin không thể truy cập vào trang index!")</script>';
            header('location:login.php');
        }
    }
    else{
        $user=[];
    }
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id="";
    }
    $item_page=!empty($_GET['per_page'])?$_GET['per_page']:8;
    $current_page=!empty($_GET['page'])?$_GET['page']:1;
    $offset=($current_page - 1)* $item_page;
    $sql_pd=mysqli_query($con,"select * from product where categoryID='$id'");
    $totalRecord=mysqli_num_rows($sql_pd);
    $totalPage=ceil($totalRecord/$item_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chi tiết sản phẩm</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<style>
    a{
        text-decoration:none;
    }
    strong.current-page-item li a {
        color: white;
        background: #281E5D;
    }
    .price-sort select {
        padding: 6px;
        font-size: 17px;
        font-weight: bold;
        color: #FC6A03;
        outline: none;
    }
.price-sort button {
    background: #FC6A03;
    width: 153px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    height: 40px;
}
.price-sort a{
    color: black;
}
.price-sort a:hover{
    color:white;
    transition: ease-in-out 0.2s;
}
.row-header {
    justify-content: space-between;
    align-items: center;
    display: flex;
}
</style>
<body>
    <div class="grid header">
        <div class="grid wide container">
        <div class="row-header">
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
                        
                    </div>
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
                                <p>Giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row navigation-box">
                <div class="col l-3">
                    <div class="category">
                        <i class="fa-solid fa-bars"></i>
                        <h4>DANH MỤC SẢN PHẨM</h4>
                    </div>
                </div>               
                <div class="col l-8" >
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
    <?php
        include('include/categorybar.php');
    ?>
    </div>
    <div class="grid trend-grid">
        <?php 
                    $sql_product_page=mysqli_query($con,"SELECT * FROM category ORDER BY categoryID ASC");
                    while ($row_product_page=mysqli_fetch_array($sql_product_page)) {
                        if($row_product_page['categoryID']==$id){
                    
        ?>
        <div class="grid wide container">
            <div class="row" style="margin-bottom: 35px;">
                <div class="col l-12 brand-new" style="padding: 17px 20px;">
                    <div class="brand-new-title">
                        <h2><?php echo $row_product_page['categoryName']; ?></h2>
                    </div>
                    <form action="productpage.php?quanly=timkiem&&id=<?php echo $row_product_page['categoryID'];?>" method="POST" class="search-bar">
                        <input type="text" placeholder="Tìm kiếm sản phẩm..." name="tukhoa">
                        <button type="submit" name="timkiem" value="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>    
                </div>
            </div>

        <?php 
            }
          }  
        ?>
        <?php
            if($quanly=='timkiem'&&$id==1){
                include('timkiem_apple.php');
            }else if($quanly=='timkiem'&&$id==2){
                include('timkiem_samsung.php');
            }else if($quanly=='timkiem'&&$id==3){
                include('timkiem_oppo.php');
            }else if($quanly=='timkiem'&&$id==4){
                include('timkiem_xiaomi.php');
            }else if($quanly=='timkiem'&&$id==5){
                include('timkiem_realme.php');
            }else if($quanly=='timkiem'&&$id==6){
                include('timkiem_phukien.php');
            }
            else{
        ?>
            <div class="row">
                <div class="col l-12">
                    
                    <div class="row card-products">
                        <?php
                        $product_sql="SELECT * FROM product where categoryID=$id LIMIT ".$item_page." offset ".$offset;
                        
                        $sql_product=mysqli_query($con,$product_sql);
                        while($row_product=mysqli_fetch_array($sql_product)){

                        ?>
                        <div class="col l-3 card-product">
                        <a href="pages/productdetail.php?id=<?php echo $row_product['productID']; ?> "><img src="images/<?php echo $row_product['productImage']; ?>" alt="">
                            <div>
                                <p class="product-name"><?php echo $row_product['productName']; ?></p>
                                <p class="price"><?php echo number_format($row_product['productPrice']); ?><span>VNĐ</span></p>
                            </div>
                        </a>
                        </div>
                        
                        <?php
                                    
                                
                        }
                            
                        ?>
                        <div class="pagination">
                            <ul id="paging">
                                <?php 
                                if($current_page>3){
                                    $first_page=1;
                                ?>
                                <li><a href="?id=<?php echo $id ?>&&per_page=<?php echo $item_page ?>&page=<?php echo $first_page;?>&page=<?php echo $first_page;?>">First</a></li>
                                <?php 
                                }
                                ?>
                                <?php
                                for($number=1;$number<=$totalPage;$number++){
                                    if($number!=$current_page){
                                        if($number>$current_page-3 && $number<$current_page+3){
                                ?>
                                <li><a href="?id=<?php echo $id ?>&&per_page=<?php echo $item_page ?>&page=<?php echo $number;?>"><?php echo $number;?></a></li>

                                <?php
                                        } 
                                    }else{
                                ?>
                                <strong class="current-page-item"><li><a><?php echo $number;?></a></li></strong>
                                <?php 
                                    }
                                }
                                if($current_page<$totalPage-3){
                                    $end_page=$totalPage;
                                ?>
                                <li><a href="?id=<?php echo $id ?>&&per_page=<?php echo $item_page ?>&page=<?php echo $number;?>&page=<?php echo $end_page;?>">Last</a></li>
                                <?php 
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
       <?php } ?>  
        </div>
    </div>
    <!-- Brand -->     <!-- Footer -->
    
    <?php
                    
        include('include/footer.php');
    ?>

    
</body>
</html>