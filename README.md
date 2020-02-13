# paymentApi

Api de processo de pagamento utilizando PHP 7.3.9, mySql e Postman.

Há dois modelos de pagamento: boleto ou cartão de crédito.

POST para criação de pagamento via boleto (payments/boleto.php).
POST para criação de pagamento via cartão de crédito (payments/credit-card.php).
GET para visualizar o dados do cliente pela id e com a forma de pagamento dele (payments/findPayment.php).

É necessário rodar o script payments.sql e atualizar as informações de $host em database/Database.php caso não seja http://localhost:8888.

É possível fazer os testes em Postman:

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/814f25dac559de65428f)

