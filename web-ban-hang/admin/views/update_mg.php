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
    <h2>Cập nhật mã giảm giá</h2>

    <form action="indexs.php?act=update_magiamgia" method="post">
        <input type="hidden" name="id" value="<?= $magiamgia['id'] ?>">

        <input type="text" name="ma" placeholder="Mã giảm giá" value="<?= htmlspecialchars($magiamgia['ma']) ?>" required>
        
        <input type="number" name="phan_tram_giam_gia" placeholder="Phần trăm giảm (%)" value="<?= (int)$magiamgia['phan_tram_giam_gia'] ?>" required>
        
        <input type="number" name="so_luong" placeholder="Số lượng" value="<?= (int)$magiamgia['so_luong'] ?>" required>
        
        <input type="date" name="han_su_dung" value="<?= htmlspecialchars($magiamgia['han_su_dung']) ?>" required>

        <select name="trang_thai">
            <option value="active" <?= $magiamgia['trang_thai'] == 'active' ? 'selected' : '' ?>>Kích hoạt</option>
            <option value="inactive" <?= $magiamgia['trang_thai'] == 'inactive' ? 'selected' : '' ?>>Tạm ngưng</option>
        </select>

        <input type="submit" name="capnhat" value="Cập nhật mã">
    </form>
</div>

</body>
</html>
