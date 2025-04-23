<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .containerr {
            width: 90%;
            min-height:600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }

        table th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
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
    </style>
</head>
<body>

<div class="containerr">
    <h2>Danh sách đơn hàng của bạn</h2>

    <table>
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Ngày đặt</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td>#<?= htmlspecialchars($order['madh'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= date('d/m/Y', strtotime($order['ngaydat'])) ?></td>
                <td><?= htmlspecialchars($order['hoten'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><strong><?= number_format($order['tongtien'],0, ',', '.') ?> $</strong> </td>
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

                <td>
                    <a href="trangchu.php?act=donhang_ct&iddh=<?=($order['id'])?>" class="btn">Xem chi tiết</a>
                </td>
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

</body>
</html>
