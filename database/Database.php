<?php

    class Database {
        
        //DB Params
        private $host = 'mysql:host=localhost;dbname=payments;port=8889';
        private $username = 'root';
        private $password = 'root';

        //DB Connection
        public function connect(){

            try {

                $connection = new PDO($this->host, $this->username, $this->password);

                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $error) {
                echo "Connection Error: ".$error->getMessage();
            }

            return $connection;
        }


    }