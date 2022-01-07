<?php
namespace App\Export;

class AsscMonthlyTarget
{
	public $asscName;
	public $target; 
	public $scooter;
	public $motorCycle;
	public $total;	
	public $conversion;
	public $balanceTarget;

	function __construct($asscName,$target,$scooter,$motorCycle,$total,$conversion,$balanceTarget) {

	    $this->asscName = $asscName;
	    $this->target = $target;
	    $this->scooter = $scooter;
	    $this->motorCycle = $motorCycle;
	    $this->total = $total;
	    $this->conversion = $conversion;
	    $this->balanceTarget = $balanceTarget;

	} 

}