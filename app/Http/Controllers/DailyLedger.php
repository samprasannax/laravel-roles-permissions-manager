<?php
namespace App\Http\Controllers;


class DailyLedger
{
	public $reportDate;
	public $description;
	public $personName;
	public $voucherType;
	public $credit;
	public $debit;
	public $openingBalance;
	public $colors;


	function __construct($reportDate,$description,$personName,$voucherType,$credit,$debit,$openingBalance,$colors) {
	    $this->reportDate = $reportDate;
	    $this->description = $description;
	    $this->personName = $personName;
	    $this->voucherType = $voucherType;
	    $this->credit = $credit;
	    $this->debit = $debit;
	    $this->openingBalance = $openingBalance;
	    $this->colors = $colors;
	} 
}