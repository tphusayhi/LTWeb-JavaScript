<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Bắt đầu session nếu chưa được bắt đầu
}

// Kiểm tra nếu thông tin người dùng đã tồn tại và chưa được lưu vào session
if (!isset($_SESSION['user_info']) && isset($user)) {
    $_SESSION['user_info'] = [
        'hoten' => $user['hoten'] ?? '',
        'email' => $user['email'] ?? '',
        'sdt' => $user['sdt'] ?? '',
        'ngaysinh' => $user['ngaysinh'] ?? '',
        'diachi' => $user['diachi'] ?? '',
    ];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trang tài khoản</title>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: "Segoe UI", sans-serif;
      background-color: #f4f6f8;
      color: #333;
    }
    .container {
      display: flex;
      flex-direction: row;
      gap: 20px;
      padding: 20px;
      margin-top:30px;
      flex-wrap: wrap;
    }
    .sidebar {
      width: 250px;
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    .avatar-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #ddd;
        }
    .avatar-upload-overlay {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      background-color: rgba(0, 0, 0, 0.6);
      padding: 5px 10px;
      border-radius: 20px;
      opacity: 0;
      transition: opacity 0.3s;
    }
    .avatar-container:hover .avatar-upload-overlay {
      opacity: 1;
    }
    .avatar-upload-overlay button {
      color: #fff;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 12px;
    }
    .profile {
      text-align: center;
      margin-top: 15px;
    }
    .profile h2 {
      font-size: 18px;
    }
    .profile p {
      font-size: 14px;
      color: gray;
    }
    .nav-links {
      margin-top: 30px;
      display: flex;
      flex-direction: column;
    }
    .nav-links a {
      padding: 10px;
      text-align: left;
      color: #333;
      text-decoration: none;
      border-radius: 5px;
      margin-bottom: 5px;
    }
    .nav-links a.active,
    .nav-links a:hover {
      background-color: #eee;
    }
    .main-content {
      flex: 1;
      min-width: 300px;
    }
    .stats {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }
    .stat-box {
      background: white;
      padding: 20px;
      flex: 1;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
      min-width: 200px;
    }
    .stat-box h3 {
      margin-bottom: 10px;
      font-size: 16px;
      color: #666;
    }
    .orders {
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
      padding: 20px;
    }
    .orders-header h2 {
      font-size: 20px;
      margin-bottom: 20px;
      text-align: center;
    }
   
    @media (min-width: 768px) {
      form {
        grid-template-columns: 1fr 1fr;
        gap: 30px;
      }
    }
    .form-group {
      display: flex;
      flex-direction: column;
    }
    label {
      font-weight: 600;
      margin-bottom: 6px;
      font-size: 14px;
    }

    input[type="password"],
    input[type="new_password"],
    input[type="confirm_password"],
    input[type="oldpassword"],
    input[type="newpassword"],
    input[type="confirmpassword"],
    input[type="oldpassword"],
    input[type="newpassword"],
    input[type="confirmpassword"],
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"] {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .form-footer {
      grid-column: span 2;
      text-align: right;
      margin-top: 10px;
    }
    .submit-btn {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 500;
    }
    .submit-btn:hover {
      background-color: #0056b3;
    }
    .formpass {
      display: block;
      grid-template-columns: 1fr;
      gap: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="sidebar">
  <?php
    $avatar = !empty($user['imgav']) ? "assets/img/" . $user['imgav'] : "images/default-avatar.png";
?>
  <form action="trangchu.php?act=upload_avatar" method="POST" enctype="multipart/form-data">
    <div class="avatar-container">
        <img src="<?= $avatar ?>" id="avatar-preview" alt="Avatar" width="150" style="border-radius: 50%;">
        <div class="avatar-upload-overlay">
            <input type="file" name="avatar" id="avatar-input" accept="image/*" style="display: none;" required>
            <button type="button" onclick="document.getElementById('avatar-input').click()">
                <i class="fas fa-camera"></i> Thay đổi
            </button>
        </div>
    </div>
    <br>
    <p style="margin-left: 55px;"><button type="submit" name="upload">Cập Nhật Avatar</button></p>
</form>
    <div class="profile">
      <h2 id="username"><?= isset($user['username']) ? htmlspecialchars($user['username']) : '' ?></h2>
      <p id="email"><?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?></p>
    </div>
    <div class="nav-links">
      <a href="trangchu.php?act=account" ><i class="fas fa-home"></i> Trang chủ</a>
      <a href="" class="active"><i class="fas fa-user"></i> Thông tin cá nhân</a>
      <a href="trangchu.php?act=donhang"><i class="fas fa-shopping-bag"></i> Đơn hàng</a>
    </div>
  </div>
  <div class="main-content">
    <div class="orders">
      <div class="orders-header">
        <h2>Thông tin cá nhân</h2>
      </div>
      <?php if (isset($user) && $user): ?>
      <form action="#" method="post">
    <div class="form-group">
        <label for="hoten">Họ và tên</label>
        <input type="text" id="hoten" name="hoten" value="<?= isset($user['hoten']) ? htmlspecialchars($user['hoten']) : '' ?>"> 
    </div>       
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?>" >
    </div>
    <div class="form-group">
        <label for="sdt">Số điện thoại</label>
        <input type="tel" id="sdt" name="sdt" value="<?= isset($user['sdt']) ? htmlspecialchars($user['sdt']) : '' ?>">
    </div>
    <div class="form-group">
        <label for="ngaysinh">Ngày sinh</label>
        <input type="date" id="ngaysinh" name="ngaysinh" value="<?= isset($user['ngaysinh']) ? htmlspecialchars($user['ngaysinh']) : '' ?>">
    </div>
    <div class="form-group" style="grid-column: span 2;">
        <label for="diachi">Địa chỉ</label>
        <input type="text" id="diachi" name="diachi" value="<?= isset($user['diachi']) ? htmlspecialchars($user['diachi']) : '' ?>">
    </div>
    <div class="form-footer">
        <button type="submit" name="btn-insert" class="submit-btn">Cập nhật thông tin</button>
    </div>
</form>

<?php else: ?>
    <p>Không tìm thấy thông tin người dùng.</p>
<?php endif; ?>

<form action="trangchu.php?act=doimatkhau" method="POST" onsubmit="return validatePasswordForm();">
  <div class="form-group">
    <label for="password">Mật khẩu hiện tại</label>
    <input type="password" id="password" name="password" required>
  </div>
  <div class="form-group">
    <label for="newpassword">Mật khẩu mới</label>
    <input type="password" id="newpassword" name="newpassword" required>
  </div>
  <div class="form-group">
    <label for="confirmpassword">Nhập lại mật khẩu mới</label>
    <input type="password" id="confirmpassword" name="confirmpassword" required>
  </div>
  <div class="form-footer">
    <button type="submit" name="btn-change-password" class="submit-btn">Cập nhật mật khẩu</button>
  </div>
</form>

<?php
// change_password_view.php

// Display any messages (success or error)
if (!empty($message)) {
    echo "<p>$message</p>";
}
?>
    </div>
  </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-insert'])) {
    // Lấy thông tin từ form
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];

    // Cập nhật thông tin vào cơ sở dữ liệu (nếu cần)
    // update_user_info($hoten, $email, $sdt, $ngaysinh, $diachi);

    // Lưu thông tin vào session
    $_SESSION['user_info'] = [
        'hoten' => $hoten,
        'email' => $email,
        'sdt' => $sdt,
        'ngaysinh' => $ngaysinh,
        'diachi' => $diachi,
    ];

    echo "<script>alert('Cập nhật thông tin thành công!');</script>";
}
?>
<script>
  document.getElementById('avatar-input').addEventListener('change', function () {
    if (this.files && this.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById('avatar-preview').src = e.target.result;
        alert("cập nhật Avatar không thành công!.");
      };
      reader.readAsDataURL(this.files[0]);
    }
  });
</script>
<script>
  function validatePasswordForm() {
  const newPassword = document.getElementById('newpassword').value;
  const confirmPassword = document.getElementById('confirmpassword').value;

  if (newPassword !== confirmPassword) {
    alert('Mật khẩu mới và nhập lại mật khẩu không khớp!');
    return false;
  }

  if (newPassword.length < 6) {
    alert('Mật khẩu mới phải có ít nhất 6 ký tự.');
    return false;
  }

  return true;
}
</script>

</body>
</html>