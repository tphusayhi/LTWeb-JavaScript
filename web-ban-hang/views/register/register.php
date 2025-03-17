<?php
require "database.php";

if (isset($_POST['btn-register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Mã hóa mật khẩu

    if (!empty($username) && !empty($email) && !empty($password)) {
        // Sử dụng Prepared Statement để tránh SQL Injection
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "Đăng ký thành công!";
        } else {
            echo "Lỗi: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Vui lòng nhập đầy đủ thông tin.";
    }
}
?>
