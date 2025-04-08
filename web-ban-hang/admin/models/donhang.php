<?php
   function insert_donhang($hoten, $sdt, $email, $diachi, $ghichu, $madh, $tongtien, $pttt, $iduser) {
    // Kết nối cơ sở dữ liệu
    $conn = connectdb();
    try {
        // Chuẩn bị câu lệnh SQL
        $sql = "
            INSERT INTO tbl_donhang (madh, hoten, sdt, email, diachi, ghichu, tongtien, pttt, iduser)
            VALUES (:madh, :hoten, :sdt, :email, :diachi, :ghichu, :tongtien, :pttt, :iduser)
        ";

        $stmt = $conn->prepare($sql);

        // Gán giá trị vào tham số
        $stmt->bindParam(':madh', $madh);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':sdt', $sdt);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':diachi', $diachi);
        $stmt->bindParam(':ghichu', $ghichu);
        $stmt->bindParam(':tongtien', $tongtien);
        $stmt->bindParam(':pttt', $pttt);
        $stmt->bindParam(':iduser', $iduser);


        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return $conn->lastInsertId(); // Trả về ID đơn hàng vừa thêm
        } else {
            return false;
        }

    } catch (PDOException $e) {
        // Ghi log hoặc hiển thị lỗi
        echo "Lỗi khi thêm đơn hàng: " . $e->getMessage();
        return false;
    }
}

function addtocart($iddh, $idpro, $tensp, $img, $dongia, $soluong, $sizes) {
    // Kết nối cơ sở dữ liệu
    $conn = connectdb();
    try {
        // Chuẩn bị câu lệnh SQL
        $sql = "
            INSERT INTO tbl_cart (iddh, idpro, tensp, img, dongia, soluong, sizes)
            VALUES (:iddh, :idpro, :tensp, :img, :dongia, :soluong, :sizes)
        ";

        $stmt = $conn->prepare($sql);

        // Gán giá trị vào các tham số
        $stmt->bindParam(':iddh', $iddh);
        $stmt->bindParam(':idpro', $idpro);
        $stmt->bindParam(':tensp', $tensp);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':dongia', $dongia);
        $stmt->bindParam(':soluong', $soluong);
        $stmt->bindParam(':sizes', $sizes);

        // Thực thi câu lệnh
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Lỗi khi thêm vào giỏ hàng: " . $e->getMessage();
        return false; // Trả về false nếu có lỗi
    }

    return true; // Trả về true nếu thêm thành công
}

function get_donhang($iduser) {
    $conn = connectdb(); // <-- đảm bảo bạn gọi connectdb()
    $sql = "SELECT * FROM tbl_donhang WHERE iduser = :iduser ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iduser', $iduser, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



// Hàm lấy chi tiết sản phẩm trong đơn hàng

function get_donhang_ct($iddh) {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT * FROM tbl_cart WHERE iddh = :iddh"; // Truy vấn lấy chi tiết đơn hàng từ bảng tbl_cart
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddh', $iddh, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll(); // Trả về mảng các dòng kết quả (chi tiết sản phẩm trong đơn hàng)
}

// Hàm lấy thông tin đơn hàng (khách hàng, mã đơn hàng, địa chỉ, v.v.)
function get_one_donhang($iddh) {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT * FROM tbl_donhang WHERE id = :iddh"; // Truy vấn lấy thông tin đơn hàng từ bảng tbl_donhang
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddh', $iddh, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch(); // Trả về 1 dòng (thông tin của đơn hàng)
}

function dh_ganday($iduser) {
    $conn = connectdb(); // <-- đảm bảo bạn đã kết nối đúng
    $sql = "SELECT * FROM tbl_donhang WHERE iduser = :iduser ORDER BY id DESC LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iduser', $iduser, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}









    
    
    
    
    
    
?>