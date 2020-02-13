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

    //new Boleto Payment
    $transactionBoleto = new Transaction();

    $transactionBoleto->clientId = isset($_GET['clientId']) ? $_GET['clientId'] : die();
    
    //boleto
    $transactionBoleto->findBoletoPayment(); 
    
    if($transactionBoleto){  

        $transaction_arr = array(
            'clientId' => $transactionBoleto->clientId,
            'buyer'=> ['name' => $transactionBoleto->buyer['name'], 'email' => $transactionBoleto->buyer['email'], 'cpf' => $transactionBoleto->buyer['cpf']],
            'payment' => ['type' => $transactionBoleto->payment['type'], 'amount' => $transactionBoleto->payment['amount']],
            'boletoNumber' => "1234 4556 6778 8888888"
        );

        //turn to json
        echo json_encode($transaction_arr);

    } else { 
        echo json_encode(
            array('message'=> 'No payment found')
        );
    }

    //new Credit Card Payment
    $transactionCredit = new Transaction();

    $transactionCredit->clientId = isset($_GET['clientId']) ? $_GET['clientId'] : die();
    $transactionCredit->findCreditCardPayment(); 
    
    if($transactionCredit){  

        $transaction_arr = array(
            'clientId' => $transactionCredit->clientId,
            'buyer'=> ['name' => $transactionCredit->buyer['name'], 'email' => $transactionCredit->buyer['email'], 'cpf' => $transactionCredit->buyer['cpf']],
            'payment' => ['type' => $transactionCredit->payment['type'], 'amount' => $transactionCredit->payment['amount']],
            'creditCard' => ['cardHolderName' => $transactionCredit->creditCard['cardHolderName'], 'cardNumber' => $transactionCredit->creditCard['cardNumber'], 'cardExpDate' => $transactionCredit->creditCard['cardExpDate'], 'cardCvv' => $transactionCredit->creditCard['cardCvv']],
            'transaction' => "Transaction Successful!"
        );

        //turn to json
        echo json_encode($transaction_arr);

    } else { 
        echo json_encode(
            array('message'=> 'No payment found')
        );
    }