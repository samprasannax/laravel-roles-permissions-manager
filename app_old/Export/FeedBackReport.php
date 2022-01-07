<?php
namespace App\Export;


class FeedbackReport
{
    public $deliveryDate;
	public $customerName;
	public $customerContact;
	public $customerAddress;
	public $dscName;
	public $vehicleType;
	public $vehicleModel;
	public $vehicleColor;
	public $chassisNo;
	public $hyp;
	public $hypBank;
	public $initialPayement;
	public $exchange;
	public $exchangeModel;
	public $valuableAmount;
	public $helmat;
	public $rto;
	public $rc;
	public $checkedBy;
	public $star;
	public $reason;
	public $dscPerformance;
	public $description;


	function __construct($deliveryDate,$customerName,$customerContact,$customerAddress,$dscName,$vehicleType,$vehicleModel,$vehicleColor,$chassisNo,$hyp,$hypBank,$initialPayement,$exchange,$exchangeModel,$valuableAmount,$helmat,$rto,$rc,$checkedBy,$star,$reason,$dscPerformance,$description) {
	    $this->deliveryDate = $deliveryDate;
	    $this->customerName = $customerName;
	    $this->customerContact = $customerContact;
	    $this->customerAddress = $customerAddress;
	    $this->dscName = $dscName;
	    $this->vehicleType = $vehicleType;
	    $this->vehicleModel = $vehicleModel;
	    $this->vehicleColor = $vehicleColor;
	    $this->chassisNo = $chassisNo;
	    $this->hyp = $hyp;
	    $this->hypBank = $hypBank;
	    $this->initialPayement = $initialPayement;
	    $this->exchange = $exchange;
	    $this->exchangeModel = $exchangeModel;
	    $this->valuableAmount = $valuableAmount;
	    $this->$helmat = $helmat;
	    $this->rto = $rto;
	     $this->rc = $rc;
	    $this->checkedBy = $checkedBy;
	    $this->star = $star;
	    $this->reason = $reason;
	    $this->dscPerformance = $dscPerformance;
	    $this->description = $description;
	} 
}