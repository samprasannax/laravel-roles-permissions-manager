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
  
class FinancePendingListLedger implements FromCollection
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

         
	          $fetch_sales_bookings = DB::table('sale_booking')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')  
                         ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')
                         ->leftJoin('bank', 'bank.id', '=', 'sale_booking.hyp_bank_name')
						 ->select('sale_booking.id','customers.customer_name','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.order_id','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.order_id','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','self_sale_vehicle_info.booking_order_id','sale_booking.delivery_note_status','sale_booking.booking_date','sale_booking.hyp','bank.bank_name','sale_booking.initial_balance','self_sale_vehicle_info.delivery_date')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.hyp', '=', 'yes')
						 ->where('sale_booking.finance_status', '=', 0)
						 ->where('sale_booking.cancel_status', '=', 0)
						 ->get();

			$total_fianace_amount = DB::table('sale_booking')
			 			 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.hyp', '=', 'yes')
						 ->where('sale_booking.finance_status', '=', 0)
						 ->where('sale_booking.cancel_status', '=', 0)
						 ->sum('sale_booking.grand_total');
			$total_remaining_amount = DB::table('sale_booking')
			 			 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.hyp', '=', 'yes')
						 ->where('sale_booking.finance_status', '=', 0)
						 ->where('sale_booking.cancel_status', '=', 0)
						 ->sum('sale_booking.total_remaining');
			$total_paid_amount = DB::table('sale_booking')
			 			 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.hyp', '=', 'yes')
						 ->where('sale_booking.finance_status', '=', 0)
						 ->where('sale_booking.cancel_status', '=', 0)
						 ->sum('sale_booking.total_paid');
						 
			                       

                
                $assc_opening_items=array();
                
                



						array_push($assc_opening_items,new FiancePendingList("Date","Customer Name","DSC Name","Bank Name","IP","Total","Remaining Amount","Total Paid"));
						array_push($assc_opening_items,new FiancePendingList("","","","","","","",""));
						



						if(!empty($fetch_sales_bookings))
						{
								foreach ($fetch_sales_bookings as $farray ) {

									   if($farray->delivery_date !='')
				                       { 
				                           $delivery_date =  date("d-m-Y", strtotime($farray->delivery_date));
				                       }
				                       else
				                       {
				                           $delivery_date="";
				                       }

									
									$customer_name = $farray->customer_name;

									$sales_person_name = $farray->sales_person_name;
									$bank_name = $farray->bank_name;
									$initial_balance = $farray->initial_balance;
									
									
									    $grand_total = $farray->grand_total;
									    $total_remaining = $farray->total_remaining;
										$total_paid = $farray->total_paid;		

									    	array_push($assc_opening_items,new FiancePendingList($delivery_date,$customer_name,$sales_person_name,$bank_name,$initial_balance,$grand_total,$total_remaining,$total_paid));

									        array_push($assc_opening_items,new FiancePendingList("","","","","","","",""));
									
									
									
									
								


								}

						}
						
					
							array_push($assc_opening_items,new FiancePendingList("","","","","",$total_fianace_amount,$total_remaining_amount,$total_paid_amount));

									        array_push($assc_opening_items,new FiancePendingList("","","","","","","",""));
									



						$report_final = collect($assc_opening_items);

						return $report_final;
    }

   
}