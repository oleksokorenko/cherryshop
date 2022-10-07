<section class="close_shop">
    <?php foreach($typeList as $oneType) { ?>
        <div style="background-image: url(<?= $oneType["img"] ?>);">
            <a href="<?= $oneType["link"] ?>"><h4><?= $oneType["name"] ?></h4></a>
        </div>
    <?php } ?>
</section>