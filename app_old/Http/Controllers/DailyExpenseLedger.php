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

class DailyExpenseLedger extends Controller{	

	    /**
	     * Create a new controller instance.
	     *
	     * @return void
	    */

	    public function __construct()
	    {
	        $this->middleware('auth');
	    }




	public function daily_expense_ledger(){

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
            
             $cash_in_hand = 0;
             $cash_paid = 0;
             $opening_balance = 0;
             $find_opening_bal =0;

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


			$cash_in_hand =  DB::table('cash_in_hand')
									->where('is_deleted', '=', 0)
									->get();
            

			$cash_paid = DB::table('customer_sales_receipt')				   
				    ->where('customer_sales_receipt.is_deleted', '=', 0)
				      ->where('customer_sales_receipt.payment_mode', '=', 1)
				      ->where('customer_sales_receipt.amount_status', '=', 0)
				    ->where('customer_sales_receipt.receipt_date', '<', $report_from_date)
				    ->sum('customer_sales_receipt.amount_to_pay');
				  
	
			$cash_paid1 = DB::table('voucher_credit')
			         ->where('voucher_credit.is_deleted', '=', 0)
				      ->where('voucher_credit.payment_mode', '=', 1)
				    ->where('voucher_credit.voucher_date', '<', $report_from_date)
				    ->sum('voucher_credit.voucher_amount');
				    
				   
			$opening_balance = $cash_in_hand[0]->opening_balance + $cash_paid + $cash_paid1;
			
		

			$voucher_total_amount = DB::table('voucher_receipt')				   
				    ->where('voucher_receipt.is_deleted', '=', 0)
				    ->where('voucher_receipt.payment_mode', '=', 1)
				    ->where('voucher_receipt.voucher_date', '<', $report_from_date)
				    ->sum('voucher_receipt.voucher_amount');
				    
				    
				

					$find_opening_bal = $opening_balance - $voucher_total_amount;

					$customer_sales_info =  DB::table('customer_sales_receipt')
									->leftJoin('dealers', 'dealers.id', '=', 'customer_sales_receipt.dealer_id')
									->leftJoin('customers', 'customers.id', '=', 'customer_sales_receipt.customer_id')
									->select('customer_sales_receipt.receipt_no','customer_sales_receipt.receipt_date','customer_sales_receipt.amount_to_pay','customer_sales_receipt.payment_mode','customer_sales_receipt.cheque_no','customer_sales_receipt.cheque_bank_name','customer_sales_receipt.credit_card_transaction_no','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.debit_card_transaction_no','customer_sales_receipt.debit_card_bank_name','customer_sales_receipt.payment_description','customers.customer_name','dealers.dealer_name','customer_sales_receipt.payee_name')

									->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('customer_sales_receipt.receipt_date', [$report_from_date, $report_to_date]);

							       						        
							        	$query->where([['customer_sales_receipt.is_deleted', '=', 0],['customer_sales_receipt.amount_status', '=', 0]]);

							        })->get();


							      //  print_r($customer_sales_info);


							   
							      




					$voucher_receipt_info = DB::table('voucher_receipt')
 						 ->leftJoin('voucher_category', 'voucher_category.id', '=', 'voucher_receipt.voucher_category')
						 ->select('voucher_category.voucher_name','voucher_receipt.id','voucher_receipt.voucher_no','voucher_receipt.voucher_date','voucher_receipt.person_name','voucher_receipt.voucher_amount','voucher_receipt.voucher_description','voucher_receipt.payment_mode','voucher_receipt.cheque_no','voucher_receipt.cheque_bank_name','voucher_receipt.credit_card_bank_name','voucher_receipt.credit_card_bank_name','voucher_receipt.debit_card_transaction_no','voucher_receipt.debit_card_bank_name')

						 ->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('voucher_receipt.voucher_date', [$report_from_date, $report_to_date]);
							       	  						        
							        	$query->where([['voucher_receipt.is_deleted', '=', 0],['voucher_receipt.payment_mode', '=', 1]]);

							        })->get();




							  
			        	$credit_voucher = DB::table('voucher_credit')
						 
						 ->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('voucher_credit.voucher_date', [$report_from_date, $report_to_date]);
							       	  						        
							        	$query->where([['voucher_credit.is_deleted', '=', 0]]);

							        })->get();


							          


					/*
					*
					Array Push Value 
					*
					*/
					//	$find_opening_bal;

						$voucher_report_items=array();

						//array_push($voucher_report_items,new DailyLedger("reportDate","description","personName","voucherType","credit","debit","OB");


						array_push($voucher_report_items,new DailyLedger("","","Report Date: ".$report_from_date,"","","","","f5d67a"));

 						array_push($voucher_report_items,new DailyLedger($report_from_date,"Opening Balance","","","","",$find_opening_bal,"fff"));


					
						while(strtotime($report_from_date) <= strtotime($report_to_date)) 
						{
								$customer_sales_info_array = collect($customer_sales_info)->where('receipt_date', '=', $report_from_date)->all();
								
								if(!empty($customer_sales_info_array))
								{

									
									foreach ($customer_sales_info_array as $farray ) {

										$receipt_date = $farray->receipt_date;
										$dealer_name = $farray->dealer_name;
										$customer_name = $farray->customer_name;
										$amount_to_pay = $farray->amount_to_pay;
										$payment_mode1 = $farray->payment_mode;
										$receipt_no = $farray->receipt_no;
										 $payee_name = $farray->payee_name;
										
										
										$payment_description = $farray->payment_description;
										

										if($payment_mode1==1)
										{
											$payment_mode = "Payment Mode : Cash";
										}

										if($payment_mode1==2)
										{
											$payment_mode = "Payment Mode : Bank / ".$payment_description;
										}

										if($payment_mode1==3)
										{
											$payment_mode = "Payment Mode : Cheque / Cheque No : ".$farray->cheque_no." / Cheque Bank Name : ".$farray->cheque_bank_name;
										}

										if($payment_mode1==4)
										{
											$payment_mode = "Payment Mode : Credit Card / Transaction No : ".$farray->credit_card_transaction_no." / Credit Card Bank Name : ".$farray->credit_card_bank_name;
										}

										if($payment_mode1==5)
										{
											$payment_mode = "Payment Mode : Debit Card / Transaction No : ".$farray->debit_card_transaction_no." / Debit Card Bank Name : ".$farray->debit_card_bank_name;
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



					                      
					                        $customer_name = $farray->customer_name;
					                        $dealer_name = $farray->dealer_name;

					                        if($customer_name !='')
					                        {
					                        	$person_name  = "customer Name:".$customer_name;
					                        }

					                         if($dealer_name !='')
					                        {
					                        	$person_name  = "ASSC Name:".$dealer_name;
					                        }


											$receipt_no = "Receipt NO:".$farray->receipt_no."/".$payment_mode;


											//array_push($voucher_report_items,new DailyLedger("reportDate","description","personName","voucherType","credit","debit","OB");
											
                                                
										   $find_opening_bal = $find_opening_bal + $amount_to_pay;

								           array_push($voucher_report_items,new DailyLedger($receipt_date,$receipt_no,$person_name,"",$amount_to_pay,"",$find_opening_bal,"c8e9fd"));
								           
								           if($payment_mode1 !=1)
								           {
								               	   $find_opening_bal = $find_opening_bal - $amount_to_pay;

								           array_push($voucher_report_items,new DailyLedger($receipt_date,$receipt_no,$person_name,"","",$amount_to_pay,$find_opening_bal,"c8e9fd"));
								           }


									}
								}
								
								$credit_voucher_array = collect($credit_voucher)->where('voucher_date', '=', $report_from_date)->all();
								
								
								if(!empty($credit_voucher_array))
								{
								    	foreach ($credit_voucher_array as $cv ) {
								    	    
								    	    $voucher_date = $cv->voucher_date;
								    	    $person_name = $cv->person_name;
								    	    $voucher_amount = $cv->voucher_amount;
								    	    
								    	    $payment_mode1 = $cv->payment_mode;
										 

										if($payment_mode1==1)
										{
											$payment_mode = "Payment Mode : Cash";
										}

										if($payment_mode1==2)
										{
											$payment_mode = "Payment Mode : Bank";
										}

										if($payment_mode1==3)
										{
											$payment_mode = "Payment Mode : Cheque / Cheque No : ".$cv->cheque_no." / Cheque Bank Name : ".$cv->cheque_bank_name;
										}

										if($payment_mode1==4)
										{
											$payment_mode = "Payment Mode : Credit Card / Transaction No : ".$cv->credit_card_transaction_no." / Credit Card Bank Name : ".$cv->credit_card_bank_name;
										}

										if($payment_mode1==5)
										{
											$payment_mode = "Payment Mode : Debit Card / Transaction No : ".$cv->debit_card_transaction_no." / Debit Card Bank Name : ".$cv->debit_card_bank_name;
										}
										
										$receipt_no = "Receipt NO:".$cv->voucher_no."/".$payment_mode;


											//array_push($voucher_report_items,new DailyLedger("reportDate","description","personName","voucherType","credit","debit","OB");

										   $find_opening_bal = $find_opening_bal + $voucher_amount;

								           array_push($voucher_report_items,new DailyLedger($voucher_date,$receipt_no,$person_name,"",$voucher_amount,"",$find_opening_bal,"A2F1FC"));
										
										
											if($payment_mode1 !=1)
								           {  
								               $find_opening_bal = $find_opening_bal - $voucher_amount;

								              array_push($voucher_report_items,new DailyLedger($voucher_date,$receipt_no,$person_name,"","",$voucher_amount,$find_opening_bal,"A2F1FC"));
								           }
										
										
								    	    
								    	}
								    
								}
							
								$voucher_receipt_info_array = collect($voucher_receipt_info)->where('voucher_date', '=', $report_from_date)->all();
								
								if(!empty($voucher_receipt_info_array))
								{
									foreach ($voucher_receipt_info_array as $freceipt ) {

										$voucher_date = $freceipt->voucher_date;
										
										$payment_mode1 = $freceipt->payment_mode;
										$voucher_description = $freceipt->voucher_description;

										if($payment_mode1==1)
										{
											$payment_mode = "Payment Mode : Cash";
										}

										if($payment_mode1==2)
										{
											$payment_mode = "Payment Mode : Bank";
										}

										if($payment_mode1==3)
										{
											$payment_mode = "Payment Mode : Cheque / Cheque No : ".$freceipt->cheque_no." / Cheque Bank Name : ".$freceipt->cheque_bank_name;
										}

										if($payment_mode1==4)
										{
											$payment_mode = "Payment Mode : Credit Card / Transaction No : ".$freceipt->credit_card_transaction_no." / Credit Card Bank Name : ".$freceipt->credit_card_bank_name;
										}

										if($payment_mode1==5)
										{
											$payment_mode = "Payment Mode : Debit Card / Transaction No : ".$freceipt->debit_card_transaction_no." / Debit Card Bank Name : ".$freceipt->debit_card_bank_name;
										}
										$voucher_no = $freceipt->voucher_no."/".$payment_mode;

										$person_name = $freceipt->person_name;
										$voucher_name = $freceipt->voucher_name;

										$voucher_amount = $freceipt->voucher_amount;
										
										$find_opening_bal = $find_opening_bal - $voucher_amount;

								        array_push($voucher_report_items,new DailyLedger($voucher_date,"Voucher.No: ".$voucher_no,$person_name,$voucher_name,$voucher_description,$voucher_amount,$find_opening_bal,"fbc4c4"));
								        
								        


									}

								}
							$report_from_date = date ("Y-m-d", strtotime("+1 days", strtotime($report_from_date)));
						}

			 return view('/daily-expense-ledger',compact(['voucher_report_items']))->with(['report_from_date'=>$rfrom_date,'report_to_date'=>$rto_date]);	
		}


}
?>