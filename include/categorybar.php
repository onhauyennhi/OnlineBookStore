<?php 
        $sql_category= mysqli_query($con,"SELECT * FROM category ORDER BY categoryID ASC");
    ?>
    <div class="grid wide container" style="padding-top: 0;">
        <div class="row" style="align-items: flex-start;">
            <div class="col l-3" >
                <div class="navigation-box-content">
                    <?php
                        while($row_category=mysqli_fetch_array($sql_category)){
                    ?>
                        <a href="productpage.php?id=<?php echo $row_category['categoryID']; ?>">
                            <div style="border-bottom: 1px solid #7C6E7F;">
                        
                            <p value="<?php echo $row_category['categoryID']?>">
                                <?php
                                    echo $row_category['categoryName'];
                                ?>
                            </p>
                            <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </a>
                        <?php
                        }
                    
                    ?>
                </div>                
            </div>
            <div class="col l-6" style="padding-top: 0;">
                <div class="row no-gutters">
                    <div class="col l-12">
                        <div class="first-banner">
                            <img src="images/first_banner.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col l-6">
                        <div class="second-banner">
                            <img src="images/second_banner.jpg" alt="">
                        </div>
                    </div>
                    <div class="col l-6">
                        <div class="third-banner">
                            <img src="images/third_banner.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l-3">
                <div class="fourth-banner">
                    <img src="images/fourth-banner.jpg" alt="">
                </div>
            </div>
        </div>
    </div>