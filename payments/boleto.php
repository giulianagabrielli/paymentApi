<?php 

    //Set header 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width");

    //Include
    include_once "../database/Database.php";
    include_once "Payment.php";

    //new DB
    $database = new Database();
    $connection = $database->connect();

    //new Payment
    $payment = new Payment();

    //Data from request
    $data = json_decode(file_get_contents("php://input"));
    $payment->clientId = $data->clientId;
    $payment->buyer = $data->buyer;
    $payment->amount = $data->amount;

    //Register
    if($payment->createBoletoPayment()){
        echo json_encode(
            array('message'=> 'Payment registered')
        );
    } else {
        echo json_encode(
            array('message'=> 'Payment not registered')
        );
    }



