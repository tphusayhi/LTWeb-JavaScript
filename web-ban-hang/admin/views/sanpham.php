<!-- <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            background-color: #f4f4f4;
            width: 100%;
        }
        .main {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        select, input[type="text"], input[type="file"], textarea {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        input[type="submit"] {
            padding: 8px 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
            background: #007bff;
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
        <h2>Quản lý Sản phẩm</h2>
        
        <form action="indexs.php?act=themsp" method="post" enctype="multipart/form-data">
            <select name="iddm" required>
                <option value="">Chọn danh mục</option>
                <?php
                    if (isset($dsdm) && is_array($dsdm)) {
                        foreach ($dsdm as $dm) {
                            echo "<option value='" . htmlspecialchars($dm['id']) . "'>" . htmlspecialchars($dm['tendm']) . "</option>";
                        }
                    }
                ?>
            </select>
            <input type="text" name="tensp" placeholder="Nhập tên sản phẩm" required>
            <input type="file" name="img" required>
            <input type="text" name="gia" placeholder="Nhập giá sản phẩm" required>
            <input type="text" name="view" placeholder="Nhập lượt xem (mặc định: 0)" value="0" required>
            <textarea name="detail" placeholder="Nhập chi tiết sản phẩm" required></textarea>
            <input type="submit" name="them" value="Thêm sản phẩm">
        </form>

        <table>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Lượt xem</th>
                <th>Chi tiết</th>
                <th>Thao tác</th>
            </tr>
            <?php
                if (isset($kq) && is_array($kq) && count($kq) > 0) {
                    $i = 1;
                    foreach ($kq as $item) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . htmlspecialchars($item['tensp']) . "</td>";

                        // Kiểm tra hình ảnh có tồn tại không
                        $imagePath = !empty($item['img']) ? "assets/img/" . htmlspecialchars($item['img']) : "assets/img/no-image.png";

                        echo '<td><img src="' . $imagePath . '" width="80px"></td>';
                        echo "<td>" . htmlspecialchars($item['gia']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['view']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['detail']) . "</td>";
                        echo "<td>
                                <a href='indexs.php?act=chon_sp&id=" . (int) $item['id'] . "'>Sửa</a> |
                                <a href='indexs.php?act=delete_sp&id=" . (int) $item['id'] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?')\">Xóa</a> |
                                <a href='indexs.php?act=chitiet_sp&id=" . (int) $item['id'] . "'>Xem chi tiết</a>
                              </td>";
                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='7'>Không có sản phẩm nào</td></tr>";
                }
            ?>
        </table>
    </div>
</body>
</html> -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            background-color: #f4f4f4;
            width: 100%;
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
            color: #007bff;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
        }
        select, input[type="text"], input[type="file"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            padding: 8px 12px;
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
            background: #007bff;
            color: white;
        }
        a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s;
        }
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.5s ease-in-out forwards;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".main").classList.add("fade-in");
        });
    </script>
</head>
<body>
    <div class="main">
        <h2>Sản phẩm</h2>
        <form action="indexs.php?act=themsp" method="post" enctype="multipart/form-data">
            <select name="iddm" required>
                <option value="0">Chọn danh mục</option>
                <?php
                    if(isset($dsdm)){
                        foreach ($dsdm as $dm) {
                            echo "<option value='" . htmlspecialchars($dm['id']) . "'>" . htmlspecialchars($dm['tendm']) . "</option>";
                        }
                    }
                ?>
            </select>
            <input type="text" name="tensp" placeholder="Nhập tên sản phẩm" required>
            <input type="file" name="img"  required>
            <input type="text" name="gia" placeholder="Nhập giá sản phẩm" required>
            <input type="text"name="detail" placeholder="Nhập chi tiết sản phẩm" required>
            <input type="submit" name="them" value="Thêm">
        </form>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Lượt xem</th>
                <th>Mô Tả</th>
                <th>Thao tác</th>
            </tr>
            <?php
                if(isset($kq) && count($kq) > 0){
                    $i = 1;
                    foreach ($kq as $item) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . htmlspecialchars($item['tensp']) . "</td>";
                        echo '<td><img src="assets/img/' . htmlspecialchars($item['img']) . '" width="80px"></td>';

                        //echo '<td><img src="../../assets/img/' . $item['img'] . '" width="80px"></td>';
                        echo "<td>" . htmlspecialchars($item['gia']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['view']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['detail']) . "</td>";
                        echo "<td>
                                <a href='indexs.php?act=chon_sp&id=" . (int) $item['id'] . "'>Sửa</a> | <a href='indexs.php?act=delete_sp&id=" . (int) $item['id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a>
                                
                              </td>";
                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='5'>Không có sản phẩm nào</td></tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>