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
use App;

class Reports extends Controller{	

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

            

			$dealer_lists =  DB::table('dealers')
						->where('is_deleted', '=', 0)
						->get();

			$sales_person_lists =  DB::table('sales_person')
						->where('is_deleted', '=', 0)
						->get();

			return view('/list-of-reports',compact(['dealer_lists','sales_person_lists']));			
		}
		
		
		



	




		public function monthly_opening_balance(){

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

             $dealer_lists = DB::table('dealers')->where('is_deleted', '0', 0)->get();


             $dealer_id = "";
             $report_from_date = "";
             $report_to_date = "";


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

			$dealer_rate_info =  DB::table('dealers')
									->where('id', '=', $dealer_id)
									->where('is_deleted', '=', 0)
									->get();


			$opening_balance = $dealer_rate_info[0]->opening_balance;


			$dealer_name = $dealer_rate_info[0]->dealer_name;


	//		print "Master Opening Balance : ".$opening_balance;


			$vehicle_total_amount = DB::table('dealer_booking')				   
				    ->where('dealer_booking.is_deleted', '=', 0)
				    ->where('dealer_booking.dealer_id', '=', $dealer_id)
				    ->where('dealer_booking.booking_date', '<', $report_from_date)
				    ->sum('dealer_booking.total_amount');

         //   print "<br>Total Dealer Booking Amount : ".$vehicle_total_amount;


			$sum_of_total_paid = DB::table('customer_sales_receipt')				   
				    ->where('customer_sales_receipt.is_deleted', '=', 0)
				    ->where('customer_sales_receipt.cancel_status', '=', 0)
				    ->where('customer_sales_receipt.dealer_id', '=', $dealer_id)
				    ->where('customer_sales_receipt.receipt_date', '<', $report_from_date)
				    ->sum('customer_sales_receipt.amount_to_pay');
				    
        //    print "<br>Sum Total Paid  : ".$sum_of_total_paid;

			$manual_return = DB::table('return_vehicle_manual')
								->where('return_vehicle_manual.is_deleted', '=', 0)
								->where('return_vehicle_manual.dealer_id', '=', $dealer_id)
								->where('return_vehicle_manual.return_date', '<', $report_from_date)
								->sum('return_vehicle_manual.total_amount');
								
		//	print "<br>Sum Total Manual Return :  ".$manual_return;			
            
            $dealer_return_vehicle_info =  DB::table('dealer_booking_vehicle_info')
                                ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
                                ->where('dealer_booking_vehicle_info.return_status', '=', 1)
            				    ->where('dealer_booking_vehicle_info.dealer_id', '=', $dealer_id)
            				    ->where('dealer_booking_vehicle_info.return_date', '<', $report_from_date)
            				    ->sum('dealer_booking_vehicle_info.vehicle_amount');
            
         	//print "<br>Dealer return vehicle info for return :  ".$dealer_return_vehicle_info;			
            	
                $dealer_return_vehicle_info1 =  DB::table('dealer_booking_vehicle_info')
                                ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
                                 ->where('dealer_booking_vehicle_info.return_status', '=', 1)
            				     ->where('dealer_booking_vehicle_info.dealer_id', '=', $dealer_id)
            				    ->where('dealer_booking_vehicle_info.booking_date', '<', $report_from_date)
            				    ->sum('dealer_booking_vehicle_info.vehicle_amount');
            
    		//print "<br>Dealer booking vehicle info for return :  ".$dealer_return_vehicle_info1;			
            	
            	
            	
            $dealer_warranty_total = DB::table('send_assc_warranty_card')
                                    ->where('send_assc_warranty_card.is_deleted', '=', 0)
            				     ->where('send_assc_warranty_card.dealer_id', '=', $dealer_id)
            				    ->where('send_assc_warranty_card.warranty_date', '<', $report_from_date)
            				    ->sum('send_assc_warranty_card.warranty_total_amount');
            				    
          //  print "<br>Dealer Warranty Amount :  ".$dealer_warranty_total;	
            				    
				$assc_offers_old = DB::table('assc_offer')
								->where('assc_offer.is_deleted', '=', 0)
								->where('assc_offer.dealer_id', '=', $dealer_id)
								->where('assc_offer.offer_date', '<', $report_from_date)
								->sum('assc_offer.total_amount');

            								
            //		print "<br>Dealer Offer List :  ".$assc_offers_old;						
            					
				

					$find_opening_bal = $opening_balance - $vehicle_total_amount - $dealer_warranty_total  - $assc_offers_old + $sum_of_total_paid + $manual_return + $dealer_return_vehicle_info;
					
				//	print $find_opening_bal;
			
					$dealer_vehicle_info =  DB::table('dealer_booking_vehicle_info')
									->leftJoin('dealer_booking', 'dealer_booking.order_id', '=', 'dealer_booking_vehicle_info.booking_order_id')
									 ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
									->select('dealer_booking.booking_date','dealer_booking.booking_date','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.vehicle_amount','main_model.model')
            						->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('dealer_booking.booking_date', [$report_from_date, $report_to_date]);

							       	  if($dealer_id !='')							        
							        	$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id],['dealer_booking_vehicle_info.is_deleted', '=', 0]]);

							        })->get();
							        
				    
				    	$dealer_vehicle_info_return =  DB::table('dealer_booking_vehicle_info')
									->leftJoin('dealer_booking', 'dealer_booking.order_id', '=', 'dealer_booking_vehicle_info.booking_order_id')
									 ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
									->select('dealer_booking.booking_date','dealer_booking.booking_date','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.vehicle_amount','main_model.model','dealer_booking_vehicle_info.return_date')
            						->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('dealer_booking_vehicle_info.return_date', [$report_from_date, $report_to_date]);

							       	  if($dealer_id !='')							        
							        	$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id],['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.return_status', '=', 1]]);

							        })->get();
							        



					$ews = DB::table('send_assc_warranty_card')
						 ->select('send_assc_warranty_card.warranty_date','send_assc_warranty_card.warranty_qty','send_assc_warranty_card.description','send_assc_warranty_card.warranty_amount','send_assc_warranty_card.warranty_total_amount')
						 ->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('send_assc_warranty_card.warranty_date', [$report_from_date, $report_to_date]);

							       	  if($dealer_id !='')							        
							        	$query->where([['send_assc_warranty_card.dealer_id', '=', $dealer_id],['send_assc_warranty_card.is_deleted', '=', 0]]);

							        })->get();


					$dealer_payment_info = DB::table('customer_sales_receipt')
										 ->select('customer_sales_receipt.receipt_no','customer_sales_receipt.amount_to_pay','customer_sales_receipt.payment_mode','customer_sales_receipt.cheque_no','customer_sales_receipt.cheque_bank_name','customer_sales_receipt.credit_card_transaction_no','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.debit_card_transaction_no','customer_sales_receipt.debit_card_bank_name','customer_sales_receipt.payment_description','customer_sales_receipt.receipt_date','customer_sales_receipt.payee_name','customer_sales_receipt.payment_description')

										->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('customer_sales_receipt.receipt_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['customer_sales_receipt.dealer_id', '=', $dealer_id],['customer_sales_receipt.is_deleted', '=', 0],['customer_sales_receipt.cancel_status', '=', 0]]);
								        })->get();


						$dealer_manual_return_info = DB::table('return_vehicle_manual')

										 ->select('return_vehicle_manual.total_amount','return_vehicle_manual.return_date','return_vehicle_manual.chassis_no')

										->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('return_vehicle_manual.return_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['return_vehicle_manual.dealer_id', '=', $dealer_id],['return_vehicle_manual.is_deleted', '=', 0]]);
								        })->get();



                        
					$assc_offers = DB::table('assc_offer')
										->leftJoin('dealers','dealers.id', '=', 'assc_offer.dealer_id')
										->leftJoin('offer_type','offer_type.id', '=', 'assc_offer.offer_id')
										->select('dealers.dealer_name','offer_type.offer_name','assc_offer.offer_qty','assc_offer.qty_amount','assc_offer.total_amount','assc_offer.offer_date','assc_offer.description','assc_offer.id','assc_offer.dealer_id')

										->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('assc_offer.offer_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['assc_offer.dealer_id', '=', $dealer_id],['assc_offer.is_deleted', '=', 0]]);
								        })->get();

					
					

					/*
					*
					Array Push Value 
					*
					*/

						$ledger_report_items=array();


						array_push($ledger_report_items,new LedgerReport("","","ASSC NAME: ".$dealer_name,"","","","f5d67a"));




 						array_push($ledger_report_items,new LedgerReport($report_from_date,"","Opening Balance","","",$find_opening_bal,"fff"));



						while (strtotime($report_from_date) <= strtotime($report_to_date)) {

							$filter_booking_vehicle_array = collect($dealer_vehicle_info)->where('booking_date', '=', $report_from_date)->all();


							if($filter_booking_vehicle_array !='')
							{
								foreach ($filter_booking_vehicle_array as $farray ) {
									$booking_date = $farray->booking_date;
									$chassis_no =  strtoupper($farray->chassis_no);
									$vehicle_amount =  $farray->vehicle_amount;
									$model = strtoupper($farray->model);
								

									$find_opening_bal = $find_opening_bal - $vehicle_amount;

							        array_push($ledger_report_items,new LedgerReport($report_from_date,$model,$chassis_no ,"",$vehicle_amount,$find_opening_bal,"c8e9fd"));
							        
							      


								}
							}		
							
							
							
							$filter_booking_return_vehicle_array = collect($dealer_vehicle_info_return)->where('return_date', '=', $report_from_date)->all();


							if($filter_booking_return_vehicle_array !='')
							{
								foreach ($filter_booking_return_vehicle_array as $farray_r) {
									$booking_date = $farray_r->booking_date;
									$chassis_no =  strtoupper($farray_r->chassis_no);
									$vehicle_amount1 =  $farray_r->vehicle_amount;
									$model = strtoupper($farray_r->model);
								

									$find_opening_bal = $find_opening_bal + $vehicle_amount1;
							        array_push($ledger_report_items,new LedgerReport($report_from_date,$model,$chassis_no ,$vehicle_amount1,"RETURN",$find_opening_bal,"c8e9fd"));
							        
							       


								}
							}			
						
						
						
						
						

							$filter_booking_receipt = collect($dealer_payment_info)->where('receipt_date', '=', $report_from_date)->all();


							if($filter_booking_receipt !='')
							{
								foreach ($filter_booking_receipt as $freceipt ) {
									$receipt_date = $freceipt->receipt_date;
									$receipt_no = $freceipt->receipt_no;
									$payment_mode1 = $freceipt->payment_mode;
                                    $payee_name = $freceipt->payee_name;
                                    $payment_description = $freceipt->payment_description;
										if($payment_mode1==1)
									{
										$payment_mode = "Cash";
									}

									if($payment_mode1==2)
									{
										$payment_mode = $payee_name." / ".$payment_description." / Bank";
									}
										if($payment_mode1==6)
									{
										$payment_mode = $payee_name." / ".$payment_description." / Insentive";
									}
										if($payment_mode1==7)
									{
										$payment_mode = $payee_name." / ".$payment_description." / Insurance";
									}
										if($payment_mode1==8)
									{
										$payment_mode = $payee_name." / ".$payment_description." / Road Tax";
									}

									if($payment_mode1==3)
									{
										$payment_mode =$payee_name." / ".$payment_description." /  Cheque / Cheque No : ".$freceipt->cheque_no." / Cheque Bank Name : ".$freceipt->cheque_bank_name;
									}

									if($payment_mode1==4)
									{
										$payment_mode = $payee_name." / ".$payment_description." / Credit Card / Transaction No : ".$freceipt->credit_card_transaction_no." / Credit Card Bank Name : ".$freceipt->credit_card_bank_name;
									}

									if($payment_mode1==5)
									{
										$payment_mode = $payee_name." / ".$payment_description." / Debit Card / Transaction No : ".$freceipt->debit_card_transaction_no." / Debit Card Bank Name : ".$freceipt->debit_card_bank_name;
									}
									
									
									

									$amount_to_pay = $freceipt->amount_to_pay;

									$find_opening_bal = $find_opening_bal + $amount_to_pay;

							        array_push($ledger_report_items,new LedgerReport($receipt_date,"R.No: ".$receipt_no,$payment_mode ,$amount_to_pay,"",$find_opening_bal,"fbc4c4"));


								}

							}

							$dealer_manual_return_info_array = collect($dealer_manual_return_info)->where('return_date', '=', $report_from_date)->all();


							if($dealer_manual_return_info_array !='')
							{
								foreach ($dealer_manual_return_info_array as $manuasl_freceipt ) {
									$return_date = $manuasl_freceipt->return_date;
									$chassis_no = $manuasl_freceipt->chassis_no;
									$vehicle_amount = $manuasl_freceipt->total_amount;

									$find_opening_bal = $find_opening_bal + $vehicle_amount;

							        array_push($ledger_report_items,new LedgerReport($return_date,"Return manual Chassis No: ".$chassis_no,"" ,$vehicle_amount,"",$find_opening_bal,""));

							        array_push($ledger_report_items,new LedgerReport("","","","","","",""));



								}

							}
							
							
							
							$dealer_warranty_send = collect($ews)->where('warranty_date', '=', $report_from_date)->all();
							
							
						    if($dealer_warranty_send !='')
							{
								foreach ($dealer_warranty_send as $ew ) {
									 $warranty_date = $ew->warranty_date;
        							$warranty_qty = $ew->warranty_qty;
        							$warranty_amount = $ew->warranty_amount;
        							$warranty_total = $ew->warranty_total_amount;
                                    $description = $ew->description;
        							$find_opening_bal = $find_opening_bal - $warranty_total;
        
        
        							array_push($ledger_report_items,new LedgerReport($warranty_date,"EW ".$description,$warranty_qty."*".$warranty_amount ,"",$warranty_total,$find_opening_bal,"fff"));
                                    array_push($ledger_report_items,new LedgerReport("","","","","","",""));


								}

							}
							
							
							
							
							$assc_offer_list = collect($assc_offers)->where('offer_date', '=', $report_from_date)->all();
							
							
						    if($assc_offer_list !='')
							{
								foreach ($assc_offer_list as $aol ) {
									 $offer_date = $aol->offer_date;
        							$dealer_name = $aol->dealer_name;
        							$offer_name = $aol->offer_name;
        							$offer_qty = $aol->offer_qty;
        							$qty_amount = $aol->qty_amount;

        							$total_amount = $aol->total_amount;
        
        							$find_opening_bal = $find_opening_bal - $total_amount;
        
        
        							array_push($ledger_report_items,new LedgerReport($offer_date,"Offers : ".$offer_name,$offer_qty."*".$qty_amount ,"",$total_amount,$find_opening_bal,"fff"));

                                    array_push($ledger_report_items,new LedgerReport("","","","","","",""));


								}

							}
							
							
							
							
							

                            


							
							
							
						    $report_from_date = date ("Y-m-d", strtotime("+1 days", strtotime($report_from_date)));
						}

                     
			
			return view('/monthly-opening-balance',compact(['ledger_report_items','dealer_lists']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date,'dealer_id'=>$dealer_id]);		
		}

	



		public function stock_in_hand()
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




            //   $stock_in_hands = DB::table('main_model')
            //             ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'main_model.vehicle_type_id')
            //             ->select('vehicle_type.type_of_vehicle','main_model.model','main_model.in_stock','main_model.id','main_model.vehicle_type_id')
            //             ->where('main_model.is_deleted', '=', '0')
            //             ->get();

