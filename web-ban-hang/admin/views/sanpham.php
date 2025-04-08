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
        select, input[type="text"], input[type="file"], textarea {
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
        <h2>Quản lý sản phẩm</h2>
        <form action="indexs.php?act=themsp" method="post" enctype="multipart/form-data">
            <select name="iddm" required>
                <option value="0">Chọn danh mục</option>
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
            <textarea name="detail" placeholder="Nhập chi tiết sản phẩm" required></textarea>

            <h5>Chọn size sản phẩm:</h5>
            <label><input type="checkbox" id="select-all-sizes"> <strong>Chọn tất cả</strong></label>
            <br>

            <div id="size-options">
                <label><input type="checkbox" name="sizes[]" value="EU 35.5"> EU 35.5</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 36"> EU 36</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 36.5"> EU 36.5</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 37.5"> EU 37.5</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 38"> EU 38</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 38.5"> EU 38.5</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 39"> EU 39</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 40"> EU 40</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 40.5"> EU 40.5</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 41"> EU 41</label><br>
                <label><input type="checkbox" name="sizes[]" value="EU 42"> EU 42</label><br>
            </div>
            <input type="submit" name="them" value="Thêm sản phẩm">
        </form>

        <table>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Lượt xem</th>
                <th>Size</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>
            <?php
                if (isset($kq) && count($kq) > 0) {
                    $i = 1;
                    foreach ($kq as $item) {
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . htmlspecialchars($item['tensp']) . "</td>";
                        echo '<td><img src="assets/img/' . htmlspecialchars($item['img']) . '" width="80px"></td>';
                        echo "<td>" . htmlspecialchars($item['gia']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['view']) . "</td>";

                        // Kiểm tra và hiển thị size
                        $sizes = json_decode($item['sizes'], true);
                        if (is_array($sizes) && count($sizes) > 0) {
                            echo "<td>" . implode(', ', array_map('htmlspecialchars', $sizes)) . "</td>";
                        } else {
                            echo "<td>Không có size</td>";
                        }

                        echo "<td>" . htmlspecialchars($item['detail']) . "</td>";
                        echo "<td>
                                <a href='indexs.php?act=chon_sp&id=" . (int) $item['id'] . "'>Sửa</a> | 
                                <a href='indexs.php?act=delete_sp&id=" . (int) $item['id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a>
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
    <script>
        document.getElementById('select-all-sizes').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('#size-options input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
</body>
</html>
