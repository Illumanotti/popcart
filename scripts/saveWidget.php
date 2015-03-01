<?php
require 'firebaseLib.php';
require 'objects/Widget.php';


$path='/widgets';
$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');

$username='benjamin';
$width=$_POST['width'];
$height=$_POST['height'];
$colorScheme=$_POST['colorScheme'];
$showHeader=$_POST['showHeader'];


$widgetSettings=new Widget($height,$width,$showHeader,$colorScheme,$username);
$firebase->set(($path."/".$username),$widgetSettings);

?>