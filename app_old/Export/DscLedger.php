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
  
class DscLedger implements FromCollection
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



               $fetch_dsc_monthly_sales = DB::table('sale_booking')
                        ->leftjoin('self_sale_vehicle_info', 'self_sale_vehicle_info.booking_order_id', '=', 'sale_booking.order_id')
                         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
                         ->leftJoin('sales_person', 'sales_person.id', '=', 'sale_booking.sales_person_id')
                         ->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')  
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id')
					     ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')  
					     ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
					     ->leftJoin('bank', 'bank.id', '=', 'sale_booking.hyp_bank_name')

						 ->select('sale_booking.hyp','bank.bank_name','self_sale_vehicle_info.helmat_status','customers.customer_name','customers.contact_no1','customers.customer_address','sales_person.sales_person_name','mechanic.mechanic_name','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color','self_sale_vehicle_info.chassis_no','self_sale_vehicle_info.delivery_date')

						->where(function($query) use ($report_from_date, $report_to_date,$dsc_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('self_sale_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dsc_id !='')							        
								        	$query->where([['self_sale_vehicle_info.sales_person_id', '=', $dsc_id]]);

								        $query->where([['self_sale_vehicle_info.is_deleted', '=', 0],['sale_booking.is_deleted', '=', 0]]);

								        })->get();




						$dsc_sales_items=array();

						$report_date = $report_from_date ."-". $report_to_date;



						array_push($dsc_sales_items,new DscLedgerReport("","","","Report Date: ".$report_date,"","","","","","",""));


						array_push($dsc_sales_items,new DscLedgerReport("Delivery Date","Customer Name","Customer Contact","Customer Address","Sales Person Name","Vehicle Type","Vehicle Model","Vehicle Color","Vehicle Chassis No","Helmat Status","HYP"));
						array_push($dsc_sales_items,new DscLedgerReport("","","","","","","","","","",""));



						if(!empty($fetch_dsc_monthly_sales))
						{
								foreach ($fetch_dsc_monthly_sales as $farray ) {

									$delivery_date = $farray->delivery_date;
									$customer_name = $farray->customer_name;
									$contact_no1 = $farray->contact_no1;
									$customer_address = $farray->customer_address;
									$sales_person_name = $farray->sales_person_name;
									$vehicle_type = $farray->type_of_vehicle;
									$vehicle_model = $farray->model;
									$vehicle_color = $farray->type_of_color;
									$chassis_no = $farray->chassis_no;
									
									$helmat = $farray->helmat_status;
									$hyp = $farray->hyp;
									$bank_name = $farray->bank_name;
									
									
									if($helmat ==0)
									{
									    $helmat_status = "NO";
									}
									else
									{
									     $helmat_status = "YES";
									}
									
									if($hyp =="no")
									{
									    $hyp1 = "CASH";
									}
									else
									{
									     $hyp1 = $bank_name;
									}
									

									array_push($dsc_sales_items,new DscLedgerReport($delivery_date,$customer_name,$contact_no1,$customer_address,$sales_person_name,$vehicle_type,$vehicle_model,$vehicle_color,$chassis_no,$helmat_status,$hyp1));

									array_push($dsc_sales_items,new DscLedgerReport("","","","","","","","","","",""));


								}

						}
 						

			

						$report_final = collect($dsc_sales_items);

						return $report_final;
    }

   
}