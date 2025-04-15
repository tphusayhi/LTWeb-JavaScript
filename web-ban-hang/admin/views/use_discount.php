<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ưu Đãi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .main {
            background: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 1200px;
            margin: 20px auto;
            min-height: 600px;
        }
        h2 {
            text-align: center;
            color: #28a745;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #28a745;
            color: white;
        }
        .copy-btn {
            padding: 5px 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .copy-btn:hover {
            background: #0056b3;
        }
    </style>
    <script>
        function copyToClipboard(code) {
            navigator.clipboard.writeText(code).then(() => {
                alert("Mã giảm giá đã được sao chép: " + code);
            });
        }
    </script>
</head>
<body>
<div class="main">
    <h2>ƯU ĐÃI DÀNH CHO BẠN</h2>
    <table>
        <tr>
            <th>STT</th>
            <th>Mã giảm giá</th>
            <th>Phần trăm giảm</th>
            <th>Số lượng còn lại</th>
            <th>Hạn sử dụng</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        <?php
        // Include the model for discount codes
        $ds_ma_giam_gia = lay_danh_sach_magiamgia(); // Fetch all discount codes from the database

        if ($ds_ma_giam_gia && count($ds_ma_giam_gia) > 0) {
            $i = 1;
            foreach ($ds_ma_giam_gia as $mg) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . htmlspecialchars($mg['ma']) . "</td>";
                echo "<td>" . (int)$mg['phan_tram_giam_gia'] . "%</td>";
                echo "<td>" . (int)$mg['so_luong'] . "</td>";
                echo "<td>" . htmlspecialchars($mg['han_su_dung']) . "</td>";
                echo "<td>" . ($mg['trang_thai'] === 'active' ? 'Kích hoạt' : 'Tạm ngưng') . "</td>";
                echo "<td><button class='copy-btn' onclick='copyToClipboard(\"" . htmlspecialchars($mg['ma']) . "\")'>Sao chép</button></td>";
                echo "</tr>";
                $i++;
            }
        } else {
            echo "<tr><td colspan='7'>Không có mã giảm giá nào.</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>