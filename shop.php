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
    
</head>
<body>
    <header id="top_page">
        <div class="marquee">
            
            <p>Cherry.shop.ua</p>
        </div>
        <div class="menu_box">
           <div class="logo-box">
                <div class="logo"><a href="/"><img src="./img/logo.jpg" alt="logo czerry"></a></div>
           </div>
            <ul class="menu">
                <li><a href="shop.html?type=sport">Sport</a></li>
                <li><a href="#">Nowości</a></li>
                <li><a href="#">Sale%</a></li>
                <li><a href="shop.html?type=aksesoria">Akcesoria</a></li>
                <li><a href="shop.html?type=odirz">Ubranie</a></li>
                <li><a href="shop.html?type=dekor">Wystrój domu</a></li>
                <li id="basket_key">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <span></span>
                </li>
            </ul>
            <div class="burger">
                <i class="fa-solid fa-bars"></i>
            </div>
       </div>
    </header>
    <section class="shop_page">
        <div class="model_foto">
            <div><img src="./img/ubranie/photo_2022-04-20_16-06-36.jpg" alt=""></div>

        </div>
        <div class="setting_box">
            <h4><?= $product["type"] ?></h4>
            <h2><?= $product["title"] ?></h2>
            <div class="multi_setting" data-name="id" data-value="<?= $product["id"] ?>"></div>
            <div class="multi_setting" data-name="name" data-value="<?= $product["title"] ?>"></div>
            <div class="multi_setting" data-name="size">
                <strong>Rozmiar:</strong>
                <ul>
                    <?php foreach($product['by_sizes'] as $oneSize) { ?>
                        <li data-colors='<?= json_encode($oneSize['colors'], 256) ?>' title="<?= $oneSize['size_label'] ?>"><?= $oneSize['size_label'] ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="multi_setting">
                <strong>Opis:</strong>
                <p><?= $product["description"] ?></p>
            </div>
            <div class="multi_setting" data-name="color">
                <strong>Kolor:</strong>
                <ul class="colors_types" id="colors_types"></ul>
            </div>
            <div class="multi_setting" id="quantity" data-name="quantity">
                <strong>Iloość</strong>
                <input type="number" min="1" max="100">
            </div>
            <div class="multi_setting">
                <strong>Cena:</strong>
                <h5 class="price"><?= $product["price"] ?> zł</h5>
            </div>
            <button id="add_to_box">Kupić</button>

        </div>
    </section>
    


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
        <p>copyright © 2022. All right reserved by Cherry.shop.ua</p> 
    </div>
    <div class="phone">
        <a class="fas fa-phone" href="tel:+380500520522">+38 (050) 052-05-22</a>
        <a class="fa-brands fa-viber" href="viber://add?number=+380500520522">+38 (050) 052-05-22</a>
        <a  class="fa-solid fa-at" href="mailto:nyamaolya@gmail.com">nyamaolya@gmail.com</a>>
    </div>
    
    <a  class="to_page "  href="#top_page"> <i class="fa-solid fa-up-long"></i> </a>
   
    
    
    
</footer>

    <script src="./js/script.js"></script>
</body>
</html>