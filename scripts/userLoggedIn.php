<?php
	session_start();
	if(isset($_SESSION['popcartUser'])){
		echo $_SESSION['popcartUser'];
	}
?>