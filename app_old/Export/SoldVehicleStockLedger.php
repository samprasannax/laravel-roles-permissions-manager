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
  
class SoldVehicleStockLedger implements FromCollection
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


        

               $vehicle_stocks = DB::table('self_sale_vehicle_info')
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'self_sale_vehicle_info.vehicle_type_id') 
						        ->leftJoin('colors', 'colors.id', '=', 'self_sale_vehicle_info.color_id')
						        ->leftJoin('main_model', 'main_model.id', '=', 'self_sale_vehicle_info.model_id')
						         ->leftJoin('customers', 'customers.id', '=', 'self_sale_vehicle_info.customer_id')
						        ->leftJoin('sales_person', 'sales_person.id','=', 'self_sale_vehicle_info.sales_person_id')
						        ->select('self_sale_vehicle_info.id','self_sale_vehicle_info.chassis_no','self_sale_vehicle_info.delivery_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','customers.customer_name','sales_person.sales_person_name')
									->where(function($query) use ($report_from_date, $report_to_date,$dsc_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('self_sale_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dsc_id !='')							        
								        	$query->where([['self_sale_vehicle_info.sales_person_id', '=', $dsc_id]]);

								        $query->where([['self_sale_vehicle_info.is_deleted', '=', 0]]);

								        })->get();




						$array_of_sold_stock =array();

						$report_date =date("d-m-Y");


						array_push($array_of_sold_stock,new SoldVehicleStock("","","Report Date: ".$report_date,"","","",""));


						array_push($array_of_sold_stock,new SoldVehicleStock("Sold Date","Vehicle Type","Vehicle Model","Vehicle Color","Chassis No","Customer Name","Dsc Name"));

						array_push($array_of_sold_stock,new SoldVehicleStock("","","","","","",""));


						if(!empty($vehicle_stocks))
						{
								foreach ($vehicle_stocks as $farray ) {
									$sold_date = date("d-m-Y", strtotime($farray->delivery_date));
									$vehicle_type = strtoupper($farray->type_of_vehicle);
									$vehicle_model = strtoupper($farray->model);
									$vehicle_color = strtoupper($farray->type_of_color);
									$chassis_no = strtoupper($farray->chassis_no);
									$customer_name = strtoupper($farray->customer_name);
									$sales_person_name = strtoupper($farray->sales_person_name);

															

									array_push($array_of_sold_stock,new SoldVehicleStock($sold_date,$vehicle_type,$vehicle_model,$vehicle_color,$chassis_no,$customer_name,$sales_person_name));

									array_push($array_of_sold_stock,new SoldVehicleStock("","","","","","",""));


								}
						}
 						
					$report_final = collect($array_of_sold_stock);

						return $report_final;
    }

   
}