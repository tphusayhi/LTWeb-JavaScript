<?php
function get_thongtin($id) {
    try {
        $conn = connectdb(); // Kết nối đến database
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT); // Ép kiểu an toàn
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về 1 bản ghi dạng mảng kết hợp
    } catch (PDOException $e) {
        echo "Lỗi truy vấn dữ liệu người dùng: " . $e->getMessage();
        return false;
    }
}


function check_user($user, $pass) {
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT role, pass FROM tbl_taikhoan WHERE user = :user");
    $stmt->bindParam(':user', $user, PDO::PARAM_STR);
    $stmt->execute();
    
    $kq = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($kq && password_verify($pass, $kq['pass'])) {
        return $kq['role'];
    }
    return 0;
}


?>