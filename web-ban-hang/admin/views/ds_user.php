<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khách hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            
            background-color: #f4f4f4;
            width: 100%;
        }
        .main {
            margin-left: 300px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 1100px;
            margin-top: 80px;
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
            display: inline-block;
            
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
        <h2>Quản lý khách hàng</h2>
        <form action="indexs.php?act=them_user" method="post" enctype="multipart/form-data">
            
            <input type="text" name="username" placeholder="Nhập tên đăng nhập" required>
            <input type="text" name="password" placeholder="Nhập mật khẩu" required>
            <select name="role" required>
                <option value="">Chọn quyền hạn</option>
                <option value="2">Admin</option>
                <option value="1">User</option>
            <input type="submit" name="them" value="Thêm tài khoản">
        </form>

        <table>
            <tr>
                <th>STT</th>
                <th>Tên Đăng Nhập</th>
                <th>Mật Khẩu</th>
                <th>Quyền Hạn</th>
                <th>Thao tác</th>
            </tr>
            <?php
               //var_dump($kq);
               if(isset($kq_user)&&(count($kq_user)>0)){
                $i=1;
                foreach ($kq_user as $users ) {
                    echo "<tr>";
                    echo "<td>".($i)."</td>";
                    echo "<td>".$users['username']."</td>";
                    echo "<td>".$users['password']."</td>";
                    echo "<td>" . ($users['role'] == 2 ? "Admin" : "User") . "</td>";
                    echo "<td>
                            <a href='indexs.php?act=delete_user&id=" . (int) $users['ID'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a>
                          </td>";
                    echo "</tr>";
                    $i++;
                }

               }            ?>

        </table>
    </div>
  


</body>
</html>