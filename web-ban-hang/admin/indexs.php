<?php
      session_start();
      ob_start();
      include "models/database.php";
      include "models/danhmuc.php";
      include "models/sanpham.php";
      $conn = connectdb();
      
     



     include "views/header.php";
     
     if(isset($_GET['act'])){   
      switch($_GET['act']){   
         case 'danhmuc' :
          // nhận yêu cầu xử lý và lấy danh sách danh mục
             
             $kq=getall_danhmuc();
             include "views/danhmuc.php";
             break;
         case 'delete_dm':
               if(isset($_GET['id'])){
                   $id=$_GET['id'];
                   delete_dm($id);
               }
               $kq=getall_danhmuc();
               include "views/danhmuc.php";
                //include "views/updateform_dm.php";
               break;
         case 'update_dm':
            // Hiển thị form cập nhật khi có ID
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                  $id = (int)$_GET['id']; // Ép kiểu tránh lỗi SQL Injection
                  $kqone = getonedm($id);
                  $kq=getall_danhmuc(); // Lấy thông tin danh mục cần sửa
                  include "views/update_dm.php";
                  exit();
            }
         
            // Xử lý cập nhật khi có dữ liệu gửi lên bằng POST
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['tendm'])) {
                  $id = (int)$_POST['id'];
                  $tendm = trim($_POST['tendm']); // Xóa khoảng trắng đầu cuối
         
                  if (!empty($tendm)) {
                     update_dm($id, $tendm);
                     header("Location: indexs.php?act=danhmuc"); // Chuyển hướng về danh sách
                     exit();
                  } else {
                     echo "Tên danh mục không thể để trống.";
                  }
            }
            break;
              
         case 'themdm':
            if (isset($_POST['them']) && !empty($_POST['tendm'])) {
                  $tendm = trim($_POST['tendm']);
                  
                  if (!empty($tendm)) {
                     $message = themdm($tendm); // Gọi hàm themdm() để thêm danh mục
                     echo "<script>alert('$message');</script>"; // Hiển thị thông báo
                  } else {
                     echo "<script>alert('Vui lòng nhập tên danh mục!');</script>";
                  }
            }
         
            // Lấy danh sách danh mục sau khi thêm mới
            $kq = getall_danhmuc();
            include "views/danhmuc.php";
            break; 
          // Sản Phẩm  
         case 'sanpham' :
            // load danh sách danh mục 
            $dsdm=getall_danhmuc();

            
            //load danh sách sản phẩm
            $kq=getall_sanpham();
               include "views/sanpham.php";
               break;   
         case 'themsp':
            // Load danh sách danh mục
            $dsdm = getall_danhmuc();
         
            if (isset($_POST['them'])) {
               $iddm = $_POST['iddm'];
               $tensp = $_POST['tensp'];
               $gia = $_POST['gia'];
               $img = "";

               // if($_FILES['img']['name']!="") $img=$_FILES['img']['name']; else $img="";
            
            //Kiểm tra xem có ảnh được tải lên không
            

               $target_dir = "../img/";
               $target_file = $target_dir . basename($_FILES["img"]["name"]);
               $img=$target_file;
               $uploadOk = 1;
               $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
               if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
               && $imageFileType != "gif" ) {
               //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                 $uploadOk = 0;
               }
               move_uploaded_file($_FILES['img']['tmp_name'], $target_file);


               // if($_FILES['img']['name']!="") $img=$_FILES['img']['name']; else $img="";
                  
               
      

      
               // Gọi hàm thêm sản phẩm
               insert_sanpham($iddm, $tensp, $img, $gia);
      
               // Chuyển hướng sau khi thêm thành công
               header("Location: indexs.php?act=sanpham");
               exit();
         
            
            }
            // Load danh sách sản phẩm
            $kq = getall_sanpham();
            include "views/sanpham.php";
            break;
              
         default:
         
         

     }
  }else{
     include "";
  }
     
     
     

    
    


    





    
     

?>