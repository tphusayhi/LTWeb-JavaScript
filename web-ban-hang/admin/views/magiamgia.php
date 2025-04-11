<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý mã giảm giá</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .main {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
            transition: transform 0.3s ease-in-out;
        }
        .main:hover {
            transform: scale(1.02);
        }
        h2 {
            text-align: center;
            color: #dc3545;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            padding: 8px;
            width: 48%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 8px 16px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background: #218838;
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
            background: #dc3545;
            color: white;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="main">
    <h2>Quản lý mã giảm giá</h2>

    <form action="indexs.php?act=them_magiamgia" method="post">
        <input type="text" name="ma" placeholder="Mã giảm giá" required>
        <input type="number" name="phan_tram_giam_gia" placeholder="Phần trăm giảm (%)" required>
        <input type="number" name="so_luong" placeholder="Số lượng" required>
        <input type="date" name="han_su_dung" required>
        <select name="trang_thai">
            <option value="active">Kích hoạt</option>
            <option value="inactive">Tạm ngưng</option>
        </select>
        <input type="submit" name="them" value="Thêm mã">
    </form>

    <table>
        <tr>
            <th>STT</th>
            <th>Mã</th>
            <th>Giảm (%)</th>
            <th>Số lượng</th>
            <th>Hạn sử dụng</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        <?php
        // Ví dụ biến $ds_ma_giam_gia là danh sách mã giảm giá lấy từ CSDL
        if (isset($ds_ma_giam_gia) && count($ds_ma_giam_gia) > 0) {
            $i = 1;
            foreach ($ds_ma_giam_gia as $mg) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . htmlspecialchars($mg['ma']) . "</td>";
                echo "<td>" . (int)$mg['phan_tram_giam_gia'] . "</td>";
                echo "<td>" . (int)$mg['so_luong'] . "</td>";
                echo "<td>" . $mg['han_su_dung'] . "</td>";
                echo "<td>" . $mg['trang_thai'] . "</td>";
                echo "<td>
                        <a href='indexs.php?act=sua_magiamgia&id=" . (int)$mg['id'] . "'>Sửa</a> |
                        <a href='indexs.php?act=xoa_magiamgia&id=" . (int)$mg['id'] . "' onclick='return confirm(\"Bạn có chắc muốn xóa không?\")'>Xóa</a>
                      </td>";
                echo "</tr>";
                $i++;
            }
        }
        ?>
    </table>
</div>
</body>
</html>
