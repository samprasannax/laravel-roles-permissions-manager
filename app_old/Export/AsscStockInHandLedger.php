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
  
class AsscStockInHandLedger implements FromCollection
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
         

        
    					$assc_stock_in_hands = DB::table('dealer_booking_vehicle_info')
                                    ->leftjoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
                                    ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
                                      ->select('dealer_booking_vehicle_info.model_id','dealer_booking_vehicle_info.vehicle_type_id','vehicle_type.type_of_vehicle','main_model.model',DB::raw("(SELECT count(id) as total_scooter FROM dealer_booking_vehicle_info
                                WHERE dealer_booking_vehicle_info.model_id = main_model.id and dealer_booking_vehicle_info.vehicle_type_id = vehicle_type.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.stock_status = 0 and dealer_booking_vehicle_info.return_status = 0) as total_stock"))->distinct()
                                     ->get();




						$array_of_assc_stock_in_hand = array();

						$report_date = date("d-m-Y");


						array_push($array_of_assc_stock_in_hand,new AsscStockInHand("","","Report Date: ".$report_date));


						array_push($array_of_assc_stock_in_hand,new AsscStockInHand("Vehicle Type","Model","In Stock"));

						array_push($array_of_assc_stock_in_hand,new AsscStockInHand("","",""));


						if(!empty($assc_stock_in_hands))
						{
								foreach ($assc_stock_in_hands as $farray ) {

									$vehicle_type = strtoupper($farray->type_of_vehicle);
									$vehicle_model = strtoupper($farray->model);
									$in_stock = $farray->total_stock;						

									array_push($array_of_assc_stock_in_hand,new AsscStockInHand($vehicle_type,$vehicle_model,$in_stock));

									array_push($array_of_assc_stock_in_hand,new AsscStockInHand("","",""));


								}
						}
 						
					$report_final = collect($array_of_assc_stock_in_hand);

						return $report_final;
    }

   
}