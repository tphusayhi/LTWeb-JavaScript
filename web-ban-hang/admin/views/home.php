<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="assets/css/product.css" />
        <script type="text/javascript" src="assets/js/script.js" defer></script>
        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
    <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

  

    .section {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 20px;
    }

    .product-grid {
      display: grid;
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
  </style>
    <body>
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
        <div class="section">
    <h2 class="section-title">Top View</h2>
    <div class="product-grid">
		<?php
		foreach($sphome1 as $item){
			echo '<div class="card">
			<span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2; "><i class=\"bx bx-heart\"></i></span>
			<span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2; "><i class=\"bx bx-cart-alt\"></i></span>
			<div class="card__img">
				<img src="assets/img/'. htmlspecialchars($item['img']) . '" style="width: 100%; height: 100%; object-fit: cover; object-position: center;" alt="" />
			</div>
			<h2 class="card__title">'. htmlspecialchars($item['tensp']) . '</h2>
			<p class="card__price">'.htmlspecialchars($item['gia']) . ' $</p>
			<div class="card__size">
				<h3>Size:</h3>
				<span>6</span>
				<span>7</span>
				<span>8</span>
				<span>9</span>
			</div>
			<div class="card__color">
				<h3>Color:</h3>
				<span class="green"></span>
				<span class="red"></span>
				<span class="black"></span>
			</div>
			<div class="card__action">
				<button>Buy now</button>
				<button>Add cart</button>
			</div>
		</div>';
		}


		?>
       
    </div>
  </div>

  <div class="section">
    <h2 class="section-title">Sản phẩm mới</h2>
    <div class="product-grid">
		<?php
	    //   foreach($sphome2 as $item){ 
			echo '<div class="card">
			<span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2; "><i class=\"bx bx-heart\"></i></span>
			<span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2; "><i class=\"bx bx-cart-alt\"></i></span>
			<div class="card__img">
				<img src="assets/img/'. htmlspecialchars($sphome2[0]['img']) . '" style="width: 100%; height: 100%; object-fit: cover; object-position: center;" alt="" />
			</div>
			<h2 class="card__title">'. htmlspecialchars($sphome2[0]['tensp']) . '</h2>
			<p class="card__price">'.htmlspecialchars($sphome2[0]['gia']) . ' $</p>
			<div class="card__size">
				<h3>Size:</h3>
				<span>6</span>
				<span>7</span>
				<span>8</span>
				<span>9</span>
			</div>
			<div class="card__color">
				<h3>Color:</h3>
				<span class="green"></span>
				<span class="red"></span>
				<span class="black"></span>
			</div>
			<div class="card__action">
				<button>Buy now</button>
				<button>Add cart</button>
			</div>
		  </div>';
		//   }


		?>
		<?php
	    //   foreach($sphome2 as $item){ 
			echo '<div class="card">
			<span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2; "><i class=\"bx bx-heart\"></i></span>
			<span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2; "><i class=\"bx bx-cart-alt\"></i></span>
			<div class="card__img">
				<img src="assets/img/'. htmlspecialchars($sphome2[1]['img']) . '" style="width: 100%; height: 100%; object-fit: cover; object-position: center;" alt="" />
			</div>
			<h2 class="card__title">'. htmlspecialchars($sphome2[1]['tensp']) . '</h2>
			<p class="card__price">'.htmlspecialchars($sphome2[1]['gia']) . ' $</p>
			<div class="card__size">
				<h3>Size:</h3>
				<span>6</span>
				<span>7</span>
				<span>8</span>
				<span>9</span>
			</div>
			<div class="card__color">
				<h3>Color:</h3>
				<span class="green"></span>
				<span class="red"></span>
				<span class="black"></span>
			</div>
			<div class="card__action">
				<button>Buy now</button>
				<button>Add cart</button>
			</div>
		  </div>';
		//   }


		?>
		<?php
	    //   foreach($sphome2 as $item){ 
			echo '<div class="card">
			<span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2; "><i class=\"bx bx-heart\"></i></span>
			<span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2; "><i class=\"bx bx-cart-alt\"></i></span>
			<div class="card__img">
				<img src="assets/img/'. htmlspecialchars($sphome2[2]['img']) . '" style="width: 100%; height: 100%; object-fit: cover; object-position: center;" alt="" />
			</div>
			<h2 class="card__title">'. htmlspecialchars($sphome2[2]['tensp']) . '</h2>
			<p class="card__price">'.htmlspecialchars($sphome2[2]['gia']) . ' $</p>
			<div class="card__size">
				<h3>Size:</h3>
				<span>6</span>
				<span>7</span>
				<span>8</span>
				<span>9</span>
			</div>
			<div class="card__color">
				<h3>Color:</h3>
				<span class="green"></span>
				<span class="red"></span>
				<span class="black"></span>
			</div>
			<div class="card__action">
				<button>Buy now</button>
				<button>Add cart</button>
			</div>
		  </div>';
		//   }


		?>
    </div>
  </div>
       

    </body>
    <script>
      const header = document.querySelector("header");
    window.addEventListener("scroll", function(){
        x = window.pageYOffset;
            if (x>0){
                header.classList.add("sticky")
            }
            else{
                header.classList.remove("sticky")
            }
        })
        




    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
    const imgContainer = document.querySelector(".aspect-ratio-169");
    const dotItem = document.querySelectorAll(".dot");
    let imgNuber= imgPosition.length
    let index = 0
        //console.log(impgPosition)

    imgPosition.forEach(function(image, index){
        image.style.left = index * 100 + "%"
        dotItem[index].addEventListener("click",function(){
        slider(index)

        })
    })
    function imgSlide(){
        index++;
        console.log(index)
        if (index>=imgNuber) (index = 0)
        slider (index)
    }
    function slider (index){
        imgContainer.style.left = "-"+index*100 + "%";
        const dotActive = document.querySelector(".active")
        dotActive.classList.remove("active")
        dotItem[index].classList.add("active")
    }



    setInterval(imgSlide,5000)



    </script>
</html>