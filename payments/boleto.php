<?php 

    //Set header 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width");

    //Include
    include_once "../database/Database.php";
    include_once "Transaction.php";

    //new DB
    $database = new Database();
    $connection = $database->connect();

    //new Payment
    $transaction = new Transaction();

    //Data from request
    $data = json_decode(file_get_contents("php://input"));
    $transaction->clientId = $data->clientId;
    $transaction->buyer = $data->buyer; 
    $transaction->payment = $data->payment; 

    //Register
    if($transaction->createBoletoPayment()){
        echo json_encode(
            array('message'=> 'Payment registered')
        );
    } else {
        echo json_encode(
            array('message'=> 'Payment not registered')
        );
    }



