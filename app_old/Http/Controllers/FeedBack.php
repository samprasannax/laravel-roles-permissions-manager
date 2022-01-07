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
 
class FeedBack extends Controller{	

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

						 ->select('self_sale_vehicle_info.delivery_date','self_sale_vehicle_info.rc_book','sale_booking.id','sale_booking.mechanic_id','sale_booking.sales_person_id','customers.customer_name','customers.contact_no1','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','self_sale_vehicle_info.chassis_no','sale_booking.rto_check_status','sale_booking.feed_back_status','sale_booking.exchange_or_new','sale_booking.hyp','sale_booking.hyp_bank_name','sale_booking.initial_balance','exchange_vehicle.model_name','exchange_vehicle.valuable_amount','self_sale_vehicle_info.helmat_status','self_sale_vehicle_info.rto','self_sale_vehicle_info.checked_by','bank.bank_name')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.account_close_status', '=', 1)
						 ->orderBy('sale_booking.feed_back_status', 'ASC')
						 ->orderBy('self_sale_vehicle_info.delivery_date', 'ASC')
						 ->get();

			

			return view('/feed-back-list',compact(['feedbacks']));			
		}


		public function fetch_rto_feed_status()
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


			 $feed_back = DB::table('feed_back')
			 				->leftJoin('sale_booking','sale_booking.order_id', '=', 'feed_back.booking_order_id')
			 				->select('sale_booking.feed_back_status','feed_back.reason','feed_back.feed_description','feed_back.dsc_performance','feed_back.star_rate','feed_back.feed_back_date','feed_back.booking_order_id')
			 				->where('feed_back.booking_order_id','=', $unique_id)
			 				->where('feed_back.is_deleted','=', 0)
			 				->get();


			 return $feed_back;

		}


		public function insert_rto_feed_status()
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
            $feed_back_status ="";
            $feed_back_date ="";
            $star_rate ="";
            $reason ="";
            $dsc_performance ="";
            $feed_description ="";
            $feed_back_status ="";

            if(isset($_POST['booking_order_id1']))$booking_order_id = $_POST['booking_order_id1'];
            if(isset($_POST['feed_back_date1']))$feed_back_date = date("Y-m-d", strtotime($_POST['feed_back_date1']));
           
            if(isset($_POST['star_rate1']))$star_rate = $_POST['star_rate1'];
           
            if(isset($_POST['reason1']))$reason = $_POST['reason1'];
            if(isset($_POST['dsc_performance1']))$dsc_performance = $_POST['dsc_performance1'];
            if(isset($_POST['feed_description1']))$feed_description = $_POST['feed_description1'];
            if(isset($_POST['feed_back_status1']))$feed_back_status = $_POST['feed_back_status1'];

            // print"Feed".$feed_back_status;
            // die();



            if($feed_back_status==1)
            {
            	$update_feed_status = DB::table('sale_booking')
            						->where([['order_id', $booking_order_id],['is_deleted', 0]])
            						->update(['feed_back_status' => 1]);
            }



            $insert_feed_back = DB::table('feed_back')
            						->insert(['booking_order_id' => $booking_order_id,'feed_back_date'=>$feed_back_date,'star_rate'=>$star_rate,'reason'=>$reason,'dsc_performance'=>$dsc_performance,'feed_description'=>$feed_description]);

			return redirect('/feed-back-list');	


        }


        public function update_rto_feed_status()
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

            $feed_back_status ="";
            $feed_back_date ="";
            $star_rate ="";
            $reason ="";
            $dsc_performance ="";
            $feed_description ="";
            $feed_back_status ="";

            if(isset($_POST['booking_order_id']))$booking_order_id = $_POST['booking_order_id'];
            if(isset($_POST['feed_back_date']))$feed_back_date = date("Y-m-d", strtotime($_POST['feed_back_date']));
           
            if(isset($_POST['star_rate']))$star_rate = $_POST['star_rate'];
          
            if(isset($_POST['reason']))$reason = $_POST['reason'];
            if(isset($_POST['feed_description']))$feed_description = $_POST['feed_description'];
            if(isset($_POST['dsc_performance']))$dsc_performance = $_POST['dsc_performance'];
            if(isset($_POST['feed_back_status']))$feed_back_status = $_POST['feed_back_status'];

            if($feed_back_status==1)
            {
            	$update_feed_status = DB::table('sale_booking')
            						->where([['order_id', $booking_order_id],['is_deleted', 0]])
            						->update(['feed_back_status' => 1]);
            }



            $update_feed_back = DB::table('feed_back')->where([['booking_order_id',$booking_order_id]])
            						->update(['feed_back_date'=>$feed_back_date,'star_rate'=>$star_rate,'reason'=>$reason,'feed_description'=>$feed_description,'dsc_performance'=>$dsc_performance]);


			return redirect('/feed-back-list');	


        }


        public function view_rto_feed_status()
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


			 $feed_back = DB::table('feed_back')	
			                 ->leftJoin('sale_booking', 'sale_booking.order_id', '=', 'feed_back.booking_order_id')		 
			                 ->select('sale_booking.feed_back_status','feed_back.star_rate','feed_back.feed_back_date','feed_back.reason','feed_back.feed_description','feed_back.dsc_performance')				
			 				 ->where('feed_back.booking_order_id','=', $unique_id)
			 				 ->get();


			 return $feed_back;



		}


		

		
}
?>