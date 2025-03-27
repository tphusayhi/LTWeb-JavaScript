<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
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
            max-width: 600px;
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
            <input type="file" name="img" accept="image/*" required>
            <input type="text" name="gia" placeholder="Nhập giá sản phẩm" required>
            <input type="submit" name="them" value="Thêm">
        </form>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Thao tác</th>
            </tr>
            <?php
                if(isset($kq) && count($kq) > 0){
                    $i = 1;
                    foreach ($kq as $dm) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . htmlspecialchars($dm['tensp']) . "</td>";
                        echo "<td><img src='" . htmlspecialchars($dm['img']) . "' alt='Hình sản phẩm' width='50'></td>";
                        echo "<td>" . htmlspecialchars($dm['gia']) . "</td>";
                        echo "<td>
                                <a href='indexs.php?act=update_dm&id=" . (int) $dm['id'] . "'>Sửa</a> |
                                <a href='indexs.php?act=delete_dm&id=" . (int) $dm['id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a>
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
