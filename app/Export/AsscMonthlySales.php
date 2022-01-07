<?php
namespace App\Export;

class AsscMonthlySales
{
	public $deliveryDate;
	public $dealerName; 
	public $vehicleType;
	public $vehicleModel;
	public $vehicleColor;
	public $chassisNo;
	public $customerName;
	public $contactNo;
	public $description;	
		public $hyp;

	function __construct($deliveryDate,$dealerName,$vehicleType,$vehicleModel,$vehicleColor,$chassisNo,$customerName,$contactNo,$description,$hyp) {

	    $this->deliveryDate = $deliveryDate;
	    $this->dealerName = $dealerName;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->vehicleColor = $vehicleColor;
	    $this->chassisNo = $chassisNo;
	    $this->customerName = $customerName;
	    $this->contactNo = $contactNo;
	    $this->description = $description;
	     $this->hyp = $hyp;
	} 

}