<?php
require_once "config.php";
require_once "model.php";

$connect = createConnect();
$productList = getProductList($connect);
// printScreen($productList);

$typeList = [];

foreach(getTypeList($connect) as $typeKey => $typeBox){
    $typeList[$typeBox["id"]] = $typeBox;
}

$productList = [];
foreach(getProductList($connect) as $produktKey => $oneProduct){
    $productList[$oneProduct["type"]][] = $oneProduct; 
}
// printScreen($_GET);
$productList = $productList[$_GET["type"]];
// printScreen($productList);

function getProductById(mysqli $connect, int $id):array {
    $result = mysqli_query($connect,"
    SELECT 
    p.`id`, 
    pr.`title`, 
    pr.`price`, 
    pr.`description`, 
    pr.`img`,
    GROUP_CONCAT(c.`value`) AS 'color_values',
    GROUP_CONCAT(c.`label`) AS 'color_labels',
    GROUP_CONCAT(c.`id`) AS 'color_ids',
    GROUP_CONCAT(s.`label`) AS 'size_labels',
    GROUP_CONCAT(s.`id`) AS 'size_ids',
    pt.`name` AS 'type',
    GROUP_CONCAT(p.`amount`) AS 'amounts'
    FROM `products` pr 
    INNER JOIN `purchases` p ON p.`product` = pr.`id`
    INNER JOIN `colors` c ON c.`id` = p.`color`
    INNER JOIN `sizes` s ON s.`id` = p.`size`
    INNER JOIN `product_types` pt ON pr.`type` = pt.`id`
    WHERE pr.`id` = {$id}
    ");
    return mysqli_fetch_assoc($result);
}

$product = getProductById($connect, 12);

// $product['sizes'] = explode(',', $product['sizes']);
// $product['color_values'] = explode(',', $product['color_values']);
// $product['color_labels'] = explode(',', $product['color_labels']);
// $product['amounts'] = explode(',', $product['amounts']);
function listToArray(array &$subject, array $targetKeys){
    foreach($targetKeys as $targetKey){
       $subject[$targetKey] = explode(',', $subject[$targetKey]); 
    }
}
listToArray($product, [
    'size_ids', 
    'size_labels', 
    'color_ids', 
    'color_values', 
    'color_labels', 
    'amounts'
]);

foreach($product['size_ids'] as $sizeKey => $oneSize){
    $product['by_sizes'][$oneSize]['size_id'] = $oneSize;
    $product['by_sizes'][$oneSize]['size_label'] = $product['size_labels'][$sizeKey];
    $product['by_sizes'][$oneSize]['colors'][] = [
        'color_id' => $product['color_ids'][$sizeKey],
        'color_value' => $product['color_values'][$sizeKey],
        'color_label' => $product['color_labels'][$sizeKey],
        'amount' => $product['amounts'][$sizeKey],
    ];
}
// printScreen($product);





