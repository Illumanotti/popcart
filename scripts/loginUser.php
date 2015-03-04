<?php
require 'firebaseLib.php';
session_start();
$username=$_POST['loginUser'];
$password=$_POST['loginPw'];
$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');

$usersPath='/users';

$user=json_decode($firebase->get($usersPath."/".$username),true);

if(!empty($user)){
	if($user['password']==hash('md5',$password)){
		$token=hash('md5',time());
		//setCookie("popCartToken",$token,time() + (86400 * 30), "/");
		$_SESSION['token']=$token;
		//assign token to user
		$path="/accessTokens";
		$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');
		$firebase->set($path."/".$token,$username);
		echo '1';
	}else{
		echo "Incorrect password";
	}
}else{
	echo "Username does not exist";
}





	
	
?>