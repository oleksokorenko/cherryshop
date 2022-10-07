<?php 
require_once "config.php";
require_once "setting.php";
require_once "model.php";


try {
    if(isset($_POST["form_name"])){
//        echo "hello";
        $connect = createConnect();
        switch($_POST["form_name"]){
            case "order":
                echo "test";
                trimFields($_POST);
                formValidate($_POST);
                $orderId = createOrder($connect, $_POST);
                printAnswer("Wasze zamowienie #{$orderId} uspeszno sohranen");
                break;
            case "review": 
                // echo "Obrobka otzywa";
                break;
            case "set_basket":
                $_SESSION["basket"] = $_POST["basket"];
                echo json_encode(["result" => "ok"]);
                break;
            case "get_basket":
                echo @$_SESSION["basket"] ?: json_encode([]);

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
    printAnswer($e->getMessage(), true);
//    printScreen($e->getTrace());
}