$stock_in_hands = DB::table('vehicle_stock')
                ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type')
                ->leftjoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
                ->leftjoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
                ->select('vehicle_type.type_of_vehicle','vehicle_stock.stock_date','colors.type_of_color','main_model.model','vehicle_stock.chassis_no')
                ->where('vehicle_stock.is_deleted','=',0)
                ->where('vehicle_stock.status','=',0)
                ->orderBy('vehicle_stock.id', 'DESC')
                ->get();
                
            // $vehicle_type = DB::table('table')
            // 				->where('is_deleted', '=', 0)
            // 				->get();

            // if(!empty($vehicle_type))
            // {
            // 	foreach ($vehicle_type as $vt) {
            // 		# code...
            // 		$vehicle_type_id = $vt->id;

            // 		$fetch_vehicle_sum = DB::table('vehicle_stock')

            // 	}
            // }



            return view('/stock-in-hand', compact(['stock_in_hands']));
		}

		public function assc_stock_in_hand()
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

            //   $assc_stock_in_hands = DB::table('dealer_booking_vehicle_info')
            //                         ->leftjoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
            //                         ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
            //                           ->select('dealer_booking_vehicle_info.model_id','dealer_booking_vehicle_info.vehicle_type_id','vehicle_type.type_of_vehicle','main_model.model',DB::raw("(SELECT count(id) as total_scooter FROM dealer_booking_vehicle_info
            //                     WHERE dealer_booking_vehicle_info.model_id = main_model.id and dealer_booking_vehicle_info.vehicle_type_id = vehicle_type.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.stock_status = 0 and dealer_booking_vehicle_info.return_status = 0) as total_stock"))->distinct()
            //                          ->get();



 $assc_stock_in_hands = DB::table('dealer_booking_vehicle_info')
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id') 
						        ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')
						        ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
						         ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
						        ->select('dealer_booking_vehicle_info.delivery_date','dealer_booking_vehicle_info.rto_date','dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.booking_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','dealers.dealer_name','dealer_booking_vehicle_info.assc_customer_name','dealer_booking_vehicle_info.contact_no')
								->where('dealer_booking_vehicle_info.is_deleted', '=', '0')
								->where('dealer_booking_vehicle_info.return_status', '=', '0')
								->where('dealer_booking_vehicle_info.stock_status', '=', '0')
								->orderBy('dealer_booking_vehicle_info.id', 'DESC')
								->get();
								
            return view('/assc-stock-in-hand', compact(['assc_stock_in_hands']));

		}


		public function receipt_report()
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







       $receipt_reports = DB::table('customer_sales_receipt')
            			  ->leftJoin('customers', 'customers.id', '=', 'customer_sales_receipt.customer_id')
            			  ->leftJoin('dealers', 'dealers.id', '=', 'customer_sales_receipt.dealer_id')
						  ->select('customer_sales_receipt.receipt_no','customer_sales_receipt.receipt_date','customer_sales_receipt.amount_to_pay','customer_sales_receipt.payment_mode','customer_sales_receipt.cheque_no','customer_sales_receipt.cheque_bank_name','customer_sales_receipt.credit_card_transaction_no','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.debit_card_transaction_no','customer_sales_receipt.debit_card_bank_name','customer_sales_receipt.payment_description','customers.customer_name','dealers.dealer_name') 
						  	->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('customer_sales_receipt.receipt_date', [$report_from_date, $report_to_date]);

							       						        
							        	$query->where([['customer_sales_receipt.is_deleted', '=', 0],['customer_sales_receipt.amount_status', '=', 0]]);

							        })->get();



            return view('/receipt-report', compact(['receipt_reports']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);

		}

		public function cancel_receipt_report()
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


       $cancel_receipt_reports = DB::table('customer_sales_receipt')
            			  ->leftJoin('customers', 'customers.id', '=', 'customer_sales_receipt.customer_id')
            			  ->leftJoin('dealers', 'dealers.id', '=', 'customer_sales_receipt.dealer_id')
						  ->select('customer_sales_receipt.receipt_no','customer_sales_receipt.receipt_date','customer_sales_receipt.amount_to_pay','customer_sales_receipt.payment_mode','customer_sales_receipt.cheque_no','customer_sales_receipt.cheque_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.debit_card_transaction_no','customer_sales_receipt.debit_card_bank_name','customer_sales_receipt.payment_description','customers.customer_name','dealers.dealer_name') 
						  ->where('customer_sales_receipt.is_deleted', '=', '0')
						  ->where('customer_sales_receipt.cancel_status', '=', 1)
						  ->get();


            return view('/cancel-receipt-report', compact(['cancel_receipt_reports']));

		}


		public function sold_vehicle_stock()
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
            
            	$sales_person_lists = DB::table('sales_person')->where('is_deleted', '0')->get();
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





       $vehicle_stocks = DB::table('self_sale_vehicle_info')
                                 ->leftJoin('vehicle_stock', 'vehicle_stock.chassis_no', '=', 'self_sale_vehicle_info.chassis_no') 
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'self_sale_vehicle_info.vehicle_type_id') 
						        ->leftJoin('colors', 'colors.id', '=', 'self_sale_vehicle_info.color_id')
						        ->leftJoin('main_model', 'main_model.id', '=', 'self_sale_vehicle_info.model_id')
						         ->leftJoin('customers', 'customers.id', '=', 'self_sale_vehicle_info.customer_id')
						        ->leftJoin('sales_person', 'sales_person.id','=', 'self_sale_vehicle_info.sales_person_id')
						        ->select('customers.contact_no1','self_sale_vehicle_info.vehicle_no','vehicle_stock.stock_date','vehicle_stock.engine_no','self_sale_vehicle_info.rto_date','self_sale_vehicle_info.id','self_sale_vehicle_info.chassis_no','self_sale_vehicle_info.delivery_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','customers.customer_name','sales_person.sales_person_name')
								->where(function($query) use ($report_from_date, $report_to_date,$dsc_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('self_sale_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dsc_id !='')							        
								        	$query->where([['self_sale_vehicle_info.sales_person_id', '=', $dsc_id]]);

								        $query->where([['self_sale_vehicle_info.is_deleted', '=', 0]]);

								        })->get();


            //return view('/sold-vehicle-stock', compact(['vehicle_stocks']));
return view('/sold-vehicle-stock',compact(['vehicle_stocks','sales_person_lists']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date,'dsc_id'=>$dsc_id]);	
		}


		public function assc_sold_vehicle_stock()
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
			$fetch_dsc_monthly_sales ="";

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


       $vehicle_stocks = DB::table('dealer_booking_vehicle_info')
                                ->leftJoin('vehicle_stock', 'vehicle_stock.chassis_no', '=', 'dealer_booking_vehicle_info.chassis_no') 
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id') 
						        ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')
						        ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
						         ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
						        ->select('vehicle_stock.stock_date','vehicle_stock.engine_no','dealer_booking_vehicle_info.delivery_date','dealer_booking_vehicle_info.rto_date','dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.booking_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','dealers.dealer_name','dealer_booking_vehicle_info.assc_customer_name','dealer_booking_vehicle_info.contact_no')
							
								->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('dealer_booking_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id]]);

								        $query->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.delivery_date', '<>', ''],['dealer_booking_vehicle_info.return_status', '=', 0]]);
							

								        })->get();



            return view('/assc-sold-vehicle-stock', compact(['vehicle_stocks','dealer_lists']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date,'dealer_id'=>$dealer_id]);	

		}

		public function return_vehicle_stock()
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


       
			$return_vehicle_lists = DB::table('dealer_booking_vehicle_info')
								 ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
								 ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
								 ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')

								 ->select('dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.model_id','dealer_booking_vehicle_info.vehicle_amount','dealer_booking_vehicle_info.book_no','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color','dealer_booking_vehicle_info.return_date','dealer_booking_vehicle_info.return_description')
								 ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
								 ->where('dealer_booking_vehicle_info.return_status', '=',1)							 
								 ->get();


            return view('/return-vehicle-stock', compact(['return_vehicle_lists']));

		}



		public function dsc_monthly_sale()
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



			$sales_person_lists = DB::table('sales_person')->where('is_deleted', '0')->get();

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


            $fetch_dsc_monthly_sales = DB::table('self_sale_vehicle_info')
                         ->leftJoin('customers', 'customers.id', '=', 'self_sale_vehicle_info.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'self_sale_vehicle_info.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'self_sale_vehicle_info.mechanic_id')  
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'self_sale_vehicle_info.vehicle_type_id')
					     ->leftJoin('main_model', 'main_model.id', '=', 'self_sale_vehicle_info.model_id')  
					     ->leftJoin('colors', 'colors.id', '=', 'self_sale_vehicle_info.color_id')

						 ->select('self_sale_vehicle_info.helmat_status','customers.customer_name','customers.contact_no1','customers.customer_address','sales_person.sales_person_name','mechanic.mechanic_name','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color','self_sale_vehicle_info.chassis_no','self_sale_vehicle_info.delivery_date')

						->where(function($query) use ($report_from_date, $report_to_date,$dsc_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('self_sale_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dsc_id !='')							        
								        	$query->where([['self_sale_vehicle_info.sales_person_id', '=', $dsc_id]]);

								        $query->where([['self_sale_vehicle_info.is_deleted', '=', 0]]);

								        })->get();

					
            return view('/dsc-monthly-sale',compact(['fetch_dsc_monthly_sales','sales_person_lists']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date,'dsc_id'=>$dsc_id]);	


		}


		public function list_of_stock_in_hand($model_id,$vehicle_type_id)
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



			   $list_of_vehicle_stocks = DB::table('vehicle_stock')
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type') 
						        ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
						        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
						        ->select('vehicle_stock.id','vehicle_stock.chassis_no','vehicle_stock.stock_date','vehicle_stock.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','vehicle_stock.is_deleted','vehicle_stock.status')
								->where([['vehicle_stock.is_deleted', '=', '0'],['vehicle_stock.model_name', '=', $model_id],['vehicle_stock.vehicle_type', '=', $vehicle_type_id],['vehicle_stock.status', '=', 0]])
								->get();

			return view('/list-of-stock-in-hand', compact(['list_of_vehicle_stocks']));

		}

		public function list_of_assc_stock_in_hand($vehicle_type_id,$model_id)
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


     
         $dealer_vehicle_stocks = DB::table('dealer_booking_vehicle_info')
                                    ->leftjoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
                                    ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
                                    ->leftjoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')
                                    ->leftjoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')

                                    ->select('main_model.model','vehicle_type.type_of_vehicle','colors.type_of_color','dealers.dealer_name','dealer_booking_vehicle_info.chassis_no','dealers.dealer_code')

                                     ->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.stock_status','=', 0],['dealer_booking_vehicle_info.return_status','=', 0],['dealer_booking_vehicle_info.model_id','=', $model_id],['dealer_booking_vehicle_info.vehicle_type_id','=', $vehicle_type_id]])
                                     ->get();


			return view('/list-of-assc-stock-in-hand', compact(['dealer_vehicle_stocks']));
		}


		public function rto_check_pending()
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


			 $rto_check_pendings = DB::table('self_sale_vehicle_info')
			 				 ->leftJoin('customers', 'customers.id', '=', 'self_sale_vehicle_info.customer_id')
	                         ->leftJoin('sales_person', 'sales_person.id', '=', 'self_sale_vehicle_info.sales_person_id')
	                         ->leftJoin('mechanic', 'mechanic.id', '=', 'self_sale_vehicle_info.mechanic_id')                      
	                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'self_sale_vehicle_info.vehicle_type_id')
	                         ->leftJoin('colors', 'colors.id', '=', 'self_sale_vehicle_info.color_id')
                        	 ->leftJoin('main_model', 'main_model.id', '=', 'self_sale_vehicle_info.model_id')
			 				 ->leftJoin('sale_booking', 'sale_booking.order_id', '=', 'self_sale_vehicle_info.booking_order_id')
			 				 ->select('customers.customer_name','sales_person.sales_person_name','mechanic.mechanic_name','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','self_sale_vehicle_info.chassis_no','self_sale_vehicle_info.delivery_date')
			 				 ->where([['sale_booking.is_deleted','=', 0],['sale_booking.cancel_status','=',0],['sale_booking.rto_check_status','=',0],['sale_booking.account_close_status', '=', 1]])
			 				 ->get();

			return view('/rto-check-pending', compact(['rto_check_pendings']));
		}


		public function voucher_receipt_report_list()
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



			$voucher_receipt_report_lists = DB::table('voucher_receipt')
						  ->leftJoin('voucher_category', 'voucher_category.id', '=', 'voucher_receipt.voucher_category')
						  ->select('voucher_category.voucher_name','voucher_receipt.id','voucher_receipt.voucher_no','voucher_receipt.voucher_date','voucher_receipt.person_name','voucher_receipt.voucher_amount','voucher_receipt.voucher_description','voucher_receipt.unique_id','voucher_receipt.order_id') 
						 	->where(function($query) use ($report_from_date, $report_to_date) {	

								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('voucher_receipt.voucher_date', [$report_from_date, $report_to_date]);
								       	 
								       	 $query->where([['voucher_receipt.is_deleted', '=', 0]]);

								        })->get();

			return view('/voucher-receipt-report-list', compact(['voucher_receipt_report_lists']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);
		}


		public function feed_back_report_list()
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

						 ->select('sale_booking.id','self_sale_vehicle_info.delivery_date','self_sale_vehicle_info.rc_book','self_sale_vehicle_info.rc_book_no','sale_booking.mechanic_id','sale_booking.sales_person_id','customers.customer_name','customers.contact_no1','sales_person.sales_person_name','mechanic.mechanic_name','sale_booking.booking_no','sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.customer_id','sale_booking.order_id','sale_booking.balance_sheet_unique_id','sale_booking.cancel_status','sale_booking.account_close_status','sale_booking.is_deleted','sale_booking.vehicle_type_id','sale_booking.vehicle_color_id','sale_booking.vehicle_model_id','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','self_sale_vehicle_info.chassis_no','sale_booking.rto_check_status','sale_booking.feed_back_status','sale_booking.exchange_or_new','sale_booking.hyp','sale_booking.hyp_bank_name','sale_booking.initial_balance','exchange_vehicle.model_name','exchange_vehicle.valuable_amount','self_sale_vehicle_info.helmat_status','self_sale_vehicle_info.rto','self_sale_vehicle_info.checked_by','bank.bank_name','feed_back.star_rate','feed_back.feed_back_date','feed_back.reason','feed_back.feed_description','feed_back.dsc_performance')
						 ->where(function($query) use ($report_from_date, $report_to_date) {	
						 		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('feed_back.feed_back_date', [$report_from_date, $report_to_date]);
 															        
								        	$query->where([['sale_booking.is_deleted', '=', 0],['sale_booking.cancel_status', '=', 0]]);
								        })->get();


						 	

			return view('/feed-back-report', compact(['feedbacks']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);
		}


        function monthwise_voucher_cateogry_report(){
            
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
            
            
            // $vou = DB::table('voucher_category')
            //         ->leftJoin('voucher_receipt', 'voucher_receipt.voucher_category','=','voucher_category.id')
            //         ->select('voucher_category.voucher_name', DB::raw("(SELECT sum(voucher_amount) as total_scooter FROM voucher_receipt
            //                         WHERE voucher_receipt.is_deleted = 0 and voucher_receipt.voucher_category = voucher_category.id and voucher_receipt.voucher_date between '$report_from_date' and '$report_to_date')"))
            //         ->where('voucher_category.is_deleted','=', 0)
            //         ->get();
                    
      
                      $voucher_report = DB::table('voucher_category')
			 		->leftjoin("voucher_receipt",function($join){
			            $join->on("voucher_receipt.voucher_category","=","voucher_category.id")
			                ->where("voucher_receipt.voucher_category","=","voucher_category.id")
			                ->where("voucher_category.is_deleted","=", 0);
			        })
			        ->select("voucher_category.voucher_name","voucher_category.id",
			        	
			        	DB::raw("(SELECT sum(voucher_amount) FROM voucher_receipt
                                WHERE voucher_receipt.voucher_category = voucher_category.id and voucher_receipt.voucher_date between '$report_from_date' and '$report_to_date' ) as total"))
				   
				    ->get();
				    
				    
				    
                     
                  //   print_r($voucher_report);
                 
                
               return view('/monthwise-voucher-report',compact(['voucher_report']));
            
            
        }
        
        
        	public function monthly_vehicle_stock(){
        	    
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
            
            
                $target_month1 = date("m");
            	 $target_year1 = date("Y");
            	 $val3 = 01;
            	 
            	 	$date_find = $target_year1."-".$target_month1."-".$val3;
            	 	
            	 	$from_date1 = date('Y-m-01',strtotime($date_find));// hard-coded '01' for first day
			        $to_date1  = date('Y-m-t',strtotime($date_find));
            	 
            	 
            	 

			   $vehicle_stocks = DB::table('vehicle_stock')
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type') 
						        ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
						        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
						        ->select('vehicle_stock.id','vehicle_stock.chassis_no','vehicle_stock.stock_date','vehicle_stock.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','vehicle_stock.is_deleted','vehicle_stock.sale_type','vehicle_stock.status')
								 ->where(function($query) use ($from_date1, $to_date1) {	
						 		
								       	 if($from_date1 !='' and $to_date1 !='')
								       	 $query->whereBetween('vehicle_stock.stock_date', [$from_date1, $to_date1]);
 															        
								        	$query->where([['vehicle_stock.is_deleted', '=', 0]]);
								        	
								        })
								->orderBy('vehicle_stock.stock_date', 'desc')
								->get();

			return view('/monthly-vehicle-stock',compact(['vehicle_stocks']));

		}
		
		
		
        public function assc_final_opening_balance(){
        	    
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
            
            
              
			   $dealer_open = DB::table('dealers')
							  ->where('is_deleted', '=', 0)
								->get();
								
								
			    $negative_total = DB::table('dealers')
			                       ->where('total_remaining', '<', 0)
			                       ->where('is_deleted', '=', 0)
			                       ->sum('total_remaining');
			                       
			  $passitive_total = DB::table('dealers')
			                       ->where('total_remaining', '>', 0)
			                       ->where('is_deleted', '=', 0)
			                       ->sum('total_remaining');

			return view('/assc-final-opening-balance',compact(['dealer_open']))->with(['negative_total'=>$negative_total,'passitive_total'=>$passitive_total]);

		}
		
		
		public function daily_delivery_note()
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


            $fetch_dsc_monthly_sales = DB::table('self_sale_vehicle_info')
                         ->leftJoin('customers', 'customers.id', '=', 'self_sale_vehicle_info.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'self_sale_vehicle_info.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'self_sale_vehicle_info.mechanic_id')  
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'self_sale_vehicle_info.vehicle_type_id')
					     ->leftJoin('main_model', 'main_model.id', '=', 'self_sale_vehicle_info.model_id')  
					     ->leftJoin('colors', 'colors.id', '=', 'self_sale_vehicle_info.color_id')

						 ->select('customers.customer_name','customers.contact_no1','customers.customer_address','sales_person.sales_person_name','mechanic.mechanic_name','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color','self_sale_vehicle_info.chassis_no','self_sale_vehicle_info.delivery_date','self_sale_vehicle_info.booking_order_id')

						->where(function($query) use ($report_from_date, $report_to_date) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('self_sale_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);


								        $query->where([['self_sale_vehicle_info.is_deleted', '=', 0]]);

								        })->get();

					
            return view('/daily-delivery-note',compact(['fetch_dsc_monthly_sales']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);	


		}
		
		
		
		public function dsc_monthly_discount(){

			
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


			 $dsc_month_discount = DB::table('sales_person')
			 		->leftjoin("sale_booking",function($join) use ($report_from_date,$report_to_date){
			            $join->on("sale_booking.sales_person_id","=","sales_person.id")
			                ->whereBetween("sale_booking.booking_date",[$report_from_date, $report_to_date])
			                ->where("sale_booking.is_deleted","=", 0)
			                ->where("sale_booking.cancel_status","=", 0)
			                ->where("sale_booking.sales_person_id","=", "sales_person.id")
			                ->where("sales_person.is_deleted","=", 0);
			        })
			        ->select("sales_person.sales_person_name",
			        	
			        	DB::raw("(SELECT sum(discount) as total_discount FROM sale_booking
                                WHERE sale_booking.sales_person_id = sales_person.id and sale_booking.is_deleted = 0 and sale_booking.cancel_status = 0 and sale_booking.booking_date between '$report_from_date' and '$report_to_date') as total_discount"))
				   
				    ->get();



				 return view('/dsc-monthly-discount', compact(['dsc_month_discount']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);

		}





	public function dsc_monthly_sales_percentage()
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



           $sale_booking_in_cash = DB::table('sale_booking')           							
           							->select(DB::raw("(SELECT count(sale_booking.id) as total_count FROM sale_booking left join self_sale_vehicle_info on sale_booking.order_id = self_sale_vehicle_info.booking_order_id
                                WHERE sale_booking.hyp = 'no' and sale_booking.is_deleted = '0' and sale_booking.cancel_status = '0' and self_sale_vehicle_info.delivery_date between '$report_from_date' and '$report_to_date') as total_count"),DB::raw("(SELECT count(sale_booking.id) as total_count1 FROM sale_booking  left join self_sale_vehicle_info on sale_booking.order_id = self_sale_vehicle_info.booking_order_id where sale_booking.is_deleted = '0' and sale_booking.cancel_status = '0' and self_sale_vehicle_info.delivery_date between '$report_from_date' and '$report_to_date') as total_count1"))
           					// 		->whereBetween("sale_booking.booking_date",[$report_from_date, $report_to_date])
			             //  			->where("sale_booking.is_deleted","=", 0)
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
			        	DB::raw("(SELECT count(sale_booking.id) as total_count FROM sale_booking left join self_sale_vehicle_info on sale_booking.order_id = self_sale_vehicle_info.booking_order_id
                                WHERE sale_booking.hyp_bank_name = bank.id and sale_booking.is_deleted = 0 and sale_booking.cancel_status = 0 and self_sale_vehicle_info.delivery_date between '$report_from_date' and '$report_to_date') as total_count"),DB::raw("(SELECT count(sale_booking.id) as total_count1 FROM sale_booking  left join self_sale_vehicle_info on sale_booking.order_id = self_sale_vehicle_info.booking_order_id WHERE  sale_booking.is_deleted = 0 and sale_booking.cancel_status = 0 and self_sale_vehicle_info.delivery_date between '$report_from_date' and '$report_to_date') as total_count1"))
				   
				    ->get();






				 return view('/dsc-monthly-percentage', compact(['sale_booking_in_cash','bank_percentage']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);



		}



	public function total_finance_amount()
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





           	$total_finances = DB::table('bank')			 		             
			         ->where("bank.is_deleted","=", 0)
			   
			        ->select("bank.bank_name",			        	
			        	DB::raw("(SELECT SUM(amount_to_pay) as total_finance_amount FROM customer_sales_receipt left join sale_booking on sale_booking.order_id = customer_sales_receipt.booking_order_id WHERE sale_booking.hyp_bank_name = bank.id and customer_sales_receipt.finance_status = 1 and customer_sales_receipt.is_deleted = 0 and customer_sales_receipt.cancel_status = 0 and sale_booking.is_deleted = 0 and sale_booking.cancel_status = 0 and customer_sales_receipt.receipt_date between '$report_from_date' and '$report_to_date' OR customer_sales_receipt.bank_id = bank.id and customer_sales_receipt.finance_status= 1 and customer_sales_receipt.receipt_date between '$report_from_date' and '$report_to_date' ) as total_finance_amount"))
			      ->groupBy("bank.bank_name","bank.id")
				   
				   ->get();




				 return view('/total-finance-amount', compact(['total_finances']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);



		}


	public function assc_monthly_sales()
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


            $fetch_assc_monthly_sales = DB::table('dealer_booking_vehicle_info')
                         ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
					     ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')  
					     ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')

						 ->select('dealers.dealer_name','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.delivery_date','dealer_booking_vehicle_info.assc_customer_name','dealer_booking_vehicle_info.contact_no','dealer_booking_vehicle_info.description')

						->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('dealer_booking_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id]]);

								        $query->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.stock_status', '=',1],['dealer_booking_vehicle_info.return_status', '=',0]]);

								        })->get();

					
            return view('/assc-monthly-sales',compact(['fetch_assc_monthly_sales','dealer_lists']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date,'dealer_id'=>$dealer_id]);	


		}
		
		
			public function assc_monthly_sales_percentage()
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
			                ->whereBetween("dealer_booking_vehicle_info.delivery_date",[$report_from_date, $report_to_date])
			                ->where("dealer_booking_vehicle_info.is_deleted","=", 0)
			                ->where("dealer_booking_vehicle_info.return_status","=", 0)
			                ->where("dealer_booking_vehicle_info.stock_status","=", 1)
			                ->where("dealer_booking_vehicle_info.bank_id","=", "bank.id")
			                ->where("bank.is_deleted","=", 0);
			        })
			        ->select("bank.bank_name",			        	
			        	DB::raw("(SELECT count(id) as total_count FROM dealer_booking_vehicle_info
                                WHERE dealer_booking_vehicle_info.bank_id = bank.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.stock_status = 1 and dealer_booking_vehicle_info.dealer_id = '$dealer_id' and dealer_booking_vehicle_info.return_status = 0 and dealer_booking_vehicle_info.delivery_date between '$report_from_date' and '$report_to_date') as total_count"))
				   
				    ->get();

		}
		else
		{

			 $bank_percentage = DB::table('bank')
			 		->leftjoin("dealer_booking_vehicle_info",function($join) use ($report_from_date,$report_to_date){
			            $join->on("dealer_booking_vehicle_info.bank_id","=","bank.id")
			                ->whereBetween("dealer_booking_vehicle_info.delivery_date",[$report_from_date, $report_to_date])
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




					
            return view('/assc-monthly-sales-percentage',compact(['fetch_cash_count','total_sales_count','dealer_lists','bank_percentage']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date,'dealer_id'=>$dealer_id]);	


		}





		public function self_sale_exchange_vehicle(){

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

									$model_name =  strtoupper($farray->model_name);
							        array_push($ledger_report_items,new SelfSaleExchangeVehicle($booking_date,$customer_name,$contact_no1 ,$sales_person_name,$model_name,$valuable_amount,$total_paid,$total_remaining,""));


								}
							}														
							


					
			
			return view('/self-sale-exchange-vehicle',compact(['ledger_report_items']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);		
		}


		public function mechanic(){

			
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

            

			$meachanic_lists =  DB::table('sale_booking')
						->where('sale_booking.is_deleted', '=', 0)
						->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')
						->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id') 
				        ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
				        ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')
				         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
				        ->leftJoin('sales_person', 'sales_person.id','=', 'sale_booking.sales_person_id')
				        ->select('sale_booking.booking_date','sale_booking.mechanic_amount','mechanic.mechanic_name','mechanic.contact_no1','mechanic.mechanic_address','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','customers.customer_name','customers.contact_no1 as custno','sales_person.sales_person_name')
						->get();
			

			return view('/mechanic-reports',compact(['meachanic_lists']));			
		}

		public function vechicle_ageing(Request $request){
			
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

             if ($request->vehicleageingreports) {
				      $fromdate = $request->fromdate;
				      $todate = $request->todate;

				      $vehicle_lists =  DB::table('vehicle_stock')
						->where('vehicle_stock.status', '=', 0)
						->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type') 
				        ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
				        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
				        ->select('vehicle_stock.stock_date','vehicle_stock.chassis_no','vehicle_stock.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model')
				        ->where(function($query) use ($fromdate, $todate) {		
							if($fromdate !='' and $todate !='')
							    $query->whereBetween('vehicle_stock.stock_date', [$fromdate, $todate]);
							})->get(); 
			} else {
			      $fromdate = date('Y-m-d',strtotime("-30 days"));
			      $todate = date('Y-m-d'); 

			      $vehicle_lists =  DB::table('vehicle_stock')
						->where('vehicle_stock.status', '=', 0)
						->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type') 
				        ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
				        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
				        ->select('vehicle_stock.stock_date','vehicle_stock.chassis_no','vehicle_stock.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model')
						->get();  
			  }
  
			return view('/vechicle-ageing-reports',compact(['vehicle_lists']))->with(['fromdate'=>$fromdate,'todate'=>$todate]);;			
		}
		public function vechicle_ageing1(Request $request, $id){
			
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

            $vehicle_lists1 =  DB::table('vehicle_stock')
						->where('vehicle_stock.status', '=', 0)
						->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type') 
				        ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
				        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
				        ->select('vehicle_stock.stock_date','vehicle_stock.chassis_no','vehicle_stock.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model')
						->first('vehicle_stock.stock_date'); 


			$fromdate1 = $vehicle_lists1->stock_date;
			$fromdate2 = date('Y-m-d', strtotime($fromdate1));
			$fromdate = date('Y-m-d', strtotime($fromdate2. ' +'.$id.'days'));
			$todate = date('Y-m-d', strtotime($fromdate. ' +'.$id.'days'));

				      $vehicle_lists =  DB::table('vehicle_stock')
						->where('vehicle_stock.status', '=', 0)
						->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type') 
				        ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
				        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
				        ->select('vehicle_stock.stock_date','vehicle_stock.chassis_no','vehicle_stock.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model')
				        ->where(function($query) use ($fromdate, $todate) {		
							if($fromdate !='' and $todate !='')
							    $query->whereBetween('vehicle_stock.stock_date', [$fromdate, $todate]);
							})->get(); 

			return view('/vechicle-ageing-reports',compact(['vehicle_lists']))->with(['fromdate'=>$fromdate,'todate'=>$todate]);;			
		}





}
?>