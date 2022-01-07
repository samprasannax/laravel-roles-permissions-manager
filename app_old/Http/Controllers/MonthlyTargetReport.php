<?php
namespace App\Http\Controllers;
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


class MonthlyTargetReport extends Controller{	
		  
        /**
	     * Create a new controller instance.
	     *
	     * @return void
	    */

	    public function __construct()
	    {
	        $this->middleware('auth');
	    }


		public function dsc_monthly_target_report (){

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

						





				 return view('/dsc-monthly-target-report', compact(['dsc_month_target']))->with(['month'=>$target_month11,'year'=>$target_year11,'sum_of_dsc_monthly_target'=>$sum_of_dsc_monthly_target,'sum_of_scooter'=>$sum_of_scooter,'sum_of_motorcycle'=>$sum_of_motorcycle]);


		}


		public function assc_monthly_target_report (){

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
                                    WHERE dealer_booking_vehicle_info.dealer_id = dealers.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.vehicle_type_id = 1 and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.booking_date between '$from_date1' and '$to_date1') as total_count_scooty"),
                        DB::raw("(SELECT count(id) as total_mc FROM dealer_booking_vehicle_info
                                WHERE dealer_booking_vehicle_info.dealer_id = dealers.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.vehicle_type_id = 2 and dealer_booking_vehicle_info.booking_date between '$from_date1' and '$to_date1') as total_count_motorcycle"))
				   
				    ->get();
				    
				    
				    
				        $sum_of_dsc_monthly_target = DB::table('assc_monthly_target')
						 ->where([['assc_monthly_target.target_month','=', $target_month1],['assc_monthly_target.target_year','=', $target_year1],['assc_monthly_target.is_deleted', '=', '0']])
							->sum('assc_monthly_target.target_qty');

						

					$sum_of_scooter = DB::table('dealer_booking_vehicle_info')
						 ->where(function($query) use ($from_date1, $to_date1) {		
							       	 if($from_date1 !='' and $to_date1 !='')
							       	 	$query->whereBetween('dealer_booking_vehicle_info.booking_date', [$from_date1, $to_date1]);					       	  						        
							       	   
							        	$query->where([["dealer_booking_vehicle_info.vehicle_type_id","=", 1],['dealer_booking_vehicle_info.is_deleted', '=', 0]]);

							        })->count();


					$sum_of_motorcycle = DB::table('dealer_booking_vehicle_info')
						 ->where(function($query) use ($from_date1, $to_date1) {		
							       	 if($from_date1 !='' and $to_date1 !='')
							       	 	$query->whereBetween('dealer_booking_vehicle_info.booking_date', [$from_date1, $to_date1]);					       	  						        
							       	   
							        	$query->where([["dealer_booking_vehicle_info.vehicle_type_id","=", 2],['dealer_booking_vehicle_info.is_deleted', '=', 0]]);

							        })->count();


				

				 return view('/assc-monthly-target-report', compact(['assc_month_target']))->with(['month'=>$target_month11,'year'=>$target_year11,'sum_of_dsc_monthly_target'=>$sum_of_dsc_monthly_target,'sum_of_scooter'=>$sum_of_scooter,'sum_of_motorcycle'=>$sum_of_motorcycle]);




		}



}
?>