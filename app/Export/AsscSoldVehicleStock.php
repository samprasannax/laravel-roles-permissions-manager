<?php
namespace App\Export;

class AsscSoldVehicleStock
{
    public $purchaseDate;
    public $deliveryDate;
	public $bookingDate;
	public $vehicleType; 
	public $vehicleModel;
	public $vehicleColor;
	public $chassisNo;	
	public $engineNo;
	public $customerName;
	public $contactNo;
	public $dealerName;
	public $rtoDate;

	function __construct($purchaseDate,$bookingDate,$vehicleType,$vehicleModel,$vehicleColor,$chassisNo,$engineNo,$customerName,$contactNo,$dealerName,$deliveryDate,$rtoDate) {

        $this->purchaseDate = $purchaseDate;
        $this->deliveryDate = $deliveryDate;
	    $this->bookingDate = $bookingDate;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->vehicleColor = $vehicleColor;
	    $this->chassisNo = $chassisNo;
	     $this->engineNo = $engineNo;
	    $this->customerName = $customerName;
	    $this->contactNo = $contactNo;
	    $this->dealerName = $dealerName;
	    $this->rtoDate = $rtoDate;

	} 

}