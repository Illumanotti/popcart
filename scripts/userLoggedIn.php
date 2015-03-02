<?php
	session_start();
	
	header('Access-Control-Allow-Origin: '.'*');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

	if(isset($_SESSION['popcartUser'])){
		echo $_SESSION['popcartUser'];
	}
?>