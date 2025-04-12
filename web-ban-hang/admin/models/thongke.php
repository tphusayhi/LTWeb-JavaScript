<?php
// models/donhang.php
function thong_ke_doanh_thu_theo_thang($conn) {
    $sql = "SELECT DATE_FORMAT(ngaydat, '%Y-%m') AS thang, SUM(tongtien) AS doanh_thu
            FROM tbl_donhang
            GROUP BY thang
            ORDER BY thang DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function tong_so_don_hang($conn) {
    $sql = "SELECT COUNT(*) AS don_hang FROM tbl_donhang";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// models/sanpham.php
function tong_so_san_pham($conn) {
    $sql = "SELECT SUM(soluong) AS tong_so_luong FROM tbl_cart";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}


function san_pham_ban_chay($conn, $limit = 5) {
    $sql = "SELECT idpro, tensp, img, SUM(soluong) AS tong_sl
            FROM tbl_cart
            GROUP BY idpro, tensp
            ORDER BY tong_sl DESC
            LIMIT $limit";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


?>