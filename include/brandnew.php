<?php 
    //phân trang
   $item_page=!empty($_GET['per_page'])?$_GET['per_page']:16;
   $current_page=!empty($_GET['page'])?$_GET['page']:1;
   $offset=($current_page - 1)* $item_page;
   $sql_brandnew_limit="SELECT * FROM product ORDER BY productID ASC LIMIT ".$item_page." offset " .$offset ;
   $sql_pd=mysqli_query($con,"select * from product");
   $totalRecord=mysqli_num_rows($sql_pd);
   $totalPage=ceil($totalRecord/$item_page);
   $row_brandnew_limit=mysqli_query($con,$sql_brandnew_limit);
?>

<!-- Brand new -->
    <div class="grid trend-grid">
        <div class="grid wide container">
            <div class="row" style="margin-bottom: 35px;">
                
                <div class="col l-12 brand-new">
                    <div class="brand-new-title">
                        <h2>TẤT CẢ SẢN PHẨM</h2>
                    </div>
                    <div class="brand-new-category">
                        <?php
                            $sql_ca=mysqli_query($con,"SELECT * FROM category ORDER BY categoryID ASC");
                            while($row_ca=mysqli_fetch_array($sql_ca)){
                        ?>
                        <a href="productpage.php?id=<?php echo $row_ca['categoryID']; ?>">
                            <div class="brand-new-branches">
                                <span><?php echo $row_ca['categoryName']; ?></span>
                            </div>
                        </a>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col l-12">
                    <div class="row card-products">
                  
                        <?php
                            while($row_brandnew=mysqli_fetch_array($row_brandnew_limit)){
                                
                        ?>
                        <div class="col l-3 card-product">
                        <a href="pages/productdetail.php?id=<?php echo $row_brandnew['productID']; ?> "><img src="images/<?php echo $row_brandnew['productImage']; ?>" alt="">
                            <div>
                                <p class="product-name"><?php echo $row_brandnew['productName']; ?></p>
                                <p class="price"><?php echo number_format($row_brandnew['productPrice']); ?><span>VNĐ</span></p>
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
                                <li><a href="?per_page=<?php echo $item_page ?>&page=<?php echo $first_page;?>&page=<?php echo $first_page;?>">First</a></li>
                                <?php 
                                }
                                ?>
                                <?php
                                for($number=1;$number<=$totalPage;$number++){
                                    if($number!=$current_page){
                                        if($number>$current_page-3 && $number<$current_page+3){
                                ?>
                                <li><a href="?per_page=<?php echo $item_page ?>&page=<?php echo $number;?>"><?php echo $number;?></a></li>

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
                                <li><a href="?per_page=<?php echo $item_page ?>&page=<?php echo $number;?>&page=<?php echo $end_page;?>">Last</a></li>
                                <?php 
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>