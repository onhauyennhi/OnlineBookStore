<?php
    include('db/connect.php');
    include('include/useradmin.php');
    $sql="SELECT * FROM product ORDER BY productID";
    $sql_query=mysqli_query($con,$sql);
?>

<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $query = "SELECT * FROM account WHERE accountID = $id";
    $result = mysqli_query($con,$query);
    $rows = mysqli_fetch_assoc($result);
?>

<?php
    $err=[];
    if(isset($_POST['editAccount'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $phone=$_POST['phone'];
        $fullname=$_POST['fullname'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        if($_POST['role']==1){
            $role='admin';
        }else if($_POST['role']==2){
            $role='customer';
        }
        if(empty($username)){
            $err['username']='Tên tài khoản không được bỏ trống!';
        }
        if(empty($password)){
            $err['password']='Mật khẩu không được bỏ trống!';
        }else if(!empty($password) && strlen($password)<6){
            $err['password']="Mật khẩu phải dài hơn 6 kí tự!";
        }
        if(empty($phone)){
            $err['phone']='Số điện thoại không được bỏ trống!';
        }else if(is_integer($phone) || strlen($phone)!=10){
            $err['phone']='Số điện thoại không hợp lệ!';
        }
        if(empty($fullname)){
            $err['fullname']='Họ tên không được bỏ trống!';
        }
        $regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
        if(empty($email)){
            $err['email']='Phải nhập vào email!';
        }else if(!preg_match($regex,$email)){
                $err['email'] ='Email không đúng định dạng!';
        }
        if(empty($address)){
            $err['address']='Địa chỉ không được bỏ trống!';
        }
        if(empty($role)){
            $err['role']='Bạn phải chọn quyền!';
        }
            if(empty($err)){
                $updateAccount="UPDATE account SET fullname = '$fullname' , username = '$username', password = '$password', 
                    phone = '$phone', email = '$email', address = '$address',role='$role' WHERE accountID = $id";
                $sqlUpdate=mysqli_query($con,$updateAccount);
                echo '<script>alert("Bạn đã sửa thông tin tài khoản thành công!")</script>';
                echo "<script>window.location.href = 'admin_account.php';</script>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
              integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <link rel="stylesheet" href="css/ad.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
    <style>
    .table-bordered {
    border: 1px solid #dee2e6;
    margin: 20px 0;
}
.admin-left a:hover {
    color: red;
    transition: 0.2s ease-in-out;
}
.admin-left a {
    text-decoration: none;
    color: black;
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
    <div class="wrapper">
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
    <div class="content-product-function">
        <div class="add-product">
                    <h1>SỬA TÀI KHOẢN</h1>
                <form action="" method="POST">
                <label for="fullname">Tên khách hàng</label>
                <input type="text" name="fullname" value="<?php echo $rows['fullname'] ?>">
                <div class="has-error">
                    <span>
                        <?php  
                            if(isset($err['fullname'])){
                                echo $err['fullname'];
                            }else{
                                echo '';
                            }
                        ?>               
                    </span>
                </div>

                <label for="username">Tên tài khoản</label>
                <input type="text" name="username" value = "<?php echo $rows['username']; ?>">
                <div class="has-error">
                    <span>
                        <?php  
                            if(isset($err['username'])){
                                echo $err['username'];
                            }else{
                                echo '';
                            }
                        ?>               
                    </span>
                </div>

                <label for="password">Password</label>
                <input type="password" name="password" value = "<?php echo $rows['password']?>">
                <div class="has-error">
                    <span>
                        <?php  
                            if(isset($err['password'])){
                                echo $err['password'];
                            }else{
                                echo '';
                            }
                        ?>               
                    </span>
                </div>

                
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" value = "<?php echo $rows['phone']?>">                
                <div class="has-error">
                    <span>
                        <?php  
                            if(isset($err['phone'])){
                                echo $err['phone'];
                            }else{
                                echo '';
                            }
                        ?>               
                    </span>
                </div>

                <label for="email">Email</label>
                <input type="text" name="email" value = "<?php echo $rows['email']?>">                
                <div class="has-error">
                    <span>
                        <?php  
                            if(isset($err['email'])){
                                echo $err['email'];
                            }else{
                                echo '';
                            }
                        ?>               
                    </span>
                </div>

                <label for="address">Địa chỉ:</label>
                <input type="text" name="address" value = "<?php echo $rows['address']?>">                
                <div class="has-error">
                    <span>
                        <?php  
                            if(isset($err['address'])){
                                echo $err['address'];
                            }else{
                                echo '';
                            }
                        ?>               
                    </span>
                </div>

                <label for="role">Quyền</label>
                
                <select name="role" id="role">
                    <option value="" selected>Chọn quyền tài khoản</option>
                    <option value="1">Admin</option>
                    <option value="2">Customer</option>
                </select>
                <div class="has-error">
                    <span>
                        <?php  
                            if(isset($err['role'])){
                                echo $err['role'];
                            }else{
                                echo '';
                            }
                        ?>               
                    </span>
                </div>
                    </br>
                
                <button  type="submit" name="editAccount">SỬA Tài Khoản</button>
                
                </form>

        </div>
    </div>
</div>       
<br> 
</div>
</body>
</html>