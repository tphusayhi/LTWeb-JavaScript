
<?php 
    function update_sp($id, $tensp, $img, $gia, $view, $detail, $iddm, $sizes) {
        $conn=connectdb();
        if($img==""){

        $sql = "UPDATE tbl_sanpham SET tensp='".$tensp."', gia='".$gia."', view='".$view."', detail='".$detail."', sizes='".$sizes."', iddm='".$iddm."' WHERE id=".$id;
        }else{
            $sql = "UPDATE tbl_sanpham SET tensp='".$tensp."', gia='".$gia."', view='".$view."', detail='".$detail."', sizes='".$sizes."', iddm='".$iddm."', img='".$img."' WHERE id=".$id;


        }
        // $stmt->bindParam(':tensp', $tensp, PDO::PARAM_STR);
        // $stmt->bindParam(':gia', $gia, PDO::PARAM_INT);
        // $stmt->bindParam(':iddm', $iddm, PDO::PARAM_INT);
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // if ($img != "") {
        //     $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        // }

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // execute the query
        $stmt->execute();
    }

    
    
    
    
    

    function getone_sp($id) {
        $conn = connectdb();
        try {
            $stmt = $conn->prepare("SELECT * FROM tbl_sanpham WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Cập nhật lượt xem sản phẩm
            $updateView = $conn->prepare("UPDATE tbl_sanpham SET view = view + 1 WHERE id = :id");
            $updateView->bindParam(":id", $id, PDO::PARAM_INT);
            $updateView->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi khi lấy sản phẩm: " . $e->getMessage();
            return false;
        }
        // try {
        //     $stmt = $conn->prepare("SELECT * FROM tbl_sanpham WHERE id = :id");
        //     $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        //     $stmt->execute();
        //     return $stmt->fetch(PDO::FETCH_ASSOC); // Lấy 1 dòng duy nhất
        // } catch (PDOException $e) {
        //     echo "Lỗi khi lấy sản phẩm: " . $e->getMessage();
        //     return false;
        // }
    }
     
    
     function delete_sp($id) {
        $conn = connectdb();
        
    
        try {
            $stmt = $conn->prepare("DELETE FROM tbl_sanpham WHERE id = :id"); // Sửa đúng bảng sản phẩm
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->rowCount(); // Trả về số dòng đã xóa (0 nếu không có dòng nào bị xóa)
        } catch (PDOException $e) {
            echo "Lỗi khi xóa sản phẩm: " . $e->getMessage();
            return false;
        }
    }
    

    
    function insert_sanpham($iddm, $tensp, $img, $gia, $view, $detail, $sizes) {
        try {
            $conn = connectdb();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Nếu không có ảnh, chèn NULL
            $sql = "INSERT INTO tbl_sanpham (iddm, tensp, img, gia, view, detail, sizes) 
                    VALUES (:iddm, :tensp, :img, :gia, 0, :detail, :sizes)";
                    
            $stmt = $conn->prepare($sql);
    
            // Ràng buộc dữ liệu đầu vào
            $stmt->bindParam(':iddm', $iddm, PDO::PARAM_INT);
            $stmt->bindParam(':tensp', $tensp, PDO::PARAM_STR);
            $stmt->bindParam(':gia', $gia, PDO::PARAM_INT);
            $stmt->bindParam(':detail', $detail, PDO::PARAM_STR);
            $stmt->bindParam(':sizes', $sizes, PDO::PARAM_STR);
    
            if (!empty($img)) {
                $stmt->bindParam(':img', $img, PDO::PARAM_STR);
            } else {
                $img = NULL;
                $stmt->bindParam(':img', $img, PDO::PARAM_NULL);
            }
    
            // Thực thi truy vấn
            $stmt->execute();
    
            // Đóng kết nối
            $conn = null;
    
            return true; // Trả về `true` nếu thêm sản phẩm thành công
        } catch (PDOException $e) {
            error_log("Lỗi thêm sản phẩm: " . $e->getMessage()); // Ghi log lỗi
            return false;
        }
    }
    
  
     
          
       

     function getall_sanpham(){
        $conn=connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_sanpham");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
    
    
    
        return $kq;
     }
?>