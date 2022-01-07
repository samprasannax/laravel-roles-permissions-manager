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

class Receipt extends Controller{	

 		/**
	     * Create a new controller instance.
	     *
	     * @return void
	     */
	    public function __construct()
	    {
	        $this->middleware('auth');
	    } 




		public function index($order_id,$customer_id){

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



             $receipt_no1 =  DB::table('customer_sales_receipt') 
            						->where(function($query) use ($start_date, $end_date) {		
							       	 if($start_date !='' and $end_date !='')
							       	 $query->whereBetween('receipt_date', [$start_date, $end_date]);
							        })
							        ->max('receipt_no');
							        

            $receipt_no = $receipt_no1 + 1;

            $fetch_customers = DB::table('customers')
            				->select('customers.customer_name')
            				->where('id', '=', $customer_id)
            				->get();

            $fetch_sale_bookings = DB::table('sale_booking')
                             ->leftJoin('bank', 'bank.id', '=', 'sale_booking.hyp_bank_name')
                          
                             ->leftJoin('exchange_vehicle', 'exchange_vehicle.booking_order_id', '=', 'sale_booking.order_id')
            
            				->select('sale_booking.grand_total','sale_booking.total_paid','sale_booking.total_remaining','sale_booking.order_id','sale_booking.customer_id','bank.bank_name','sale_booking.initial_balance','exchange_vehicle.valuable_amount')
            				->where('sale_booking.order_id', '=', $order_id)
            				->where('sale_booking.customer_id', '=', $customer_id)
            				->get();

             $fetch_sale_receipts = DB::table('customer_sales_receipt')
            				
            				->where([['customer_sales_receipt.booking_order_id', '=', $order_id],['customer_sales_receipt.customer_id', '=', $customer_id]])
            				->get();

            			






			return view('/receipt-list', compact(['fetch_customers','fetch_sale_bookings','fetch_sale_receipts']))->with(['receipt_no'=>$receipt_no]);
		}

		public function new_receipt(){

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



			return view('/new-receipt');
		}

		public function insert_receipt()
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


			     /** Payment Mode **/
			    if(isset($_POST['order_id']))$order_id = $_POST['order_id'];
                if(isset($_POST['customer_id']))$customer_id = $_POST['customer_id'];
               

                if(isset($_POST['total_paid']))$total_paid1 = $_POST['total_paid'];
                if(isset($_POST['total_remaining']))$total_remaining1 = $_POST['total_remaining'];
                
                if(isset($_POST['amount_to_pay']))$amount_to_pay = $_POST['amount_to_pay'];
                
                /*
                Sever Side Validation
                */
                
                
                if(isset($_POST['total_paid_old']))$total_paid_old = $_POST['total_paid_old'];
                if(isset($_POST['total_remaining_old']))$total_remaining_old = $_POST['total_remaining_old'];
                
                $total_paid = $total_paid_old + $amount_to_pay;
                $total_remaining = $total_remaining_old - $amount_to_pay;
                


			    if(isset($_POST['payment_mode']))$payment_mode = $_POST['payment_mode'];

			    if(isset($_POST['receipt_no']))$receipt_no = $_POST['receipt_no'];

			    if(isset($_POST['receipt_date']))$receipt_date = date("Y-m-d", strtotime($_POST['receipt_date']));

			    if(isset($_POST['cheque_no']))$cheque_no = $_POST['cheque_no']; // cheque No
			    if(isset($_POST['cheque_bank_name']))$cheque_bank_name = $_POST['cheque_bank_name'];// cheque Bank Name

			    if(isset($_POST['credit_card_transaction_no']))$credit_card_transaction_no = $_POST['credit_card_transaction_no']; // Credit Card Transaction No
			    if(isset($_POST['credit_card_bank_name']))$credit_card_bank_name = $_POST['credit_card_bank_name']; //  Credit Card Bank Name

				if(isset($_POST['debit_card_transaction_no']))$debit_card_transaction_no = $_POST['debit_card_transaction_no']; // Debit Card Transaction No
			    if(isset($_POST['debit_card_bank_name']))$debit_card_bank_name = $_POST['debit_card_bank_name'];// Debit Card Bank Name

