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
  
class SalesPercentageLedger implements FromCollection
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


            $report_from_date1="";
			$report_to_date1="";
			$fetch_dsc_monthly_sales ="";

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

            
            $total_sale_count = DB::table('sale_booking')
                               ->whereBetween("sale_booking.booking_date",[$report_from_date, $report_to_date])
                               	->where("sale_booking.is_deleted","=", 0)
           						->count();
                
                               

           $sale_booking_in_cash = DB::table('sale_booking')           							
           							->select(DB::raw("(SELECT count(id) as total_count FROM sale_booking
                                WHERE sale_booking.hyp = 'no' and sale_booking.is_deleted = '0' and sale_booking.cancel_status = '0' and sale_booking.booking_date between '$report_from_date' and '$report_to_date') as total_count"),DB::raw("(SELECT count(id) as total_count1 FROM sale_booking where sale_booking.is_deleted = '0' and sale_booking.cancel_status = '0' and sale_booking.booking_date between '$report_from_date' and '$report_to_date') as total_count1"))
           							->whereBetween("sale_booking.booking_date",[$report_from_date, $report_to_date])
			               			->where("sale_booking.is_deleted","=", 0)
			               			->limit(1)
           							->get();
                

           	 $bank_percentage = DB::table('bank')
			 		->leftjoin("sale_booking",function($join) use ($report_from_date,$report_to_date){
			            $join->on("sale_booking.hyp_bank_name","=","bank.id")
			                ->whereBetween("sale_booking.booking_date",[$report_from_date, $report_to_date])
			                ->where("sale_booking.is_deleted","=", 0)
			                ->where("sale_booking.cancel_status","=", 0)
			                ->where("sale_booking.hyp_bank_name","=", "bank.id")
			                ->where("bank.is_deleted","=", 0);
			        })
			        ->select("bank.bank_name",			        	
			        	DB::raw("(SELECT count(id) as total_count FROM sale_booking
                                WHERE sale_booking.hyp_bank_name = bank.id and sale_booking.is_deleted = 0 and sale_booking.cancel_status = 0 and sale_booking.booking_date between '$report_from_date' and '$report_to_date') as total_count"),DB::raw("(SELECT count(id) as total_count1 FROM sale_booking WHERE  sale_booking.is_deleted = 0 and sale_booking.cancel_status = 0 and sale_booking.booking_date between '$report_from_date' and '$report_to_date') as total_count1"))
				   
				    ->get();







           


					/*
					*
					Array Push Value 
					*;
					*/

						$ledger_report_items=array();


						array_push($ledger_report_items,new SalesPercentage("From Date : ".$report_from_date,"To Date : ".$report_to_date));



						array_push($ledger_report_items,new SalesPercentage("Cash / Finance","Percentage"));
						

							if($sale_booking_in_cash !='')
							{
								foreach ($sale_booking_in_cash as $farray ) {
								    $total_count = $farray->total_count;
				                    $total_count1 = $farray->total_count1;

				                    $cash = round($total_count / $total_count1 * 100).'%';

							        array_push($ledger_report_items,new SalesPercentage("CASH",$cash));


								}
							}
							else
							{
								  array_push($ledger_report_items,new SalesPercentage("CASH",'0%'));

							}
										
						

							if($bank_percentage !='')
							{
								foreach ($bank_percentage as $freceipt ) {
									$bank_name = $freceipt->bank_name;

									$total_count = $freceipt->total_count;
				                    $total_count1 = $freceipt->total_count1;

				                    $finance = round($total_count / $total_count1 * 100).'%';
									

							        array_push($ledger_report_items,new SalesPercentage($bank_name,$finance));



								}

							}
							
							
							if($total_sale_count !=0)
							{
							    
				                    $total_sales = round($total_sale_count / 100 * 100).'%';
				                    array_push($ledger_report_items,new SalesPercentage("TOTAL",$total_sales));
							}
							
							
							





						$report_final = collect($ledger_report_items);

						return $report_final;
    }

   
}