<?php
function delete_user($id) {
    $conn = connectdb();
    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount(); // Trả về số dòng đã xóa
    } catch (PDOException $e) {
        echo "Lỗi khi xóa user: " . $e->getMessage();
        return false;
    }
}
function them_user($username, $password, $role) {
    $conn = connectdb();

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) 
                                VALUES (:username, :password, :role)");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(":role", $role, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false; // Có thể log lỗi nếu muốn
    }
}


function getall_users(){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq_user = $stmt->fetchAll();



    return $kq_user;
}

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


function uploadAvatar($id, $file) {
    if (isset($file) && $file['error'] === 0) {
        $target_dir = "assets/img/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            $newFileName = uniqid("avatar_") . "." . $imageFileType;
            $target_file = $target_dir . $newFileName;

            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                // Cập nhật avatar trong CSDL
                $pdo = connectdb(); // Kết nối đến database
                $sql = "UPDATE users SET imgav = :avatar WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':avatar' => $newFileName,
                    ':id' => $id
                ]);
                return "Ảnh đại diện đã được cập nhật thành công!";
            } else {
                return "Không thể di chuyển file. Vui lòng kiểm tra quyền thư mục.";
            }
        } else {
            return "Chỉ hỗ trợ file JPG, JPEG, PNG, GIF!";
        }
    } else {
        return "Không có file hoặc có lỗi khi tải lên!";
    }
}



?>