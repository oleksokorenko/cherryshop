<?php
function createConnect():mysqli {
    $connect = mysqli_connect(
        DB_HOST,
        DB_USER,
        DB_PASSWORD,
        DB_NAME
    );
    if (mysqli_errno($connect)) {
        throw new RuntimeException('ошибка mysqli: ' . mysqli_error($connect));
    }
    /* Устаовите желаемую кодировку после установления соединения */ 
    mysqli_set_charset($connect, 'utf8mb4');
    return $connect;
}


function getProductList(mysqli $connect):array {
    $result = mysqli_query($connect,"
    SELECT 
    pr.`id`, 
    pr.`title`, 
    pr.`price`, 
    pr.`description`, 
    pr.`img`, 
    pt.`name` AS 'type',
    SUM(p.`amount`) AS 'amount'
    FROM `products` pr 
    INNER JOIN `purchases` p ON p.`product` = pr.`id`
    INNER JOIN `product_types` pt ON pr.`type` = pt.`id`
    GROUP BY pr.`id`
    ");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function printScreen(mixed $data): void {
    echo "<br>";
    echo"<pre>";
    print_r($data);
    echo"<pre/>";
    echo "<br>";
}

function getTypeList(mysqli $connect):array {
    $result = mysqli_query($connect,"SELECT * FROM `product_types`");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


// function getClothesShop(mysqli $connect):array{
//     $result = mysqli_query($connect,"SELECT*")
// }





