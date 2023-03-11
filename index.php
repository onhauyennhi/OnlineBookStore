<?php
if (isset($_GET['quanly'])) {
    $quanly = $_GET['quanly'];
} else {
    $quanly = '';
}
include_once('db/connect.php');
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if ($user['role'] == "admin") {
        echo '<script>alert("Admin không thể truy cập vào trang index!")</script>';
        header('location:login.php');
    }
} else {
    $user = [];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script defer src="js/javaScript.js"></script>
</head>
<style>
    a {
        text-decoration: none
    }

    .brand-new-title h2 {
        margin: 20px 0;
    }

    .grid-banner {
        /* display: grid; */
        margin-left: auto;
        width: 91.666667%;
        margin-top: 1rem;
        gap: 1rem;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        display: grid;
        margin-right: auto;
    }

    strong.current-page-item li a {
        color: white;
        background: #281E5D;
    }

    .banner-grid-cate {
        width: 100%;
        position: relative;
    }

    img.banner-cate-img {
        /* width: 100%; */
        max-width: 100%;
        height: auto;
        display: block;
        overflow: hidden;
    }

    .banner-cate-text {
        top: 50%;
        bottom: 50%;
        left: 1rem;
        position: absolute;
    }
</style>

<body>
    <div class="grid header">
        <div class="grid wide container">
            <?php
            include('include/topbar.php');
            include('include/menubar.php');
            ?>
        </div>
    </div>


    <?php
    include('include/categorybar.php');
    ?>
    <!-- <section>
        <div class="grid-banner">
            <div class="banner-grid-cate">
                
                <div class="banner-cate-text">
                    <h4 class="text-black tracking-wider text-xl md:text-sm lg:text-2xl font-semibold">Điện thoại</h4>
                    <a href="#" class="text-lg text-black tracking-wider hover:text-orange-300 duration-300 mt-0.5">Mua Ngay</a>
                </div>
            </div>
            <div class="banner-grid-cate">
            
                <div class="banner-cate-text">
                    <h4 class="text-black tracking-wider text-xl md:text-sm lg:text-2xl font-semibold">Phụ kiện</h4>
                    <a href="#" class="text-lg text-black tracking-wider hover:text-orange-300 duration-300 mt-0.5">Mua Ngay</a>
                </div>
        </div>
        </div>
    </section> -->
    <?php
    if ($quanly == 'timkiem') {
        include('timkiem.php');
    } else {
        include('include/brandnew.php');
    }
    ?>
    <?php
    include('include/banner.php');
    ?>
    <!-- Brand --> <!-- Footer -->

    <?php
    include('include/footer.php');
    ?>


</body>

</html>