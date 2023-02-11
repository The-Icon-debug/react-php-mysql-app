<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 86400");
    header("Access-Control-Allow-Headers: Content-Type, Origin, Accept, Authorization, X-Requested-With");
    header("HTTP/1.1 200 OK");


    include_once '../config/database.php';
    include_once '../class/products.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $item = new Product($db);

    $data = json_decode(file_get_contents("php://input"));

    //
    $item->sku = $data->sku;
    $item->name = $data->name;
    $item->price = $data->price;
    $item->type = $data->type;
    $item->value = $data->value;
    
    if($item->createProduct()){
        echo 'Product created successfully.';
    } else{
        echo 'Product could not be created.';
    }
?>