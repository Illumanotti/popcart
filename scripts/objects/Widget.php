<?php
class Widget{
	public $widgetHeight;
	public $widgetWidth;
	public $showHeader;
	public $colorScheme;
	public $username;
	
	public function __construct($newH,$newW,$newHeader,$newColor,$newUser){
		$this->widgetHeight=$newH;
		$this->widgetWidth=$newW;
		$this->showHeader=$newHeader;
		$this->colorScheme=$newColor;
		$this->username=$newUser;
	}
	

}
?>