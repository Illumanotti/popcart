<?php
	require 'firebaseLib.php';
	session_start();
	
	header('Access-Control-Allow-Origin: '.'*');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');
$path="/accessTokens";

if(isset($_SESSION['token'])) {
	$token=$_SESSION['token'];
	$username=json_decode($firebase->get($path.'/'.$token));
	if(empty($username)){
		echo '0';
	}else{
		echo $username;
	}
	
}else{
	
	echo '0';
}
?>