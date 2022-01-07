<?php
namespace App\Export;

class DealerBookingList
{
    public $bookingDate;
	public $vehicleType;
	public $vehicleModel;
	public $color;	
	public $chassisNo;	
	public $dealerName;	

	function __construct($bookingDate,$vehicleType,$vehicleModel,$color,$chassisNo,$dealerName) {

	    $this->bookingDate = $bookingDate;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->color = $color;
	    $this->chassisNo = $chassisNo;
	    $this->dealerName = $dealerName;
	} 

}