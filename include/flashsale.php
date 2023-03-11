<?php
    $sql_flashsale_query="SELECT * FROM product ORDER BY productID ASC";
    $sql_flashsale=mysqli_query($con,$sql_flashsale_query);
?>
    <!-- Flash Sale -->
    <div class="grid wide container flash-sale-grid">
        <div class="row no-gutters">
            <div class="col l-12 flash-sale">
                <h2>FLASH</h2>
                <i class="fa-solid fa-bolt"></i>
                <h2>SALE</h2>
            </div>
        </div>
        <div class="row">
            <div class="col l-12">
                <div class="row card-products">
                    <?php while($row_flashsale=mysqli_fetch_array($sql_flashsale)){ 
                        if($row_flashsale['productHot']==2){
                    ?>
                    <div class="col l-3 card-product">
                        <a href="pages/productdetail.php?id=<?php echo $row_flashsale['productID']; ?> ">
                            <img src="images/<?php echo $row_flashsale['productImage']; ?>" alt="">
                            <div>
                                <p class="product-name"><?php echo $row_flashsale['productName']; ?></p>
                                <p class="price"><?php echo number_format($row_flashsale['productPrice']); ?><span>VNĐ</span></p>
                            </div>
                        </a>
                    </div>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>