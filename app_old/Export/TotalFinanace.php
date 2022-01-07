<?php
namespace App\Export;

class TotalFinanace
{
	public $bankName;
	public $totalAmount;

	function __construct($bankName,$totalAmount) {

	    $this->bankName = $bankName;
	    $this->totalAmount = $totalAmount;
	} 

}