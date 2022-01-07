<?php
namespace App\Export;

class AsscStockInHand
{
	public $vehicleType;
	public $vehicleModel;
	public $inStock;	

	function __construct($vehicleType,$vehicleModel,$inStock) {

	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->inStock = $inStock;
	} 

}