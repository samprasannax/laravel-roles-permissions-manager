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
  
class VoucherReceiptLedger implements FromCollection
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

         
			$dsc_id="";
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



              $voucher_receipt_report_lists = DB::table('voucher_receipt')
						  ->leftJoin('voucher_category', 'voucher_category.id', '=', 'voucher_receipt.voucher_category')
						  ->select('voucher_category.voucher_name','voucher_receipt.id','voucher_receipt.voucher_no','voucher_receipt.voucher_date','voucher_receipt.person_name','voucher_receipt.voucher_amount','voucher_receipt.voucher_description','voucher_receipt.unique_id','voucher_receipt.order_id','voucher_receipt.payment_mode','voucher_receipt.cheque_no','voucher_receipt.cheque_bank_name','voucher_receipt.credit_card_transaction_no','voucher_receipt.credit_card_bank_name','voucher_receipt.debit_card_transaction_no','voucher_receipt.debit_card_bank_name') 

						 	->where(function($query) use ($report_from_date, $report_to_date) {	

								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('voucher_receipt.voucher_date', [$report_from_date, $report_to_date]);

								        })->get();





						$voucher_receipt_items=array();

						$report_date = $report_from_date ."-". $report_to_date;



						array_push($voucher_receipt_items,new DscLedgerReport("","","Report Date: ".$report_date,"","","",""));


						array_push($voucher_receipt_items,new DscLedgerReport("Voucher No","Voucher Date","Person Name","Voucher Category","Amount","Description","Payment Mode"));



						if(!empty($voucher_receipt_report_lists))
						{
								foreach ($voucher_receipt_report_lists as $farray ) {

									$voucher_no = $farray->voucher_no;
									$voucher_date = $farray->voucher_date;
									$person_name = $farray->person_name;									
									$voucher_name = $farray->voucher_name;									
									$voucher_amount = $farray->voucher_amount;								
									$voucher_description = $farray->voucher_description;

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

										$voucher_date1 = date("d-m-Y", strtotime($farray->voucher_date));


									array_push($voucher_receipt_items,new DscLedgerReport("Voucher No:".$voucher_no,$voucher_date1,$person_name,$voucher_name,$voucher_amount,$voucher_description,$payment_mode));

									array_push($voucher_receipt_items,new DscLedgerReport("","","","","","",""));


								}

						}
 						

			

						$report_final = collect($voucher_receipt_items);

						return $report_final;
    }

   
}