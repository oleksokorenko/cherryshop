<section>
    <ul class="product_list">
        <?php foreach($productList as $oneProduct) { ?>
            <li onclick="window.location.href = '/?page=product&pid=<?= $oneProduct["id"] ?>'">
                <div><img src="<?= $oneProduct["img"] ?>" ></div>
                <h3><?= $oneProduct["title"] ?></h3>
                <strong><?= $oneProduct["price"] ?> zł</strong>
            </li>
        <?php } ?>
    </ul>
</section>
