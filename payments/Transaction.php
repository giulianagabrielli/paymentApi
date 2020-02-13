<?php

    include_once "../database/Database.php";

    class Transaction extends Database {

        public $clientId;
        public $buyer; //buyer: name, email, cpf
        public $payment; //payment: amount, type
        public $creditCard; //creditCard: cardHolderName, cardNumber, cardExpDate, cardCvv.

        public function createBoletoPayment(){

            //Connecting DB
            $connection = parent::connect();

            //Create query
            $query = $connection->prepare('INSERT INTO boleto (clientId, name, email, cpf, amount, type) VALUES (:clientId, :name, :email, :cpf, :amount, :type)');

            //Binding
            $query->bindValue(':clientId', htmlspecialchars(strip_tags($this->clientId)));
            $query->bindValue(':name', htmlspecialchars(strip_tags($this->buyer->name)));
            $query->bindValue(':email', htmlspecialchars(strip_tags($this->buyer->email)));
            $query->bindValue(':cpf', htmlspecialchars(strip_tags($this->buyer->cpf)));
            $query->bindValue(':amount', htmlspecialchars(strip_tags($this->payment->amount)));
            $query->bindValue(':type', htmlspecialchars(strip_tags($this->payment->type)));

            //Execute query
            if($query->execute()){
                return true;
            } else {
                printf("Error %s.\n", $query->error);
                return false;
            }

        }

        public function createCreditCardPayment(){

            //Connecting DB
            $connection = parent::connect();

            //Create query
            $query = $connection->prepare('INSERT INTO creditcard (clientId, name, email, cpf, amount, type, cardHolderName, cardNumber, cardExpDate, cardCvv) VALUES (:clientId, :name, :email, :cpf, :amount, :type, :cardHolderName, :cardNumber, :cardExpDate, :cardCvv)');

            //Binding
            $query->bindValue(':clientId', htmlspecialchars(strip_tags($this->clientId)));
            $query->bindValue(':name', htmlspecialchars(strip_tags($this->buyer->name)));
            $query->bindValue(':email', htmlspecialchars(strip_tags($this->buyer->email)));
            $query->bindValue(':cpf', htmlspecialchars(strip_tags($this->buyer->cpf)));
            $query->bindValue(':amount', htmlspecialchars(strip_tags($this->payment->amount)));
            $query->bindValue(':type', htmlspecialchars(strip_tags($this->payment->type)));
            $query->bindValue(':cardHolderName', htmlspecialchars(strip_tags($this->creditCard->cardHolderName)));
            $query->bindValue(':cardNumber', htmlspecialchars(strip_tags($this->creditCard->cardNumber)));
            $query->bindValue(':cardExpDate', htmlspecialchars(strip_tags($this->creditCard->cardExpDate)));
            $query->bindValue(':cardCvv', htmlspecialchars(strip_tags($this->creditCard->cardCvv)));
            
            //Execute query
            if($query->execute()){
                return true;
            } else {
                printf("Error %s.\n", $query->error);
                return false;
            }
        }

        public function findBoletoPayment(){ 

            //Connecting DB
            $connection = parent::connect();

            //Create query
            $query = $connection->prepare('SELECT * FROM boleto WHERE clientId=:clientId');

            //Binding
            $query->bindValue(':clientId', htmlspecialchars(strip_tags($this->clientId)));

            $query->execute();
            // return $query;

            $arrayPayment = $query->fetch(PDO::FETCH_ASSOC);
           
            $this->buyer = ["name" => $arrayPayment['name'], "email" => $arrayPayment['email'], "cpf" => $arrayPayment['cpf']];
            $this->payment = ["type" => $arrayPayment['type'], "amount" => $arrayPayment['amount']];
    
        }


        public function findCreditCardPayment(){ 

            //Connecting DB
            $connection = parent::connect();

            //Create query
            $query = $connection->prepare('SELECT * FROM creditcard WHERE clientId=:clientId');

            //Binding
            $query->bindValue(':clientId', htmlspecialchars(strip_tags($this->clientId)));

            $query->execute();
            // return $query;

            $arrayPayment = $query->fetch(PDO::FETCH_ASSOC);
           
            $this->buyer = ["name" => $arrayPayment['name'], "email" => $arrayPayment['email'], "cpf" => $arrayPayment['cpf']];
            $this->payment = ["type" => $arrayPayment['type'], "amount" => $arrayPayment['amount']];
            $this->credirCard = ["cardHolderName" => $arrayPayment['cardHolderName'], "cardNumber" => $arrayPayment['cardNumber'], "cardExpDate" => $arrayPayment['cardExpDate'], "cardCvv" => $arrayPayment['cardCvv'],];
    
        }






    }