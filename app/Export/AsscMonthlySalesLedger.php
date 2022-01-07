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
  
class AsscMonthlySalesLedger implements FromCollection
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
         

            $dealer_id="";
			$report_from_date1="";
			$report_to_date1="";
			$fetch_assc_monthly_sales ="";

			if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];

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


            $fetch_assc_monthly_sales = DB::table('dealer_booking_vehicle_info')
                         ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
                         ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
					     ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')  
					     ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')
					     ->leftJoin('bank', 'bank.id', '=', 'dealer_booking_vehicle_info.bank_id')

						 ->select('bank.bank_name','dealers.dealer_name','vehicle_type.type_of_vehicle','main_model.model','colors.type_of_color','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.delivery_date','dealer_booking_vehicle_info.assc_customer_name','dealer_booking_vehicle_info.contact_no','dealer_booking_vehicle_info.description')

						->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('dealer_booking_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id]]);

								        $query->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.stock_status', '=',1],['dealer_booking_vehicle_info.return_status', '=',0]]);

								        })->get();


						$array_of_assc_monhtly_sales =array();
						$report_date =date("d-m-Y");

						array_push($array_of_assc_monhtly_sales,new AsscMonthlySales("","","Report Date: ".$report_date,"","","","","","",""));


						array_push($array_of_assc_monhtly_sales,new AsscMonthlySales("Date","Dealer Name","Vehicle Type","Vehicle Model","Vehicle Color","Chassis No","Customer Name","Contact No","Address","HYP"));

						array_push($array_of_assc_monhtly_sales,new AsscMonthlySales("","","","","","","","","",""));


						if(!empty($fetch_assc_monthly_sales))
						{
								foreach ($fetch_assc_monthly_sales as $farray ) {

									$delivery_date = date("d-m-Y", strtotime($farray->delivery_date));

									$dealer_name = strtoupper($farray->dealer_name);
									$type_of_vehicle = strtoupper($farray->type_of_vehicle);
									$model = strtoupper($farray->model);
									$type_of_color = strtoupper($farray->type_of_color);
									$chassis_no = strtoupper($farray->chassis_no);
									$customer_name = strtoupper($farray->assc_customer_name);
									$contact_no = strtoupper($farray->contact_no);
									$description = strtoupper($farray->description);
									$bank_name = strtoupper($farray->bank_name);
									
									if($bank_name !='')
									{
									    $hyp = $bank_name;
									}
									else
									{
									    $hyp="CASH";
									}
					

									array_push($array_of_assc_monhtly_sales,new AsscMonthlySales($delivery_date,$dealer_name,$type_of_vehicle,$model,$type_of_color,$chassis_no,$customer_name,$contact_no,$description,$hyp));

									
						array_push($array_of_assc_monhtly_sales,new AsscMonthlySales("","","","","","","","","",""));


								}
						}
 						
					$report_final = collect($array_of_assc_monhtly_sales);

					return $report_final;
    }

   
}