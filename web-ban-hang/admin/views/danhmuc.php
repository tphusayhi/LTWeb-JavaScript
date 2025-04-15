<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            
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
            gap: 10px;
            justify-content: center;
        }
        input[type="text"] {
            padding: 8px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        <h2>Danh mục sản phẩm</h2>
       
        <form action="indexs.php?act=themdm" method="post">
        <input type="text" name="tendm" placeholder="Nhập tên danh mục">
            <input type="submit" name="them" value="Thêm">
        </form>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Ưu Tiên</th>
                <th>Hiển Thị</th>
                <th>Thao tác</th>
            </tr>
            <?php
               //var_dump($kq);
               if(isset($kq)&&(count($kq)>0)){
                $i=1;
                foreach ($kq as $dm ) {
                    echo "<tr>";
                    echo "<td>".($i)."</td>";
                    echo "<td>".$dm['tendm']."</td>";
                    echo "<td>".$dm['uutien']."</td>";
                    echo "<td>".$dm['hienthi']."</td>";
                    echo "<td>
                            <a href='indexs.php?act=update_dm&id=" . (int) $dm['id'] . "'>Sửa</a> |
                            <a href='indexs.php?act=delete_dm&id=" . (int) $dm['id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a>
                          </td>";
                    echo "</tr>";
                    $i++;
                }

               }            ?>
            

            
        </table>
    </div>
</body>
</html>