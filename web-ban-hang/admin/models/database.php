<?php
     
          $host = "localhost";
          $username = "root";
          $password = "";
          $dbname = "user_database";


          $conn = new mysqli($host, $username, $password, $dbname);
          if ($conn->connect_error) {
          die("Kết nối thất bại: " . $conn->connect_error);
          }
          echo "Kết nối thành công";
          





 
?>
