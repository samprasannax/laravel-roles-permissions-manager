<?php
namespace App\Export;

use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Auth;
use App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class DscMonthlyTargetLedger implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        	if (! Gate::allows('admin')) 
			{
				if (! Gate::allows('receipt')) 
				{
					if (! Gate::allows('stock_import')) 
					{
						if (! Gate::allows('gate_pass')) 
						{
							if (! Gate::allows('rto')) {
            					return abort(401);
			            	}
			            }
			        }
            	}
            }
           $target_month="";
            $target_year="";
            

            if(isset($_POST['target_month']))$target_month = $_POST['target_month'];
            if(isset($_POST['target_year']))$target_year = $_POST['target_year'];
           

            if($target_month =='')
            {
            	 $target_month1 = date("m");
            	 $target_year1 = date("Y");
            }
            else
             {
             	 $target_month1 = $target_month;
            	 $target_year1 = $target_year;
             } 


			// $target_month1 = 02;
			// $target_year1 = 2021;


 
			$target_month11 = $target_month1;
			$target_year11 = $target_year1;

			$val3 = 01;

			$date_find = $target_year1."-".$target_month1."-".$val3;

			$from_date1 = date('Y-m-01',strtotime($date_find));// hard-coded '01' for first day
			$to_date1  = date('Y-m-t',strtotime($date_find));




			 $dsc_month_target = DB::table('sales_person')
			 		->leftjoin("dsc_monthly_target",function($join) use ($target_month1,$target_year1){
			            $join->on("dsc_monthly_target.dsc_id","=","sales_person.id")
			                ->where("dsc_monthly_target.target_month","=", $target_month1)
			                ->where("dsc_monthly_target.target_year","=", $target_year1)
			                ->where("sales_person.is_deleted","=", 0);
			        })
			        ->select("sales_person.sales_person_name","dsc_monthly_target.target_qty","sales_person.id",
			        	
			        	DB::raw("(SELECT count(id) as total_scooter FROM self_sale_vehicle_info
                                WHERE self_sale_vehicle_info.sales_person_id = sales_person.id and self_sale_vehicle_info.is_deleted = 0 and self_sale_vehicle_info.vehicle_type_id = 1 and self_sale_vehicle_info.delivery_date between '$from_date1' and '$to_date1') as total_count_scooty"),
                        DB::raw("(SELECT count(id) as total_mc FROM self_sale_vehicle_info
                                WHERE self_sale_vehicle_info.sales_person_id = sales_person.id and self_sale_vehicle_info.is_deleted = 0 and self_sale_vehicle_info.vehicle_type_id = 2  and self_sale_vehicle_info.delivery_date between '$from_date1' and '$to_date1') as total_count_motorcycle"))
				   
				    ->get();


				    $sum_of_dsc_monthly_target = DB::table('dsc_monthly_target')
						 ->where([['dsc_monthly_target.target_month','=', $target_month1],['dsc_monthly_target.target_year','=', $target_year1],['dsc_monthly_target.is_deleted', '=', '0']])
							->sum('dsc_monthly_target.target_qty');

						

					$sum_of_scooter = DB::table('self_sale_vehicle_info')
						 ->where(function($query) use ($from_date1, $to_date1) {		
							       	 if($from_date1 !='' and $to_date1 !='')
							       	 	$query->whereBetween('self_sale_vehicle_info.delivery_date', [$from_date1, $to_date1]);					       	  						        
							       	   
							        	$query->where([["self_sale_vehicle_info.vehicle_type_id","=", 1],['self_sale_vehicle_info.is_deleted', '=', 0]]);

							        })->count();


					$sum_of_motorcycle = DB::table('self_sale_vehicle_info')
						 ->where(function($query) use ($from_date1, $to_date1) {		
							       	 if($from_date1 !='' and $to_date1 !='')
							       	 	$query->whereBetween('self_sale_vehicle_info.delivery_date', [$from_date1, $to_date1]);					       	  						        
							       	   
							        	$query->where([["self_sale_vehicle_info.vehicle_type_id","=", 2],['self_sale_vehicle_info.is_deleted', '=', 0]]);

							        })->count();

						


						$array_of_dsc_monthly_stock =array();

						$report_date =date("d-m-Y");


						array_push($array_of_dsc_monthly_stock,new DscMonthlyTarget("","","Report Date: ".$report_date,"","","",""));


						array_push($array_of_dsc_monthly_stock,new DscMonthlyTarget("Dsc Name","Target","Scooter","Motor Cycle","Total","Conversion","Balance Target"));

						array_push($array_of_dsc_monthly_stock,new DscMonthlyTarget("","","","","","",""));


						if(!empty($dsc_month_target))
						{
								foreach ($dsc_month_target as $farray ) {

									$dsc_name = strtoupper($farray->sales_person_name);
									$target = $farray->target_qty;
									$scooter =$farray->total_count_scooty;
									$motorcycle = $farray->total_count_motorcycle;
									$total = $scooter + $motorcycle;
									if($farray->target_qty != 0)
                          			{

									  $data1=$farray->target_qty;
		                              $dataofdata1=$farray->total_count_scooty + $farray->total_count_motorcycle;
		                              $percent=($dataofdata1*100)/$data1;

		                            $conversion =  number_format($percent, 2).'%';
				                        }
				                        else
				                        {
				                        	 $conversion =  number_format(0, 2).'%';
				                        }

		                            
                                    $balance =  $farray->target_qty - $total;


															

									array_push($array_of_dsc_monthly_stock,new DscMonthlyTarget($dsc_name,$target,$scooter,$motorcycle,$total,$conversion,$balance));

									array_push($array_of_dsc_monthly_stock,new DscMonthlyTarget("","","","","","",""));


								}
						}





								$sum_total_target = $sum_of_scooter + $sum_of_motorcycle;
								$sum_of_total_balance = $sum_of_dsc_monthly_target - $sum_of_scooter + $sum_of_motorcycle;


									array_push($array_of_dsc_monthly_stock,new DscMonthlyTarget("",$sum_of_dsc_monthly_target,$sum_of_scooter,$sum_of_motorcycle,$sum_total_target,"",$sum_of_total_balance));

									array_push($array_of_dsc_monthly_stock,new DscMonthlyTarget("","","","","","",""));


 						
					$report_final = collect($array_of_dsc_monthly_stock);

					return $report_final;
    }

   
}