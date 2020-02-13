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
            $query = $connection->prepare('INSERT INTO transactions (clientId, name, email, cpf, amount, type) VALUES (:clientId, :name, :email, :cpf, :amount, :type)');

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
            $query = $connection->prepare('INSERT INTO transactions (clientId, name, email, cpf, amount, type, cardHolderName, cardNumber, cardExpDate, cardCvv) VALUES (:clientId, :name, :email, :cpf, :amount, :type, :cardHolderName, :cardNumber, :cardExpDate, :cardCvv)');

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

        public function findPayment(){ 

            //Connecting DB
            $connection = parent::connect();

            //Create query
            $query = $connection->prepare('SELECT * FROM transactions WHERE clientId=:clientId');

            //Binding
            $query->bindValue(':clientId', htmlspecialchars(strip_tags($this->clientId)));

            $query->execute();

            //Array with data from db
            $arrayData = $query->fetch(PDO::FETCH_ASSOC);

            if($arrayData['type'] == "boleto"){

                $this->buyer = [
                    "name" => $arrayData['name'], 
                    "email" => $arrayData['email'], 
                    "cpf" => $arrayData['cpf']
                ];
                $this->payment = [
                    "type" => $arrayData['type'], 
                    "amount" => $arrayData['amount']
                ];
            } else {
                $this->buyer = [
                    "name" => $arrayData['name'], 
                    "email" => $arrayData['email'], 
                    "cpf" => $arrayData['cpf']
                ];
                $this->payment = [
                    "type" => $arrayData['type'], 
                    "amount" => $arrayData['amount']
                ];
                $this->creditCard = [
                    "cardHolderName" => $arrayData['cardHolderName'], 
                    "cardNumber" => $arrayData['cardNumber'], 
                    "cardExpDate" => $arrayData['cardExpDate'], 
                    "cardCvv" => $arrayData['cardCvv']
                ];
            }
    
        }


    }