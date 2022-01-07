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
use Illuminate\Support\Facades\Redirect;

class SalesBooking extends Controller{	

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
            
            
             $report_from_date1="";
             $report_to_date1="";

         
            if(isset($_GET['report_from_date']))$report_from_date1 = $_GET['report_from_date'];

            if(isset($_GET['report_to_date']))$report_to_date1 = $_GET['report_to_date'];

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



            $fetch_sales_bookings = DB::table('sale_booking')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')  
                         ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')
                         ->leftJoin('bank', 'bank.id', '=', 'sale_booking.hyp_bank_name')
						 ->select('sale_booking.id','customers.customer_name','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.order_id','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.order_id','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','self_sale_vehicle_info.booking_order_id','sale_booking.delivery_note_status','sale_booking.booking_date','sale_booking.hyp','bank.bank_name','sale_booking.initial_balance')
							 ->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('sale_booking.booking_date', [$report_from_date, $report_to_date]);

							       						        
							        	$query->where([['sale_booking.is_deleted', '=', 0]]);

							        })->get();

			return view('/sales-booking', compact(['fetch_sales_bookings']));
		}
		
		
		
		
		public function sales_booking_without_filter(){

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
						 ->select('sale_booking.id','customers.customer_name','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.order_id','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.order_id','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','self_sale_vehicle_info.booking_order_id','sale_booking.delivery_note_status','sale_booking.booking_date','sale_booking.hyp','bank.bank_name','sale_booking.initial_balance')
						 ->where([['sale_booking.is_deleted', '=', 0]])
						 ->orderBy('sale_booking.account_close_status', 'asc')
                         ->get();

			return view('/sales-booking-without-filter', compact(['fetch_sales_bookings']));
		}
		
		
		
		
		
		public function fetch_account_close_details()
		{
		    
		    if(isset($_POST['order_id']))$order_id = $_POST['order_id'];
		    
		    
		    $fetch_sales_bookings = DB::table('sale_booking')
						 ->select('sale_booking.account_close_date','sale_booking.account_close_description')
						 ->where([['sale_booking.is_deleted', '=', 0],['sale_booking.order_id', '=', $order_id]])
                         ->get();

		    return $fetch_sales_bookings;
		    
		    
		}
		
		
		

        
        
        public function finance_pending_list(){

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
						 
			return view('/pending-finance-list', compact(['fetch_sales_bookings','total_fianace_amount','total_remaining_amount','total_paid_amount']));
		}



		





		public function new_booking(){



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


			$financial_year = DB::table('financial_year')->get();

            $start_date = $financial_year[0]->start_date;
            $end_date = $financial_year[0]->end_date;



             $fetch_booking1 =  DB::table('sale_booking')           						

            						->where(function($query) use ($start_date, $end_date) {		
							       	 if($start_date !='' and $end_date !='')
							       	 $query->whereBetween('booking_date', [$start_date, $end_date]);

							        })
							        ->max('booking_unique_value');

            $fetch_booking = $fetch_booking1 + 1;
		
			$current_date = date("Ymd");
			$booking_prefix = "SUB";

			$booking_no = $booking_prefix . '-' . $current_date.'-'.$fetch_booking;


			$customers = DB::table('customers')
						 ->where('is_deleted', '=', '0')
						 ->get();


			$banks = DB::table('bank')
						 ->where('is_deleted', '=', '0')
						 ->get();


			$sales_persons = DB::table('sales_person')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$mechanics = DB::table('mechanic')
						 ->where('is_deleted', '=', '0')
						 ->get();
			 $vehicle_types = DB::table('vehicle_type')
						 ->where('is_deleted', '=', '0')
						 ->get();


			$vehicle_models = DB::table('main_model')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$colors = DB::table('colors')
						 ->where('is_deleted', '=', '0')
						 ->get();

			 $receipt_no1 =  DB::table('customer_sales_receipt') 
            						->where(function($query) use ($start_date, $end_date) {		
							       	 if($start_date !='' and $end_date !='')
							       	 $query->whereBetween('receipt_date', [$start_date, $end_date]);

							        })
							        ->max('receipt_no');

            $receipt_no = $receipt_no1 + 1;





			return view('/new-booking', compact(['customers','sales_persons','mechanics','vehicle_models','colors','vehicle_types','banks']))->with(['booking_unique_value'=>$fetch_booking,'booking_no'=>$booking_no,'receipt_no'=>$receipt_no]);
		}

		public function fetch_vehicle_amount()
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

              if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
			 

			 if(isset($_POST['model_name1']))$model_name1 = $_POST['model_name1'];
			 


			    $vehicle_amount = DB::table('vehicle_model')	    								  					  
							      ->select('vehicle_model.self_sale_rate')
							      ->where([['vehicle_model.model_name', '=', $model_name1],['vehicle_model.vehicle_type', '=', $vehicle_type],['vehicle_model.is_deleted', '=', 0]])
							      ->get();			      
			        return $vehicle_amount;
		}

		public function insert_sale_booking()
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

             if(isset($_POST['booking_save']))$booking_save = $_POST['booking_save'];

			/** Booking Info **/
			 if(isset($_POST['booking_unique_value']))$booking_unique_value = $_POST['booking_unique_value'];
			 if(isset($_POST['booking_no']))$booking_no = $_POST['booking_no'];
			 if(isset($_POST['booking_date']))$booking_date = date("Y-m-d", strtotime($_POST['booking_date']));
			 if(isset($_POST['customer_id']))$customer_id = $_POST['customer_id'];
			 if(isset($_POST['sales_person_id']))$sales_person_id = $_POST['sales_person_id'];
			 if(isset($_POST['mechanic_id']))$mechanic_id = $_POST['mechanic_id'];


			 /* HYp Info */
			 if(isset($_POST['hyp']))$hyp = $_POST['hyp'];
			 if(isset($_POST['bank_name']))$hyp_bank_name = $_POST['bank_name'];
			 if(isset($_POST['initial_balance']))$initial_balance = $_POST['initial_balance'];




			 /** Exchange and New **/
			 if(isset($_POST['exchange_new']))$exchange_new = $_POST['exchange_new'];
			 if(isset($_POST['ex_vehicle_model_name']))$ex_vehicle_model_name = $_POST['ex_vehicle_model_name'] ?: 'Null';
			 if(isset($_POST['ex_vehicle_chassis_no']))$ex_vehicle_chassis_no = $_POST['ex_vehicle_chassis_no'] ?: 'Null';
			 if(isset($_POST['ex_vehicle_engine_no']))$ex_vehicle_engine_no = $_POST['ex_vehicle_engine_no'] ?: 'Null';
			 if(isset($_POST['ex_vehicle_amount']))$ex_vehicle_amount = $_POST['ex_vehicle_amount'] ?: '0';
			 if(isset($_POST['ex_vehicle_date']))$ex_vehicle_date = $_POST['ex_vehicle_date'] ?: '0';
			 if(isset($_POST['ex_vehicle_no']))$ex_vehicle_no = $_POST['ex_vehicle_no'] ?: 'Null';

			  /** New Vehicle Info **/
			  if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
			  if(isset($_POST['model_id']))$model_id = $_POST['model_id'];
			  if(isset($_POST['color_id']))$color_id = $_POST['color_id'];
			  if(isset($_POST['self_sale_rate']))$self_sale_rate = $_POST['self_sale_rate'];

			  /** Extra Charges **/
			  if(isset($_POST['extra_fitting']))$extra_fitting = $_POST['extra_fitting'];
			  if(isset($_POST['extra_fitting_charge']))$extra_fitting_charge = $_POST['extra_fitting_charge'];
			  if(isset($_POST['mechanic_charge']))$mechanic_charge = $_POST['mechanic_charge'];
			  if(isset($_POST['mechanic_amount']))$mechanic_amount = $_POST['mechanic_amount'];
			  if(isset($_POST['insurance']))$insurance = $_POST['insurance'];
			  if(isset($_POST['insurance_amount']))$insurance_amount = $_POST['insurance_amount'];
			  if(isset($_POST['discount']))$discount = $_POST['discount'];

			   /** Calculation **/
			   if(isset($_POST['gross_total']))$gross_total = $_POST['gross_total'];
			   if(isset($_POST['grand_total']))$grand_total = $_POST['grand_total'];
			   if(isset($_POST['description']))$description = $_POST['description'];


			   /** Receipt **/
			   if(isset($_POST['receipt_no']))$receipt_no = $_POST['receipt_no'];
			   if(isset($_POST['receipt_date']))$receipt_date = date("Y-m-d", strtotime($_POST['receipt_date']));			
			   if(isset($_POST['amount_to_pay']))$amount_to_pay = $_POST['amount_to_pay'];

			   if(isset($_POST['total_paid']))$total_paid = $_POST['total_paid'];
			   if(isset($_POST['total_remaining']))$total_remaining = $_POST['total_remaining'];	


			   /** Payment Mode **/

			   if(isset($_POST['payment_mode']))$payment_mode = $_POST['payment_mode'];

			   if(isset($_POST['cheque_no']))$cheque_no = $_POST['cheque_no']; // cheque No
			   
			   if(isset($_POST['cheque_bank_name']))$cheque_bank_name = $_POST['cheque_bank_name'];// cheque Bank Name

			   if(isset($_POST['credit_card_transaction_no']))$credit_card_transaction_no = $_POST['credit_card_transaction_no']; // Credit Card Transaction No
			   if(isset($_POST['credit_card_bank_name']))$credit_card_bank_name = $_POST['credit_card_bank_name']; //  Credit Card Bank Name

				if(isset($_POST['debit_card_transaction_no']))$debit_card_transaction_no = $_POST['debit_card_transaction_no']; // Debit Card Transaction No
			    if(isset($_POST['debit_card_bank_name']))$debit_card_bank_name = $_POST['debit_card_bank_name'];// Debit Card Bank Name

			    if(isset($_POST['payment_description']))$payment_description = $_POST['payment_description'];

			    /* Amount Status */
			     if(isset($_POST['amount_status']))$amount_status = $_POST['amount_status'];
			      if(isset($_POST['payee_name']))$payee_name = $_POST['payee_name'];
			      
			      
			       if(isset($_POST['creator_name']))$creator_name = $_POST['creator_name'];

			    


				   $booking_order_id = date("Ymd") . time() . mt_rand();

				   $balance_sheet_unique_id = 'B'.date("Ymd") . time() . mt_rand();

				   $balance_sheet_date = date('Y-m-d');




				$insert_booking = DB::table('sale_booking')->insert( ['order_id'=>$booking_order_id,'booking_no'=>$booking_no,'booking_unique_value'=>$booking_unique_value,'exchange_or_new'=>$exchange_new,'vehicle_model_id' => $model_id, 'booking_date' => $booking_date,'customer_id' =>$customer_id,'sales_person_id'=>$sales_person_id,'extra_fitting'=>$extra_fitting,'extra_fitting_charge'=>$extra_fitting_charge,'mechanic_id'=>$mechanic_id,'mechanic_charge'=>$mechanic_charge,'mechanic_amount'=>$mechanic_amount,'insurance'=>$insurance,'insurance_amount'=>$insurance_amount,'discount'=>$discount,'vehicle_sale_rate'=>$self_sale_rate,'gross_total'=>$gross_total,'grand_total'=>$grand_total,'total_paid'=>$total_paid,'total_remaining'=>$total_remaining,'description'=>$description,'balance_sheet_unique_id'=>$balance_sheet_unique_id,'vehicle_type_id'=>$vehicle_type,'vehicle_color_id'=>$color_id,'hyp'=>$hyp,'hyp_bank_name'=>$hyp_bank_name,'initial_balance'=>$initial_balance] );



				if($exchange_new == 'exchange')
				{
					$insert_exchange_vehicle = DB::table('exchange_vehicle')->insert( ['booking_order_id'=>$booking_order_id,'model_name'=>$ex_vehicle_model_name,'chassis_no'=>$ex_vehicle_chassis_no,'engine_no'=>$ex_vehicle_engine_no,'valuable_amount'=>$ex_vehicle_amount, 'exchange_date'=>$ex_vehicle_date,'vehicle_no'=>$ex_vehicle_no] );

				}



				$insert_receipt = DB::table('customer_sales_receipt')->insertGetId( ['creator_name'=>$creator_name,'booking_order_id'=>$booking_order_id,'receipt_no' => $receipt_no,'amount_to_pay' => $amount_to_pay, 'payment_mode' =>$payment_mode, 'cheque_no' => $cheque_no, 'cheque_bank_name' => $cheque_bank_name, 'credit_card_transaction_no'=>$credit_card_transaction_no,'credit_card_bank_name'=>$credit_card_bank_name,'debit_card_transaction_no'=>$debit_card_transaction_no,'debit_card_bank_name'=>$debit_card_bank_name,'payment_description'=>$payment_description,'receipt_date'=>$receipt_date,'balance_sheet_unique_id'=>$balance_sheet_unique_id,'customer_id'=>$customer_id,'amount_status'=>$amount_status,'payee_name'=>$payee_name] );

			

				$insert_balance_sheet = DB::table('balance_sheet')->insert(['unique_id'=>$balance_sheet_unique_id,'order_id'=>$booking_order_id,'bal_date'=>$balance_sheet_date,'payment_mode'=>$payment_mode,'amount'=>$amount_to_pay]);
			      
			
			
			
			
			   
				    if($booking_save=='save')
					{
					    //print"Test1";
					    
					    	return redirect('/sales-booking')->with('success', 'Booking Saved!');
					    	
					//	return redirect('/dealer-booking')->with('success', 'Dealers booking Saved!');

					}
					else
					{
					    //print"Test";
						
						return Redirect('/sales-booking')->with(['receipt_id'=>$insert_receipt]);
						//return redirect('/dealer-booking')->with('success', 'Dealers booking Saved!');
					}



			
			

		
		

		}


	   public function edit_sale_booking($sale_booking_order_id,$balance_sheet_unique_id){
              
            if (! Gate::allows('admin')) 
			{
				if (! Gate::allows('receipt')) 
				{
					if (! Gate::allows('stock_import')) 
					{
						if (! Gate::allows('gate_pass')) 
						{
							if (! Gate::allows('rto')) 
							{
            					return abort(401);
			            	}
			            }
			        }
            	}
            }

			$customers = DB::table('customers')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$sales_persons = DB::table('sales_person')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$mechanics = DB::table('mechanic')
						 ->where('is_deleted', '=', '0')
						 ->get();
			 $vehicle_types = DB::table('vehicle_type')
						 ->where('is_deleted', '=', '0')
						 ->get();



			$colors = DB::table('colors')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$banks = DB::table('bank')
						 ->where('is_deleted', '=', '0')
						 ->get();


			$edit_sales_bookings = DB::table('sale_booking')			
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')
                         ->leftJoin('bank', 'bank.id', '=', 'sale_booking.hyp_bank_name')

                         ->select('sale_booking.id','sale_booking.order_id','sale_booking.booking_no','sale_booking.balance_sheet_unique_id','sale_booking.exchange_or_new','sale_booking.vehicle_model_id','sale_booking.booking_date','sale_booking.customer_id','sale_booking.sales_person_id','sale_booking.extra_fitting','sale_booking.extra_fitting_charge','sale_booking.mechanic_id','sale_booking.mechanic_charge','sale_booking.mechanic_amount','sale_booking.insurance','sale_booking.insurance_amount','sale_booking.discount','sale_booking.vehicle_sale_rate','sale_booking.gross_total','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.description','customers.customer_name','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','bank.bank_name','sale_booking.hyp','sale_booking.hyp_bank_name','sale_booking.initial_balance')
						 ->where([['sale_booking.is_deleted', '=', 0],['sale_booking.order_id', '=', $sale_booking_order_id],['sale_booking.balance_sheet_unique_id', '=', $balance_sheet_unique_id]])
						 ->get();


						 // print_r($edit_sales_bookings);
						 // die();


						$vehicle_type_id = $edit_sales_bookings[0]->vehicle_type_id;

		            	$vehicle_models = DB::table('main_model')
							 ->where([['is_deleted', '=', '0'],['vehicle_type_id', '=', $vehicle_type_id]])
							 ->get();




			 // $edit_exchange_vehicle = DB::table('exchange_vehicle')
			 // 						->where([['is_deleted', '=', 0],['booking_order_id', '=', $sale_booking_order_id]])
			 // 						->get();
			  $edit_exchange_vehicle = "";		 

			  $edit_exchange_vehicle_qry = DB::select("SELECT * FROM exchange_vehicle WHERE booking_order_id = '$sale_booking_order_id' and is_deleted='0'");
			   if(!empty($edit_exchange_vehicle_qry))
               {
               		$edit_exchange_vehicle = $edit_exchange_vehicle_qry;
               }



			return view('/edit-sale-booking', compact(['customers','sales_persons','mechanics','vehicle_models','colors','vehicle_types','edit_sales_bookings','edit_exchange_vehicle','banks']));

	   		//return view('/edit-sale-booking');

	   }


	   public function update_sale_booking()
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
            
            
            
            
            

	   	     /** Booking Info **/
			 if(isset($_POST['booking_unique_value']))$booking_unique_value = $_POST['booking_unique_value'];
			 if(isset($_POST['booking_no']))$booking_no = $_POST['booking_no'];
			 if(isset($_POST['booking_date']))$booking_date = date("Y-m-d", strtotime($_POST['booking_date']));
			 if(isset($_POST['customer_id']))$customer_id = $_POST['customer_id'];
			 if(isset($_POST['sales_person_id']))$sales_person_id = $_POST['sales_person_id'];
			 if(isset($_POST['mechanic_id']))$mechanic_id = $_POST['mechanic_id'];


			  /* HYp Info */
			 if(isset($_POST['hyp']))$hyp = $_POST['hyp'];
			 if(isset($_POST['bank_name']))$hyp_bank_name = $_POST['bank_name'];
			 if(isset($_POST['initial_balance']))$initial_balance = $_POST['initial_balance'];






			 /** Exchange and New **/
			 if(isset($_POST['exchange_new']))$exchange_new = $_POST['exchange_new'];
			 
			 if(isset($_POST['ex_vehicle_model_name']))$ex_vehicle_model_name = $_POST['ex_vehicle_model_name'] ?: 'Null';
			 
		
			 if(isset($_POST['ex_vehicle_chassis_no']))$ex_vehicle_chassis_no = $_POST['ex_vehicle_chassis_no'] ?: 'Null';
			 
		
			 if(isset($_POST['ex_vehicle_engine_no']))$ex_vehicle_engine_no = $_POST['ex_vehicle_engine_no'] ?: 'Null';
			 
		
			 
			 if(isset($_POST['ex_vehicle_amount']))$ex_vehicle_amount = $_POST['ex_vehicle_amount'] ?: '0';
			 if(isset($_POST['ex_vehicle_date']))$ex_vehicle_date = $_POST['ex_vehicle_date'] ?: '0';
			 if(isset($_POST['ex_vehicle_no']))$ex_vehicle_no = $_POST['ex_vehicle_no'] ?: 'Null';
		

			  /** New Vehicle Info **/
			  if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
			  if(isset($_POST['model_id']))$model_id = $_POST['model_id'];
			  if(isset($_POST['color_id']))$color_id = $_POST['color_id'];
			  if(isset($_POST['self_sale_rate']))$self_sale_rate = $_POST['self_sale_rate'];

			  /** Extra Charges **/
			  if(isset($_POST['extra_fitting']))$extra_fitting = $_POST['extra_fitting'];
			  if(isset($_POST['extra_fitting_charge']))$extra_fitting_charge = $_POST['extra_fitting_charge'];
			  if(isset($_POST['mechanic_charge']))$mechanic_charge = $_POST['mechanic_charge'];
			  if(isset($_POST['mechanic_amount']))$mechanic_amount = $_POST['mechanic_amount'];
			  if(isset($_POST['insurance']))$insurance = $_POST['insurance'];
			  if(isset($_POST['insurance_amount']))$insurance_amount = $_POST['insurance_amount'];
			  if(isset($_POST['discount']))$discount = $_POST['discount'];

			   /** Calculation **/
			   if(isset($_POST['gross_total']))$gross_total = $_POST['gross_total'];
			   if(isset($_POST['grand_total']))$grand_total = $_POST['grand_total'];
			   if(isset($_POST['description']))$description = $_POST['description'];

			   /** OLd Value */

			   if(isset($_POST['old_total_paid']))$old_total_paid = $_POST['old_total_paid'];
			   if(isset($_POST['old_grand_total']))$old_grand_total = $_POST['old_grand_total'];
			   if(isset($_POST['booking_order_id']))$old_booking_order_id = $_POST['booking_order_id'];
			   if(isset($_POST['balance_sheet_unique_id']))$old_balance_sheet_unique_id = $_POST['balance_sheet_unique_id'];
			   if(isset($_POST['old_exchange_new']))$old_exchange_new = $_POST['old_exchange_new'];


			   if($old_exchange_new == "exchange" && $exchange_new == "exchange")
			   {
			      	$update_exchange_vehicle_info = DB::table('exchange_vehicle')->where('booking_order_id', '=', $old_booking_order_id)->update( ['exchange_date'=>$ex_vehicle_date,'model_name'=>$ex_vehicle_model_name,'chassis_no'=>$ex_vehicle_chassis_no,'engine_no'=>$ex_vehicle_engine_no,'vehicle_no'=>$ex_vehicle_no,'valuable_amount'=>$ex_vehicle_amount] );
                   
			   }

			   if($old_exchange_new == "new" AND $exchange_new == "exchange")
			   {
			   	    $insert_exchange_vehicle = DB::table('exchange_vehicle')->insert(['booking_order_id'=>$old_booking_order_id,'model_name'=>$ex_vehicle_model_name,'chassis_no'=>$ex_vehicle_chassis_no,'engine_no' =>$ex_vehicle_engine_no,'valuable_amount'=>$ex_vehicle_amount,'exchange_date'=>$ex_vehicle_date,'vehicle_no'=>$ex_vehicle_no] );
			   }

			   if($old_exchange_new == "exchange" AND $exchange_new == "new")
			   {
			   	    $update_exchange_vehicle = DB::table('exchange_vehicle')->where('booking_order_id', $old_booking_order_id)->update( ['exchange_vehicle.is_deleted'=>'1'] );

			   }


			   $t_remaining = $grand_total - $old_total_paid;

			  $update_booking = DB::table('sale_booking')->where([['order_id', $old_booking_order_id],['balance_sheet_unique_id', $old_balance_sheet_unique_id]])->update( ['exchange_or_new' =>$exchange_new, 'vehicle_model_id' => $model_id, 'booking_date' => $booking_date, 'sales_person_id'=>$sales_person_id,'extra_fitting'=>$extra_fitting,'extra_fitting_charge'=>$extra_fitting_charge,'mechanic_id'=>$mechanic_id,'mechanic_charge'=>$mechanic_charge,'mechanic_amount'=>$mechanic_amount,'insurance'=>$insurance,'insurance_amount'=>$insurance_amount,'discount'=>$discount,'vehicle_sale_rate'=>$self_sale_rate,'gross_total'=>$gross_total,'grand_total'=>$grand_total,'total_paid'=>$old_total_paid,'total_remaining'=>$t_remaining,'description'=>$description,'vehicle_type_id'=>$vehicle_type,'vehicle_color_id'=>$color_id,'hyp'=>$hyp,'hyp_bank_name'=>$hyp_bank_name,'initial_balance'=>$initial_balance] );
                
              $update_sale_booking_vehicle = DB::table('self_sale_vehicle_info')->where([['booking_order_id', $old_booking_order_id]])->update(['sales_person_id'=>$sales_person_id]);
			  return redirect('/sales-booking')->with('success', 'Booking Updated!');
	   }


	   public function delete_sale_booking($sale_booking_order_id,$balance_sheet_unique_id)
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


	   	$delete_exchange_vehicle = DB::table('exchange_vehicle')->where('booking_order_id', $sale_booking_order_id)->update( ['exchange_vehicle.is_deleted'=>'1'] );

	   	$delete_sales_booking = DB::table('sale_booking')->where('order_id', $sale_booking_order_id)->update( ['sale_booking.is_deleted'=>'1'] );

	   	$delete_receipt = DB::table('customer_sales_receipt')->where('booking_order_id', $sale_booking_order_id)->update( ['customer_sales_receipt.is_deleted'=>'1'] );

	   	$delete_balance_sheet = DB::table('balance_sheet')->where('order_id', $sale_booking_order_id)->update( ['balance_sheet.is_deleted'=>'1'] );

	   	  return redirect('/sales-booking')->with('success', 'Sale Booking Deleted!');

	   }


	   public function cancel_booking($booking_order_id,$balance_sheet_unique_id,$customer_id)
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

            

	   	        $update_receipt = DB::table('customer_sales_receipt')->where([['booking_order_id', '=', $booking_order_id],['is_deleted', '=', 0]])->update(['cancel_status' => 1]);

			    $update_sales_booking = DB::table('sale_booking')->where('order_id', $booking_order_id)->update( ['cancel_status' => 1 ]);

			    // print_r($update_receipt);
			    // die();


			    $update_balance_sheet = DB::table('balance_sheet')->where([['unique_id', '=', $balance_sheet_unique_id],['is_deleted', '=', 0]])->update(['is_deleted'=>1]);


			     return redirect('/sales-booking')->with('success', 'Sale Booking Canceled!');



	   }



		public function fetch_sale_booking_info(){

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

            if(isset($_POST['order_id']))$order_id = $_POST['order_id'];		


            $fsbs = DB::table('sale_booking')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')

                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')

                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')  

                         ->leftJoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')

                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id')
                         ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
                         ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')

						 ->select('sale_booking.id','customers.customer_name','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.order_id','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.order_id','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','self_sale_vehicle_info.booking_order_id','self_sale_vehicle_info.chassis_no','self_sale_vehicle_info.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','sale_booking.id')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.order_id', '=', $order_id)
						 ->get();

			return $fsbs;
		}



		public function add_customer_sale_vehicle_info($booking_order_id)
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


	        $vehicle_types = DB::table('vehicle_type')
						 ->where('is_deleted', '=', '0')
						 ->get();


			$vehicle_models = DB::table('main_model')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$colors = DB::table('colors')
						 ->where('is_deleted', '=', '0')
						 ->get();


                $fsbs = DB::table('sale_booking')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')                      
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id')
                         ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
                         ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')

						 ->select('sale_booking.id','sale_booking.mechanic_id','sale_booking.sales_person_id','customers.customer_name','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.order_id', '=', $booking_order_id)
						 ->get();

						$vehicle_type_id = $fsbs[0]->vehicle_type_id;
						$vehicle_color_id = $fsbs[0]->vehicle_color_id;
						$vehicle_model_id = $fsbs[0]->vehicle_model_id;

						$vehicle_stock_chassis_nos = DB::table('vehicle_stock')
													->select('vehicle_stock.chassis_no')
													->where([['vehicle_type', '=', $vehicle_type_id],['vehicle_color', '=', $vehicle_color_id],['model_name', '=', $vehicle_model_id],['status', '=', 0],['temp_status', '=', 0],['is_deleted', '=', 0]])
													->get();


						
				// 		$update_delivery_status = DB::table('sale_booking')
				// 		 				 ->where([['order_id', '=', $booking_order_id],['is_deleted', '=', 0]])

				// 		 				 ->update(['delivery_note_status'=>'1']);





						return view('/add-customer-sale-vehicle-info', compact(['fsbs','vehicle_types','vehicle_models','colors','vehicle_stock_chassis_nos']));
		}


		public function edit_customer_sale_vehicle_info($booking_order_id)
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

	        $vehicle_types = DB::table('vehicle_type')
						 ->where('is_deleted', '=', '0')
						 ->get();


			$vehicle_models = DB::table('main_model')
						 ->where('is_deleted', '=', '0')
						 ->get();

			$colors = DB::table('colors')
						 ->where('is_deleted', '=', '0')
						 ->get();


                $fsbs = DB::table('sale_booking')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')                      
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id')
                         ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
                         ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')

						 ->select('sale_booking.id','sale_booking.mechanic_id','sale_booking.sales_person_id','customers.customer_name','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','sale_booking.delivery_note_checked_by')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.order_id', '=', $booking_order_id)
						 ->get();

						$vehicle_type_id = $fsbs[0]->vehicle_type_id;
						$vehicle_color_id = $fsbs[0]->vehicle_color_id;
						$vehicle_model_id = $fsbs[0]->vehicle_model_id;

						$vehicle_stock_chassis_nos = DB::table('vehicle_stock')
													->select('vehicle_stock.chassis_no')
													->where([['vehicle_type', '=', $vehicle_type_id],['vehicle_color', '=', $vehicle_color_id],['model_name', '=', $vehicle_model_id],['status', '=', 0],['temp_status', '=', 0],['is_deleted', '=', 0]])
													->get();

						$chassis_no_info = DB::table('self_sale_vehicle_info')											
													->where([['vehicle_type_id', '=', $vehicle_type_id],['color_id', '=', $vehicle_color_id],['model_id', '=', $vehicle_model_id],['booking_order_id', '=', $booking_order_id]])
													->get();


						return view('/edit-customer-sale-vehicle-info', compact(['fsbs','vehicle_types','vehicle_models','colors','vehicle_stock_chassis_nos','chassis_no_info']));
		}



		public function insert_customer_sale_vehicle_info()
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

            if(isset($_POST['booking_order_id']))$booking_order_id = $_POST['booking_order_id'];
            if(isset($_POST['customer_id']))$customer_id = $_POST['customer_id'];
            if(isset($_POST['mechanic_id']))$mechanic_id = $_POST['mechanic_id'];
            if(isset($_POST['sales_person_id']))$sales_person_id = $_POST['sales_person_id'];
            if(isset($_POST['vehicle_type_id']))$vehicle_type_id = $_POST['vehicle_type_id'];

            // print"vehicle Type Id : ". $vehicle_type_id;
            // die();

			if(isset($_POST['model_id']))$model_id = $_POST['model_id'];
			if(isset($_POST['color_id']))$color_id = $_POST['color_id'];
			if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
			if(isset($_POST['delivery_date']))$delivery_date = date("Y-m-d", strtotime($_POST['delivery_date']));
			if(isset($_POST['description']))$description = $_POST['description'];

			 if(isset($_POST['helmat_status']))$helmat_status = $_POST['helmat_status'];
			 if(isset($_POST['service_book_no']))$service_book_no = $_POST['service_book_no'];

            	if(isset($_POST['delivery_note_checked_by']))$delivery_note_checked_by = $_POST['delivery_note_checked_by'];



			$insert_self_sale_vehicle_info = DB::table('self_sale_vehicle_info')->insert( ['booking_order_id'=>$booking_order_id,'vehicle_type_id' => $vehicle_type_id,'model_id' => $model_id, 'color_id' =>$color_id, 'chassis_no' => $chassis_no,'customer_id'=>$customer_id,'sales_person_id'=>$sales_person_id,'delivery_date'=>$delivery_date,'delivery_description'=>$description,'helmat_status'=>$helmat_status,'service_book_no'=>$service_book_no]);
			
			
			$checked_by =  DB::table('sale_booking')
						 				 ->where([['order_id', '=', $booking_order_id],['is_deleted', '=', 0]])
						 				 ->update(['delivery_note_checked_by'=> $delivery_note_checked_by,'delivery_note_status'=> '1']);


						 $update_stock = DB::table('vehicle_stock')
						 				 ->where([['chassis_no', '=', $chassis_no]])
						 				 ->update(['status'=>'1', 'sale_type'=>'customer', 'sale_type_id'=>$customer_id]);

						$fetch_total_stock = DB::table('main_model')
											->select('main_model.in_stock')
											->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])
											->get();

						$in_stock = $fetch_total_stock[0]->in_stock;

						$update_in_stock = $in_stock - 1;

						$update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])->update(['in_stock'=>$update_in_stock]);

					return redirect('/sales-booking');


		}

		public function update_customer_sale_vehicle_info()
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

            if(isset($_POST['booking_order_id']))$booking_order_id = $_POST['booking_order_id'];
            if(isset($_POST['customer_id']))$customer_id = $_POST['customer_id'];
            if(isset($_POST['mechanic_id']))$mechanic_id = $_POST['mechanic_id'];
            if(isset($_POST['sales_person_id']))$sales_person_id = $_POST['sales_person_id'];

            if(isset($_POST['vehicle_type_id']))$vehicle_type_id = $_POST['vehicle_type_id'];

            // print"vehicle Type Id : ". $vehicle_type_id;
            // die();

			if(isset($_POST['model_id']))$model_id = $_POST['model_id'];
			if(isset($_POST['color_id']))$color_id = $_POST['color_id'];
			if(isset($_POST['old_chassis_no']))$old_chassis_no = $_POST['old_chassis_no'];
			if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];

			if(isset($_POST['delivery_date']))$delivery_date = date("Y-m-d", strtotime($_POST['delivery_date']));
			if(isset($_POST['description']))$description = $_POST['description'];
			if(isset($_POST['helmat_status']))$helmat_status = $_POST['helmat_status'];
			if(isset($_POST['service_book_no']))$service_book_no = $_POST['service_book_no'];

            	if(isset($_POST['delivery_note_checked_by']))$delivery_note_checked_by = $_POST['delivery_note_checked_by'];



	$checked_by =  DB::table('sale_booking')
						 				 ->where([['order_id', '=', $booking_order_id],['is_deleted', '=', 0]])
						 				 ->update(['delivery_note_checked_by'=> $delivery_note_checked_by,'delivery_note_status'=> '1']);
						 				 
			if($chassis_no == '')
			{
				$insert_self_sale_vehicle_info = DB::table('self_sale_vehicle_info')->where('booking_order_id', '=', $booking_order_id)->update( ['chassis_no' => $old_chassis_no,'delivery_date'=>$delivery_date,'delivery_description'=>$description,'helmat_status'=>$helmat_status,'service_book_no'=>$service_book_no]);

			}

			if($chassis_no != '')
			{
				$insert_self_sale_vehicle_info1 = DB::table('self_sale_vehicle_info')->where('booking_order_id', '=', $booking_order_id)->update( ['chassis_no' => $chassis_no,'delivery_date'=>$delivery_date,'delivery_description'=>$description,'helmat_status'=>$helmat_status,'service_book_no'=>$service_book_no]);

						/* Stock Increase */

				        $update_stock1 = DB::table('vehicle_stock')
						 				 ->where([['chassis_no', '=', $old_chassis_no]])
						 				 ->update(['status'=>'0', 'sale_type'=>'null', 'sale_type_id'=>0]);

				        $fetch_total_stock1 = DB::table('main_model')
											->select('main_model.in_stock')
											->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])
											->get();

						$in_stock1 = $fetch_total_stock1[0]->in_stock;

						$update_in_stock1 = $in_stock1 + 1;

						$update_instock_val1 = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])->update(['in_stock'=>$update_in_stock1]);

						/* Stock Decrease */

						$update_stock = DB::table('vehicle_stock')
						 				 ->where([['chassis_no', '=', $chassis_no]])
						 				 ->update(['status'=>'1', 'sale_type'=>'customer', 'sale_type_id'=>$customer_id]);

						$fetch_total_stock = DB::table('main_model')
											->select('main_model.in_stock')
											->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])
											->get();

						$in_stock = $fetch_total_stock[0]->in_stock;

						$update_in_stock = $in_stock - 1;

						$update_instock_val = DB::table('main_model')->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.id', '=', $model_id]])->update(['in_stock'=>$update_in_stock]);

			}

			return redirect('/sales-booking');

		}





		public function customer_gate_pass_print($booking_order_id){

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
                         ->leftJoin('bank', 'bank.id', '=', 'sale_booking.hyp_bank_name')
                        
						 ->select('customers.enquiry_no','sale_booking.id','sale_booking.mechanic_id','sale_booking.booking_unique_value','sale_booking.sales_person_id','customers.customer_name','customers.swd_category','customers.swd_name','customers.contact_no1','customers.customer_address','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','sale_booking.initial_balance','sale_booking.exchange_or_new','bank.bank_name','sale_booking.hyp','sale_booking.extra_fitting','sale_booking.delivery_note_checked_by')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.cancel_status', '=', 0)
						 ->where('sale_booking.order_id', '=', $booking_order_id)
						 ->get();



			$exchange_vehicle_info ="";

			$exchange_vehicle_info = DB::table('exchange_vehicle')
									->where('is_deleted', '=', 0)
									->where('booking_order_id', '=', $booking_order_id)
									->get();



			$self_sale_info="";
			$self_sale_info = DB::table('self_sale_vehicle_info')
									->where('is_deleted', '=', 0)
									->where('booking_order_id', '=', $booking_order_id)
									->get();

			$chassis_no = $self_sale_info[0]->chassis_no;

			$fetch_vehicle_stock = "";

			$fetch_vehicle_stock = DB::table('vehicle_stock')
									->where('is_deleted', '=', 0)
									->where('chassis_no', '=', $chassis_no)
									->get();











           
			return view('/customer-gate-pass-print', compact(['fsbs','exchange_vehicle_info','self_sale_info','fetch_vehicle_stock']));
			//return view('/customer-gate-pass-print');
		}


		public function update_account_close_status()
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


            if(isset($_POST['booking_order_id_close']))$booking_order_id_close = $_POST['booking_order_id_close'];
            if(isset($_POST['account_close_date']))$account_close_date =  date("Y-m-d", strtotime($_POST['account_close_date']));
            if(isset($_POST['account_close_description']))$account_close_description = $_POST['account_close_description'];

            $update_account_close = DB::table('sale_booking')
						 				 ->where([['order_id', '=', $booking_order_id_close]])
						 				 ->update(['account_close_status'=>'1', 'account_close_description'=>$account_close_description, 'account_close_date'=>$account_close_date]);

			  return redirect('/sales-booking')->with('success', 'Sale Booking Account Closed!');



		}


		public function reupdate_cancel($order_id)
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


              if(isset($_POST['order_id']))$order_id = $_POST['order_id'];



               $update_sale_reupdate = DB::table('sale_booking')
						 				 ->where([['order_id', '=', $order_id],['is_deleted', '=', 0]])

						 				 ->update(['cancel_status'=>'0']);


				$update_sale_reupdate1 = DB::table('customer_sales_receipt')
						 				 ->where([['booking_order_id', '=', $order_id],['is_deleted', '=', 0]])

						 				 ->update(['cancel_status'=>'0']);

				 return redirect('/sales-booking')->with('success', 'Successfully Re-update the cancel receipt!');



		}



