<?php

    include_once "../database/Database.php";

    class Payment extends Database {

        public $clientId;
        public $buyer; //atenção ao array
        public $amount;

        public function createBoletoPayment(){

            //Connecting DB
            $connection = parent::connect();

            //Create query
            $query = $connection->prepare('INSERT INTO boleto (clientId, buyer, amount) VALUES (:clientId, :buyer, :amount)');

            //Binding
            $query->bindValue(':clientId', htmlspecialchars(strip_tags($this->clientId)));
            $query->bindValue(':buyer', htmlspecialchars(strip_tags($this->buyer)));
            $query->bindValue(':amount', htmlspecialchars(strip_tags($this->amount)));

            //Execute query
            if($query->execute()){
                return true;
            } else {
                printf("Error %s.\n", $query->error);
                return false;
            }

        }

        public function findBoletoPayment($clientId){

            //Connecting DB
            $connection = parent::connect();

            //Create query
            $query = $connection->prepare('SELECT * FROM boleto WHERE clientId=$clientId');

            $query->execute();
            return $query;
        }




    }