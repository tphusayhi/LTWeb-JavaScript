<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin-style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
            transition: background 0.3s ease-in-out;
        }
        .header {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: background 0.3s, transform 0.2s;
        }
        .sidebar a:hover {
            background: #495057;
            transform: translateX(5px);
        }
        .content {
            margin-left: 250px;
            padding: 80px 20px 20px;
            width: 100%;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.classList.add("fade-in");
        });
    </script>
</head>
<body>
    <div class="header">
        Admin Dashboard
    </div>
    <div class="sidebar">
        <h3 class="text-center">Admin Panel</h3>
        <a href="#"><i class="fas fa-home"></i> Trang chủ</a>
        <a href="indexs.php?act=sanpham"><i class="fas fa-box"></i> Sản phẩm</a>
        <a href="indexs.php?act=danhmuc"><i class="fas fa-list"></i> Danh mục</a>
        <a href="#"><i class="fas fa-users"></i> Khách hàng</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> Đơn hàng</a>
        <a href="#"><i class="fas fa-cogs"></i> Cài đặt</a>
        <a href="indexs.php?act=dangxuat"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>
    <!-- <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Sản phẩm</h5>
                        <p>Quản lý danh sách sản phẩm.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Khách hàng</h5>
                        <p>Danh sách khách hàng.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Đơn hàng</h5>
                        <p>Quản lý đơn hàng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</body>
</html>
