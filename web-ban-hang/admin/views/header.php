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
            <li>
            <form action="trangchu.php?act=search" method="GET" style ="display: inline-flex;height: 20px;width: 300px;align-items: center;">
            <input type="hidden" name="act" value="search">
            <input name="keyword" placeholder="Tìm kiếm" type="text" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                <button class="fas fa-search"></button>
        </form>
    </li> 
                <li> <a class="fa fa-paw" href="" ></a></li>
                <li> <a class="fa fa-shopping-bag" href="trangchu.php?act=viewcart" ></a></li>
                <?php 
// Kiểm tra xem user có avatar không
$user_ava = getall_user_ava(); // Lấy danh sách avatar
$avatar = "assets/images/default-avatar.jpg"; // Mặc định

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];

    // Tìm avatar theo ID
    foreach ($user_ava as $u) {
        if ($u['id'] == $id && !empty($u['imgav'])) {
            $avatar = "assets/img/" . $u['imgav'];
            break;
        }
    }
}
?>

                <li> <a  href="trangchu.php?act=account" ><img src="<?= htmlspecialchars($avatar) ?>" id="avatar-preview" alt="Avatar" width="20" style="border-radius: 50%;"></a></li>
                
       



            </div>
        </header>
    </body>
</html>