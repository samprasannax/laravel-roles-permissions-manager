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

class RtoCheck extends Controller{	

	     /**
	     * Create a new controller instance.
	     *
	     * @return void
	     */
	    public function __construct()
	    {
	        $this->middleware('auth');
	    }



		public function index(){
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

          

                $fsbs = DB::table('sale_booking')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')                      
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id')
                         ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
                         ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')
                          ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')

						 ->select('self_sale_vehicle_info.id','sale_booking.mechanic_id','sale_booking.sales_person_id','customers.customer_name','customers.contact_no1','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','sale_booking.account_close_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','self_sale_vehicle_info.chassis_no','sale_booking.rto_check_status','self_sale_vehicle_info.insurance','self_sale_vehicle_info.insurance_date','self_sale_vehicle_info.rto','self_sale_vehicle_info.rto_date','self_sale_vehicle_info.number_plate','self_sale_vehicle_info.plate_checked_date','self_sale_vehicle_info.vehicle_no','self_sale_vehicle_info.rc_book','self_sale_vehicle_info.rc_book_checked_date','self_sale_vehicle_info.rc_book_no','self_sale_vehicle_info.checked_by')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.account_close_status', '=', 1)
						 ->where('sale_booking.rto_check_status', '=', 0)
						 ->orderby('sale_booking.account_close_date', 'desc')
						 
						 ->get();



			return view('/rto-check-list',compact(['fsbs']));			
		}
		
		
		
		public function rto_check_completed(){
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

          

                $fsbs = DB::table('sale_booking')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')                      
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id')
                         ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
                         ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')
                          ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')

						 ->select('self_sale_vehicle_info.id','sale_booking.mechanic_id','sale_booking.sales_person_id','customers.customer_name','customers.contact_no1','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','sale_booking.account_close_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','self_sale_vehicle_info.chassis_no','sale_booking.rto_check_status','self_sale_vehicle_info.insurance','self_sale_vehicle_info.insurance_date','self_sale_vehicle_info.rto','self_sale_vehicle_info.rto_date','self_sale_vehicle_info.number_plate','self_sale_vehicle_info.plate_checked_date','self_sale_vehicle_info.vehicle_no','self_sale_vehicle_info.rc_book','self_sale_vehicle_info.rc_book_checked_date','self_sale_vehicle_info.rc_book_no','self_sale_vehicle_info.checked_by')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.account_close_status', '=', 1)
						  ->where('sale_booking.rto_check_status', '=', 1)
						 ->orderby('sale_booking.account_close_date', 'desc')
						 
						 ->get();



			return view('/rto-check-completed',compact(['fsbs']));			
		}
		
		
		

		public function fetch_rto_check_status()
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

			 if(isset($_POST['unique_id']))$unique_id = $_POST['unique_id'];


			 $check_details = DB::table('self_sale_vehicle_info')
			 				 ->leftJoin('sales_person', 'sales_person.id', '=', 'self_sale_vehicle_info.sales_person_id')
			 				 ->leftJoin('sale_booking', 'sale_booking.order_id', '=', 'self_sale_vehicle_info.booking_order_id')
			 				 ->select('sales_person.sales_person_name','sale_booking.extra_fitting','sale_booking.rto_check_status','self_sale_vehicle_info.insurance','self_sale_vehicle_info.insurance_date','self_sale_vehicle_info.rto','self_sale_vehicle_info.rto_date','self_sale_vehicle_info.number_plate','self_sale_vehicle_info.plate_checked_date','self_sale_vehicle_info.vehicle_no','self_sale_vehicle_info.rc_book','self_sale_vehicle_info.rc_book_checked_date','self_sale_vehicle_info.rc_book_no','self_sale_vehicle_info.checked_by','self_sale_vehicle_info.booking_order_id','self_sale_vehicle_info.id')
			 				 ->where('self_sale_vehicle_info.id','=', $unique_id)
			 				 ->get();

			 			

			 return $check_details;



		}

		public function fetch_rto_view()
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

			 if(isset($_POST['unique_id']))$unique_id = $_POST['unique_id'];

			 $check_details_view = DB::table('self_sale_vehicle_info')
			 				 ->leftJoin('sales_person', 'sales_person.id', '=', 'self_sale_vehicle_info.sales_person_id')
			 				 ->leftJoin('sale_booking', 'sale_booking.order_id', '=', 'self_sale_vehicle_info.booking_order_id')
			 				 ->select('sales_person.sales_person_name','sale_booking.extra_fitting','sale_booking.rto_check_status','self_sale_vehicle_info.rc_book_no','self_sale_vehicle_info.helmat','self_sale_vehicle_info.vehicle_no','self_sale_vehicle_info.checked_by','self_sale_vehicle_info.booking_order_id','self_sale_vehicle_info.id','self_sale_vehicle_info.finance_date')
			 				 ->where('self_sale_vehicle_info.id','=', $unique_id)
			 				 ->get();

			 return $check_details_view;
		}

		public function update_rto_check_list()
		{

			if(isset($_POST['unique_id']))$unique_id = $_POST['unique_id'];
			if(isset($_POST['booking_order_id']))$booking_order_id = $_POST['booking_order_id'];

			if(isset($_POST['insurance']))$insurance = $_POST['insurance'];
			if(isset($_POST['insurance_date']))$insurance_date = $_POST['insurance_date'];

			if(isset($_POST['rto']))$rto = $_POST['rto'];
			if(isset($_POST['rto_checked_date']))$rto_checked_date = $_POST['rto_checked_date'];

			if(isset($_POST['number_plate']))$number_plate = $_POST['number_plate'];
			if(isset($_POST['plate_checked_date']))$plate_checked_date = $_POST['plate_checked_date'];
			if(isset($_POST['vehicle_no']))$vehicle_no = $_POST['vehicle_no'];

			if(isset($_POST['rc_book']))$rc_book = $_POST['rc_book'];
			if(isset($_POST['rc_book_no']))$rc_book_no = $_POST['rc_book_no'];
			if(isset($_POST['rc_book_checked_date']))$rc_book_checked_date = $_POST['rc_book_checked_date'];
			
			if(isset($_POST['checked_by']))$checked_by = $_POST['checked_by'];
			if(isset($_POST['confim_status_update']))$confim_status_update = $_POST['confim_status_update'];



			if($confim_status_update == 1)
			{
				$update_check_status = DB::table('sale_booking')
            						->where([['order_id', $booking_order_id],['is_deleted', 0]])
            						->update(['rto_check_status' => 1]);
			}
			else
			{
			    	$update_check_status = DB::table('sale_booking')
            						->where([['order_id', $booking_order_id],['is_deleted', 0]])
            						->update(['rto_check_status' => 0]);
			}


			 $update_rto_check_status = DB::table('self_sale_vehicle_info')
            						->where([['id', $unique_id],['booking_order_id', $booking_order_id]])
            						->update(['insurance' => $insurance,'insurance_date'=>$insurance_date,'rto'=>$rto,'rto_date'=>$rto_checked_date,'number_plate'=>$number_plate,'plate_checked_date'=>$plate_checked_date,'vehicle_no'=>$vehicle_no,'rc_book'=>$rc_book,'rc_book_no'=>$rc_book_no,'rc_book_checked_date'=>$rc_book_checked_date,'checked_by'=>$checked_by]);

            				




            return redirect('/rto-check')->with(['message' => 'Rto Check Status Updated Successfully..!!!']);


		}

		
}
?>