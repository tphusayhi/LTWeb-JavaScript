<?php
session_start();
ob_start();
require "models/database.php";

// Kiểm tra trước khi in $_SESSION['user']
if (isset($_SESSION['user'])) {
    print_r($_SESSION['user'], true);
}

// Đảm bảo hàm connectdb() tồn tại
if (!function_exists('connectdb')) {
    function connectdb() {
        try {
            $dsn = "mysql:host=localhost;dbname=your_database_name;charset=utf8";
            $username = "your_username";
            $password = "your_password";
            return new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $conn = connectdb();
        $sql = "SELECT id, username, password, role FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = (int) $user['role'];

            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => (int) $user['role']
            ];

        
            // Điều hướng theo role
            if ($_SESSION['role'] == 2) {
                header("Location: indexs.php");
            } else {
                header("Location: trangchu.php");
            }
            exit();
        } else {
            $error = "Sai tên đăng nhập hoặc mật khẩu!";
        }
    } else {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    }
} 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-login {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .text-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.95rem;
        }

        .text-link a {
            color: #007bff;
            text-decoration: none;
        }

        .text-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" name="btn-login" class="btn btn-login w-100">Đăng nhập</button>
        </form>

        <div class="text-link">
            <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
            <p><a href="trangchu.php">Quay lại trang chủ</a></p>
        </div>
    </div>
</body>
</html>
