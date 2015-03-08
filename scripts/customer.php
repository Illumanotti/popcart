<?php
require_once 'braintree/lib/Braintree.php';

//Braintree configuration 
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('nrqrmbjbsxdypmg2');
Braintree_Configuration::publicKey('h5m6ty4z7m4py9sf');
Braintree_Configuration::privateKey('06accf2ab77b6f3f54c040fefa8b3dec');
$result = Braintree_Customer::create(array(
    "firstName" => $_POST["first_name"],
    "lastName" => $_POST["last_name"],
    "creditCard" => array(
        "number" => $_POST["number"],
        "expirationMonth" => $_POST["month"],
        "expirationYear" => $_POST["year"],
        "cvv" => $_POST["cvv"],
        "billingAddress" => array(
            "postalCode" => $_POST["postal_code"]
        )
    )
));

if ($result->success) {
	$newURL='../scripts/subscription.php?customer_id='.$result->customer->id .'&plan='.$_POST['subplan'];
	header('Location: '.$newURL);
	 
} else {
    echo("Validation errors:<br/>");
    foreach (($result->errors->deepAll()) as $error) {
        echo("- " . $error->message . "<br/>");
    }
}

?>