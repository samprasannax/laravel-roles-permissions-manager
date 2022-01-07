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
  
class AsscSalesPercentageLedger implements FromCollection
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




			$dealer_lists = DB::table('dealers')->where('is_deleted', '0')->get();

			$dealer_id="";
			$report_from_date1="";
			$report_to_date1="";
			$fetch_assc_monthly_sales ="";

			if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];

            if(isset($_POST['report_from_date']))$report_from_date1 = $_POST['report_from_date'];
            if(isset($_POST['report_to_date']))$report_to_date1 = $_POST['report_to_date'];


 			if($report_from_date1 =='')
            {
            	$report_from_date1 = date("Y-m-d");
            }

            if($report_to_date1 =='')
            {
            	$report_to_date1 = date("Y-m-d");
            }

            $report_from_date = date("Y-m-d", strtotime($report_from_date1));
            $report_to_date = date("Y-m-d", strtotime($report_to_date1));

            $rfrom_date = $report_from_date;
            $rto_date = $report_to_date;


            $fetch_cash_count = DB::table('dealer_booking_vehicle_info')                        
						->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('dealer_booking_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id]]);

								        $query->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.stock_status', '=',1],['dealer_booking_vehicle_info.return_status', '=',0],['dealer_booking_vehicle_info.bank_id', '=',0]]);

								        })->count();
			$total_sales_count = DB::table('dealer_booking_vehicle_info')
										->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('dealer_booking_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id]]);

								        $query->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.stock_status', '=',1],['dealer_booking_vehicle_info.return_status', '=',0]]);
								          })->count();

		if($dealer_id !='')
		{

				 $bank_percentage = DB::table('bank')
			 		->leftjoin("dealer_booking_vehicle_info",function($join) use ($report_from_date,$report_to_date,$dealer_id){
			            $join->on("dealer_booking_vehicle_info.bank_id","=","bank.id")
			                ->whereBetween("dealer_booking_vehicle_info.booking_date",[$report_from_date, $report_to_date])
			                ->where("dealer_booking_vehicle_info.is_deleted","=", 0)
			                ->where("dealer_booking_vehicle_info.return_status","=", 0)
			                ->where("dealer_booking_vehicle_info.bank_id","=", "bank.id")
			                ->where("bank.is_deleted","=", 0);
			        })
			        ->select("bank.bank_name",			        	
			        	DB::raw("(SELECT count(id) as total_count FROM dealer_booking_vehicle_info
                                WHERE dealer_booking_vehicle_info.bank_id = bank.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.dealer_id = '$dealer_id' and dealer_booking_vehicle_info.return_status = 0 and dealer_booking_vehicle_info.delivery_date between '$report_from_date' and '$report_to_date') as total_count"))
				   
				    ->get();

		}
		else
		{

			 $bank_percentage = DB::table('bank')
			 		->leftjoin("dealer_booking_vehicle_info",function($join) use ($report_from_date,$report_to_date){
			            $join->on("dealer_booking_vehicle_info.bank_id","=","bank.id")
			                ->whereBetween("dealer_booking_vehicle_info.booking_date",[$report_from_date, $report_to_date])
			                ->where("dealer_booking_vehicle_info.is_deleted","=", 0)
			                ->where("dealer_booking_vehicle_info.return_status","=", 0)
			                ->where("dealer_booking_vehicle_info.bank_id","=", "bank.id")
			                ->where("bank.is_deleted","=", 0);
			        })
			        ->select("bank.bank_name",			        	
			        	DB::raw("(SELECT count(id) as total_count FROM dealer_booking_vehicle_info
                                WHERE dealer_booking_vehicle_info.bank_id = bank.id and dealer_booking_vehicle_info.is_deleted = 0  and dealer_booking_vehicle_info.return_status = 0 and dealer_booking_vehicle_info.delivery_date between '$report_from_date' and '$report_to_date') as total_count"))
				   
				    ->get();


		}










           


					/*
					*
					Array Push Value 
					*;
					*/

						$ledger_report_items=array();


						array_push($ledger_report_items,new AsscSalesPercentage("From Date : ".$report_from_date,"To Date : ".$report_to_date));

						array_push($ledger_report_items,new AsscSalesPercentage("Cash / Finance","Percentage"));


                            if($total_sales_count !=0)
                            {
                              $cash = round($fetch_cash_count / $total_sales_count * 100).'%';

							 array_push($ledger_report_items,new AsscSalesPercentage("CASH",$cash));
                            }
                            else
                            {
                                
							 array_push($ledger_report_items,new AsscSalesPercentage("CASH","0%"));
                            }
							 





							if($bank_percentage !='')
							{
								foreach ($bank_percentage as $farray ) {

								    $total_count = $farray->total_count;
								    $bank_name =  strtoupper($farray->bank_name);
				                   
                                    if($total_sales_count !=0)
                                    {
                                         $finanace = round($total_count / $total_sales_count * 100).'%';
                                    }
                                    else
                                    {
                                        $finanace = "0%";
                                    }
				                    

							        array_push($ledger_report_items,new AsscSalesPercentage($bank_name,$finanace));

								}
							}



                            if($total_sales_count !=0)
                            {
                              $total = round($fetch_cash_count / 100 * 100).'%';

							 array_push($ledger_report_items,new AsscSalesPercentage("TOTAL",$total));
                            }
                            else
                            {
                                
							 array_push($ledger_report_items,new AsscSalesPercentage("TOTAL","0%"));
                            }
							 
							 
							 

						




						$report_final = collect($ledger_report_items);
						return $report_final;
    }

   
}