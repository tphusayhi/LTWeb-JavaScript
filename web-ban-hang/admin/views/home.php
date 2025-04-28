<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="assets/css/product.css" />
        <script type="text/javascript" src="assets/js/script.js" defer></script>

        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
    <style>
    /* * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    } */

  

    .section {
      max-width: 100%;
      background: #fff;
      border-radius: 10px; 
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
      margin-top: 30px;
    }

    .section .card {
      margin: 10px 70px;
    }
    .section-title {
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 20px;
    }
    .section h2{
      font-size: 30px;
      color: cornflowerblue;
    }
    .section h1{
      font-size: 35px;
      color: darkblue;
    }
    .product-grid {
      display: grid;
      margin-bottom: 20px;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .product {
      background: #fff;
      padding: 15px;
      text-align: center;
      border-radius: 8px;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .product:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .product img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
    }

    .product h3 {
      margin: 10px 0 5px;
      font-size: 1.2rem;
    }

    .product p {
      color: #777;
    }
    #Slider {
    padding-bottom: 30px;
    border-bottom: 2px solid #000;
    overflow: hidden;
    height: 640px;
}
.aspect-ratio-169 {
    display: block;
    position: relative;
    padding-top: 56.25%;
    transition: 0.3s;
    
  }
  
  .aspect-ratio-169 img {
    display: block;
    position: absolute;
    width: 100%;
    height: 75%;
    top: 0;
    left: 0;
  }
  .dot-container{
    position: absolute;
    bottom: 150px;
    height: 10px;
    width: 100%;
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    
  }
  .dot {
    height: 16px;
    width: 16px;
    background-color: #ccc;
    border-radius: 50%;
    margin-right: 12px;
    cursor: pointer;
  }
.dot.active {
    background-color: #333;
}
  </style>
    <body>
<?php if (isset($_COOKIE['promo_ad'])): ?>
    <div class="promo-banner" style="background-color: #ffcc00; padding: 10px; text-align: center;font-size: 18px;color: #333;font-weight: bold;">
    <marquee direction = "right" behavior = "scroll" loop = -1 scrollamount = 10>🎉 Ưu đãi đặc biệt dành cho bạn! Giảm giá 20% cho đơn hàng đầu tiên! 🎉</marquee>
    </div>
<?php endif; ?>
<!-- slider -->
        <section id="Slider">
        <div class="aspect-ratio-169">
            <img src="assets/images/slide1.jpg" alt="slider1">
            <img src="assets/images/slide2.jpg" alt="slider2">
            <img src="assets/images/slide3.jpg" alt="slider3">
            <img src="assets/images/slide4.jpg" alt="slider4">
            <img src="assets/images/slide5.jpg" alt="slider5">
        </div>
        <div class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
        </section>
        <!--<br><br><br>-->
   
    <br><br><br><h1 class="section-title" style="color: darkgray;font-size:35px;">SẢN PHẨM ĐƯỢC QUAN TÂM</h1>
  <div class="section">
    <h1 class="section-title">Sản Phẩm Mới</h1>
    <div class="product-grid">
    <?php
    // Lấy tối đa 6 sản phẩm từ danh sách $sphome1
    $latestProducts = array_slice($sphome1, 0, 6);

    foreach ($latestProducts as $item) {
        $sizes = json_decode($item['sizes'], true);
        echo '<div class="card">
        <span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-heart"></i></span>
        <span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-cart-alt"></i></span>
        <div class="card__img">
        <a href="trangchu.php?act=sanpham_ct&id=' . $item['id'] . '">
            <img src="assets/img/' . htmlspecialchars($item['img']) . '" style="width: 252px; height: 168px; object-fit: cover; object-position: center;" alt="" /></a>
        </div>
        <a href="trangchu.php?act=sanpham_ct&id=' . $item['id'] . '">
        <h2 class="card__title">' . htmlspecialchars($item['tensp']) . '</h2></a>
        <p class="card__price">' . htmlspecialchars($item['gia']) . ' $</p>
        <div class="card__size">
            <h3>Size:</h3>';
        if (is_array($sizes) && count($sizes) > 0) {
            echo "<p>" . implode(' || ', array_map('htmlspecialchars', $sizes)) . "</p>";
        } else {
            echo "<p>Không có size</p>";
        }

        echo '</div>
        <div class="card__action">
            <a href="trangchu.php?act=sanpham_ct&id=' . $item['id'] . '"><button>View</button></a>
        </div>
        </div>';
    }
    ?>
