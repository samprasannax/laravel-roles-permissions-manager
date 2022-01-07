<?php
namespace App\Export;

class AsscSalesPercentage
{
	public $cashFinance;
	public $percentage;

	function __construct($cashFinance,$percentage) {

	    $this->cashFinance = $cashFinance;
	    $this->percentage = $percentage;
	} 

}