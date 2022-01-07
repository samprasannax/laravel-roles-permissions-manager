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


class DailyAccountClose extends Controller{	
		  
        /**
	     * Create a new controller instance.
	     *
	     * @return void
	    */

	    public function __construct()
	    {
	        $this->middleware('auth');
	    }


		public function daily_account_close (){

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

            	$daily_account_close = DB::table('daily_account_close')
            						->where('is_deleted', '=', 0)
            						->orderby('id','DESC')
            						->get();



				 return view('/daily-account-close', compact(['daily_account_close']));




		}


		public function new_daily_account_close()
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

            $report_from_date1 = date("Y-m-d");
            $report_to_date1 = date("Y-m-d");

            $report_from_date = date("Y-m-d", strtotime($report_from_date1));
            $report_to_date = date("Y-m-d", strtotime($report_to_date1));



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
									->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('customer_sales_receipt.receipt_date', [$report_from_date, $report_to_date]);

							       						        
							        	$query->where([['customer_sales_receipt.is_deleted', '=', 0],['customer_sales_receipt.payment_mode', '=', 1],['customer_sales_receipt.amount_status', '=', 0]]);

							        })->sum('customer_sales_receipt.amount_to_pay');




					$voucher_receipt_info = DB::table('voucher_receipt')
						 ->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('voucher_receipt.voucher_date', [$report_from_date, $report_to_date]);
							       	  						        
							        	$query->where([['voucher_receipt.is_deleted', '=', 0],['voucher_receipt.payment_mode', '=', 1]]);

							        })->sum('voucher_receipt.voucher_amount');




							  
			        $credit_voucher = DB::table('voucher_credit')						 
						 ->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('voucher_credit.voucher_date', [$report_from_date, $report_to_date]);
							       	  						        
							        	$query->where([['voucher_credit.is_deleted', '=', 0],['voucher_credit.payment_mode', '=', 1]]);

							        })->sum('voucher_credit.voucher_amount');

					$total_open = $find_opening_bal + $customer_sales_info + $credit_voucher;

					$final_open = $total_open - $voucher_receipt_info;





            return view('/new-daily-account-close',compact(['final_open']));


		}


			public function insert_new_daily_account_close (){

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


            if(isset($_POST['close_date']))$close_date =  date("Y-m-d", strtotime($_POST['close_date']));
            if(isset($_POST['note_two_thousand']))$note_two_thousand = $_POST['note_two_thousand'];
            if(isset($_POST['two_thousand_count']))$two_thousand_count = $_POST['two_thousand_count'];
            if(isset($_POST['two_thousand_value']))$two_thousand_value = $_POST['two_thousand_value'];
            if(isset($_POST['note_five_hundred']))$note_five_hundred = $_POST['note_five_hundred'];
            if(isset($_POST['five_hundred_count']))$five_hundred_count = $_POST['five_hundred_count'];
            if(isset($_POST['five_hundred_value']))$five_hundred_value = $_POST['five_hundred_value'];
            if(isset($_POST['note_two_hundred']))$note_two_hundred = $_POST['note_two_hundred'];
            if(isset($_POST['two_hundred_count']))$two_hundred_count = $_POST['two_hundred_count'];
            if(isset($_POST['two_hundred_value']))$two_hundred_value = $_POST['two_hundred_value'];
            if(isset($_POST['note_one_hundred']))$note_one_hundred = $_POST['note_one_hundred'];
            if(isset($_POST['one_hundred_count']))$one_hundred_count = $_POST['one_hundred_count'];
            if(isset($_POST['one_hundred_value']))$one_hundred_value = $_POST['one_hundred_value'];
            if(isset($_POST['note_fifty']))$note_fifty = $_POST['note_fifty'];
            if(isset($_POST['fifty_count']))$fifty_count = $_POST['fifty_count'];
            if(isset($_POST['fifty_value']))$fifty_value = $_POST['fifty_value'];
            if(isset($_POST['note_twenty']))$note_twenty = $_POST['note_twenty'];
            if(isset($_POST['twenty_count']))$twenty_count = $_POST['twenty_count'];
            if(isset($_POST['twenty_value']))$twenty_value = $_POST['twenty_value'];
            if(isset($_POST['note_ten']))$note_ten = $_POST['note_ten'];
            if(isset($_POST['ten_count']))$ten_count = $_POST['ten_count'];
            if(isset($_POST['ten_value']))$ten_value = $_POST['ten_value'];
            if(isset($_POST['note_five']))$note_five = $_POST['note_five'];
            if(isset($_POST['five_count']))$five_count = $_POST['five_count'];
            if(isset($_POST['five_value']))$five_value = $_POST['five_value'];
              if(isset($_POST['note_two']))$note_two = $_POST['note_two'];
            if(isset($_POST['two_count']))$two_count = $_POST['two_count'];
            if(isset($_POST['two_value']))$two_value = $_POST['two_value'];
            if(isset($_POST['note_one']))$note_one = $_POST['note_one'];
            if(isset($_POST['one_count']))$one_count = $_POST['one_count'];
            if(isset($_POST['note_one']))$note_one = $_POST['note_one'];
            if(isset($_POST['one_value']))$one_value = $_POST['one_value'];
            if(isset($_POST['total_note_amount']))$total_note_amount = $_POST['total_note_amount'];
            if(isset($_POST['total_soft_amount']))$total_soft_amount = $_POST['total_soft_amount'];
            if(isset($_POST['tally_amount']))$tally_amount = $_POST['tally_amount'];
            if(isset($_POST['close_by']))$close_by = $_POST['close_by'];


 				$insert_daily_account_close = DB::table('daily_account_close')->insert( ['close_date'=>$close_date,'note_two_thousand'=>$note_two_thousand,'two_thousand_count'=>$two_thousand_count,'two_thousand_value'=>$two_thousand_value,'note_five_hundred'=>$note_five_hundred,'five_hundred_count'=>$five_hundred_count,'five_hundred_value'=>$five_hundred_value,'note_two_hundred'=>$note_two_hundred,'two_hundred_count'=>$two_hundred_count,'two_hundred_value'=>$two_hundred_value,'note_one_hundred'=>$note_one_hundred,'one_hundred_count'=>$one_hundred_count,'one_hundred_value'=>$one_hundred_value,'note_fifty'=>$note_fifty,'one_hundred_value'=>$one_hundred_value,'note_fifty'=>$note_fifty,'fifty_count'=>$fifty_count,'fifty_value'=>$fifty_value,'note_twenty'=>$note_twenty,'twenty_count'=>$twenty_count,'twenty_value'=>$twenty_value,'note_ten'=>$note_ten,'ten_count'=>$ten_count,'ten_value'=>$ten_value,'note_five'=>$note_five,'five_count'=>$five_count,'five_value'=>$five_value,'note_two'=>$note_two,'two_count'=>$two_count,'two_value'=>$two_value,'note_one'=>$note_one,'one_count'=>$one_count,'one_value'=>$one_value,'total_note_amount'=>$total_note_amount,'total_soft_amount'=>$total_soft_amount,'tally_amount'=>$tally_amount,'close_by'=>$close_by] );


				 return redirect('/daily-account-close');




		}

		public function delete_daily_account_close($unique_id)
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

			$delete_daily_account_close = DB::table('daily_account_close')->where([['is_deleted', '=', 0],['id', '=', $unique_id]])->update(['is_deleted'=>1]);

			 return redirect('/daily-account-close');
		}







}
?>