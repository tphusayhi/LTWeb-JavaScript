<?php
require_once "models/database.php"; // Nạp file kết nối CSDL

session_start();
$conn = connectdb(); // Kết nối CSDL

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-login'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        try {
            // Truy vấn lấy thông tin người dùng
            $sql = "SELECT id, username, password, role FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra nếu tài khoản tồn tại và mật khẩu đúng
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                // Điều hướng theo vai trò
                if ($user['role'] == 1) {
                    header("Location: indexs.php"); // Trang admin
                } else {
                    header("Location: login.php"); // Trang người dùng
                }
                exit;
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu.";
            }
        } catch (PDOException $e) {
            $error = "Lỗi kết nối CSDL: " . $e->getMessage();
        }
    } else {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; }
        .container { max-width: 350px; margin: 100px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng nhập</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit" name="btn-login">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
