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
  
class TotalFinanaceLedger implements FromCollection
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
         

             	$total_finances = DB::table('bank')			 		             
			         ->where("bank.is_deleted","=", 0)
			   
			        ->select("bank.bank_name",			        	
			        	DB::raw("(SELECT SUM(amount_to_pay) as total_finance_amount FROM customer_sales_receipt left join sale_booking on sale_booking.order_id = customer_sales_receipt.booking_order_id WHERE sale_booking.hyp_bank_name = bank.id and customer_sales_receipt.finance_status = 1 and customer_sales_receipt.is_deleted = 0 and customer_sales_receipt.cancel_status = 0 and sale_booking.is_deleted = 0 and sale_booking.cancel_status = 0 OR customer_sales_receipt.bank_id = bank.id and customer_sales_receipt.finance_status= 1 and customer_sales_receipt.is_deleted=0 and customer_sales_receipt.cancel_status = 0) as total_finance_amount"))
			      ->groupBy("bank.bank_name","bank.id")
				   
				   ->get();





						$array_total_finance =array();

						$report_date =date("d-m-Y");


						array_push($array_total_finance,new TotalFinanace("Report Date: ".$report_date,""));

					

						array_push($array_total_finance,new TotalFinanace("Bank Name","Total Amount"));


						if(!empty($total_finances))
						{
								foreach ($total_finances as $farray ) {

									$bank_name = $farray->bank_name;									
									$total_finance_amount = $farray->total_finance_amount;	

									array_push($array_total_finance,new TotalFinanace($bank_name,$total_finance_amount));
							

								}
						}
 						
					$report_final = collect($array_total_finance);

						return $report_final;
    }

   
}