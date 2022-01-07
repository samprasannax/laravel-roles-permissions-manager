<?php
namespace App\Export;

class DscMonthlyTarget
{
	public $dscName;
	public $target; 
	public $scooter;
	public $motorCycle;
	public $total;	
	public $conversion;
	public $balanceTarget;

	function __construct($dscName,$target,$scooter,$motorCycle,$total,$conversion,$balanceTarget) {

	    $this->dscName = $dscName;
	    $this->target = $target;
	    $this->scooter = $scooter;
	    $this->motorCycle = $motorCycle;
	    $this->total = $total;
	    $this->conversion = $conversion;
	    $this->balanceTarget = $balanceTarget;

	} 

}