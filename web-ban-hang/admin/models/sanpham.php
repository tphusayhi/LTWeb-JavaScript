<?php 
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