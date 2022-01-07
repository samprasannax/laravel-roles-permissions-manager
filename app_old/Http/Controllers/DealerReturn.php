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

class DealerReturn extends Controller{	

	 /**
	     * Create a new controller instance.
	     *
	     * @return void
	     */
	    public function __construct()
	    {
	        $this->middleware('auth');
	    }


		public function index($dealer_unique_id){

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


			$dealer_booking = DB::table('dealer_booking')
								 ->where('is_deleted', '=', 0)
								 ->where('dealer_id', '=', $dealer_unique_id)
								 ->where('delivery_status', '=', 1)										 
								 ->get();

			$dealer_stock_info ="";

			if(!empty($dealer_booking))
			{


			foreach ($dealer_booking as $dbooking) {

				         $order_id =  $dbooking->order_id;
				         $dealer_id = $dbooking->dealer_id;

			$dealer_stock_info = DB::table('dealer_booking_vehicle_info')
								 ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
								 ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
								 ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
								 ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')

								 ->select('dealers.dealer_name','dealers.dealer_code','dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.model_id','dealer_booking_vehicle_info.book_no','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color','dealer_booking_vehicle_info.assc_customer_name','dealer_booking_vehicle_info.delivery_date','dealer_booking_vehicle_info.assc_dsc_name','dealer_booking_vehicle_info.stock_status','dealer_booking_vehicle_info.booking_order_id','dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.return_status','dealer_booking_vehicle_info.return_date','dealer_booking_vehicle_info.return_description','dealer_booking_vehicle_info.warranty_status')

								 ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
								 ->where('dealer_booking_vehicle_info.booking_order_id', '=', $order_id)
								 ->where('dealer_booking_vehicle_info.return_status', '=', 1)	
								 ->get();

		
						
			}
		}

			return view('/dealer-return',compact(['dealer_stock_info']));
		}




		public function check_assc_info(){

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


			if(isset($_POST['assc_unique_id']))$unique_id = $_POST['assc_unique_id'];
			if(isset($_POST['assc_booking_order_id']))$booking_order_id = $_POST['assc_booking_order_id'];
			if(isset($_POST['assc_dealer_id']))$dealer_id = $_POST['assc_dealer_id'];

			if(isset($_POST['return_chassis_no']))$return_chassis_no = $_POST['return_chassis_no'];
			if(isset($_POST['assc_vehicle_amount']))$assc_vehicle_amount = $_POST['assc_vehicle_amount'];
			if(isset($_POST['return_date']))$return_date =  date("Y-m-d", strtotime($_POST['return_date']));
			if(isset($_POST['return_description']))$return_description = $_POST['return_description'];

			if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
			if(isset($_POST['model_id']))$model_id = $_POST['model_id'];
			

			/* 
			*
			Dealer  Amount -( Reduce Code)
			*
			*/

			$select_dealer = DB::table('dealers')
									->where([['id', '=', $dealer_id],['is_deleted', '=', 0]])
									->get();


						$initial_balance = $select_dealer[0]->initial_balance;
						
						$total_remaining = $select_dealer[0]->total_remaining;

						$update_initial_balance = $initial_balance + $assc_vehicle_amount;
						$update_total_remaining = $total_remaining + $assc_vehicle_amount;


			
			    $update_sales_booking = DB::table('dealers')->where('id', $dealer_id)->update( ['initial_balance' => $update_initial_balance, 'total_remaining'=>$update_total_remaining ]);


			/* 
			*
				Stock -( Reduce Code)
			*
			*/


			 $update_retrun_stock = DB::table('vehicle_stock')
            						->where([['chassis_no', $return_chassis_no],['vehicle_type', $vehicle_type],['model_name', $model_id]])
            						->update(['temp_status' =>0, 'sale_type_id' =>0,'sale_type' => '','status' => 0]);

               $fetch_total_stock = DB::table('main_model')
											->select('main_model.in_stock')
											->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_id]])
											->get();

						$in_stock = $fetch_total_stock[0]->in_stock;

						$update_in_stock = $in_stock + 1;


						$update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.id', '=', $model_id]])->update(['in_stock'=>$update_in_stock]);



			/* 
			*
				Dealer Booking -( Reduce Code)
			*
			*/



   	                         $fetch_dealer_booking =  DB::table('dealer_booking')
			           						->where('order_id', '=', $booking_order_id)
			           						->where('dealer_id', '=', $dealer_id)
			           						->where('is_deleted', '=', 0)
			           						->get();


			           		$dealer_qty = $fetch_dealer_booking[0]->total_qty;
			           		$dealer_total_amount = $fetch_dealer_booking[0]->total_amount;


			           		$update_dealer_qty = $dealer_qty-1;
			           		$update_dealer_toal_amount = $dealer_total_amount-$assc_vehicle_amount;

                            /* Update Dealer Booking */
			                $update_dealer_booking = DB::table('dealer_booking')
			           							->where([['order_id', '=', $booking_order_id],['is_deleted', '=', 0]])
			           							->update(['total_qty' => $update_dealer_qty,'total_amount' => $update_dealer_toal_amount]);


			                $dealer_assc_details = DB::table('dealer_booking_vehicle_info')
								 ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
								 ->where('dealer_booking_vehicle_info.id', '=', $unique_id)
								 ->where('dealer_booking_vehicle_info.booking_order_id', '=', $booking_order_id)		
								 ->update(['return_date'=>$return_date, 'return_description'=>$return_description,'return_status'=>1]);

			 return redirect('/dealer-return/'.$dealer_id.'')->with(['message' => 'Updated successfully.!!!']);
		}









	
}
?>