</div>
  </div>

  <div class="section">
    <!-- <h2 class="section-title">SẢN PHẨM MỚI</h2> -->
    <h1 class="section-title">Sản phẩm Top View</h1>
  <div class="product-grid">
  <?php
	    //   foreach($sphome2 as $item){ 
			echo '<div class="card">
			<span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-heart"></i></span>
        <span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-cart-alt"></i></span>
			<div class="card__img">
				<img src="assets/img/'. htmlspecialchars($sphome2[0]['img']) . '" style="width: 252px; height: 168px; object-fit: cover; object-position: center;" alt="" />
			</div>
			<h2 class="card__title">'. htmlspecialchars($sphome2[0]['tensp']) . '</h2>
			<p class="card__price">'.htmlspecialchars($sphome2[0]['gia']) . ' $</p>
			<div class="card__size">
				<h3>Size:</h3>';
				if (is_array($sizes) && count($sizes) > 0) {
          echo "<p>" . implode('|| ', array_map('htmlspecialchars', $sizes)) . "</p>";
      } else {
          echo "<p>Không có size</p>";
      }

      echo '  </div>
			
			<div class="card__action">
				<a href=trangchu.php?act=sanpham_ct&id=' .($sphome2[0]['id']). '"><button>View</button></a>

			</div>
		  </div>';
		//   }


		?>
		<?php
	    //   foreach($sphome2 as $item){ 
			echo '<div class="card">
			<span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-heart"></i></span>
        <span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-cart-alt"></i></span>
			<div class="card__img">
				<img src="assets/img/'. htmlspecialchars($sphome2[1]['img']) . '" style="width: 252px; height: 168px; object-fit: cover; object-position: center;" alt="" />
			</div>
			<h2 class="card__title">'. htmlspecialchars($sphome2[1]['tensp']) . '</h2>
			<p class="card__price">'.htmlspecialchars($sphome2[1]['gia']) . ' $</p>
		  <div class="card__size">
				<h3>Size:</h3>';
				if (is_array($sizes) && count($sizes) > 0) {
          echo "<p>" . implode('|| ', array_map('htmlspecialchars', $sizes)) . "</p>";
      } else {
          echo "<p>Không có size</p>";
      }

      echo '  </div>
			
			<div class="card__action">
				<a href=trangchu.php?act=sanpham_ct&id=' . ($sphome2[1]['id']). '"><button>View</button></a>

			</div>
      </div>';
		//   }


		?>
		<?php
	    //   foreach($sphome2 as $item){ 
			echo '<div class="card">
			<span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-heart"></i></span>
        <span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-cart-alt"></i></span>
			<div class="card__img">
				<img src="assets/img/'. htmlspecialchars($sphome2[2]['img']) . '" style="width: 252px; height: 168px; object-fit: cover; object-position: center;" alt="" />
			</div>
			<h2 class="card__title">'. htmlspecialchars($sphome2[2]['tensp']) . '</h2>
			<p class="card__price">'.htmlspecialchars($sphome2[2]['gia']) . ' $</p>
		  <div class="card__size">
				<h3>Size:</h3>';
				if (is_array($sizes) && count($sizes) > 0) {
          echo "<p>" . implode('|| ', array_map('htmlspecialchars', $sizes)) . "</p>";
      } else {
          echo "<p>Không có size</p>";
      }

      echo '  </div>
			
			<div class="card__action">
				<a href=trangchu.php?act=sanpham_ct&id=' . ($sphome2[2]['id']) . '"><button>View</button></a>

			</div>
      </div>';
		//   }


		?>
  </div>
       

    </body>
    <script>
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
    const imgContainer = document.querySelector(".aspect-ratio-169");
    const dotItem = document.querySelectorAll(".dot");
    let imgNumber = imgPosition.length;
    let index = 0;

    // Thêm transition để slider chuyển động mượt mà
    imgContainer.style.transition = "left 0.5s ease";

    // Cập nhật vị trí ảnh và sự kiện click cho các chấm điều hướng
    imgPosition.forEach(function(image, idx){
        image.style.left = idx * 100 + "%"; // Đặt vị trí ảnh
        dotItem[idx].addEventListener("click", function(){
            slider(idx); // Gọi hàm slider khi nhấn vào chấm
        });
    });

    function imgSlide() {
        index++;
        if (index >= imgNumber) {
            index = 0; // Nếu vượt quá số ảnh, quay lại ảnh đầu tiên
        }
        slider(index);
    }

    function slider(index) {
        // Chuyển slider sang ảnh tương ứng
        imgContainer.style.left = "-" + index * 100 + "%";
        
        // Cập nhật chấm điều hướng
        const dotActive = document.querySelector(".dot.active");
        if (dotActive) {
            dotActive.classList.remove("active"); // Gỡ bỏ lớp active ở chấm hiện tại
        }
        dotItem[index].classList.add("active"); // Thêm lớp active cho chấm hiện tại
    }

    // Tự động chuyển ảnh mỗi 5 giây
    setInterval(imgSlide, 5000);
</script>

</html>