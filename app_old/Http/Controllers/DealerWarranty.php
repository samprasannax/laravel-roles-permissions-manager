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

class DealerWarranty extends Controller{	

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


           $dealer_warranty_lists = DB::table('dealer_booking_vehicle_info')
           						->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
								 ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
								 ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
								 ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')

								 ->select('dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.dealer_id','dealer_booking_vehicle_info.booking_order_id','dealer_booking_vehicle_info.delivery_date','dealer_booking_vehicle_info.warranty_status','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.model_id','dealer_booking_vehicle_info.vehicle_amount','dealer_booking_vehicle_info.book_no','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color','dealers.dealer_name')
								 ->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.return_status', '=', 0],['dealer_booking_vehicle_info.dealer_id', '=', $dealer_unique_id],['dealer_booking_vehicle_info.stock_status', '=', 1],['dealer_booking_vehicle_info.warranty_status', '=', 0]])								
								 ->get();

			$total_remaining_warranty = DB::table('dealer_booking_vehicle_info')
					     ->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.return_status', '=', 0],['dealer_booking_vehicle_info.dealer_id', '=', $dealer_unique_id],['dealer_booking_vehicle_info.warranty_status', '=', 0],['dealer_booking_vehicle_info.stock_status', '=', 1]])		
					    ->count();


			return view('/dealer-warranty',compact(['dealer_warranty_lists','total_remaining_warranty']));
		}


		public function update_dealer_warranty_card()
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

            
			if(isset($_POST['dealer_unique_id']))$dealer_unique_id = $_POST['dealer_unique_id'];
			if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];
			if(isset($_POST['dealer_booking_order_id']))$dealer_booking_order_id = $_POST['dealer_booking_order_id'];

			if(isset($_POST['warranty_date']))$warranty_date = date("Y-m-d", strtotime($_POST['warranty_date']));
			if(isset($_POST['warranty_qty']))$warranty_qty = $_POST['warranty_qty'];
			if(isset($_POST['warranty_amount']))$warranty_amount = $_POST['warranty_amount'];
			if(isset($_POST['warranty_total_amount']))$warranty_total_amount = $_POST['warranty_total_amount'];


			$fetch_pending = DB::table('dealer_booking_vehicle_info')
							->where([['is_deleted', '=', 0], ['dealer_id', '=', $dealer_id], ['return_status', '=', 0], ['warranty_status', '=', 0],['stock_status', '=', 1]])
							->get();

			foreach($fetch_pending as $fp)
			{
				$f_booking_order_id = $fp->booking_order_id;
				$f_dealer_id = $fp->dealer_id;
				$f_vehicle_type_id = $fp->vehicle_type_id;
				$f_model_id = $fp->model_id;
				$f_color_id = $fp->color_id;
				$f_chassis_no = $fp->chassis_no;



				$insert_warranty_amount = DB::table('dealer_warranty_amount_list')
										->insert( ['booking_order_id'=>$f_booking_order_id, 'dealer_id'=>$f_dealer_id, 'vehicle_type_id'=>$f_vehicle_type_id,'model_id'=>$f_model_id,'color_id'=>$f_color_id,'chassis_no'=>$f_chassis_no,'warranty_amount'=>$warranty_amount]);

			}

			$update_dealer_booking_vehicle_info_warranty = DB::table('dealer_booking_vehicle_info')
														  ->where([['is_deleted', '=', 0], ['dealer_id', '=', $dealer_id], ['return_status', '=', 0], ['warranty_status', '=', 0],['stock_status', '=', 1]])
														  ->update(['warranty_status'=>1]);

			

			$insert_warranty_card = DB::table('send_assc_warranty_card')->insert( ['dealer_id'=>$dealer_id, 'warranty_date'=>$warranty_date, 'warranty_qty'=>$warranty_qty,'warranty_amount'=>$warranty_amount,'warranty_total_amount'=>$warranty_total_amount] );



		 	            $fetch_dealer_amount = DB::table('dealers')
			           						->where('id', '=', $dealer_id)
			           						->where('is_deleted', '=', 0)
			           						->get();

			           	$dealer_initial = $fetch_dealer_amount[0]->initial_balance;           	
			           	$total_remaining = $fetch_dealer_amount[0]->total_remaining;

			           	$update_dealer_initial = $dealer_initial - $warranty_total_amount;
			           	$update_total_remaining = $total_remaining - $warranty_total_amount;


			           	$update_dealer_balance = DB::table('dealers')
			           							->where([['id', '=', $dealer_id],['is_deleted', '=', 0]])
			           							->update(['initial_balance' => $update_dealer_initial,'total_remaining' => $update_total_remaining]);





 			return redirect('/sub-dealer')->with(['message' => 'Warranty Updated successfully.!!!']);
								

		}




		
}
?>