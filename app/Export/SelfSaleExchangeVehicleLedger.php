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
  
class SelfSaleExchangeVehicleLedger implements FromCollection
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
 
             $report_from_date = "";
             $report_to_date = "";
             $report_from_date1 ="";
             $report_to_date1 = "";

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



					$sale_bookings =  DB::table('sale_booking')
									->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
									->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
									->leftJoin('exchange_vehicle', 'exchange_vehicle.booking_order_id', '=', 'sale_booking.order_id')
									->select('customers.customer_name','customers.contact_no1','sales_person.sales_person_name','exchange_vehicle.model_name','exchange_vehicle.valuable_amount','sale_booking.order_id','sale_booking.booking_date')
            						->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('sale_booking.booking_date', [$report_from_date, $report_to_date]);
						        
							        	$query->where([['sale_booking.is_deleted', '=', 0],['sale_booking.cancel_status', '=', 0],['sale_booking.exchange_or_new', '=', 'exchange']]);

							        })->get();


					/*
					*
					Array Push Value 
					*
					*/

						$ledger_report_items=array();

								array_push($ledger_report_items,new SelfSaleExchangeVehicle("Booking Date","Customer Name","Contact No","Sales Person Name","Exchange Vehicle Model","Exchange Amount","Total Paid","Total Remaining","Status"));

								array_push($ledger_report_items,new SelfSaleExchangeVehicle("","","","","","","","",""));




							if($sale_bookings !='')
							{
								foreach ($sale_bookings as $farray ) {
									$booking_date = $farray->booking_date;
									$customer_name =  strtoupper($farray->customer_name);
									$contact_no1 =  $farray->contact_no1;
									$sales_person_name =  strtoupper($farray->sales_person_name);
									$model_name =  strtoupper($farray->model_name);
									$valuable_amount =  $farray->valuable_amount;
									$order_id =  $farray->order_id;


									$find_total_paid = DB::table('customer_sales_receipt')
												->where('customer_sales_receipt.booking_order_id', '=', $order_id)
												->where('customer_sales_receipt.cancel_status', '=', 0)
												->where('customer_sales_receipt.exchange_status', '=', 1)
												->where('customer_sales_receipt.is_deleted', '=', 0)
												->where('customer_sales_receipt.amount_status', '=', 0)
												->sum('customer_sales_receipt.amount_to_pay');

								
									$total_paid = $find_total_paid;

									$total_remaining = $valuable_amount - $find_total_paid;	


									if($total_paid >= $valuable_amount)
									{
										$status = "COMPLETED";
									}
									else
									{
										$status = "PENDING";
									}


									$model_name =  strtoupper($farray->model_name);
							        array_push($ledger_report_items,new SelfSaleExchangeVehicle($booking_date,$customer_name,$contact_no1 ,$sales_person_name,$model_name,$valuable_amount,$total_paid,$total_remaining,$status));

							        array_push($ledger_report_items,new SelfSaleExchangeVehicle("","","","","","","","",""));



								}
							}														
							






						$report_final = collect($ledger_report_items);

						return $report_final;
    }

   
}