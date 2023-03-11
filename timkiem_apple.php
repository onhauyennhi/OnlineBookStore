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
    if(isset($_POST['timkiem'])){
        $tukhoa = $_POST['tukhoa'];
    }else{
        $tukhoa="";
    }
    $tukhoa=!empty($_GET['tukhoa'])?$_GET['tukhoa']:$tukhoa;
    $item_page=!empty($_GET['per_page'])?$_GET['per_page']:8;
    $current_page=!empty($_GET['page'])?$_GET['page']:1;
    $offset=($current_page - 1)* $item_page;
    $sql_pro="SELECT * FROM product WHERE categoryID='1' AND productName LIKE '%$tukhoa%' LIMIT ".$item_page." offset " .$offset;
    $sql_pd=mysqli_query($con,"select * from product where categoryID='1' AND productName Like '%$tukhoa%'");
    $totalRecord=mysqli_num_rows($sql_pd);
    $totalPage=ceil($totalRecord/$item_page);   
?>
<div class="row">
                <div class="col l-12">
                    
                    <div class="row card-products">
                        <?php
                        
                        
                        $sql_product=mysqli_query($con,$sql_pro);
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
                            <?php for($number=1;$number<=$totalPage;$number++){
                                ?>
                                <li><a href="?quanly=timkiem&&id=<?php echo $id; ?>&&per_page1=8&page1=<?php echo $number;?>"><?php echo $number;?></a></li>
                                <?php 
                                 if(isset($_POST['timkiem'])){
                                    $tukhoa = $_POST['tukhoa'];
                                }
                             } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>