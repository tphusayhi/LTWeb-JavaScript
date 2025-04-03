<?php
require_once "models/database.php"; // Nạp file kết nối CSDL

$conn = connectdb(); // Kết nối CSDL
$message = ""; // Biến để lưu thông báo lỗi hoặc thành công

if (!$conn) {
    die("Lỗi kết nối CSDL.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $role = 1; // Mặc định là 0 (Người dùng)

    if (!empty($username) && !empty($email) && !empty($password) && !empty($confirmPassword)) {
        if ($password !== $confirmPassword) {
            $message = "Mật khẩu nhập lại không khớp.";
        } elseif (strlen($password) < 6) {
            $message = "Mật khẩu phải có ít nhất 6 ký tự.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Email không hợp lệ.";
        } else {
            try {
                // Kiểm tra xem tên đăng nhập hoặc email đã tồn tại chưa
                $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $message = "Tên đăng nhập hoặc email đã tồn tại.";
                } else {
                    // Mã hóa mật khẩu trước khi lưu
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Chèn dữ liệu vào cơ sở dữ liệu
                    $sql = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
                    $stmt->bindParam(":role", $role, PDO::PARAM_INT);
                    
                    if ($stmt->execute()) {
                        header("Location: login.php?success=1"); 
                        exit;
                    } else {
                        $message = "Lỗi: Không thể đăng ký.";
                    }
                }
            } catch (PDOException $e) {
                $message = "Lỗi: " . $e->getMessage();
            }
        }
    } else {
        $message = "Vui lòng nhập đầy đủ thông tin.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5"> 
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Đăng Ký</h2>
                <?php if (!empty($message)) echo '<div class="alert alert-danger">' . $message . '</div>'; ?>
                <form id="registerForm" action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Nhập lại mật khẩu:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <input type="submit" class="btn btn-primary w-100" name="btn-register" value="Đăng Ký">
                </form>
                <p class="text-center mt-3">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            let isValid = true;
            let username = document.getElementById("username").value.trim();
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();
            let confirmPassword = document.getElementById("confirmPassword").value.trim();
            
            let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                alert("Email không hợp lệ.");
                isValid = false;
            }
            if (password.length < 6) {
                alert("Mật khẩu phải có ít nhất 6 ký tự.");
                isValid = false;
            }
            if (password !== confirmPassword) {
                alert("Mật khẩu nhập lại không khớp.");
                isValid = false;
            }
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
