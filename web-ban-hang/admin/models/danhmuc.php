<?php
    function themdm($tendm) {
        $conn = connectdb();
        try {
            // Kiểm tra danh mục đã tồn tại chưa
            $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_danhmuc WHERE tendm = :tendm");
            $stmt->bindParam(":tendm", $tendm, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn(); // Lấy số lượng danh mục trùng tên
            
            if ($count > 0) {
                return "Danh mục đã tồn tại!";
            }
    
            // Nếu chưa tồn tại, thực hiện thêm mới
            $stmt = $conn->prepare("INSERT INTO tbl_danhmuc (tendm) VALUES (:tendm)");
            $stmt->bindParam(":tendm", $tendm, PDO::PARAM_STR);
            $stmt->execute();
            return "Thêm danh mục thành công!";
        } catch (PDOException $e) {
            return "Lỗi khi thêm danh mục: " . $e->getMessage();
        }
    }
    
        
    function update_dm($id, $tendm) {
        $conn=connectdb();
        $sql = "UPDATE tbl_danhmuc SET tendm='".$tendm."' WHERE id=".$id;

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // execute the query
        $stmt->execute();
    }
    function getonedm($id) {
        $conn = connectdb();
        try {
            $stmt = $conn->prepare("SELECT * FROM tbl_danhmuc WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Lấy 1 dòng duy nhất
        } catch (PDOException $e) {
            echo "Lỗi khi lấy danh mục: " . $e->getMessage();
            return false;
        }
    }
    function delete_dm($id) {
        $conn = connectdb();
        try {
            $stmt = $conn->prepare("DELETE FROM tbl_danhmuc WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount(); // Trả về số dòng đã xóa
        } catch (PDOException $e) {
            echo "Lỗi khi xóa danh mục: " . $e->getMessage();
            return false;
        }
    }
    function getall_danhmuc(){
    $conn=connectdb();
    $stmt = $conn->prepare("SELECT * FROM tbl_danhmuc");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();



    return $kq;
}
?>