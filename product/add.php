<!--Thêm -->
<?php
    $err=[];
    if(isset($_POST['addProduct'])){
        $productImage=$_POST['productImage'];
        $productName=$_POST['productName'];
        $productPrice=$_POST['productPrice'];
        $productQuantity=$_POST['productQuantity'];
        $productBrand=$_POST['productBrand'];
        $productDetail=$_POST['productDetail'];
        if(empty($productImage)){
            $err['productImage']='Sản phẩm phải có hình ảnh!';
        }
        
        if(is_numeric($productQuantity)==false){
            $err['productQuantity']='Số lượng sản phẩm không hợp lệ!';
        }
        if($productQuantity>0){
            if(is_numeric($productQuantity)==false){
                $err['productQuantity']='Số lượng sản phẩm không hợp lệ!';
            }
        }else if($productQuantity<0){
            $err['productQuantity']='Số lượng sản phẩm không được âm!';
        }
        if(!is_string($productName)){
            $err['productName']='Tên sản phẩm không đúng định dạng!';
        }
        if(empty($productName)){
            $err['productName']='Sản phẩm phải có tên!';
        }
        if($productPrice>0){
            if(is_numeric($productPrice)==false){
                $err['productPrice']='Giá sản phẩm không hợp lệ!';
            }
        }else if($productPrice<0){
            $err['productPrice']='Giá sản phẩm không được âm!';
        }
        if(empty($productPrice)){
            $err['productPrice']='Phải nhập vào giá sản phẩm!';
        }
        if(empty($productQuantity)){
            $err['productQuantity']='Phải nhập vào số lượng sản phẩm!';
        }
        if(empty($productBrand)){
            $err['productBrand']='Phải chọn brand của sản phẩm!';
        }
        if(empty($productDetail)){
            $err['productDetail']='Phải ghi chi tiết sản phẩm!';
        }
        if(isset($user['username'])){
            if(empty($err)){
                $insertProductQuery="insert into product(categoryID,productName,productPrice,productQuantity,productImage,productDetail) values('$productBrand','$productName','$productPrice','$productQuantity','$productImage','$productDetail')";
                $sqlInsertProduct=mysqli_query($con,$insertProductQuery);
                if($sqlInsertProduct){
                    echo '<script>alert("Bạn đã thêm sản phẩm thành công!")</script>';
                    echo "<script>window.location.href = 'admin_product.php';</script>";
                }
            }
            }
        else{
            echo '<script>alert("Bạn phải đăng nhập để thực hiện chức năng!")</script>';
        }   
    }
    
?>