<?php
     function getall_sanpham(){
        $conn=connectdb();
        $stmt = $conn->prepare("SELECT * FROM tbl_sanpham");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll();
    
    
    
        return $kq;
     }
?>