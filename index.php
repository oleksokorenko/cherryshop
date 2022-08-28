<?php require_once "page_controller.php"; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cherry.shop.Sumy.ua</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;1,200&display=swap" rel="stylesheet">
    <!-- <style>
        .img{
    background:url(/img/logo.jpg)  ;
    height: 100px;
    width: 100px;
    background-size: cover;
    margin: 10px;
    border-radius: 50%;
    


        }
        .flex{
            border: 10px solid green;
            height: max-content;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;


        }
        .flex > div{
            border: 5px dashed red;
            height: 200px;
            width: 30%;
            margin: 5px;
            background-color: aquamarine;

        }
        .flex_break{
            flex-basis: 100%;
            height: 0 !important;
            opacity: 0;
            /* width: auto; */
        }

    </style> -->
</head>
<body>
    <header id="top_page">
        <div class="marquee">
            
            <p>Shop-sumy.com.ua</p>
        </div>
        <div class="menu_box">
           <div class="logo-box">
                <div class="logo"><a href="/"><img src="./img/logo.jpg" alt="logo czerry"></a></div>
           </div>
            <ul class="menu">
                <li><a href="shop.html?type=sport">Sport</a></li>
                <!-- <li><a href="#">Nowości</a></li>
                <li><a href="#">Sale%</a></li> -->
                <li><a href="shop.html?type=aksesoria">Akcesoria</a></li>
                <li><a href="shop.html?type=odirz">Ubranie</a></li>
                <li><a href="shop.html?type=dekor">Wystrój domu</a></li>
                <li id="basket_key">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <!-- <i class="fa-solid fa-bars"></i> -->
                    <span></span>
                </li>
            </ul>
            <div class="burger"><i class="fa-solid fa-bars"></i>
            </div>
       </div>
    </header>
    <!-- <section class="promo_kod">
        <div>
            <span>Sale from</span>
            <span>Sale to</span>
            <span class="flex_break"></span>
            <strong>55%</strong>
            <strong>+</strong>
            <strong>10%</strong>
        </div>
        <div id="promo_info">
            <h3>Spring Sale</h3>
            <p style="display: none;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum, vero.</p>
            <span>Popatrz</span>
            <div id="copy_kod">k</div>

        </div>
        

    </section> -->
    <section class="close_shop">
        <?php foreach($typeList as $oneType) { ?>
            <div style="background-image: url(<?= $oneType["img"] ?>);">
                <a href="<?= $oneType["link"] ?>"><h4><?= $oneType["name"] ?></h4></a>
            </div>
        <?php } ?>
    </section>
<div style="height: 3000px;"></div>
    <!-- ************
    // <div class="img" ></div>
    // <div class="flex">
    //     <div></div>
    //     <div></div>
    //     <div class="flex_break"></div>
    //     <div></div>
    //     <div class="flex_break"></div>
        
    //     <div></div>
        
    //     <div></div>
    // </div>
    <!-- // <input type="text" placeholder="hdhfsi" tabindex=""> -->


<footer>
    <div class="social">
        <a href="https://instagram.com/cherry.ua.shop?utm_medium=copy_link" target="_blank">
            <img src="img/instagram.png" alt="instagram" title="instagram">
        </a>
        <a href="https://www.facebook.com/profile.php?id=100017211275677" target="_blank">
            <img src="img/facebook.png" alt="facebook" title="facebook">
        </a>
    </div>
    <div>
        <p>copyright © 2022. All right reserved by Shop-sumy.com.ua <?= date('d-m-Y H:i:s T') ?></p> 
    </div>
    <div class="phone">
        <a class="fas fa-phone" href="tel:+380500520522">+38 (050) 052-05-22</a>
        <a class="fa-brands fa-viber" href="viber://add?number=+380500520522">+38 (050) 052-05-22</a>
        <a  class="fa-solid fa-at" href="mailto:nyamaolya@gmail.com">nyamaolya@gmail.com</a>>
    </div>
    
    <a  class="to_page "  href="#top_page"> <i class="fa-solid fa-up-long"></i> </a>
   
    
    <!-- cookis -->
    
</footer>
<script src="./js/functions.js"></script>
<script src="./js/script.js"></script>
</body>
</html>