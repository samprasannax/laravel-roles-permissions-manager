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
  
class CancelReceiptLedger implements FromCollection
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
         

            $cancel_receipts = DB::table('customer_sales_receipt')
            			  ->leftJoin('customers', 'customers.id', '=', 'customer_sales_receipt.customer_id')
            			  ->leftJoin('dealers', 'dealers.id', '=', 'customer_sales_receipt.dealer_id')
						  ->select('customer_sales_receipt.receipt_no','customer_sales_receipt.receipt_date','customer_sales_receipt.amount_to_pay','customer_sales_receipt.payment_mode','customer_sales_receipt.cheque_no','customer_sales_receipt.cheque_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.credit_card_bank_name','customer_sales_receipt.debit_card_transaction_no','customer_sales_receipt.debit_card_bank_name','customer_sales_receipt.payment_description','customers.customer_name','dealers.dealer_name') 
						  ->where('customer_sales_receipt.is_deleted', '=', '0')
						  ->where('customer_sales_receipt.cancel_status', '=', 1)
						  ->get();





						$array_cancel_receipt =array();

						$report_date =date("d-m-Y");


						array_push($array_cancel_receipt,new CancelReceipt("","","Report Date: ".$report_date,"",""));


						array_push($array_cancel_receipt,new CancelReceipt("Receipt No","Receipt Date","Customer Name","Paid Amount","Payment Mode"));

						array_push($array_cancel_receipt,new CancelReceipt("","","","",""));


						if(!empty($cancel_receipts))
						{
								foreach ($cancel_receipts as $farray ) {

									$receipt_no = $farray->receipt_no;
									$receipt_date = date("d-m-Y", strtotime($farray->receipt_date));

									$customer_name = strtoupper($farray->customer_name);
									$paid_amount = $farray->amount_to_pay;	
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
											$payment_mode = "Payment Mode : Cheque ";
										}

										if($payment_mode1==4)
										{
											$payment_mode = "Payment Mode : Credit Card ";
										}

										if($payment_mode1==5)
										{
											$payment_mode = "Payment Mode : Debit Card ";
										}


										if($payment_mode1==6)
										{
											$payment_mode = "Payment Mode : Insentive ";
										}



										if($payment_mode1==7)
										{
											$payment_mode = "Payment Mode : Insurance ";
										}



										if($payment_mode1==8)
										{
											$payment_mode = "Payment Mode : Road Tax ";
										}







									array_push($array_cancel_receipt,new CancelReceipt($receipt_no,$receipt_date,$customer_name,$paid_amount,$payment_mode));

									array_push($array_cancel_receipt,new CancelReceipt("","","","",""));


								}
						}
 						
					$report_final = collect($array_cancel_receipt);

						return $report_final;
    }

   
}