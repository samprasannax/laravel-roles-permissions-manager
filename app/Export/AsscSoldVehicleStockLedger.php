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
  
class AsscSoldVehicleStockLedger implements FromCollection
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
			$fetch_dsc_monthly_sales ="";

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




        

                $vehicle_stocks = DB::table('dealer_booking_vehicle_info')
                                 ->leftJoin('vehicle_stock', 'vehicle_stock.chassis_no', '=', 'dealer_booking_vehicle_info.chassis_no') 
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id') 
						        ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')
						        ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
						         ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
						        ->select('dealer_booking_vehicle_info.rto_date','vehicle_stock.stock_date','vehicle_stock.engine_no','dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.booking_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','dealers.dealer_name','dealer_booking_vehicle_info.assc_customer_name','dealer_booking_vehicle_info.contact_no','dealer_booking_vehicle_info.delivery_date')
								
								->where(function($query) use ($report_from_date, $report_to_date,$dealer_id) {		
								       	 if($report_from_date !='' and $report_to_date !='')
								       	 $query->whereBetween('dealer_booking_vehicle_info.delivery_date', [$report_from_date, $report_to_date]);

								       	  if($dealer_id !='')							        
								        	$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id]]);

								        $query->where([['dealer_booking_vehicle_info.is_deleted', '=', 0],['dealer_booking_vehicle_info.delivery_date', '<>', ''],['dealer_booking_vehicle_info.return_status', '=', 0]]);
							

								        })->get();


						$array_of_assc_sold_stock =array();

						$report_date =date("d-m-Y");


						array_push($array_of_assc_sold_stock,new AsscSoldVehicleStock("","","Report Date: ".$report_date,"","","","","","","","",""));


						array_push($array_of_assc_sold_stock,new AsscSoldVehicleStock("Purchase Date","Booking Date","Delaer Name","Sold Date","Vehicle Type","Vehicle Model","Vehicle Color","Chassis No","Engine No","Customer Name","Contact No","RTO Date"));

						array_push($array_of_assc_sold_stock,new AsscSoldVehicleStock("","","","","","","","","","","",""));


						if(!empty($vehicle_stocks))
						{
								foreach ($vehicle_stocks as $farray ) {
								    	$purchase_date = date("d-m-Y", strtotime($farray->stock_date));
									$sold_date = date("d-m-Y", strtotime($farray->delivery_date));
									$booking_date = date("d-m-Y", strtotime($farray->booking_date));
									$vehicle_type = strtoupper($farray->type_of_vehicle);
									$vehicle_model = strtoupper($farray->model);
									$vehicle_color = strtoupper($farray->type_of_color);
									$chassis_no = strtoupper($farray->chassis_no);
									$engine_no = strtoupper($farray->engine_no);
									$customer_name = strtoupper($farray->assc_customer_name);
									$contact_no = strtoupper($farray->contact_no);
									$dealer_name = strtoupper($farray->dealer_name);
									
									if($farray->rto_date!="")
									{
									     $rto_date = date("d-m-Y", strtotime($farray->rto_date));
									}
									else
									{
									    $rto_date="RTO Date Not Added";
									}
								   


															

									array_push($array_of_assc_sold_stock,new AsscSoldVehicleStock($purchase_date,$booking_date,$dealer_name,$sold_date,$vehicle_type,$vehicle_model,$vehicle_color,$chassis_no,$engine_no,$customer_name,$contact_no,$rto_date));

									array_push($array_of_assc_sold_stock,new AsscSoldVehicleStock("","","","","","","","","","","",""));


								}
						}
 						
					$report_final = collect($array_of_assc_sold_stock);

						return $report_final;
    }

   
}