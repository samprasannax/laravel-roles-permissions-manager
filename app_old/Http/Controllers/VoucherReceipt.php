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

class VoucherReceipt extends Controller{	

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







			$voucher_receipt_lists = DB::table('voucher_receipt')
						  ->leftJoin('voucher_category', 'voucher_category.id', '=', 'voucher_receipt.voucher_category')
						  ->select('voucher_category.voucher_name','voucher_receipt.id','voucher_receipt.voucher_no','voucher_receipt.voucher_date','voucher_receipt.person_name','voucher_receipt.voucher_amount','voucher_receipt.voucher_description','voucher_receipt.unique_id','voucher_receipt.order_id') 
						 
						 ->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('voucher_receipt.voucher_date', [$report_from_date, $report_to_date]);

							       						        
							        	$query->where([['voucher_receipt.is_deleted', '=', 0]]);

							        })->get();
							        
			return view('/voucher-receipt-list', compact(['voucher_receipt_lists']));

		}


		public function new_voucher_receipt(){

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



            $voucher_code_max1 =  DB::table('voucher_receipt')           						

            						->where(function($query) use ($start_date, $end_date) {
		
							       	 if($start_date !='' and $end_date !='')
							       	 $query->whereBetween('voucher_date', [$start_date, $end_date]);

							        })
							        ->max('voucher_no');

            $voucher_code_max = $voucher_code_max1 + 1;
		
			// $current_date = date("Ymd");
			// $customer_code_prefix = "SUC";

			// $customer_code = $customer_code_prefix . '-' . $current_date.'-'.$customer_code_max;


			//output: SUC-000001
	       $voucher_categorys = DB::table('voucher_category')
							 ->select('voucher_category.id','voucher_category.voucher_name')
							 ->where('voucher_category.is_deleted', '=', 0)
							 ->get();


			return view('/new-voucher-receipt',compact(['voucher_categorys']))->with(['success' => 'Member Basic Details Added successfully.', 'voucher_no'=>$voucher_code_max]);
		}


		public function insert_voucher_receipt(){	

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




            if(isset($_POST['voucher_no']))$voucher_no = $_POST['voucher_no'];
			
			if(isset($_POST['voucher_date']))$voucher_date = date("Y-m-d", strtotime($_POST['voucher_date']));
			if(isset($_POST['voucher_category']))$voucher_category = $_POST['voucher_category'];
			if(isset($_POST['person_name']))$person_name = $_POST['person_name'];
			if(isset($_POST['voucher_amount']))$voucher_amount = $_POST['voucher_amount'];
			if(isset($_POST['voucher_description']))$voucher_description = $_POST['voucher_description'];

			  // $customer_date = date("Y-m-d");

		      $unqiue_string = Str::random(30); 

			  $balance_sheet_unique_id = 'B'.date("Ymd") . time() . mt_rand();
			  $balance_sheet_date = date('Y-m-d');
			  

			    if(isset($_POST['payment_mode']))$payment_mode = $_POST['payment_mode'];

			    if(isset($_POST['cheque_no']))$cheque_no = $_POST['cheque_no']; // cheque No
			    if(isset($_POST['cheque_bank_name']))$cheque_bank_name = $_POST['cheque_bank_name'];// cheque Bank Name

			    if(isset($_POST['credit_card_transaction_no']))$credit_card_transaction_no = $_POST['credit_card_transaction_no']; // Credit Card Transaction No
			    if(isset($_POST['credit_card_bank_name']))$credit_card_bank_name = $_POST['credit_card_bank_name']; //  Credit Card Bank Name

				if(isset($_POST['debit_card_transaction_no']))$debit_card_transaction_no = $_POST['debit_card_transaction_no']; // Debit Card Transaction No
			    if(isset($_POST['debit_card_bank_name']))$debit_card_bank_name = $_POST['debit_card_bank_name'];// Debit Card Bank Name



			   $insert_voucher_receipt = DB::table('voucher_receipt')->insert( ['unique_id' => $unqiue_string,'order_id' => $balance_sheet_unique_id,'voucher_no' => $voucher_no,'voucher_date' => $voucher_date, 'voucher_category' =>$voucher_category, 'person_name' => $person_name, 'voucher_amount' => $voucher_amount, 'payment_mode' =>$payment_mode, 'cheque_no' => $cheque_no, 'cheque_bank_name' => $cheque_bank_name, 'credit_card_transaction_no'=>$credit_card_transaction_no,'credit_card_bank_name'=>$credit_card_bank_name,'debit_card_transaction_no'=>$debit_card_transaction_no,'debit_card_bank_name'=>$debit_card_bank_name,'voucher_description' => $voucher_description] );


	           $insert_balance_sheet = DB::table('balance_sheet')->insert(['unique_id'=>$unqiue_string,'order_id'=>$balance_sheet_unique_id,'bal_date'=>$balance_sheet_date,'payment_mode'=>$payment_mode,'amount'=>$voucher_amount, 'voucher_status'=>1]);


			
				return redirect('/voucher-receipt-list')->with('success', 'Voucher receipt saved!');
          

			
		}




		public function edit_voucher_receipt($voucher_receipt_unique_id)
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


            $edit_voucher_receipt = DB::table('voucher_receipt')
            			  ->leftJoin('voucher_category', 'voucher_category.id', '=', 'voucher_receipt.voucher_category')
						  ->select('voucher_category.voucher_name','voucher_receipt.id','voucher_receipt.voucher_no','voucher_receipt.voucher_date','voucher_receipt.person_name','voucher_receipt.voucher_amount','voucher_receipt.voucher_description','voucher_receipt.voucher_category','voucher_receipt.payment_mode','voucher_receipt.cheque_no','voucher_receipt.cheque_bank_name','voucher_receipt.credit_card_transaction_no','voucher_receipt.credit_card_bank_name','voucher_receipt.debit_card_transaction_no','voucher_receipt.debit_card_bank_name','voucher_receipt.unique_id','voucher_receipt.order_id') 
						 ->where('voucher_receipt.is_deleted', '=', '0')
						 ->where('voucher_receipt.id', '=', $voucher_receipt_unique_id)
						 ->get();

			$voucher_categorys = DB::table('voucher_category')
							 ->select('voucher_category.id','voucher_category.voucher_name')
							 ->where('voucher_category.is_deleted', '=', 0)
							 ->get();

			return view('/edit-voucher-receipt',compact(['edit_voucher_receipt','voucher_categorys']));

		}


		public function update_voucher_receipt(){	

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

			if(isset($_POST['voucher_receipt_unique_id']))$voucher_receipt_unique_id = $_POST['voucher_receipt_unique_id'];
			if(isset($_POST['unique_id']))$unique_id = $_POST['unique_id'];
			if(isset($_POST['order_id']))$order_id = $_POST['order_id'];


			if(isset($_POST['voucher_no']))$voucher_no = $_POST['voucher_no'];
			if(isset($_POST['voucher_date']))$voucher_date = date("Y-m-d", strtotime($_POST['voucher_date']));
			if(isset($_POST['voucher_category']))$voucher_category = $_POST['voucher_category'];
			if(isset($_POST['person_name']))$person_name = $_POST['person_name'];
			if(isset($_POST['voucher_amount']))$voucher_amount = $_POST['voucher_amount'];
			if(isset($_POST['voucher_description']))$voucher_description = $_POST['voucher_description'];


			    if(isset($_POST['payment_mode']))$payment_mode = $_POST['payment_mode'];

			    if(isset($_POST['cheque_no']))$cheque_no = $_POST['cheque_no']; // cheque No
			    if(isset($_POST['cheque_bank_name']))$cheque_bank_name = $_POST['cheque_bank_name'];// cheque Bank Name

			    if(isset($_POST['credit_card_transaction_no']))$credit_card_transaction_no = $_POST['credit_card_transaction_no']; // Credit Card Transaction No
			    if(isset($_POST['credit_card_bank_name']))$credit_card_bank_name = $_POST['credit_card_bank_name']; //  Credit Card Bank Name

				if(isset($_POST['debit_card_transaction_no']))$debit_card_transaction_no = $_POST['debit_card_transaction_no']; // Debit Card Transaction No
			    if(isset($_POST['debit_card_bank_name']))$debit_card_bank_name = $_POST['debit_card_bank_name'];// Debit Card Bank Name



			$update_voucher_payment = DB::table('voucher_receipt')->where([['id', $voucher_receipt_unique_id],['unique_id', $unique_id],['order_id', $order_id]])->update( ['payment_mode' =>$payment_mode, 'cheque_no' => '', 'cheque_bank_name' => '', 'credit_card_transaction_no'=>'','credit_card_bank_name'=>'','debit_card_transaction_no'=>'','debit_card_bank_name'=>'' ]);		


			$update_voucher_receipt = DB::table('voucher_receipt')->where('id', $voucher_receipt_unique_id)->update( ['voucher_no' => $voucher_no, 'voucher_date'=>$voucher_date, 'person_name'=>$person_name, 'voucher_category'=>$voucher_category,'voucher_amount'=>$voucher_amount,'voucher_description'=>$voucher_description,'payment_mode' =>$payment_mode, 'cheque_no' => $cheque_no, 'cheque_bank_name' => $cheque_bank_name, 'credit_card_transaction_no'=>$credit_card_transaction_no,'credit_card_bank_name'=>$credit_card_bank_name,'debit_card_transaction_no'=>$debit_card_transaction_no,'debit_card_bank_name'=>$debit_card_bank_name ]);

  			$balance_sheet_date = date('Y-m-d');

			$update_balance_sheet = DB::table('balance_sheet')->where([['unique_id', '=', $unique_id],['is_deleted', '=', 0]])->update(['bal_date'=>$balance_sheet_date,'payment_mode'=>$payment_mode,'amount'=>$voucher_amount]);

			return redirect('/voucher-receipt-list')->with('success', 'Voucher receipt updated!');


			
		}

		public function delete_voucher_receipt($voucher_receipt_unique_id,$unique_id,$order_id){	

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

				$delete_voucher_receipt = DB::table('voucher_receipt')->where('id', $voucher_receipt_unique_id)->update( ['is_deleted' => '1']);


				$delete_voucher_balance_sheet = DB::table('balance_sheet')
												->where('unique_id', $unique_id)
												->where('order_id', $order_id)
												->update( ['is_deleted' => '1']);
			      
			      
			
				return redirect('/voucher-receipt-list')->with('success', 'Voucher Receipt Deleted!');
			
		}


		public function print_voucher_receipt($voucher_receipt_unique_id)
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


            $print_voucher_receipt = DB::table('voucher_receipt')
            			  ->leftJoin('voucher_category', 'voucher_category.id', '=', 'voucher_receipt.voucher_category')
						  ->select('voucher_category.voucher_name','voucher_receipt.id','voucher_receipt.voucher_no','voucher_receipt.voucher_date','voucher_receipt.person_name','voucher_receipt.voucher_amount','voucher_receipt.voucher_description','voucher_receipt.voucher_category') 
						 ->where('voucher_receipt.is_deleted', '=', '0')
						 ->where('voucher_receipt.id', '=', $voucher_receipt_unique_id)
						 ->get();

			// $voucher_categorys = DB::table('voucher_category')
			// 				 ->select('voucher_category.id','voucher_category.voucher_name')
			// 				 ->where('voucher_category.is_deleted', '=', 0)
			// 				 ->get();

			return view('/print-voucher-receipt',compact(['print_voucher_receipt']));

		}



}
?>