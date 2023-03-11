<?php
    include_once('db/connect.php');
    $err=[]; //tạo một mảng chứa text lỗi
    if(isset($_POST['register'])){
        $fullname=$_POST['registerName'];
        $username=$_POST['registerUser'];
        $password=$_POST['registerPass'];
        $rPassword=$_POST['registerPassConf'];
        $phone=$_POST['registerPhone'];
        $role='customer';
        $sql_check="SELECT * FROM account where username ='$username'";
        $check_query=mysqli_query($con,$sql_check);
        $data=mysqli_num_rows($check_query);
        if(empty($fullname)){ //nếu fullname trống
            $err['fullname'] ='Bạn chưa nhập họ tên!';
        }
        if(empty($username)){//nếu username trống
            $err['username']='Bạn chưa nhập tên đăng nhập!';
        }else if($data>0){
            $err['username']="Tên tài khoản đã tồn tại!";
        }
        if(empty($phone)){//nếu phone trống
            $err['phone']='Số điện thoại không được để trống!';
        }else if(is_integer($phone) || strlen($phone)!=10){
            $err['phone']='Số điện thoại không hợp lệ!';
        }
        if(empty($password)){//nếu password trống
            $err['password'] ='Bạn chưa nhập mật khẩu!';
        }else if(!empty($password) && strlen($password)<6){
            $err['password']="Mật khẩu phải dài hơn 6 kí tự!";
        }
        if(empty($rPassword)){//nếu rPassword trống
            $err['rPassword']='Bạn chưa nhập lại mật khẩu';
        }
        if($password!=$rPassword){//nếu nhập lại không giống
            $err['rPassword']='Mật khẩu nhập lại không đúng!';
        }
        if(empty($err)){ //nếu không có lỗi nào
            $sql="INSERT INTO account(fullname,username,password,phone,role) VALUES('$fullname','$username','$password','$phone','$role')";
            $sql_query=mysqli_query($con,$sql);
            if($sql_query){//thực thi câu lệnh thành công
                echo '<script>alert("Bạn đã đăng ký thành công!")</script>';
                echo "<script>window.location.href = 'login.php';</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="css/register.css">
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

    <div class="register-wrapper">
        <form action="" class="formRegister" method="POST" role="form" >
            <h1>ĐĂNG KÝ</h1>
            <div class="input-gr">
                <input type="text" name="registerName" id="registerName" placeholder="Nhập đầy đủ họ tên" value="<?php if(isset($fullname)) echo $fullname ?>">
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
            </div>
            <div class="input-gr">
                <input type="text" name="registerUser" id="registerUser" placeholder="Nhập tên đăng nhập" value="<?php if(isset($username)) echo $username ?>">
                <div class="has-error">
                    <span><?php 
                    if(isset($err['username'])){
                        echo $err['username'];
                    }else{
                        echo '';
                    }
                    
                    ?></span>
                </div>
            </div>
            <div class="input-gr">
                <input type="password" name="registerPass" id="registerPass" placeholder="Nhập mật khẩu" value="<?php if(isset($password)) echo $password ?>">
                <div class="has-error">
                    <span><?php 
                    if(isset($err['password'])){
                        echo $err['password'];
                    }else{
                        echo '';
                    }
                    ?></span>
                </div>
            </div>
            <div class="input-gr">
                <input type="password" name="registerPassConf" id="registerPassConf" placeholder="Nhập lại mật khẩu" value="<?php if(isset($rPassword)) echo $rPassword ?>">
                <div class="has-error">
                    <span>
                    <?php 
                        if(isset($err['rPassword'])){
                            echo $err['rPassword'];
                        }else{
                            echo '';
                        }
                    ?>
                    </span>
                </div>
            </div>
            <div class="input-gr">
                <input type="text" name="registerPhone" id="registerPhone" placeholder="Nhập số điện thoại" value="<?php if(isset($phone)) echo $phone ?>">
                <div class="has-error">
                    <span><?php 
                    if(isset($err['phone'])){
                        echo $err['phone'];
                    }else{
                        echo '';
                    }
                    
                    ?></span>
                </div>
            </div>
            <input type="submit" value="Đăng ký" name="register" class="btnSubmit"></br>
            <p>Bạn đã có tài khoản? Nhấn vào đây để <a href="login.php" class="toLogin">đăng nhập</a></p>
        </form>
    </div>
    <?php
        include('include/footer.php');
    ?>
</body>
</html>