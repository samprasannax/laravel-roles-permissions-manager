<?php
namespace App\Export;

class Mechanic
{


	public $mname;
	public $contactnumber;
	public $maddress;
	public $type_of_vehicle;
	public $type_of_color;
	public $model;
	public $customer_name;
	public $custno;
	public $sales_person_name;


	function __construct($mname,$contactnumber,$maddress,$type_of_vehicle,$type_of_color,$model,$customer_name,$custno,$sales_person_name) {

	    $this->mname = $mname;
	    $this->contactnumber = $contactnumber;
	    $this->maddress = $maddress;
	    $this->type_of_vehicle = $type_of_vehicle;
	    $this->type_of_color = $type_of_color;
	    $this->model = $model;
	    $this->customer_name = $customer_name;
	    $this->custno = $custno;
	    $this->sales_person_name = $sales_person_name;

	} 

}