<?php
require_once 'braintree/lib/Braintree.php';

//Braintree configuration 
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('nrqrmbjbsxdypmg2');
Braintree_Configuration::publicKey('h5m6ty4z7m4py9sf');
Braintree_Configuration::privateKey('06accf2ab77b6f3f54c040fefa8b3dec');
try {
    $customer_id = $_GET["customer_id"];
	$plan=$_GET['plan'];
    $customer = Braintree_Customer::find($customer_id);
    $payment_method_token = $customer->creditCards[0]->token;

    $result = Braintree_Subscription::create(array(
        'paymentMethodToken' => $payment_method_token,
        'planId' => $plan
    ));

    if ($result->success) {
        echo("Success! Subscription " . $result->subscription->id . " is " . $result->subscription->status);
    } else {
        echo("Validation errors:<br/>");
        foreach (($result->errors->deepAll()) as $error) {
            echo("- " . $error->message . "<br/>");
        }
    }
} catch (Braintree_Exception_NotFound $e) {
    echo("Failure: no customer found with ID " . $_GET["customer_id"]);
}

?>