<?php
require_once "../../models/database.php"; // Nạp file kết nối CSDL

$conn = connectdb(); // Đảm bảo có kết nối CSDL trước khi thực hiện truy vấn

if (isset($_POST['btn-register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($email) && !empty($password)) {
        try {
            // Mã hóa mật khẩu trước khi lưu vào CSDL
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Sử dụng Prepared Statement để tránh SQL Injection
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Đăng ký thành công!";
            } else {
                echo "Lỗi: Không thể đăng ký.";
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        echo "Vui lòng nhập đầy đủ thông tin.";
    }
}
?>
