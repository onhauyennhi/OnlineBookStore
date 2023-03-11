


    <?php
        
        $sql_cate_home=mysqli_query($con,"SELECT * FROM category ORDER BY categoryID ASC");
        while($row_cate_home=mysqli_fetch_array($sql_cate_home)){
            $id_category=$row_cate_home['categoryID'];
    ?>
    <!-- Iphone -->
    <div class="grid wide container">
        <div class="row" style="align-items: flex-start;">
        
            <div class="col l-9">
                <div class="row no-gutters">
                    <div class="col l-12 type-of-product">
                        <h2>
                            <?php
                                echo $row_cate_home['categoryName'];
                            ?>

                        </h2>
                    </div>
                </div>
                <div class="row card-products">
                    <?php
                    $item_page=!empty($_GET['per_page'])?$_GET['per_page']:3;
                    $current_page=!empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page - 1)* $item_page;
                    $sql_pd=mysqli_query($con,"select * from product where categoryID=$id_category");
                    $totalRecord=mysqli_num_rows($sql_pd);
                    $totalPage=ceil($totalRecord/$item_page);
                    $pd_query="SELECT * FROM product where categoryID=$id_category ORDER BY productID ASC  LIMIT ".$offset.",".$item_page;
                    $sql_product=mysqli_query($con,$pd_query);
                    while($row_product=mysqli_fetch_array($sql_product)){
                            if($row_product['categoryID']==$id_category){
                    ?>
                    <div class="col l-4 card-product">
                        <a href="pages/productdetail.php?id=<?php echo $row_product['productID']; ?> ">
                            <img src="images/<?php echo $row_product['productImage'];  ?>" alt="">
                            <div>
                                <p class="product-name"><?php echo $row_product['productName']; ?></p>
                                <p class="price"><?php echo number_format($row_product['productPrice']); ?><span>VNĐ</span></p>
                            </div>
                        </a>
                    </div>
                    <?php
                        }
                    }
                    
                    ?>  
                    <div class="pagination">
                            <ul id="paging">
                                <?php for($number=1;$number<=$totalPage;$number++){
                                ?>
                                <li><a href="?categoryName=<?php echo $row_cate_home['categoryName'] ?>&&per_page=3&page=<?php echo $number;?>"><?php echo $number;?></a></li>
                                <?php 
                                }
                                ?>
                            </ul>
                        </div>
                </div>
                
                
            </div>
            <div class="col l-3" >
                <div class="row no-gutters">
                    <div class="col l-12 another-types">
                        <h2>Sản phẩm khác</h2>
                    </div>
                </div>
                <div class="row no-gutters card-products-another">
                    <?php 
                        $sql_normal=mysqli_query($con,"SELECT * FROM product ORDER BY productID ASC");
                        while ($row_normal=mysqli_fetch_array($sql_normal)) {
                            if($row_normal['productHot']==3){
                    ?>
                    <a href="pages/productdetail.php?id=<?php echo $row_normal['productID']; ?>">
                        <div class="col l-12 card-product-another">
                                <img src="images/<?php echo $row_normal['productImage'];?>" alt="">
                                <div>
                                    <p class="product-name-another"><?php echo $row_normal['productName'];?></p> <br>
                                    <p class="price-another"><?php echo number_format($row_normal['productPrice']);?><span>VNĐ</span></p>
                                </div>
                            
                        </div>
                    </a>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div class="grid wide container">
        <div class="row no-gutters">
            <div class="col l-12 name-of-brand">
                <h2>ĐẠI LÝ CHÍNH HÃNG</h2>
            </div>
        </div>
        <div class="row">
            <div class="col l-2 brand">
                <img src="images/apple_logo.png" alt="">
            </div>
            <div class="col l-2 brand">
                <img src="images/samsung-logo.jpg" alt="">
            </div>
            <div class="col l-2 brand">
                <img src="images/oppo_logo.jpg" alt="">
            </div>
            <div class="col l-2 brand">
                <img src="images/xiaomi_logo.png" alt="">
            </div>
            <div class="col l-2 brand">
                <img src="images/huawei_logo.jpg" alt="">
            </div>
            <div class="col l-2 brand">
                <img src="images/vivo-logo.jpg" alt="">
            </div>
        </div>
    </div>
