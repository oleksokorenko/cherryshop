<?php
$let = 123444;
echo $let;
echo "<br>";
print_r($let);
$var  = false;
print_r($var);
echo "<br>";
var_dump($var);
const KAPITAN = 569008998;
echo KAPITAN;
define("CAP", "olek");
echo CAP;
echo "<br><br>";
echo $let - KAPITAN;
echo "<br><br>";
echo $let . KAPITAN;
$let = "WAR";
echo "<br><br>";
var_dump((int) $var);

echo KAPITAN + (int) $let;
echo "<br><br>";

$ppp = "privet";
$name = "sanya";
// $name = ucfirst($name);
// $ppp = strtoupper($ppp);

$str = ucwords($name . ", " . $ppp . "!");
echo $str;
// echo "<br><br>";
// echo "{$name}_, {$ppp} !";
// echo "<br><br>";
// $name .= "SANYA";
// echo $name;
// echo "<br><br>";
// $number = 25;
// $number += 25;
// echo $number;
echo "<br><br>";
$age = 0;
if ($age >= 18 && $age < 21) {
    echo "wejcie wolne";
}
elseif ($age >= 21 && $age < 65){
    echo "można wszystko";
}
elseif (($age >= 65 && $age < 90) || $age === 0 || $age === 1 ){
    echo "ty emeryt i masz ulge";
}
else {
    echo "wejscie nie wolne";
}

echo "<br><br>";


            //    massiwy

$arr = [12, 14, 5, 8, 35, 344, 334, 6587, "hudjs", 3256, 90];
$counter = 0;
while($counter < count($arr)){
    // echo $arr[$counter] . "<br>";
    $counter ++;
}
echo "<br>";
$people = [
    "sanya" => [
        "age" => 18,
        "height" => 189,
        "color" => "blue",
        "education" => "student",
        "solary" => 500,
        "occupation" => "programmer",
        "passport" => 133,
    ], 
    "oleg" => [
        "age" => 34,
        "height" => 179,
        "color" => "red",
        "education" => "higher",
        "solary" => 15000,
        "occupation" => "director",
        "passport" => 145,
    ],
    "myron" => [
        "age" => 6,
        "height" => 112,
        "color" => "blue",
        "education" => "preschooler",
        "solary" => 11,
        "occupation" => "kid",
        "passport" => 1279,  
    ],
];
$people["oleg"]["age"] += 4;
// echo "<pre>";
// print_r($people);
         ////// for//////////////////////////////



// print_r($arr); 
for($i = 0; $i < count($arr); $i++){
    if(!($arr[$i] % 2)){
        $arr[$i] = ($arr[$i] / 2) . "a";
        continue;
    }
    
    $arr[$i] .= "b";
    if($i < 3){
        break;
    }
}
// print_r($arr);

// foreach///
echo "<br>";
// foreach($people as $key => &$item){
    
//     if($item < 18){
//         unset($item);
//     }
    
//     print_r("$item  ===>  $key");
//     echo "<br>";

// }
// print_r($people);


// ///////////////////////////////masiw w masiwie zmiana struktury masiwa za pomoca cykla
foreach($people as $key => $item){
    $people[$key]["name"] = $key;
    $people[$people[$key]["passport"]] = $people[$key];
    unset($people[$people[$key]["passport"]]["passport"]);
    unset($people[$key]);
}
echo "<br>";
// print_r($people[145]);

// ///////////////wstroennye funk.w masiwie
$colors = [
    0 => "red",
    4 => "blue",
    3 => "green",
    2 => "yellow",
    5 => "black", 
    1 => "orange",
];
echo "<br>";
print_r($colors);
// asort($colors);
// ksort($colors);
// $colors = array_flip($colors);
// var_dump(array_search("blue", $colors));
// var_dump(in_array("red", $colors));
// var_dump(array_shift($colors)) ;
print_r(array_keys($colors)) ;


printScreen($colors);

// ///////////
function printScreen(mixed $data): void {
    echo "<br>";
    echo"<pre>";
    print_r($data);
    echo"<pre/>";
    echo "<br>";
}
// phpinfo();
// connecting baza sql//
$connect = mysqli_connect(
    "uc455454.mysql.tools",
    "uc455454_shopsisterbadabase",
    "Yc75~)ck4U",
    "uc455454_shopsisterbadabase"
);

$result = mysqli_query($connect,"SELECT p.`id`, pr.`title`, pr.`price`, pr.`description`, pr.`img`, s.`value` AS 'size', c.`label` AS 'color', p.`amount`
FROM `purchases` p 
INNER JOIN `products` pr ON p.`product` = pr.`id`
INNER JOIN `colors` c ON p.`color` = c.`id`
INNER JOIN `sizes` s ON p.`size` = s.`id`");
$resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
printScreen($resultArray);
?>
<table>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>price</th>
        <th>description</th>
        <th>img</th>
        <th>size</th>
        <th>color</th>
        <th>amount</th>
    </tr>
    <?php
//     foreach($resultArray as $item){
//         echo "
//     <tr>
//         <td>{$item["id"]}</td>
//         <td>{$item["title"]}</td>
//         <td>{$item["price"]}</td>
//         <td>{$item["description"]}</td>
//         <td>{$item["img"]}</td>
//         <td>{$item["size"]}</td>
//         <td>{$item["color"]}</td>
//         <td>{$item["amount"]}</td>
//     </tr>
//     ";
// }
    ?>


<?php foreach($resultArray as $item){ ?>
    <tr>
        <td><?= $item["id"] ?></td>
        <td><?= $item["title"] ?></td>
        <td><?= $item["price"] ?></td>
        <td><?= $item["description"] ?></td>
        <td><?= $item["img"] ?></td>
        <td><?= $item["size"] ?></td>
        <td><?= $item["color"] ?></td>
        <td><?= $item["amount"] ?></td>
    </tr>
    <?php } ?>



</table>
















