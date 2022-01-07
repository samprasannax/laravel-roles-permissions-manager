<?php
namespace App\Export;


class VoucherReceiptReport
{
	public $voucherNo;
	public $voucherDate;
	public $personName;
	public $voucherCategory;
	public $paidAmount;
	public $descriptionDetails;
	public $paymentMode;


	function __construct($voucherNo,$voucherDate,$personName,$voucherCategory,$paidAmount,$descriptionDetails,$paymentMode) {
	    $this->voucherNo = $voucherNo;
	    $this->voucherDate = $voucherDate;
	    $this->personName = $personName;
	    $this->voucherCategory = $voucherCategory;
	    $this->paidAmount = $paidAmount;
	    $this->descriptionDetails = $descriptionDetails;
	    $this->paymentMode = $paymentMode;
	} 
}