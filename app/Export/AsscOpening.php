<?php
namespace App\Export;


class AsscOpening
{
	public $dealerName;
	public $pending;
	public $unclear;
	
	


	function __construct($dealerName,$pending,$unclear) {
	    $this->dealerName = $dealerName;
	    $this->pending = $pending;
	    $this->unclear = $unclear;
	} 
}