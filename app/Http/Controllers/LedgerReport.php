<?php
namespace App\Http\Controllers;


class LedgerReport
{
	public $reportDate;
	public $receiptNo;
	public $particular;
	public $credit;
	public $debit;
	public $openingBalance;
	public $bgColor;


	function __construct($reportDate,$receiptNo,$particular,$credit,$debit,$openingBalance,$bgColor) {
	    $this->reportDate = $reportDate;
	    $this->receiptNo = $receiptNo;
	    $this->particular = $particular;
	    $this->credit = $credit;
	    $this->debit = $debit;
	    $this->openingBalance = $openingBalance;
	    $this->bgColor = $bgColor;
	} 
}