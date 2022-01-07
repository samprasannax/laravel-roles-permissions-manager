<?php
namespace App\Export;

class CancelReceipt
{
	public $receiptNo;
	public $receiptDate; 
	public $customerName;	
	public $paidAmount;	
	public $paymentMode;	

	function __construct($receiptNo,$receiptDate,$customerName,$paidAmount,$paymentMode) {

	    $this->receiptNo = $receiptNo;
	    $this->receiptDate = $receiptDate;
	    $this->customerName = $customerName;
	    $this->paidAmount = $paidAmount;
	    $this->paymentMode = $paymentMode;
	} 

}