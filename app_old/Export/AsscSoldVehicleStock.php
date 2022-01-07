<?php
namespace App\Export;

class AsscSoldVehicleStock
{
	public $bookingDate;
	public $vehicleType; 
	public $vehicleModel;
	public $vehicleColor;
	public $chassisNo;	
	public $customerName;
	public $contactNo;
	public $dealerName;

	function __construct($bookingDate,$vehicleType,$vehicleModel,$vehicleColor,$chassisNo,$customerName,$contactNo,$dealerName) {

	    $this->bookingDate = $bookingDate;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->vehicleColor = $vehicleColor;
	    $this->chassisNo = $chassisNo;
	    $this->customerName = $customerName;
	    $this->contactNo = $contactNo;
	    $this->dealerName = $dealerName;

	} 

}