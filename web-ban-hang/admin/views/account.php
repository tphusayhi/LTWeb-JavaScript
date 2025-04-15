<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang tài khoản</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 40px;
        }

        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            padding: 30px;
            flex-wrap: wrap;
        }

        .sidebar {
            width: 250px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .avatar-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #ddd;
        }

        .avatar-upload-overlay {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 5px 10px;
            border-radius: 20px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .avatar-container:hover .avatar-upload-overlay {
            opacity: 1;
        }

        .avatar-upload-overlay button {
            color: #fff;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }

        .profile {
            text-align: center;
            margin-top: 15px;
        }

        .profile h2 {
            font-size: 18px;
        }

        .profile p {
            font-size: 14px;
            color: gray;
        }

        .nav-links {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
        }

        .nav-links a {
            padding: 10px;
            text-align: left;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .nav-links a.active,
        .nav-links a:hover {
            background-color: #eee;
        }

        .main-content {
            flex: 1;
            min-width: 300px;
        }

        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-box {
            background: white;
            padding: 20px;
            flex: 1;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            min-width: 200px;
        }

        .stat-box h3 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #666;
        }

        .orders {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            padding: 20px;
        }

        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: bold;
    color: #fff;
    text-align: center;
    white-space: nowrap;
}

/* Mỗi trạng thái một màu riêng */
.badge-pending {
    background-color: #ffc107; /* vàng */
    color: #212529;             /* chữ đen dễ đọc */
}

.badge-packing {
    background-color: #007bff; /* xanh dương */
}

.badge-shipping {
    background-color: #17a2b8; /* xanh nhạt */
    color: #212529;
}

.badge-completed {
    background-color: #28a745; /* xanh lá */
}

.badge-cancelled {
    background-color: #dc3545; /* đỏ */
}

        

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-outline-primary {
            border: 1px solid #007bff;
            color: #007bff;
            background: none;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<?php
$tongDonHang = 0; // Khởi tạo biến đếm tổng số đơn hàng
$tongTienTatCa = 0; // Khởi tạo biến tính tổng tiền tất cả đơn hàng
$tongsoluong=0;

if (!empty($orders)): 
    foreach ($orders as $order): 
        $tongDonHang++; // Tăng số lượng đơn hàng
        $tongTienTatCa += $order['tongtien']; // Cộng dồn tổng tiền
    endforeach;
endif;
if (!empty($_SESSION['giohang'])) {
    foreach ($_SESSION['giohang'] as $item) {
        $tongsoluong += $item[4]; // Cộng dồn số lượng sản phẩm trong giỏ hàng
    }
}
?>
<div class="container">
    <div class="sidebar">
        <div class="avatar-container">
            <img src="images/default-avatar.png" id="avatar-preview">
            <div class="avatar-upload-overlay">
                <input type="file" id="avatar-input" accept="image/*" style="display: none;">
                <button onclick="document.getElementById('avatar-input').click()"><i class="fas fa-camera"></i> Thay đổi</button>
            </div>
        </div>
        <div class="profile">
        <h2 id="username"><?= isset($user['username']) ? htmlspecialchars($user['username']) : '' ?></h2>
        <p id="email"><?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?></p>
        </div>
        <div class="nav-links">
            <a href="#" class="active"><i class="fas fa-home"></i> Trang chủ</a>
            <a href="trangchu.php?act=thongtincanhan"><i class="fas fa-user"></i> Thông tin cá nhân</a>
            <a href="trangchu.php?act=donhang"><i class="fas fa-shopping-bag"></i> Đơn hàng</a>
        </div>
    </div>
    <div class="main-content">
        <div class="stats">
        <div class="stat-box">
            <h3>Tổng đơn hàng</h3>
            <h2 id="total-orders"><?= $tongDonHang ?></h2>
        </div>
        <div class="stat-box">
            <h3>Tổng chi tiêu</h3>
            <h2 id="total-spent"><?= number_format($tongTienTatCa, 0, ',', '.') ?>đ</h2>
        </div>

            <div class="stat-box">
                <h3>Giỏ hàng hiện tại</h3>
                <h2 id="cart-items"><?=$tongsoluong?> sản phẩm</h2>
            </div>
        </div>
        <div class="orders">
            <div class="orders-header">
                <h5>Đơn hàng gần đây</h5>
                <a href="trangchu.php?act=donhang"><button class="btn-sm btn-outline-primary">Xem tất cả</button></a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                <tbody>
                    <tr>
                        <td>#<?= htmlspecialchars($order['madh'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= date('d/m/Y', strtotime($order['ngaydat'])) ?></td>
                        <td><?= number_format($order['tongtien'], 0, ',', '.') ?> đ</td>
                        
                        <td>
                        <?php 
                        switch (htmlspecialchars($order['trangthai'])) {
                            case 1: 
                                echo '<span class="badge badge-pending">Chờ xác nhận</span>'; 
                                break;
                            case 2: 
                                echo '<span class="badge badge-packing">Đang đóng gói</span>'; 
                                break;
                            case 3: 
                                echo '<span class="badge badge-shipping">Đang vận chuyển</span>'; 
                                break;
                            case 4: 
                                echo '<span class="badge badge-completed">Hoàn thành</span>'; 
                                break;
                            case 5:
                                echo '<span class="badge badge-cancelled">Đã hủy</span>'; 
                                break;
                            default: 
                                echo '<span class="badge badge-cancelled">Không xác định</span>'; 
                                break;
                        }
                        ?>
                        </td>



                        <td><button class="btn-sm btn-outline-primary"><a href="trangchu.php?act=donhang_ct&iddh=<?=($order['id'])?>">Chi tiết<a></button></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Không có đơn hàng nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.getElementById('avatar-input').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('avatar-preview').src = e.target.result;
                alert("Avatar đã được cập nhật (chỉ preview - không upload).");
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
</body>
</html>