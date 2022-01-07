<?php
namespace App\Export;

class FiancePendingList
{
	public $bookingDate;
	public $customerName;
	public $dscName;
	public $bankName;
	public $ip;
	public $totalAmount;
	public $remainingAmount;
	public $totalPaid;


	function __construct($bookingDate,$customerName,$dscName,$bankName,$ip,$totalAmount,$remainingAmount,$totalPaid) {

	    $this->bookingDate = $bookingDate;
	    $this->customerName = $customerName;
	    $this->dscName = $dscName;
	    $this->bankName = $bankName;
	    $this->ip = $ip;
	    $this->totalAmount = $totalAmount;
	    $this->remainingAmount = $remainingAmount;
	    $this->totalPaid = $totalPaid;

	} 

}