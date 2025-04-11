<?php
function update_magiamgia($id, $ma, $phan_tram, $so_luong, $han_su_dung, $trang_thai) {
    $conn = connectdb();
    try {
        // Kiểm tra xem mã mới có bị trùng với mã khác không (trừ chính bản ghi đang sửa)
        $stmt = $conn->prepare("SELECT COUNT(*) FROM ma_giam_gia WHERE ma = :ma AND id != :id");
        $stmt->bindParam(":ma", $ma, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return "Mã giảm giá đã tồn tại với bản ghi khác!";
        }

        // Cập nhật bản ghi
        $stmt = $conn->prepare("UPDATE ma_giam_gia 
                                SET ma = ?, phan_tram_giam_gia = ?, so_luong = ?, han_su_dung = ?, trang_thai = ?
                                WHERE id = ?");
        $stmt->execute([$ma, $phan_tram, $so_luong, $han_su_dung, $trang_thai, $id]);

        return "Cập nhật mã giảm giá thành công!";
    } catch (PDOException $e) {
        return "Lỗi khi cập nhật mã giảm giá: " . $e->getMessage();
    }
}


function lay_1_magiamgia_theo_id($id) {
    $conn = connectdb();
    $stmt = $conn->prepare("SELECT * FROM ma_giam_gia WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function them_magiamgia($ma, $phan_tram, $so_luong, $han_su_dung, $trang_thai) {
    $conn = connectdb();
    try {
        // Kiểm tra mã đã tồn tại chưa
        $stmt = $conn->prepare("SELECT COUNT(*) FROM ma_giam_gia WHERE ma = :ma");
        $stmt->bindParam(":ma", $ma, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn(); // Lấy số lượng bản ghi trùng mã

        if ($count > 0) {
            return "Mã giảm giá đã tồn tại!";
        }

        // Nếu chưa tồn tại, thực hiện thêm mới
        $stmt = $conn->prepare("INSERT INTO ma_giam_gia (ma, phan_tram_giam_gia, so_luong, han_su_dung, trang_thai) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$ma, $phan_tram, $so_luong, $han_su_dung, $trang_thai]);

        return "Thêm mã giảm giá thành công!";
    } catch (PDOException $e) {
        return "Lỗi khi thêm mã giảm giá: " . $e->getMessage();
    }
}

function xoa_magiamgia($id) {
    $conn = connectdb();
    try {
        $stmt = $conn->prepare("DELETE FROM ma_giam_gia WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount(); // Trả về số dòng đã xóa
    } catch (PDOException $e) {
        echo "Lỗi khi xóa mã giảm giá: " . $e->getMessage();
        return false;
    }
}


function getall_magiamgia(){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM ma_giam_gia");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();



    return $kq;
}
?>
