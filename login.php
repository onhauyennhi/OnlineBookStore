<?php
    include('db/connect.php');
    $err=[];
    if(isset($_POST['login'])){
        $username=$_POST['loginUser'];
        $password=$_POST['loginPass'];
        $sql="SELECT * FROM account WHERE username='$username'";
        $sql_query=mysqli_query($con,$sql);
        $data=mysqli_fetch_assoc($sql_query);//truy vấn cơ sở dữ liệu
        $check_username=mysqli_num_rows($sql_query); //trả về số lượng hàng trong csdl
        if($check_username==1){//có dữ liệu tồn tại
            if($password==$data['password'] ){
                $_SESSION['user']=$data;
                if($data['role']=="customer"){
                    echo '<script>alert("Chào mừng bạn đến mua hàng!")</script>';
                    echo "<script>window.location.href = 'index.php';</script>";
                }else if($data['role']=="admin"){
                    echo '<script>alert("Chào mừng admin!")</script>';
                    echo "<script>window.location.href = 'admin.php';</script>";
                }
                
            }else{
                $err['password']='Sai mật khẩu';
            }

        }else{
            $err['username']='Tên đăng nhập không tồn tại!';
        }
        if(empty($username)){//nếu username trống
            $err['username']='Bạn chưa nhập tên đăng nhập';
        }
        if(empty($password)){//nếu username trống
            $err['password']='Bạn chưa nhập mật khẩu';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/grid.css">
</head>
<body>
    <header class="header">
      <div class="container">
        <div class="header__logo">
            <h2>
                <span style="color: white;">DVN</span>
                <span style="color: #B90E0A;">CellphoneS</span>
            </h2>
        </div>
        <nav class="header__nav">
          <a href="index.php">Trang Chủ</a>
          <a href="">Tin tức</a>
          <a href="">Thông Báo</a>
          <a href="pages/introduce.php">Giới thiệu</a>
        </nav>
      </div>
    </header>
    <div class="login-wrapper">

        <form action="" class="form" method="POST">
            <h1>ĐĂNG NHẬP</h1>
            <div class="input-gr">
                <input type="text" name="loginUser" id="loginUser" placeholder="Nhập tên đăng nhập" value="<?php if(isset($username)) echo $username ?>">
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
            </div>
            <div class="input-gr">
                <input type="password" name="loginPass" id="loginPass" placeholder="Nhập mật khẩu" value="<?php if(isset($password)) echo $password ?>">
                <div class="has-error">
                    <span><?php 
                            if(isset($err['password'])){
                                echo $err['password'];
                            }else{
                                echo '';
                            } 
                        ?>
                    </span>
                </div>
            </div>
            <input type="submit" value="Đăng nhập" name="login" class="btnSubmit"></br>
            <p>Bạn chưa có tài khoản? Nhấn vào đây để <a href="register.php" class="toRegister">đăng kí</a></p>
        </form>
    </div>
    <?php
        include('include/footer.php');
    ?>
</body>
</html>