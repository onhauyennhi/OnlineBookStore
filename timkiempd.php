<?php
    if(isset($_POST['timkiem'])){
        $tukhoa = $_POST['tukhoa'];
    }        
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id='';
    }
    $tukhoa=!empty($_GET['tukhoa'])?$_GET['tukhoa']:$tukhoa;
    $item_page1=!empty($_GET['per_page1'])?$_GET['per_page1']:8;
    $current_page1=!empty($_GET['page1'])?$_GET['page1']:1;
    $offset1=($current_page1 - 1)* $item_page1;
    $sql_limit="SELECT * FROM product WHERE productID='$id' AND productName LIKE '%$tukhoa%' LIMIT ".$item_page1." offset " .$offset1 ;
    $sql_limit1="SELECT * FROM product WHERE productID='$id' AND productName LIKE '%$tukhoa%'";
    $sql_pd=mysqli_query($con,$sql_limit1);
    $totalPage=ceil(mysqli_num_rows($sql_pd)/$item_page1);  
    $row_brandnew_limit=mysqli_query($con,$sql_limit);
?>
<!-- Brand new -->
    <div class="grid trend-grid">
        <div class="grid wide container">
            <div class="row" style="margin-bottom: 35px;">
                
                <div class="col l-12 brand-new">
                    <div class="brand-new-title">
                        <h2>TỪ KHÓA BẠN ĐÃ TÌM : <?php echo $tukhoa; ?></h2> 
                    </div>
                    <form action="productpage.php?id=<?php echo $row_product_page['categoryID']; ?>&&quanly=timkiempd" method="POST" class="search-bar">
                        <input type="text" placeholder="Tìm kiếm sản phẩm..." name="tukhoa">
                        <button type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form> 
                    <div class="brand-new-category">
                        <?php
                            $sql_ca=mysqli_query($con,"SELECT * FROM category ORDER BY categoryID ASC");
                            while($row_ca=mysqli_fetch_array($sql_ca)){
                        ?>
                        
                            
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
                                if($row_brandnew['productHot']==1){
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
                        }
                        ?>
                    </div>
                    <div class="pagination">
                            <ul id="paging">
                                <?php for($number=1;$number<=$totalPage;$number++){
                                ?>
                                <li><a href="?quanly=timkiem&&tukhoa=<?php echo $tukhoa; ?>&&per_page1=8&page1=<?php echo $number;?>"><?php echo $number;?></a></li>
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
    </div>