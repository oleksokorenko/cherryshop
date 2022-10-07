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

function getProtectionValue(string|int|float|null $value): string|int|float|null {
    return ($value || !is_numeric($value)) ? "'{$value}'" : $value;
}

function searchItemByField(mysqli $connect, string $table, string $field, mixed $value ): ?int {
    $value = getProtectionValue($value);
    $result = mysqli_query($connect, "SELECT `id` FROM `{$table}` WHERE `{$field}` = {$value}");
    return @mysqli_fetch_assoc($result)["id"];
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

function getProductById(mysqli $connect, int $id):array {
    $result = mysqli_query($connect,"
    SELECT 
    GROUP_CONCAT(p.`id`) AS 'ids', 
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

function formValidate(array &$formData): void {
    $errors = [];
    $formName = $formData["form_name"];
    unset($formData["form_name"]);
    if(!isset(FORM_FIELDS_CONDITIONS[$formName])){
        throw new Exception("Nie ma takiej formu");
    }
    if(count($formData) != count(FORM_FIELDS_CONDITIONS[$formName])){
        $errors[] = "Nie prawidlowa ilość pola";
    }
    foreach(FORM_FIELDS_CONDITIONS[$formName] as $field => $rules){
        if(!isset($formData[$field])){
            $errors[] = "Brak pola  {$rules["name"]}";
        }
        if($rules["required"] === 1 && !$formData[$field]){
            $errors[] = "Puste pole {$rules["name"]}";
        }
        if($rules["condition"] && !preg_match($rules["condition"], $formData[$field])){
            $errors[] = "Pole {$rules["name"]} nieprawidlowo zapisane";
        }
    }
    if(!empty($errors)){
        throw new Exception(implode(",\n", $errors));
    }
}


// function obrezka pustych poley///////////

function trimFields(array &$fields): void {
    foreach($fields as &$field){
        if(is_string($field)){
            $field = trim($field);
        }
    }
}

// ////////////////////////////////////

// $result = preg_match_all(
//     "/(^|\s)(([\w\d_\-]{2,50})@([\w\d]{2,50}))\.([\w]{2,50})(\s|$)/iu",
//     "fghjj@fdd.con adfdf frrfg@mail.ru tde45667 325egfxfv fghsuj54e3@rrhf.com rgddd55645tgn",
//     $matches
// );
// // printScreen($result);
// // printScreen($matches);
// printScreen($matches);
// // var_dump($result);
function insertOneItemToDB(mysqli $connect, string $table, array $fieldsArr): int|string {
    $sqlString = "INSERT INTO `{$table}` SET ";
    foreach($fieldsArr as $field => $value){
        $value = getProtectionValue($value);
        $sqlString .= "`{$field}` = {$value},";
    }
    $sqlString = substr($sqlString, 0, -1);
    mysqli_query($connect, $sqlString);
    return mysqli_insert_id($connect);
}


function insertItemsToDB(mysqli $connect, string $table, array $fieldsArr): void {
    $sqlString = "";
    foreach($fieldsArr as $product){
        $sqlValues = "";
        foreach($product as $field => $value){
            $sqlFields .= "`{$field}`,";
            $sqlValues .= getProtectionValue($value) . ",";
        }
        if(!$sqlString){
            $sqlFields = substr($sqlFields, 0, -1);
            $sqlString .= "INSERT INTO `{$table}` ($sqlFields) VALUES ";
        } 
        $sqlValues = substr($sqlValues, 0, -1);
        $sqlString .= "($sqlValues),";
    }
    $sqlString = substr($sqlString, 0, -1);
    mysqli_query($connect, $sqlString);
}
function getProductPriciesByIds(mysqli $DBconnect, int|string $idList): array{
    $productPrice = mysqli_query($DBconnect, "
        SELECT p.`price`, pur.`id` 
        FROM `purchases` pur 
        INNER JOIN `products` p ON pur.`product` = p.`id` 
        WHERE pur.`id` IN ($idList);
    ");
    return mysqli_fetch_all($productPrice, MYSQLI_ASSOC);
}
function buildPurchaseArray(string $puchasesJSON):array {
    $puchases = [];
    foreach(json_decode($puchasesJSON, true) as $puchase){
        if(!$puchase){
            continue;
        }
        $puchases[$puchase["id"]] = $puchase["quantity"];
    }
    return $puchases;
}

function getArrayKeyList(array $array):string {
    return implode(",", array_keys($array));
}

function getFullPrice(array $productPriceArr, array $puchases): int {
    $fullPrice = 0;
    foreach($productPriceArr as $onePriceProduct ){
        $fullPrice += $onePriceProduct["price"] * $puchases[$onePriceProduct["id"]];
    }
    return $fullPrice;
}

function getOrCreateUser(mysqli $connect, array $request): ?int {
    if(!$userId = searchItemByField($connect, "users", "phone", $request["phone"])){
        $userId = insertOneItemToDB($connect, "users", [
            "phone" => $request["phone"],
            "email" => $request["email"],
            "name" => $request["name"]
        ]);
    }
    return $userId;
}

function createOrder(mysqli $connect, array $request):int {
    $userId = getOrCreateUser($connect, $request);
    $puchases = buildPurchaseArray($request["puchases"]);
    $puchaseIds = getArrayKeyList($puchases);
    $productPriceArr = getProductPriciesByIds($connect, $puchaseIds);
    $fullPrice = getFullPrice($productPriceArr, $puchases);
    $orderId = insertOneItemToDB($connect, "orders", [
        "user" => $userId,
        "address" => $request["address"],
        "comment" => $request["comment"],
        "fullprice" => $fullPrice
    ]);
    $productPriceArr = array_map(function($item){
        global $orderId, $puchases;
        return ["purchase" => $item["id"], "order" => $orderId, "quantity" => $puchases[$item["id"]]];
    }, $productPriceArr);
    insertItemsToDB($connect, "purchers_by_order", $productPriceArr);
    return $orderId;
}

function printAnswer(mixed $data, bool $error = false): string {
    return json_encode([
        "type" => $error ? "error" : "response",
        "data" => $data
    ], JSON_UNESCAPED_UNICODE);
}

function listToArray(array &$subject, array $targetKeys): void
{
    foreach($targetKeys as $targetKey){
        $subject[$targetKey] = explode(',', $subject[$targetKey]);
    }
}

function getDataProductById(mysqli $connect, int $id):array {
    $product = getProductById($connect, $id);
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
    return $product;
}