			    if(isset($_POST['payment_description']))$payment_description = $_POST['payment_description'];

			    /* OB Status */

			    if(isset($_POST['amount_status']))$amount_status = $_POST['amount_status'];

			    if(isset($_POST['amount_status']))$amount_status = $_POST['amount_status'];
			    if(isset($_POST['payee_name']))$payee_name = $_POST['payee_name'];
			     
			     if(isset($_POST['finance_status']))$finance_status = $_POST['finance_status'];
			     if(isset($_POST['creator_name']))$creator_name = $_POST['creator_name'];

                if(isset($_POST['exchange_status']))$exchange_status = $_POST['exchange_status'];

			    $balance_sheet_unique_id = 'B'.date("Ymd") . time() . mt_rand();

			    $balance_sheet_date = date('Y-m-d');

                


			    $insert_receipt = DB::table('customer_sales_receipt')->insert( ['exchange_status'=>$exchange_status,'creator_name'=>$creator_name,'booking_order_id'=>$order_id,'receipt_no' => $receipt_no,'amount_to_pay' => $amount_to_pay, 'payment_mode' =>$payment_mode, 'cheque_no' => $cheque_no, 'cheque_bank_name' => $cheque_bank_name, 'credit_card_transaction_no'=>$credit_card_transaction_no,'credit_card_bank_name'=>$credit_card_bank_name,'debit_card_transaction_no'=>$debit_card_transaction_no,'debit_card_bank_name'=>$debit_card_bank_name,'payment_description'=>$payment_description,'receipt_date'=>$receipt_date,'customer_id'=>$customer_id,'balance_sheet_unique_id'=>$balance_sheet_unique_id,'amount_status'=>$amount_status,'payee_name'=>$payee_name,'finance_status'=>$finance_status] );



			    
                 if($finance_status==1)
                {
                     $update_sales_booking = DB::table('sale_booking')->where('order_id', $order_id)->update( ['total_paid' => $total_paid, 'total_remaining'=>$total_remaining, 'finance_status'=>$finance_status ]);

                }
                else
                {
                  $update_sales_booking = DB::table('sale_booking')->where('order_id', $order_id)->update( ['total_paid' => $total_paid, 'total_remaining'=>$total_remaining]);   
                }


			    $insert_balance_sheet = DB::table('balance_sheet')->insert(['unique_id'=>$balance_sheet_unique_id,'order_id'=>$order_id,'bal_date'=>$balance_sheet_date,'payment_mode'=>$payment_mode,'amount'=>$amount_to_pay]);


