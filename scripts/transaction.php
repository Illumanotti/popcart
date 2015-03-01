<?php
require_once 'braintree/lib/Braintree.php';

//Braintree configuration 
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('nrqrmbjbsxdypmg2');
Braintree_Configuration::publicKey('h5m6ty4z7m4py9sf');
Braintree_Configuration::privateKey('06accf2ab77b6f3f54c040fefa8b3dec');


$result = Braintree_Transaction::sale(array(
    "amount" => "1000.00",
    "creditCard" => array(
        "number" => $_POST["number"],
        "cvv" => $_POST["cvv"],
        "expirationMonth" => $_POST["month"],
        "expirationYear" => $_POST["year"]
    ),
    "options" => array(
        "submitForSettlement" => true
    )
));

if ($result->success) {
    echo("Success! Transaction ID: " . $result->transaction->id);
} else if ($result->transaction) {
    echo("Error: " . $result->message);
    echo("<br/>");
    echo("Code: " . $result->transaction->processorResponseCode);
} else {
    echo("Validation errors:<br/>");
    foreach (($result->errors->deepAll()) as $error) {
        echo("- " . $error->message . "<br/>");
    }
}


?>