<?php 

    //Set header 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
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
    $transaction->clientId = isset($_GET['clientId']) ? $_GET['clientId'] : die();

    $transaction->findPayment(); 
        
        if($transaction->payment['type'] == "boleto"){  
    
            $transaction_arr = array(
                'clientId' => $transaction->clientId,
                'buyer'=> [
                    'name' => $transaction->buyer['name'], 
                    'email' => $transaction->buyer['email'], 
                    'cpf' => $transaction->buyer['cpf']
                ],
                'payment' => [
                    'type' => $transaction->payment['type'], 
                    'amount' => $transaction->payment['amount']
                ],
                'boletoNumber' => "1234 4556 6778 8888888"
            );
    
            //turn to json
            echo json_encode($transaction_arr);
    
        } elseif ($transaction->payment['type'] == "credit card") {

            $transaction_arr = array(
                'clientId' => $transaction->clientId,
                'buyer'=> [
                    'name' => $transaction->buyer['name'], 
                    'email' => $transaction->buyer['email'], 
                    'cpf' => $transaction->buyer['cpf']
                ],
                'payment' => [
                    'type' => $transaction->payment['type'], 
                    'amount' => $transaction->payment['amount']
                ],
                'creditCard' => [
                    'cardHolderName' => $transaction->creditCard['cardHolderName'], 'cardNumber' => $transaction->creditCard['cardNumber'], 
                    'cardExpDate' => $transaction->creditCard['cardExpDate'], 
                    'cardCvv' => $transaction->creditCard['cardCvv']
                ],
                'status' => "Authorized"
            );
    
            //turn to json
            echo json_encode($transaction_arr);
        } else {
            echo json_encode(
                array('message'=> 'No client id found')
            );

        }

    
    

