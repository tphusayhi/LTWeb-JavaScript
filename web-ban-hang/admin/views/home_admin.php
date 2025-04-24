<?php
// Lấy dữ liệu thống kê từ cơ sở dữ liệu
$doanh_thu_thang = thong_ke_doanh_thu_theo_thang($conn);
$tong_sp = tong_so_san_pham($conn);
$tong_don = tong_so_don_hang($conn);
$top_sp = san_pham_ban_chay($conn);
$i = 1; // Biến đếm cho sản phẩm bán chạy
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thống kê</title>
    <style>
        .right-container {
            width: 800px;
            margin-left: 400px;
            margin-top: 60px;
            padding: 20px;
        }

        .stat-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
            flex: 1;
            text-align: center;
        }

        .styled-table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }

        .styled-table th,
        .styled-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .styled-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="right-container">
    <h2>📊 Thống kê tổng quan</h2>
    <div class="stat-container">
        <div class="stat-box">
            <h3>Tổng số sản phẩm</h3>
            <p><strong><?= $tong_sp ?></strong></p>
        </div>
        <div class="stat-box">
            <h3>Tổng số đơn hàng</h3>
            <p><strong><?= $tong_don ?></strong></p>
        </div>
    </div>

    <h3>📅 Doanh thu theo tháng</h3>
    <table class="styled-table">
        <tr>
            <th>Tháng</th>
            <th>Doanh thu ($)</th>
        </tr>
        <?php foreach ($doanh_thu_thang as $row): ?>
        <tr>
            <td><?= $row['thang'] ?></td>
            <td><?= number_format($row['doanh_thu'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>🔥 Sản phẩm bán chạy nhất</h3>
    <table class="styled-table">
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng bán</th>
        </tr>
        <?php foreach ($top_sp as $sp): ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $sp['idpro'] ?></td>
            <td><img src="assets/img/<?= $sp['img'] ?>" alt="<?= $sp['tensp'] ?>" style="width: 50px; height: 50px;"></td>
            <td><?= $sp['tensp'] ?></td>
            <td><?= $sp['tong_sl'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
