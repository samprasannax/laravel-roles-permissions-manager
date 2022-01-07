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
  
class ReceiptLedger implements FromCollection
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




       $receipt_reports = DB::table('customer_sales_receipt')
            			  ->leftJoin('customers', 'customers.id', '=', 'customer_sales_receipt.customer_id')
            			  ->leftJoin('dealers', 'dealers.id', '=', 'customer_sales_receipt.dealer_id')
						  ->select('customer_sales_receipt.receipt_no','customer_sales_receipt.receipt_date','customer_sales_receipt.amount_to_pay','customer_sales_receipt.payment_mode','customer_sales_receipt.cheque_no','customer_sales_receipt.cheque_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.debit_card_transaction_no','customer_sales_receipt.debit_card_bank_name','customer_sales_receipt.payment_description','customers.customer_name','dealers.dealer_name') 
						  	->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('customer_sales_receipt.receipt_date', [$report_from_date, $report_to_date]);

							       						        
							        	$query->where([['customer_sales_receipt.cancel_status', '=', 0],['customer_sales_receipt.is_deleted', '=', 0],['customer_sales_receipt.payment_mode', '=', 1],['customer_sales_receipt.amount_status', '=', 0]]);

							        })->get();




						$receipt_items=array();

						$report_date = $report_from_date ."-". $report_to_date;



						array_push($receipt_items,new ReceiptReports("","","Report Date: ".$report_date,"","",""));


						array_push($receipt_items,new ReceiptReports("Receipt No","Receipt Date","Dealer Name","Customer Name","Paid Amount","Payment Mode"));



						if(!empty($receipt_reports))
						{
								foreach ($receipt_reports as $farray ) {

									$receipt_no = $farray->receipt_no;
									$receipt_date = $farray->receipt_date;
									$dealer_name = $farray->dealer_name;
									$customer_name = $farray->customer_name;
									
									$amount_to_pay = $farray->amount_to_pay;

										
										$payment_mode1 = $farray->payment_mode;

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

										$receipt_date1 = date("d-m-Y", strtotime($farray->receipt_date));




									array_push($receipt_items,new ReceiptReports("Receipt No:".$receipt_no,$receipt_date1,$dealer_name,$customer_name,$amount_to_pay,$payment_mode));


									array_push($receipt_items,new ReceiptReports("","","","","",""));


								}

						}
 						

			

						$report_final = collect($receipt_items);

						return $report_final;
    }

   
}