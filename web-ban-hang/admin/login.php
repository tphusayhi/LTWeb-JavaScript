<?php

session_start();
ob_start();
require "models/database.php";

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
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}
.login-container {
    width: 300px;
    margin: 100px auto;
    padding: 20px;
    background: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
h2 {
    text-align: center;
}
.error {
    color: red;
    text-align: center;
}
input {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
}
button {
    width: 100%;
    padding: 10px;
    background: blue;
    color: white;
    border: none;
}

        </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label for="username">Tên đăng nhập</label>
            <input type="text" name="username" required>
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" required>
            <button type="submit" name="btn-login">Đăng nhập</button>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </div>
</body>
</html>
