<?php
namespace App\Http\Controllers;


class SelfSaleExchangeVehicle
{
	public $bookingDate;
	public $customerName;
	public $contactNo;
	public $salesPersonName;
	public $exchangeVehicleModel;
	public $exchangeAmount;
	public $totalPaid;
	public $totalRemaining;
	public $status;

	function __construct($bookingDate,$customerName,$contactNo,$salesPersonName,$exchangeVehicleModel,$exchangeAmount,$totalPaid,$totalRemaining,$status) {
	    $this->bookingDate = $bookingDate;
	    $this->customerName = $customerName;
	    $this->contactNo = $contactNo;
	    $this->salesPersonName = $salesPersonName;
	    $this->exchangeVehicleModel = $exchangeVehicleModel;
	    $this->exchangeAmount = $exchangeAmount;
	    $this->totalPaid = $totalPaid;
	    $this->totalRemaining = $totalRemaining;
	    $this->status = $status;

	} 
}