<?php 
require_once "config.php";
require_once "setting.php";
require_once "model.php";


try {
    if(isset($_POST["form_name"])){
        $connect = createConnect();
        switch($_POST["form_name"]){
            case "order":
                trimFields($_POST);
                formValidate($_POST);                          
                if(!$userId = searchItemByField($connect, "users", "phone", $_POST["phone"])){
                    $userId = insertOneItemToDB($connect, "users", [
                        "phone" => $_POST["phone"],
                        "email" => $_POST["email"],
                        "name" => $_POST["name"]
                    ]);
                }
                $fullPrice = getFullPriceByPurchase($connect, $_POST["puchases"]);
                $orderId = insertOneItemToDB($connect, "orders", [
                    "user" => $userId, 
                    "adress" => $_POST["address"],
                    "comment" => $_POST["comment"],
                    "fullprice" => $fullPrice
                ]);

                $productPriceArr = array_map(function($item){
                    global $orderId, $puchases;
                    return ["purchase" => $item["id"], "order" => $orderId, "quantity" => $puchases[$item["id"]]];
                }, $productPriceArr);
                insertItemsToDB($connect, "purchers_by_order", $productPriceArr);
                printScreen($sqlString );
                break;
            case "review": 
                // echo "Obrobka otzywa";
                break;
            default:
                throw new Exception("Nie ma takiej formy") ;
        }

    //     // if($_POST["form_name"] == "order"){
            
    //     // } elseif($_POST["form_name"] == "review"){
            
    //     // }else{
    //     //     echo "Nie ma takiej formy";
    //     // }
        
    } else {
        throw new Exception("Nie prawidłowy zapros") ;
    }
} catch(Throwable $e){
    print_r($e->getMessage());
    print_r($e->getTrace());
}