			    return redirect('/receipt/'.$order_id.'/'.$customer_id.'')->with(['message' => 'Added successfully.!!!']);


		}


		


		public function edit_single_receipt()
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

			if(isset($_POST['receipt_id']))$receipt_id = $_POST['receipt_id'];


			$edit_single_receipt = DB::table('customer_sales_receipt')
									->where('id', '=', $receipt_id)
									->where('is_deleted', '=', 0)
									->get();

			return $edit_single_receipt;

		}


		public function update_receipt()
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

			   
			    if(isset($_POST['uorder_id']))$uorder_id = $_POST['uorder_id'];
                if(isset($_POST['ucustomer_id']))$ucustomer_id = $_POST['ucustomer_id'];
             


                if(isset($_POST['utotal_paid']))$utotal_paid1 = $_POST['utotal_paid'];
                if(isset($_POST['utotal_remaining']))$utotal_remaining1 = $_POST['utotal_remaining'];

                if(isset($_POST['uamount_to_pay']))$uamount_to_pay = $_POST['uamount_to_pay'];

			    if(isset($_POST['upayment_mode']))$upayment_mode = $_POST['upayment_mode'];

			    if(isset($_POST['ureceipt_no']))$ureceipt_no = $_POST['ureceipt_no'];

			    if(isset($_POST['ureceipt_date']))$ureceipt_date = date("Y-m-d", strtotime($_POST['ureceipt_date']));

			    if(isset($_POST['ucheque_no']))$ucheque_no = $_POST['ucheque_no']; // cheque No
			    if(isset($_POST['ucheque_bank_name']))$ucheque_bank_name = $_POST['ucheque_bank_name'];// cheque Bank Name

			    if(isset($_POST['ucredit_card_transaction_no']))$ucredit_card_transaction_no = $_POST['ucredit_card_transaction_no']; // Credit Card Transaction No
			    if(isset($_POST['ucredit_card_bank_name']))$ucredit_card_bank_name = $_POST['ucredit_card_bank_name']; //  Credit Card Bank Name

				if(isset($_POST['udebit_card_transaction_no']))$udebit_card_transaction_no = $_POST['udebit_card_transaction_no']; // Debit Card Transaction No
			    if(isset($_POST['udebit_card_bank_name']))$udebit_card_bank_name = $_POST['udebit_card_bank_name'];// Debit Card Bank Name

			    if(isset($_POST['upayment_description']))$upayment_description = $_POST['upayment_description'];


			    if(isset($_POST['ubalance_sheet_unique_id']))$ubalance_sheet_unique_id = $_POST['ubalance_sheet_unique_id'];
			    if(isset($_POST['ureceipt_id']))$ureceipt_id = $_POST['ureceipt_id'];
			    
			    if(isset($_POST['ucreator_name']))$creator_name = $_POST['ucreator_name'];
			    


			    /* OB Amount Status */

				 if(isset($_POST['uamount_status']))$uamount_status = $_POST['uamount_status'];
				 if(isset($_POST['upayee_name']))$upayee_name = $_POST['upayee_name'];

                    if(isset($_POST['ufinance_status']))$ufinance_status = $_POST['ufinance_status'];
                    
                    
                    if(isset($_POST['uexchange_status']))$uexchange_status = $_POST['uexchange_status'];
                    
                /*
                Server Side Calculation
                */
                
                if(isset($_POST['utotal_paid_old']))$utotal_paid_old = $_POST['utotal_paid_old'];
                if(isset($_POST['utotal_remaining_old']))$utotal_remaining_old = $_POST['utotal_remaining_old'];
                if(isset($_POST['old_uamount_to_pay']))$old_uamount_to_pay = $_POST['old_uamount_to_pay'];
                    
                    
                   $min_total_paid = $utotal_paid_old - $old_uamount_to_pay;
                   $min_total_remaining =  $utotal_remaining_old + $old_uamount_to_pay;
            
                   $utotal_remaining = $min_total_remaining - $uamount_to_pay;
                   $utotal_paid = $min_total_paid + $uamount_to_pay;  
                    
 				



			     $ubalance_sheet_date = date('Y-m-d');

				     $ubalance_sheet_date = date('Y-m-d');

			     $updat_payment =DB::table('customer_sales_receipt')
			     				->where([['booking_order_id', '=', $uorder_id],['balance_sheet_unique_id', '=', $ubalance_sheet_unique_id],['id', '=', $ureceipt_id],['is_deleted', '=', 0]])
			     				->update(['cheque_no' => '', 'cheque_bank_name' => '', 'credit_card_transaction_no'=> '','credit_card_bank_name'=> '','debit_card_transaction_no'=> '','debit_card_bank_name'=> '']);


			    $update_receipt = DB::table('customer_sales_receipt')->where([['booking_order_id', '=', $uorder_id],['balance_sheet_unique_id', '=', $ubalance_sheet_unique_id],['id', '=', $ureceipt_id],['is_deleted', '=', 0]])->update( ['exchange_status'=>$uexchange_status,'creator_name'=>$creator_name,'amount_to_pay' => $uamount_to_pay, 'payment_mode' =>$upayment_mode, 'cheque_no' => $ucheque_no, 'cheque_bank_name' => $ucheque_bank_name, 'credit_card_transaction_no'=>$ucredit_card_transaction_no,'credit_card_bank_name'=>$ucredit_card_bank_name,'debit_card_transaction_no'=>$udebit_card_transaction_no,'debit_card_bank_name'=>$udebit_card_bank_name,'payment_description'=>$upayment_description,'receipt_date'=>$ureceipt_date,'amount_status'=>$uamount_status,'payee_name'=>$upayee_name,'finance_status'=>$ufinance_status ] );

			   
                if($ufinance_status==1)
                {
                   $update_sales_booking = DB::table('sale_booking')->where('order_id', $uorder_id)->update( ['total_paid' => $utotal_paid, 'total_remaining'=>$utotal_remaining, 'finance_status'=>$ufinance_status ]);

                }
                else
                {
                  $update_sales_booking = DB::table('sale_booking')->where('order_id', $uorder_id)->update( ['total_paid' => $utotal_paid, 'total_remaining'=>$utotal_remaining]);   
                }


			    $update_balance_sheet = DB::table('balance_sheet')->where([['unique_id', '=', $ubalance_sheet_unique_id],['is_deleted', '=', 0]])->update(['bal_date'=>$ubalance_sheet_date,'payment_mode'=>$upayment_mode,'amount'=>$uamount_to_pay]);


			    return redirect('/receipt/'.$uorder_id.'/'.$ucustomer_id.'')->with(['message' => 'Update successfully.!!!']);


		}

		public function delete_single_receipt($receipt_id,$booking_order_id,$balance_sheet_unique_id,$customer_id)
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


			$select_customer_receipt = DB::table('customer_sales_receipt')
									   ->where([['booking_order_id', '=', $booking_order_id],['balance_sheet_unique_id', '=', $balance_sheet_unique_id],['id', '=', $receipt_id],['is_deleted', '=', 0],['customer_id', '=', $customer_id]])									   
									   ->get();
			$select_sale_booking = DB::table('sale_booking')
									->where([['order_id', '=', $booking_order_id],['is_deleted', '=', 0],['customer_id', '=', $customer_id]])
									->get();


						$up_amount_to_pay = $select_customer_receipt[0]->amount_to_pay;

						$up_total_paid = $select_sale_booking[0]->total_paid;
						$up_total_remaining = $select_sale_booking[0]->total_remaining;

						$update_total_paid = $up_total_paid - $up_amount_to_pay;
						$update_total_remaining = $up_total_remaining + $up_amount_to_pay;


			 $update_receipt = DB::table('customer_sales_receipt')->where([['booking_order_id', '=', $booking_order_id],['balance_sheet_unique_id', '=', $balance_sheet_unique_id],['id', '=', $receipt_id],['is_deleted', '=', 0]])->update( ['is_deleted' => 1] );

			    $update_sales_booking = DB::table('sale_booking')->where('order_id', $booking_order_id)->update( ['total_paid' => $update_total_paid, 'total_remaining'=>$update_total_remaining ]);


			    $update_balance_sheet = DB::table('balance_sheet')->where([['unique_id', '=', $balance_sheet_unique_id],['is_deleted', '=', 0]])->update(['is_deleted'=>1]);


			    return redirect('/receipt/'.$booking_order_id.'/'.$customer_id.'')->with(['message' => 'Deleted successfully.!!!']);





		}






		public function print_customer_receipt($voucher_receipt_unique_id)
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


            $print_customer_receipt = DB::table('customer_sales_receipt')
            			  ->leftJoin('customers', 'customers.id', '=', 'customer_sales_receipt.customer_id')
						  ->select('customer_sales_receipt.creator_name','customer_sales_receipt.payee_name','customer_sales_receipt.receipt_no','customer_sales_receipt.receipt_date','customer_sales_receipt.amount_to_pay','customer_sales_receipt.payment_mode','customer_sales_receipt.cheque_no','customer_sales_receipt.cheque_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.credit_card_transaction_no','customer_sales_receipt.debit_card_transaction_no','customer_sales_receipt.debit_card_bank_name','customer_sales_receipt.payment_description','customers.customer_name') 
						  ->where('customer_sales_receipt.is_deleted', '=', '0')
						  ->where('customer_sales_receipt.id', '=', $voucher_receipt_unique_id)
						  ->get();

			// $voucher_categorys = DB::table('voucher_category')
			// 				 ->select('voucher_category.id','voucher_category.voucher_name')
			// 				 ->where('voucher_category.is_deleted', '=', 0)
			// 				 ->get();

			return view('/print-customer-receipt',compact(['print_customer_receipt']));

		}



}

?>