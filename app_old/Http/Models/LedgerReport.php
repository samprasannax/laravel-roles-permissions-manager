<?php
namespace App;

class LedgerReport extends Model
{
	public $reportDate;
	public $receiptNo;


	function __construct($reportDate,$receiptNo) {
	    $this->reportDate = $reportDate;
	    $this->receiptNo = $receiptNo;
	}



   // protected $fillable = ['brand_name','model_name','price','description','image'];


	//$model = new Model;


}