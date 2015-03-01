<?php
require 'firebaseLib.php';
require 'objects/OrderItem.php';

$path='/carts';
$productsPath='/products';
$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');

$buyer=$_POST['buyer'];
$seller=$_POST['seller'];
$productID=$_POST['productID'];

$orderCart=json_decode($firebase->get($path."/".$buyer),true);

$product=json_decode($firebase->get($productsPath."/".$seller."/".$productID));

if($orderCart===null){
	$orderCart=[];
}

$orderItem=new OrderItem($buyer,$seller,$product,1);

$orderCart[]=$orderItem;

$firebase->set(($path."/".$buyer),$orderCart);

echo 'Success!';

?>