<?php
require 'firebaseLib.php';
require 'objects/Product.php';

$path='/products';
$firebase = new Firebase('https://popcart.firebaseio.com', 'u6V7Q6zAxWp6vdhQSmq4pNX4MSUL7mtPwfqtYFgR');

$username="benjamin";
$productName= $_POST['productName'];
$price=$_POST['productPrice'];
$desc=$_POST['productDesc'];
$stock=$_POST['productStock'];
// an array of allowed extensions
$allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$extension = end($temp);
//check if the file type is image and then extension
// store the files to upload folder
//echo '0' if there is an error
if ((($_FILES["fileToUpload"]["type"] == "image/gif")
|| ($_FILES["fileToUpload"]["type"] == "image/jpeg")
|| ($_FILES["fileToUpload"]["type"] == "image/jpg")
|| ($_FILES["fileToUpload"]["type"] == "image/pjpeg")
|| ($_FILES["fileToUpload"]["type"] == "image/x-png")
|| ($_FILES["fileToUpload"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["fileToUpload"]["error"] > 0) {
    echo "0";
  } else {
    $target = "../uploads/".$username."/";
	$imageURL="https://popcart.herokuapp.com/uploads/".$username."/";
	//create folder if user does not exist
	if (!file_exists($target)) {
    mkdir($target, 0755, true);
	}
	//upload file
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target. $productName.".".$extension);
	
	$productsArray=json_decode($firebase->get($path."/".$username),true);
	$product=new Product(sizeof($productsArray),$productName,$username,$imageURL. $productName.".".$extension,$price,$stock,$desc);
	$productsArray[]=$product;
	$firebase->set(($path."/".$username),$productsArray);
	
	
    echo  "upload/" . $_FILES["fileToUpload"]["name"];
  }
} else {
  echo "0";
}



?>