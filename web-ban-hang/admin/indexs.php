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
           
               if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
                   $target_dir = "assets/img/";
                   if (!is_dir($target_dir)) {
                       mkdir($target_dir, 0777, true);
                   }
               
                   $imageFileType = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
                   $allowed_types = ["jpg", "jpeg", "png", "gif"];
               
                   if (in_array($imageFileType, $allowed_types)) {
                       $newFileName = uniqid() . "." . $imageFileType;  // Tránh trùng tên file
                       $target_file = $target_dir . $newFileName;
               
                       if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                           $img = $newFileName; // Chỉ lưu tên file vào CSDL
                       } else {
                           echo "<script>alert('Lỗi: Không thể di chuyển file! Kiểm tra quyền thư mục.');</script>";
                           $img = "";
                       }
                   } else {
                       echo "<script>alert('Lỗi: Chỉ chấp nhận định dạng JPG, JPEG, PNG, GIF!');</script>";
                       $img = "";
                   }
               } else {
                   echo "<script>alert('Lỗi: Không có file hoặc lỗi khi tải lên!');</script>";
               }
           
               // ✅ Gọi hàm thêm sản phẩm vào CSDL
               if ($tensp != "" && $gia != "" && $iddm != "") {
                   insert_sanpham($iddm, $tensp, $img, $gia);  
                   echo "<script>alert('Thêm sản phẩm thành công!');</script>";
                   header("Location: indexs.php?act=sanpham");
                   exit();
               } else {
                   echo "<script>alert('Lỗi: Vui lòng nhập đầy đủ thông tin sản phẩm!');</script>";
               }
           }
           
            $kq = getall_sanpham();
            include "views/sanpham.php";
            break;
         case 'delete_sp':
            $dsdm=getall_danhmuc();
            if(isset($_GET['id'])){
                  $id=$_GET['id'];
                  delete_sp($id);
            }
            //load danh sách sản phẩm
            $kq=getall_sanpham();
               include "views/sanpham.php";;
            break;
         case 'update_sp': 
            //load danh sách danh mục 
            $dsdm=getall_danhmuc();

            if(isset($_GET['capnhat'])&&($_GET['capnhat'])){
               //$spct=getone_sp($_GET['id']);
               $iddm = $_POST['iddm'];
               $tensp = $_POST['tensp'];
               $gia = $_POST['gia'];
               $id = $_POST['id'];
               if($_FILES["img"]["name"]!=""){
                  $target_dir = "assets/img/";
                  if (!is_dir($target_dir)) {
                      mkdir($target_dir, 0777, true);
                  }
              
                  $imageFileType = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
                  $allowed_types = ["jpg", "jpeg", "png", "gif"];
              
                  if (in_array($imageFileType, $allowed_types)) {
                      $newFileName = uniqid() . "." . $imageFileType;  // Tránh trùng tên file
                      $target_file = $target_dir . $newFileName;
              
                      if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                          $img = $newFileName; // Chỉ lưu tên file vào CSDL
                      } else {
                          echo "<script>alert('Lỗi: Không thể di chuyển file! Kiểm tra quyền thư mục.');</script>";
                          $img = "";
                      }
                  } else {
                      echo "<script>alert('Lỗi: Chỉ chấp nhận định dạng JPG, JPEG, PNG, GIF!');</script>";
                      $img = "";
                  }
              } else {
                  echo "<script>alert('Lỗi: Không có file hoặc lỗi khi tải lên!');</script>";
              }else{
                $img=""
              }
              update_sp($id, $tendsp, $img, $gia, $iddm)

            }else{
               $spct= null;
            }
               

            
            //load danh sách sản phẩm
            
            $kq=getall_sanpham();
               include "views/sanpham.php";
               break; 
      
      default:
         
         

     }
  }else{
     include "";
  }
     
     
     

    
    


    





    
     

?>