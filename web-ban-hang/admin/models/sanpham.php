<?php 
    function update_sp($id, $tendsp, $img, $gia, $iddm) {
        $conn=connectdb();
        if($img==""){

        $sql = "UPDATE tbl_sanpham SET tensp='".$tensp."', gia='".$gia."', iddm='".$iddm."' WHERE id=".$id;
        }else{
            $sql = "UPDATE tbl_sanpham SET tensp='".$tensp."', gia='".$gia."', iddm='".$iddm."', img='".$img."' WHERE id=".$id;


        }

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
            return $stmt->fetch(PDO::FETCH_ASSOC); // Lấy 1 dòng duy nhất
        } catch (PDOException $e) {
            echo "Lỗi khi lấy sản phẩm: " . $e->getMessage();
            return false;
        }
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
    

    
     function insert_sanpham($iddm, $tensp, $img, $gia) {
        $conn = connectdb();
      try {
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          $sql = "INSERT INTO tbl_sanpham (iddm, tensp, img, gia) VALUES (:iddm, :tensp, :img, :gia)";
          $stmt = $conn->prepare($sql);
          
          $stmt->bindParam(':iddm', $iddm, PDO::PARAM_INT);
          $stmt->bindParam(':tensp', $tensp, PDO::PARAM_STR);
          $stmt->bindParam(':img', $img, PDO::PARAM_STR);
          $stmt->bindParam(':gia', $gia, PDO::PARAM_STR);
          
          $stmt->execute();
          echo "Thêm sản phẩm thành công!";
      } catch (PDOException $e) {
          echo "Lỗi: " . $e->getMessage();
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