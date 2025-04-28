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

        .container {
            width: 70%;
            margin-top: 80px;
            background-color: #fff;
            padding: 30px;
            margin-left: 300px;
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

/* Dropdown trạng thái */
select.badge {
    font-size: 13px;
    font-weight: bold;
    border: none;
    border-radius: 12px;
    padding: 6px 10px;
    color: #fff;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    text-align: center;
    text-align-last: center;
}

/* Màu nền thay đổi theo trạng thái (thông qua JS hoặc class tương ứng) */
.badge-pending {
    background-color: #ffc107; /* vàng */
    color: #212529;
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

<div class="container">
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
    <?php if (!empty($alldonhang)): ?>
        <?php foreach ($alldonhang as $order): ?>
            <tr>
                <td>#<?= htmlspecialchars($order['madh'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= date('d/m/Y', strtotime($order['ngaydat'])) ?></td>
                <td><?= htmlspecialchars($order['hoten'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= number_format($order['tongtien'], 0, ',', '.') ?> $</td>

                <td>
                    <form action="indexs.php?act=capnhat_trangthai" method="post" style="margin: 0;">
                        <input type="hidden" name="id_donhang" value="<?= $order['id'] ?>">
                        <?php
                            // Lấy class tương ứng với trạng thái hiện tại
                            $badgeClass = '';
                            switch ($order['trangthai']) {
                                case 1: $badgeClass = 'badge-pending'; break;
                                case 2: $badgeClass = 'badge-packing'; break;
                                case 3: $badgeClass = 'badge-shipping'; break;
                                case 4: $badgeClass = 'badge-completed'; break;
                                case 5: $badgeClass = 'badge-cancelled'; break;
                                default: $badgeClass = 'badge-cancelled'; break;
                            }
                        ?>
                        <select name="trangthai" onchange="this.form.submit()" class="badge <?= $badgeClass ?>">
                            <option value="1" class="badge-pending" <?= $order['trangthai'] == 1 ? 'selected' : '' ?>>Chờ xác nhận</option>
                            <option value="2" class="badge-packing" <?= $order['trangthai'] == 2 ? 'selected' : '' ?>>Đang đóng gói</option>
                            <option value="3" class="badge-shipping" <?= $order['trangthai'] == 3 ? 'selected' : '' ?>>Đang vận chuyển</option>
                            <option value="4" class="badge-completed" <?= $order['trangthai'] == 4 ? 'selected' : '' ?>>Hoàn thành</option>
                            <option value="5" class="badge-cancelled" <?= $order['trangthai'] == 5 ? 'selected' : '' ?>>Đã hủy</option>
                        </select>
                    </form>
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
