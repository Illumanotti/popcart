<?php
class OrderItem{
	public $buyer;
	public $seller;
	public $product;
	public $quantity;
	
	public function __construct($newB,$newS,$newP,$newQ){
		$this->buyer=$newB;
		$this->seller=$newS;
		$this->product=$newP;
		$this->quantity=$newQ;
	}
}
?>