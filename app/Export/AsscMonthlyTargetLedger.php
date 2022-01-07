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
  
class AsscMonthlyTargetLedger implements FromCollection
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




			 $assc_month_target = DB::table('dealers')
			 		->leftjoin("assc_monthly_target",function($join) use ($target_month1,$target_year1){
			            $join->on("assc_monthly_target.assc_id","=","dealers.id")
			                ->where("assc_monthly_target.target_month","=", $target_month1)
			                ->where("assc_monthly_target.target_year","=", $target_year1)
			                ->where("dealers.is_deleted","=",'0');
			        })
			        ->select("dealers.dealer_name","assc_monthly_target.target_qty","dealers.id",
			        	
			        	DB::raw("(SELECT count(id) as total_scooter FROM dealer_booking_vehicle_info
                                    WHERE dealer_booking_vehicle_info.dealer_id = dealers.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.vehicle_type_id = 1 and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.delivery_date between '$from_date1' and '$to_date1') as total_count_scooty"),
                        DB::raw("(SELECT count(id) as total_mc FROM dealer_booking_vehicle_info
                                WHERE dealer_booking_vehicle_info.dealer_id = dealers.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.vehicle_type_id = 2 and dealer_booking_vehicle_info.delivery_date between '$from_date1' and '$to_date1') as total_count_motorcycle"))
				   
				    ->get();
				    
				    
				    
				        $sum_of_dsc_monthly_target = DB::table('assc_monthly_target')
						 ->where([['assc_monthly_target.target_month','=', $target_month1],['assc_monthly_target.target_year','=', $target_year1],['assc_monthly_target.is_deleted', '=', '0']])
							->sum('assc_monthly_target.target_qty');

						

					$sum_of_scooter = DB::table('dealer_booking_vehicle_info')
						 ->where(function($query) use ($from_date1, $to_date1) {		
							       	 if($from_date1 !='' and $to_date1 !='')
							       	 	$query->whereBetween('dealer_booking_vehicle_info.delivery_date', [$from_date1, $to_date1]);					       	  						        
							       	   
							        	$query->where([["dealer_booking_vehicle_info.vehicle_type_id","=", 1],['dealer_booking_vehicle_info.is_deleted', '=', 0]]);

							        })->count();


					$sum_of_motorcycle = DB::table('dealer_booking_vehicle_info')
						 ->where(function($query) use ($from_date1, $to_date1) {		
							       	 if($from_date1 !='' and $to_date1 !='')
							       	 	$query->whereBetween('dealer_booking_vehicle_info.delivery_date', [$from_date1, $to_date1]);					       	  						        
							       	   
							        	$query->where([["dealer_booking_vehicle_info.vehicle_type_id","=", 2],['dealer_booking_vehicle_info.is_deleted', '=', 0]]);

							        })->count();




						


						$array_of_dsc_monthly_stock =array();

						$report_date =date("d-m-Y");


						array_push($array_of_dsc_monthly_stock,new AsscMonthlyTarget("","","Report Date: ".$report_date,"","","",""));


						array_push($array_of_dsc_monthly_stock,new AsscMonthlyTarget("Dsc Name","Target","Scooter","Motor Cycle","Total","Conversion","Balance Target"));

						array_push($array_of_dsc_monthly_stock,new AsscMonthlyTarget("","","","","","",""));


						if(!empty($assc_month_target))
						{
								foreach ($assc_month_target as $farray ) {

									$dsc_name = strtoupper($farray->dealer_name);
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
		                            		$conversion = '0%';
		                            	}
		                            
                                    $balance =  $farray->target_qty - $total;


															

									array_push($array_of_dsc_monthly_stock,new AsscMonthlyTarget($dsc_name,$target,$scooter,$motorcycle,$total,$conversion,$balance));

									array_push($array_of_dsc_monthly_stock,new AsscMonthlyTarget("","","","","","",""));


								}
						}





								$sum_total_target = $sum_of_scooter + $sum_of_motorcycle;
								$sum_of_total_balance = $sum_of_dsc_monthly_target - $sum_of_scooter + $sum_of_motorcycle;


									array_push($array_of_dsc_monthly_stock,new AsscMonthlyTarget("",$sum_of_dsc_monthly_target,$sum_of_scooter,$sum_of_motorcycle,$sum_total_target,"",$sum_of_total_balance));

									array_push($array_of_dsc_monthly_stock,new AsscMonthlyTarget("","","","","","",""));


 						
					$report_final = collect($array_of_dsc_monthly_stock);

					return $report_final;
    }

   
}