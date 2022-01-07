<?php
namespace App\Export;


class ReceiptReports
{
	public $receiptNo;
	public $receiptDate;
	public $dealerName;
	public $customerName;
	public $paidAmount;
	public $paymentMode;


	function __construct($receiptNo,$receiptDate,$dealerName,$customerName,$paidAmount,$paymentMode) {
	    $this->receiptNo = $receiptNo;
	    $this->receiptDate = $receiptDate;
	    $this->dealerName = $dealerName;
	    $this->customerName = $customerName;
	    $this->paidAmount = $paidAmount;
	    $this->paymentMode = $paymentMode;
	} 
}