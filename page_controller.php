<?php
require_once "config.php";
require_once "model.php";

$connect = createConnect();
$productList = getProductList($connect);

$typeList = [];

foreach(getTypeList($connect) as $typeKey => $typeBox){
    $typeList[$typeBox["id"]] = $typeBox;
}

$productList = [];
foreach(getProductList($connect) as $produktKey => $oneProduct){
    $productList[$oneProduct["type"]][] = $oneProduct; 
}
if(@$_GET["type"]){
    $productList = $productList[$_GET["type"]];
}

if(@$_GET["pid"]){
    $product = getDataProductById($connect, $_GET["pid"]);
}















