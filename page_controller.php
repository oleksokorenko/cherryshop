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
    'ids',
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
        'id' => $product['ids'][$sizeKey],
        'color_id' => $product['color_ids'][$sizeKey],
        'color_value' => $product['color_values'][$sizeKey],
        'color_label' => $product['color_labels'][$sizeKey],
        'amount' => $product['amounts'][$sizeKey],
    ];
}
// printScreen($product);





