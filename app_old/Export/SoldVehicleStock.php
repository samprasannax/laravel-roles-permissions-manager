<?php
namespace App\Export;

class SoldVehicleStock
{
	public $soldDate;
	public $vehicleType; 
	public $vehicleModel;
	public $vehicleColor;
	public $chassisNo;	
	public $customerName;
	public $dscName;

	function __construct($soldDate,$vehicleType,$vehicleModel,$vehicleColor,$chassisNo,$customerName,$dscName) {

	    $this->soldDate = $soldDate;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->vehicleColor = $vehicleColor;
	    $this->chassisNo = $chassisNo;
	    $this->customerName = $customerName;
	    $this->dscName = $dscName;

	} 

}