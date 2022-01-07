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
  
class AsscLedger implements FromCollection
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

             $dealer_lists = DB::table('dealers')->where('is_deleted', '0', 0)->get();

            if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];
            if(isset($_POST['report_from_date']))$report_from_date = $_POST['report_from_date'];
            if(isset($_POST['report_to_date']))$report_to_date = $_POST['report_to_date'];


			$dealer_rate_info =  DB::table('dealers')
									->where('id', '=', $dealer_id)
									->where('is_deleted', '=', 0)
									->get();




			$opening_balance = $dealer_rate_info[0]->opening_balance;


			$dealer_name = $dealer_rate_info[0]->dealer_name;


			//print "Dealer Opening Balance".$opening_balance;


			$vehicle_total_amount = DB::table('dealer_booking')				   
				    ->where('dealer_booking.is_deleted', '=', 0)
				     ->where('dealer_booking.dealer_id', '=', $dealer_id)
				    ->where('dealer_booking.booking_date', '<', $report_from_date)
				    ->sum('dealer_booking.total_amount');

			//print "<br>Sum Total ".$vehicle_total_amount;


			$sum_of_total_paid = DB::table('customer_sales_receipt')				   
				    ->where('customer_sales_receipt.is_deleted', '=', 0)
				    ->where('customer_sales_receipt.cancel_status', '=', 0)
				    ->where('customer_sales_receipt.dealer_id', '=', $dealer_id)
				    ->where('customer_sales_receipt.receipt_date', '<', $report_from_date)
				    ->sum('customer_sales_receipt.amount_to_pay');

			$manual_return = DB::table('return_vehicle_manual')
								->where('return_vehicle_manual.is_deleted', '=', 0)
								->where('return_vehicle_manual.dealer_id', '=', $dealer_id)
								->where('return_vehicle_manual.return_date', '<', $report_from_date)
								->sum('return_vehicle_manual.total_amount');



  $dealer_return_vehicle_info =  DB::table('dealer_booking_vehicle_info')
                                ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
                                 ->where('dealer_booking_vehicle_info.return_status', '=', 1)
            				     ->where('dealer_booking_vehicle_info.dealer_id', '=', $dealer_id)
            				    ->where('dealer_booking_vehicle_info.return_date', '<', $report_from_date)
            				    ->sum('dealer_booking_vehicle_info.vehicle_amount');
            								
            				   $dealer_return_vehicle_info1 =  DB::table('dealer_booking_vehicle_info')
                                ->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
                                 ->where('dealer_booking_vehicle_info.return_status', '=', 1)
            				     ->where('dealer_booking_vehicle_info.dealer_id', '=', $dealer_id)
            				    ->where('dealer_booking_vehicle_info.booking_date', '<', $report_from_date)
            				    ->sum('dealer_booking_vehicle_info.vehicle_amount');
            				
            				 
            $dealer_warranty_total = 		DB::table('send_assc_warranty_card')
                                    ->where('send_assc_warranty_card.is_deleted', '=', 0)
            				     ->where('send_assc_warranty_card.dealer_id', '=', $dealer_id)
            				    ->where('send_assc_warranty_card.warranty_date', '<', $report_from_date)
            				    ->sum('send_assc_warranty_card.warranty_total_amount');	
            				    
            				    
            				     				    
            				    
				$assc_offers_old = DB::table('assc_offer')
								->where('assc_offer.is_deleted', '=', 0)
								->where('assc_offer.dealer_id', '=', $dealer_id)
								->where('assc_offer.offer_date', '<', $report_from_date)
								->sum('assc_offer.total_amount');

            								
            								

					$find_opening_bal = $opening_balance - $vehicle_total_amount - $dealer_return_vehicle_info - $dealer_return_vehicle_info1 - $dealer_warranty_total - $assc_offers_old + $sum_of_total_paid + $manual_return;

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
						 ->select('send_assc_warranty_card.warranty_date','send_assc_warranty_card.warranty_qty','send_assc_warranty_card.warranty_amount','send_assc_warranty_card.warranty_total_amount')
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
					*;
					*/

						$ledger_report_items=array();

						array_push($ledger_report_items,new LedgerReport("","","ASSC NAME: ".$dealer_name,"","","",""));

						array_push($ledger_report_items,new LedgerReport("","","","","","",""));

						array_push($ledger_report_items,new LedgerReport("DATE","S.NO","PARTICULAR","CREDIT","DEBIT","OB",""));					

						array_push($ledger_report_items,new LedgerReport("","","","","","",""));



 						array_push($ledger_report_items,new LedgerReport($report_from_date,"","Opening Balance","","",$find_opening_bal,""));
 						array_push($ledger_report_items,new LedgerReport("","","","","","",""));

 						// print"From Date". $report_from_date;
 						// print"To Date".$report_to_date;

 						// die();

						while (strtotime($report_from_date) <= strtotime($report_to_date)) {

							$filter_booking_vehicle_array = collect($dealer_vehicle_info)->where('booking_date', '=', $report_from_date)->all();

							$find_opening_bal;

							if($filter_booking_vehicle_array !='')
							{
								foreach ($filter_booking_vehicle_array as $farray ) {
									$booking_date = $farray->booking_date;
									$chassis_no =  strtoupper($farray->chassis_no);
									$vehicle_amount = $farray->vehicle_amount;
									$model =  strtoupper($farray->model);

									$find_opening_bal = $find_opening_bal - $vehicle_amount;

							        array_push($ledger_report_items,new LedgerReport($report_from_date,$model,$chassis_no ,"",$vehicle_amount,$find_opening_bal,""));
							        array_push($ledger_report_items,new LedgerReport("","","","","","",""));


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
							        array_push($ledger_report_items,new LedgerReport($report_from_date,$model,$chassis_no ,$vehicle_amount1,"RETURN",$find_opening_bal,""));
							        
							       


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

							        array_push($ledger_report_items,new LedgerReport($receipt_date,"R.No: ".$receipt_no,$payment_mode ,$amount_to_pay,"",$find_opening_bal,""));
							        array_push($ledger_report_items,new LedgerReport("","","","","","",""));



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
        
        							$find_opening_bal = $find_opening_bal - $warranty_total;
        
        
        							array_push($ledger_report_items,new LedgerReport($warranty_date,"EW",$warranty_qty."*".$warranty_amount ,"",$warranty_total,$find_opening_bal,""));
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

        							$total_amount = $aol->qty_amount;
        
        							$find_opening_bal = $find_opening_bal - $total_amount;
        
        
        							array_push($ledger_report_items,new LedgerReport($offer_date,"Offers : ".$offer_name,$offer_qty."*".$qty_amount ,"",$total_amount,$find_opening_bal,"fff"));

                                    array_push($ledger_report_items,new LedgerReport("","","","","","",""));


								}

							}
							
							
							
							
							

							

							
							
						    $report_from_date = date ("Y-m-d", strtotime("+1 days", strtotime($report_from_date)));
						}








						$report_final = collect($ledger_report_items);

						return $report_final;
    }

   
}