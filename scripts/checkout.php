<?php
require_once 'braintree/lib/Braintree.php';
require 'firebaseLib.php';
require 'objects/Transaction.php';

//Braintree configuration 
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('nrqrmbjbsxdypmg2');
Braintree_Configuration::publicKey('h5m6ty4z7m4py9sf');
Braintree_Configuration::privateKey('06accf2ab77b6f3f54c040fefa8b3dec');


$result = Braintree_Transaction::sale(array(
    "amount" => $_POST["totalAmount"],
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
    //echo("Success! Transaction ID: " . $result->transaction->id);
	//log transaction 
	$cartPath='/carts';
	$tranPath='/transactions';
	
	$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');
	
	$buyer=$_POST['buyer'];
	$seller=$_POST['seller'];
	$tranID=$result->transaction->id;
	$orderItems=json_decode($firebase->get(($cartPath."/".$buyer),"POST"));
	$transaction=new Transaction($buyer,$seller,$tranID,$orderItems);
	$tranArray=json_decode($firebase->get($tranPath,true));
	$tranArray[]=$transaction;
	$firebase->set($tranPath,$tranArray);
	//log transaction
	$emptyArray=[];
	$firebase->set(($cartPath."/".$buyer),$emptyArray);
	//clear cart
	
	//clear cart end
	echo "1";
} else if ($result->transaction) {
    echo("Error: " . $result->message);
    echo("<br/>");
    echo("Code: " . $result->transaction->processorResponseCode);
} else {
    echo("Validation errors:<br/>");
	echo $_POST["totalAmount"];
    foreach (($result->errors->deepAll()) as $error) {
        echo("- " . $error->message . "<br/>");
    }
}


?>