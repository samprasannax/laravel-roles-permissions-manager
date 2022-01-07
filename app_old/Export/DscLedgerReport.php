<?php
namespace App\Export;


class DscLedgerReport
{
	public $deliveryDate;
	public $customerName;
	public $customerContact;
	public $customerAddress;
	public $salespersonName;
	public $vehicleType;
	public $vehicleModel;
	public $vehicleColor;
	public $chassisNo;
	public $helmatStatus;
	public $hyp;


	function __construct($deliveryDate,$customerName,$customerContact,$customerAddress,$salespersonName,$vehicleType,$vehicleModel,$vehicleColor,$chassisNo,$helmatStatus,$hyp) {
	    $this->deliveryDate = $deliveryDate;
	    $this->customerName = $customerName;
	     $this->customerContact = $customerContact;
	      $this->customerAddress = $customerAddress;
	    $this->salespersonName = $salespersonName;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->vehicleColor = $vehicleColor;
	    $this->chassisNo = $chassisNo;
	    $this->helmatStatus = $helmatStatus;
	    $this->hyp = $hyp;
	} 
}