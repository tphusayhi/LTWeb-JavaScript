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
        <script type="text/javascript" src="asets/js/script.js" defer></script>
        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
	<style>
		/* Ẩn checkbox mặc định */
.custom-checkbox input {
    display: none;
}

/* Tạo hộp checkbox tùy chỉnh */
.custom-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 16px;
    user-select: none;
}

/* Ô vuông */
.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #333;
    border-radius: 4px;
    display: inline-block;
    position: relative;
    margin-right: 10px;
}

/* Khi checkbox được chọn, tạo dấu tick */
.custom-checkbox input:checked + .checkmark::after {
    content: "";
    position: absolute;
    left: 5px;
    top: 2px;
    width: 6px;
    height: 10px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

/* Hiệu ứng khi chọn */
.custom-checkbox input:checked + .checkmark {
    background-color: #007bff;
    border-color: #007bff;
}

#showAllBtn {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
    transition: 0.3s;
}

#showAllBtn:hover {
    background-color: #0056b3;
}


		</style>
    <body>
       

        <!--category-->
        <section class="cartegory">
            <div class="container">
                <div class="cartegory-top row">
                    <p>Trang chủ</p> <span>&#10509;</span> <p>Nữ</p> <span>&#10509;</span> <p>Hàng nữ mới về</p>
                </div>
            </div>
            <div class="contaimer">
                <div class="row">
                    <div class="cartegory-left">
                        <ul>
						<li class="cartegory-left-li"><a href=""><label class="custom-checkbox">
											<input type="checkbox">
											<span class="checkmark"><a href="trangchu.php?act=sanpham_user">
                                            </span>Tất cả sản phẩm
										</label></a></li>
							<?php
							     foreach($dsdm as $dm){
									echo '<li class="cartegory-left-li"><a href=""><label class="custom-checkbox">
											<input type="checkbox">
											<span class="checkmark"></span><a href="trangchu.php?act=sanpham_user&id='.$dm['id'].'">'. htmlspecialchars($dm['tendm']) . '
										</label></a></li>';
								 }

							?>
                            <!-- <li class="cartegory-left-li"><a href="">HÀNG MỚI</a></li>
                            <li class="cartegory-left-li"><a href="">TẾT 2025</a></li>
                            <li class="cartegory-left-li"><a href="#">NAM</a>
                            <ul>
                                <li><a href="">Giày thể thao</a></li>
                                <li><a href="">Giày thời trang</a></li>
                                <li><a href="">Phụ kiện khác</a></li>
                                
                            </ul>
                            </li>
                            <li class="cartegory-left-li"><a href="#">NỮ</a>
                                <ul>
                                    <li><a href="">Giày thể thao</a></li>
                                    <li><a href="">Giày thời trang</a></li>
                                    <li><a href="">Phụ kiện khác</a></li>
                                    
                                </ul>
                            </li>
                            <li class="cartegory-left-li"><a href="">ƯU ĐÃI</a></li>
                            <li class="cartegory-left-li"><a href="">BỘ SƯU TẬP</a></li>
                            <li class="cartegory-left-li"><a href="">THÔNG TIN</a></li> -->
                        </ul>
                    </div>
                    <div class="cartegory-right row">
                        <div class="cartegory-right-top-item">
                            <p>HÀNG MỚI VỀ</P>
                        </div>
                        <div class="cartegory-right-top-item">
                            <button><span>Bộ lọc</span><i class="fas fa-sort-down"></i></button>
                        </div>
                        <div class="cartegory-right-top-item">
                            <select name="" id="">
                                <option value="">Sắp xếp</option>
                                <option value="">Giá cao đến thấp</option>
                                <option value="">Giá thấp đến cao</option>
                            </select>
                        </div>
                        <div class="cartegory-right-content row">
						
						<?php
							foreach($dssp_dm as $item){
								echo '<div class="card">
                            <form action="trangchu.php?act="
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
            <a href="trangchu.php?act=sanpham_ct&id= ' . $item['id'] . '">
                <button>Buy now</button>
            </a>
            <button>Add cart</button>
        </div>

							</div>';

							}


						?>
                        </div>    
                        <div class="cartegory-right-bottom row">
                            <div class="cartegory-right-bottom-items">
                                <p>Hiển thị 2 <span>|</span> 4 sản phẩm</p>
                            </div>
                            <div class="cartegory-right-bottom-items">
                                <p><span>&#171;</span> 1 2 3 4 5 <span>&#187;</span> Trang cuối</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

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

    
	function redirectToAllProducts() {
        const checkbox = document.getElementById("showAllCheckbox");
        if (checkbox.checked) {
            window.location.href = "trangchu.php?act=sanpham_user";
        }
    }

    document.getElementById("showAllCheckbox").addEventListener("change", redirectToAllProducts);


    </script>
</html>