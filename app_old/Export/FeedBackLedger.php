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
  
class FeedBackLedger implements FromCollection
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

         
			$dsc_id="";
			$report_from_date1="";
			$report_to_date1="";
			$fetch_dsc_monthly_sales ="";

			if(isset($_POST['dsc_id']))$dsc_id = $_POST['dsc_id'];

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

$feedbacks = DB::table('sale_booking')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')                      
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id')
                         ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
                         ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')
                         ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')
                         ->leftJoin('bank', 'bank.id', '=', 'sale_booking.hyp_bank_name')
                         ->leftJoin('exchange_vehicle', 'exchange_vehicle.booking_order_id', '=', 'sale_booking.order_id')
                          ->leftJoin('feed_back', 'feed_back.booking_order_id', '=', 'sale_booking.order_id')

						 ->select('self_sale_vehicle_info.delivery_date','self_sale_vehicle_info.rc_book','sale_booking.id','sale_booking.mechanic_id','sale_booking.sales_person_id','customers.customer_name','customers.contact_no1','customers.customer_address','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','self_sale_vehicle_info.chassis_no','sale_booking.rto_check_status','sale_booking.feed_back_status','sale_booking.exchange_or_new','sale_booking.hyp','sale_booking.hyp_bank_name','sale_booking.initial_balance','exchange_vehicle.model_name','exchange_vehicle.valuable_amount','self_sale_vehicle_info.helmat_status','self_sale_vehicle_info.rto','self_sale_vehicle_info.checked_by','bank.bank_name','feed_back.star_rate','feed_back.feed_back_date','feed_back.reason','feed_back.feed_description','feed_back.dsc_performance')
						 ->where(function($query) use ($report_from_date, $report_to_date) {	
						 		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('feed_back.feed_back_date', [$report_from_date, $report_to_date]);
 															        
								        	$query->where([['sale_booking.is_deleted', '=', 0],['sale_booking.cancel_status', '=', 0]]);
								        })->get();


						$feed_back_items=array();

						$report_date = $report_from_date ."-". $report_to_date;



						array_push($feed_back_items,new FeedBackReport("","","","Report From Date: ".$report_from_date,"Report To Date: ".$report_to_date,"","","","","","","","","","","","","","","","","",""));


						array_push($feed_back_items,new FeedBackReport("DELIVERY DATE","CUSTOMER NAME","CUSTOMER CONTACT","CUSTOMER ADDRESS","DSC NAME","TYPE","MODEL","COLOR","CHASSIS NO","HYP","HYP BANK","INITIAL BALANCE","EXCHAGE","EXCHAGNE MODEL","VALUABLE AMOUNT","HELMAT","RTO","RC BOOK","STAR","REASON","DSC PERFORMANCE","DESCRIPTION","CHECKED BY"));
						array_push($feed_back_items,new FeedBackReport("","","","","","","","","","","","","","","","","","","","","","",""));



						if(!empty($feedbacks))
						{
								foreach ($feedbacks as $farray ) {

									$delivery_date = $farray->delivery_date;
									$customer_name = $farray->customer_name;
									$contact_no1 = $farray->contact_no1;
									$customer_address = $farray->customer_address;
									$sales_person_name = $farray->sales_person_name;
									$vehicle_type = $farray->type_of_vehicle;
									$vehicle_model = $farray->model;
									$vehicle_color = $farray->type_of_color;
									$chassis_no = $farray->chassis_no;
									
									 $hyp1 = $farray->hyp;
									 
									 if($hyp1==1)
									 {
									     $hyp = "YES";
									 }
									 else
									 {
									     $hyp = "NO";
									 }
									 
									 $hyp_bank = $farray->bank_name;
									 $intitial_balance = $farray->initial_balance;
									 
									 $exchange = $farray->exchange_or_new;
									 $exchange_mode = $farray->model_name;
									 $valuable_amount = $farray->valuable_amount;
									 $helmat1 = $farray->helmat_status;
									 if($helmat1==0)
									 {
									     $helmat = "NO";
									 }
									 else
									 {
									     $helmat = "YES";
									 }
									 
									 
									  $rto1 = $farray->rto;
									 if($rto1==0)
									 {
									     $rto = "NO";
									 }
									 else
									 {
									     $rto = "YES";
									 }
									 
									 
									  $rc_book1 = $farray->rc_book;
									 if($rc_book1==0)
									 {
									     $rc_book = "NO";
									 }
									 else
									 {
									     $rc_book = "YES";
									 }
									 
									 $checked_by = $farray->checked_by;
									 $star = $farray->star_rate;
									 $reason = $farray->reason;
									 $dsc_performance = $farray->dsc_performance;
									  $feed_description = $farray->feed_description;
									 
									 
									 

									array_push($feed_back_items,new FeedBackReport($delivery_date,$customer_name,$contact_no1,$customer_address,$sales_person_name,$vehicle_type,$vehicle_model,$vehicle_color,$chassis_no,$hyp,$hyp_bank,$intitial_balance,$exchange,$exchange_mode,$valuable_amount,$helmat,$rto,$rc_book,$star,$reason,$dsc_performance,$feed_description,$checked_by));

										array_push($feed_back_items,new FeedBackReport("","","","","","","","","","","","","","","","","","","","","","",""));


								}

						}
 						

			

						$report_final = collect($feed_back_items);

						return $report_final;
    }

   
}