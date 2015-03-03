<?php
class Transaction{
	public $buyer;
	public $seller;
	public $transactionID;
	public $items;
	
	public function __construct($newB,$newS,$newT,$newI){
		$this->buyer=$newB;
		$this->seller=$newS;
		$this->transactionID=$newT;
		$this->items=$newI;
	}
	
}

?>