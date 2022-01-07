<?php
namespace App\Export;

class AsscSalesPercentage
{
	public $cashFinance;
	public $percentage;
	public $count;

	function __construct($cashFinance,$percentage,$count) {

	    $this->cashFinance = $cashFinance;
	    $this->percentage = $percentage;
	    $this->count = $count;
	} 

}