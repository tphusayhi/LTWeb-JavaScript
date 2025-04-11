<?php   
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
        
        function getall_sanpham($iddm = 0, $view = 1, $sort_price = 'ASC') {
            $conn = connectdb();
            $sql = "SELECT * FROM tbl_sanpham WHERE 1";
            
            // Nếu có ID danh mục, thêm điều kiện lọc
            if ($iddm > 0) {
                $sql .= " AND iddm = " . (int)$iddm; // Ép kiểu để tránh lỗi SQL Injection
            }
            
            // Lọc theo giá nếu có yêu cầu
            if ($sort_price == 'ASC' || $sort_price == 'DESC') {
                $sql .= " ORDER BY gia " . $sort_price;
            } else {
                // Nếu không có yêu cầu sắp xếp theo giá thì sắp xếp theo lượt xem hoặc ID
                if ($view == 1) {
                    $sql .= " ORDER BY view DESC";
                } else {
                    $sql .= " ORDER BY id DESC";
                }
            }
            
            // Thực thi câu truy vấn
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

