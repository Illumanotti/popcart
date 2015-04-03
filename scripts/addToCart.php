<?php
require 'firebaseLib.php';
require 'objects/OrderItem.php';

	header('Access-Control-Allow-Origin: '.'*');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
$path='/carts';
$productsPath='/products';
$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');

$buyer=$_POST['buyer'];
$seller=$_POST['seller'];
$productID=$_POST['productID'];
$quantity=$_POST['quantity'];

$orderCart=json_decode($firebase->get($path."/".$buyer),true);

$product=json_decode($firebase->get($productsPath."/".$seller."/".$productID));

if($orderCart===null){
	$orderCart=[];
}

$orderItem=new OrderItem($buyer,$seller,$product,$quantity);

$orderCart[]=$orderItem;

$firebase->set(($path."/".$buyer),$orderCart);

echo 'Success!';

?>