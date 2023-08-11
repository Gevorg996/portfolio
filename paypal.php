<?php

ini_set('display_errors', 'off');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="O">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/css.css">
    <style>
        body {
            background: navy;
            text-align: center;
            color: white;
            padding: 100px;
            font-size: 30px;
        }
    </style>
    <title>paypal</title>
</head>
<body>      

    <?php
    error_reporting(E_ALL & ~E_DEPRECATED);

    $clientID = 'ARp56X0VLCsoPP3zGxnoIIrz4q_0unRm4cv3xKl2w4H_0mQf9jGwKA7DC_XHAOdA9JeWhyUZODojJ9wS';
    $clientSecret = 'EGoVdDpsSOTZZbG5EWqa5bCbgbgxwhgGYdoYFY6yBWj-z1tqfGXNYu-4Zb7DMcjDdZK87UrEp88M1URq';
    $credentials = base64_encode($clientID . ':' . $clientSecret);
    $tokenURL = 'https://api-m.sandbox.paypal.com/v1/oauth2/token';
    $data = [
        'grant_type' => 'client_credentials'
    ];

    $options = [
        'http' => [
            'header' => "Authorization: Basic $credentials\r\n" .
            "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($tokenURL, false, $context);
    if ($response === false) {

        die('Ошибка при получении токена доступа');
    }
    $responseData = json_decode($response, true);

    if (isset($responseData['access_token'])) {
        $accessToken = $responseData['access_token'];

    } else {
        echo 'cant get token';
    }
    require 'vendor/autoload.php';

    use PayPal\Rest\ApiContext;
    use PayPal\Auth\OAuthTokenCredential;
    use PayPal\Api\CreditCard;
    use PayPal\Api\Payment;
    use PayPal\Api\PaymentExecution;

    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientID, $clientSecret)
    );

    $cardNumber = $_POST['cardnumber'];
    $expDate = $_POST['date'];
    $cardHolderName = $_POST['holder'];
    $cvv = $_POST['cvv'];


    $card = new CreditCard();
    $card->setType('visa') 
    ->setNumber($cardNumber)
    ->setExpireMonth(substr($expDate, 0, 2))
    ->setExpireYear(substr($expDate, 3, 2))
    ->setCvv2($cvv)
    ->setFirstName(explode(' ', $cardHolderName)[0])
    ->setLastName(explode(' ', $cardHolderName)[1]);

    try {

        $payment = new Payment();
        $payment->setIntent('sale')
        ->setPayer(
            array(
                'payment_method' => 'credit_card',
                'funding_instruments' => array(
                    array(
                        'credit_card' => $card
                    )
                )
            )
        )
        ->setTransactions(
            array(
                array(
                    'amount' => array(
                        'total' => '10.00', 
                        'currency' => 'USD' 
                    )
                )
            )
        );

        $payment->create($apiContext);

        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId($payment->getPayer()->getPayerInfo()->getPayerId());
        $payment->execute($paymentExecution, $apiContext);

        echo "success: " . $payment->getId();
    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="js/js.js"></script>
</html>