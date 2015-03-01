<?php
	$str=file_get_contents('php://input');
	$filename=$str.filename.'jpg';
	$path='../uploads'.$filename;
	echo $str.filename; 
	//file_put-contents($path,$str);
	
	
?>