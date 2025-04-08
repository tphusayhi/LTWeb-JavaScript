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
        <header>
            <div class="logo">
                <a href="home.php">
                <img src="assets/images/logo.png" alt="logo" height="70px" width="70px"></a>
            </div>
            <div class="menu">
                <li><a href="cartegory.html">TRANG CHỦ</a></li>
                <li><a href="">ƯU ĐÃI</a></li>
                <li><a href="">SỬA CHỮA</a></li>
                <li><a href="trangchu.php?act=sanpham_user">BỘ SƯU TẬP</a></li>
                <li><a href="trangchu.php?act=donhang">ĐƠN HÀNG</a></li>
                <li><a href="trangchu.php?act=dangxuat">Đăng Xuất</a></li>
            </div>
            <div class="oders">
                <li><input placeholder="Tìm kiếm" type="text"> <i class="fas fa-search"></i></li>
                <li> <a class="fa fa-paw" href="" ></a></li>
                <li> <a class="fa fa-user" href="trangchu.php?act=account" ></a></li>
                <li> <a class="fa fa-shopping-bag" href="trangchu.php?act=viewcart" ></a></li>
            </div>
        </header>
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