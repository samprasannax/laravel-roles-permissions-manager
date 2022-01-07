<?php
namespace App\Export;

class StockInHand
{
    public $stockDate;
	public $vehicleType;
	public $vehicleModel;
	public $color;	
	public $chassisNo;	

	function __construct($stockDate,$vehicleType,$vehicleModel,$color,$chassisNo) {

	    $this->stockDate = $stockDate;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->color = $color;
	    $this->chassisNo = $chassisNo;
	} 
}