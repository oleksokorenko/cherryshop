<?php 
require_once "config.php";
require_once "model.php";


try {
    if(isset($_POST["form_name"])){
        switch($_POST["form_name"]){
            case "order":
                trimFields($_POST);
                formValidate($_POST);
                printScreen($_POST);
                $connect = createConnect();
                $result = mysqli_query($connect, "SELECT * FROM `users` WHERE `phone` = '{$_POST["phone"]}'");
                $userId =  mysqli_fetch_assoc($result)["id"];               
                if(!$userId){
                    mysqli_query($connect, "
                        INSERT INTO `users`
                        SET `phone` = '{$_POST["phone"]}',
                        `email` = '{$_POST["email"]}',
                        `name` = '{$_POST["name"]}'
                    ");
                    $userId = mysqli_insert_id($connect);
                }
                printScreen($userId);

                
                $puchases = [];
                foreach(json_decode($_POST["puchases"], true) as $puchase){
                    if(!$puchase){
                        continue;
                    }
                    $puchases[$puchase["id"]] = $puchase["quantity"];
                }
                
                $idList = implode(",", array_keys($puchases));





                $productPrice = mysqli_query($connect, "
                    SELECT p.`price`, pur.`id` 
                    FROM `purchases` pur 
                    INNER JOIN `products` p ON pur.`product` = p.`id` 
                    WHERE pur.`id` IN ($idList);
                ");
                $productPriceArr = mysqli_fetch_all($productPrice, MYSQLI_ASSOC);
                printScreen($productPriceArr);
                printScreen($puchases);
                $fullPrice = 0;

                
                foreach($productPriceArr as $key => $onePriceProduct ){
                    $fullPrice += $onePriceProduct["price"] * $puchases[$onePriceProduct["id"]];
                }
                printScreen($fullPrice);
                mysqli_query($connect, "
                    INSERT INTO `orders`
                    SET `user` = '{$userId}',
                    `address` = '{$_POST["address"]}',
                    `comment` = '{$_POST["comment"]}',
                    `fullprise` = '{$fullPrice}'
                ");
                $orderId = mysqli_insert_id($connect);
                printScreen($orderId);


                mysqli_query($connect, "
                    INSERT INTO `purchers_by_order`
                    (`purchase`, `order`,`quantity`)
                    VALUES ('{$puchases}', 134, 'cap is yellow')
                ");
                $puchases = array_map(function($item){
                    global $orderId;
                    return ["purchase" => $item["id"], "order" => $orderId, "quantity" => $item];
                }, $productPriceArr);
                printScreen($productPriceArr);
                
                

                // function multiInsert():void{};
                
            


                
                


                



                
            




                // echo "Obrobka ordera";
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
