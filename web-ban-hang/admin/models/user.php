<?php
function update_password($id, $hashed_password) {
    try {
        $conn = connectdb(); // Hàm kết nối PDO đến CSDL

        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute(); // Trả về true nếu thành công
    } catch (PDOException $e) {
        // Ghi log thay vì echo (để không lộ lỗi ra trình duyệt nếu dùng thực tế)
        error_log("Lỗi cập nhật mật khẩu: " . $e->getMessage());
        return false;
    }
}



function update_user($id, $hoten, $email, $sdt, $ngaysinh, $diachi) {
    $conn = connectdb();
    $sql = "UPDATE users 
            SET hoten = :hoten, email = :email, sdt = :sdt, ngaysinh = :ngaysinh, diachi = :diachi 
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':hoten', $hoten);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':sdt', $sdt);
    $stmt->bindParam(':ngaysinh', $ngaysinh);
    $stmt->bindParam(':diachi', $diachi);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute(); // Trả về true nếu thành công
}



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