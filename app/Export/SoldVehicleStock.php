<?php
namespace App\Export;

class SoldVehicleStock
{
    public $purchaseDate;
	public $soldDate;
	public $vehicleType; 
	public $vehicleModel;
	public $vehicleColor;
	public $chassisNo;	
	public $engineNo;
	public $customerName;
	public $dscName;
	public $rtoDate;
	public $vehicleNo;
	public $contactNo;

	function __construct($purchaseDate,$soldDate,$vehicleType,$vehicleModel,$vehicleColor,$chassisNo,$engineNo,$customerName,$dscName,$rtoDate,$vehicleNo,$contactNo) {

        $this->purchaseDate = $purchaseDate;
	    $this->soldDate = $soldDate;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->vehicleColor = $vehicleColor;
	    $this->chassisNo = $chassisNo;
	    $this->engineNo = $engineNo;
	    $this->customerName = $customerName;
	    $this->dscName = $dscName;
	    $this->rtoDate = $rtoDate;
	    $this->vehicleNo = $vehicleNo;
	    $this->contactNo = $contactNo;

	} 

}