public function sale_booking_ledger_print($booking_order_id){

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
                         ->leftJoin('bank', 'bank.id', '=', 'sale_booking.hyp_bank_name')
                        
						 ->select('sale_booking.id','sale_booking.mechanic_id','sale_booking.booking_unique_value','sale_booking.sales_person_id','customers.customer_name','customers.swd_category','customers.swd_name','customers.contact_no1','customers.customer_address','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','sale_booking.initial_balance','sale_booking.exchange_or_new','bank.bank_name','sale_booking.hyp','sale_booking.extra_fitting','sale_booking.delivery_note_checked_by')
						 ->where('sale_booking.is_deleted', '=', 0)
						 ->where('sale_booking.cancel_status', '=', 0)
						 ->where('sale_booking.order_id', '=', $booking_order_id)
						 ->get();



            $fetch_receipt_details = DB::table('customer_sales_receipt')
                                     ->where('customer_sales_receipt.is_deleted', '=', 0)
            						 ->where('customer_sales_receipt.cancel_status', '=', 0)
            						 ->where('customer_sales_receipt.booking_order_id', '=', $booking_order_id)
            						 ->get();
						 

			$exchange_vehicle_info ="";

			$exchange_vehicle_info = DB::table('exchange_vehicle')
									->where('is_deleted', '=', 0)
									->where('booking_order_id', '=', $booking_order_id)
									->get();



			$self_sale_info="";
			$self_sale_info = DB::table('self_sale_vehicle_info')
									->where('is_deleted', '=', 0)
									->where('booking_order_id', '=', $booking_order_id)
									->get();

			$chassis_no = $self_sale_info[0]->chassis_no;

			$fetch_vehicle_stock = "";

			$fetch_vehicle_stock = DB::table('vehicle_stock')
									->where('is_deleted', '=', 0)
									->where('chassis_no', '=', $chassis_no)
									->get();











           
			return view('/sale-booking-ledger-print', compact(['fsbs','exchange_vehicle_info','self_sale_info','fetch_vehicle_stock','fetch_receipt_details']));
			
		}



	



}
?>