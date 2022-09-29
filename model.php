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

function formValidate(array $formData): void {
    $errors = [];
    $formName = $formData["form_name"];
    if(!isset(FORM_FIELDS_CONDITIONS[$formName])){
        throw new Exception("Nie ma takiej formu");
    }
    unset($formData["form_name"]);
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








