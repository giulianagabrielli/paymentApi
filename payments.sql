create database payments;

use payments;

CREATE TABLE `transactions` (
  `clientId` int (20) NOT NULL PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `cardHolderName` varchar(255),
  `cardNumber` bigint (100),
  `cardExpDate` varchar(5),
  `cardCvv` int(4),
  `created_at`datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);