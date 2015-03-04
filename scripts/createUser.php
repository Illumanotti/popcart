<?php
require 'firebaseLib.php';
	
$usersPath='/users';
$widgetsPath='/widgets';
$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');

$username=$_POST['userName'];
$password=$_POST['password'];
$confirm=$_POST['confirm'];
$alias=$_POST['alias'];

$usersArray=json_decode($firebase->get($usersPath),true);
$errorMsg="";
if(strcmp($confirm,$password)==0){
	if(!empty($usersArray)){
		foreach($usersArray as $user){
		if($user['user']==$username){
			$errorMsg.= $username." already exists. Choose another username<br/>";
		}
	}
	}
}else{
	$errorMsg.="Password does not match Confirm Password<br/>";
}
if(empty($errorMsg)|| $errorMsg==""){
	$user=array('user'=>$username,'password'=>hash('md5',$password),'alias'=>$alias,'accountType'=>0);
	$firebase->set($usersPath."/".$username,$user);
	$widget=array('widgetHeight'=>500,'widgetWidth'=>500,'showHeader'=>'none','colorScheme'=>'light','username'=>$username);
	$firebase->set($widgetsPath."/".$username,$widget);
	echo "1";
}else{
	echo $errorMsg;
	$errorMsg="";
}


?>