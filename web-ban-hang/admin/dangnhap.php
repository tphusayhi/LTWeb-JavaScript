<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
ob_start();
include "models/database.php";
include "models/user.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $user = htmlspecialchars(trim($_POST['user']));
    $pass = htmlspecialchars(trim($_POST['pass']));

    $role = check_user($user, $pass);
    $_SESSION['role'] = $role;

    if ($role == 1) {
        header('Location: indexs.php');
        exit;
    } else {
        header('Location: login.php');
        exit;
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
        .container { max-width: 300px; margin: 100px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        input { width: 100%; padding: 8px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng nhập</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="text" name="user" placeholder="Tên đăng nhập" required>
            <input type="password" name="pass" placeholder="Mật khẩu" required>
            <button type="submit" name="login">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
