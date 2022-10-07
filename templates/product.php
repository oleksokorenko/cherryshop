<section class="shop_page">
    <div class="model_foto">
        <div><img src="<?= $product["img"] ?>" alt=""></div>

    </div>
    <div class="setting_box">
        <h4><?= $product["type"] ?></h4>
        <h2><?= $product["title"] ?></h2>
        <div class="multi_setting" data-name="id" id="product_id"></div>
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
        <div class="multi_setting" data-name="price" data-value="<?= $product["price"] ?>">
            <strong>Cena:</strong>
            <h5 class="price" > <?= $product["price"] ?> zł</h5>
        </div>
        <button id="add_to_box">Kupić</button>

    </div>
</section>

