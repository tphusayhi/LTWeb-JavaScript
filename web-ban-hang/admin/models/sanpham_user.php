<?php
        function getall_sanpham($iddm = 0, $view = 1){
            $conn = connectdb();
            $sql = "SELECT * FROM tbl_sanpham WHERE 1";
        
            // Nếu có ID danh mục, thêm điều kiện lọc
            if ($iddm > 0) {
                $sql .= " AND iddm = " . (int)$iddm; // Ép kiểu để tránh lỗi SQL Injection
            }
        
            // Sắp xếp theo lượt xem hoặc theo ID
            if ($view == 1) {
                $sql .= " ORDER BY view DESC";
            } else {
                $sql .= " ORDER BY id DESC";
            }
        
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $kq = $stmt->fetchAll();
        
            return $kq;
        }
        
        // function getall_sanpham($iddm, $view = 1){
        //     $conn=connectdb();
        //     $sql="SELECT * FROM tbl_sanpham WHERE 1";

        //     if($iddm>0){
        //                 $sql.=" AND iddm=".$iddm.;
        //             }

        //     if($view==1){
        //         $sql.=" order by view DESC";
        //     }else{
        //         $sql.=" order by id DESC";
        //     }
        //     $stmt = $conn->prepare($sql);
        //     $stmt->execute();
        //     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //     $kq = $stmt->fetchAll();



        //     return $kq;
        // } 
 ?>

