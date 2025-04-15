<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <!-- <link rel="stylesheet" href="assets/css/product.css" /> -->
        <script type="text/javascript" src="assets/js/script.js" defer></script>
        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="trangchu.php">
                <img src="assets/images/logo.png" alt="logo" height="70px" width="70px"></a>
            </div>
            <div class="menu">
                <li><a href="trangchu.php?act=home">TRANG CHỦ</a></li>
                <li><a href="trangchu.php?act=use_discount">ƯU ĐÃI</a></li>
                <li><a href="trangchu.php?act=sanpham_user">BỘ SƯU TẬP</a></li>
                <li><a href="trangchu.php?act=donhang">ĐƠN HÀNG</a></li>
                <?php
                    // Kiểm tra nếu người dùng đã đăng nhập
                    if (!isset($_SESSION['user_id']) && !isset($_SESSION['user'])) {
                        // Chưa đăng nhập thì hiển thị "Đăng nhập" và "Đăng ký"
                        echo '<li><a href="login.php">ĐĂNG NHẬP</a></li>';
                        echo '<li><a href="register.php">ĐĂNG KÝ</a></li>';
                    } else {
                        // Nếu đã đăng nhập thì hiển thị "Đăng xuất"
                        echo '<li><a href="trangchu.php?act=dangxuat">ĐĂNG XUẤT</a></li>';
                    }
                ?>
            </div>
            <div class="oders">
                <li><input placeholder="Tìm kiếm" type="text"> <i class="fas fa-search"></i></li>
                <li> <a class="fa fa-paw" href="" ></a></li>
                <li> <a class="fa fa-user" href="trangchu.php?act=account" ></a></li>
                <li> <a class="fa fa-shopping-bag" href="trangchu.php?act=viewcart" ></a></li>
            </div>
        </header>
    </body>
</html>