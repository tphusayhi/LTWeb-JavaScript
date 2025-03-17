<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    
</head>
<body>
<header class="page-header">
    <div class="panel wrapper">
        <div class="panel header">
            <div class="header-content">
                <div class="logo-header">
                    <a class="logo" href="https://jollibee.com.vn/" title="Logo Jollibee" aria-label="store logo">
                        <img src="https://jollibee.com.vn/static/version1741791982/frontend/Jollibee/default/vi_VN/images/logo.png" title="Logo Jollibee" alt="Logo Jollibee" width="100" height="100">
                    </a>
                </div>

                <nav class="nav-sections-top">
                    <ul class="nav-menu">
                        <li class="level0 level-top ui-menu-item home"><a href="indexs.php">Trang Chủ</a></li>
                        <li class="level0 level-top ui-menu-item about"><a href="indexs.php?act=danhmuc">Danh Mục</a></li>
                        <li class="level0 level-top parent ui-menu-item"><a href="indexs.php?act=sanpham">Sản Phẩm</a></li>
                        <li class="level0 level-top ui-menu-item item-promotion"><a href="indexs.php?act=khuyenmai">Khuyến mãi</a></li>
                        <li class="level0 level-top ui-menu-item service"><a href="indexs.php?act=giohang">Giỏ Hàng</a></li>
                        <li class="level0 level-top ui-menu-item news"><a href="indexs.php?act=taikhoan">Tài Khoản</a></li>
                    </ul>
                </nav>


                <ul class="header links">
                    <li class="authorization-link">
                        <a href="/dang-nhap" class="login">Đăng Nhập</a>
                    </li>
                    <li class="authorization-link">
                        <a href="/dang-ky" class="register">Đăng Ký</a>
                    </li>
                </ul>
         

                
    
            </div>
        </div>
    </div>
</header>

<script>
    function handleFormSubmit() {
        var selectionProvince = document.getElementById('province-selector');
        var indexProvince = selectionProvince.selectedIndex;
        var selectionDistrict = document.getElementById('district-selector');
        var indexDistrict = selectionDistrict.selectedIndex;
        smartech('dispatch', 'Select Location', {
            'city': selectionProvince.options[indexProvince].text,
            'district': selectionDistrict.options[indexDistrict].text,
        });
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
