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
         

        
    				// 	$assc_stock_in_hands = DB::table('dealer_booking_vehicle_info')
        //                             ->leftjoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
        //                             ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id')
        //                               ->select('dealer_booking_vehicle_info.model_id','dealer_booking_vehicle_info.vehicle_type_id','vehicle_type.type_of_vehicle','main_model.model',DB::raw("(SELECT count(id) as total_scooter FROM dealer_booking_vehicle_info
        //                         WHERE dealer_booking_vehicle_info.model_id = main_model.id and dealer_booking_vehicle_info.vehicle_type_id = vehicle_type.id and dealer_booking_vehicle_info.is_deleted = 0 and dealer_booking_vehicle_info.stock_status = 0 and dealer_booking_vehicle_info.return_status = 0) as total_stock"))->distinct()
        //                              ->get();


 $assc_stock_in_hands = DB::table('dealer_booking_vehicle_info')
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id') 
						        ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')
						        ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
						         ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
						        ->select('dealer_booking_vehicle_info.delivery_date','dealer_booking_vehicle_info.rto_date','dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.booking_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','dealers.dealer_name','dealer_booking_vehicle_info.assc_customer_name','dealer_booking_vehicle_info.contact_no')
								->where('dealer_booking_vehicle_info.is_deleted', '=', 0)
								->where('dealer_booking_vehicle_info.stock_status', '=', 0)
								->where('dealer_booking_vehicle_info.return_status', '=', 0)
								->orderBy('dealer_booking_vehicle_info.id', 'DESC')
								->get();
								
								


						$array_of_assc_stock_in_hand = array();

						$report_date = date("d-m-Y");


						array_push($array_of_assc_stock_in_hand,new AsscStockInHand("","","Report Date: ".$report_date,"","",""));


						array_push($array_of_assc_stock_in_hand,new AsscStockInHand("Booking Date","Vehicle Type","Vehicle Model","Vehicle Color","Chassis No","Dealer Name"));

						array_push($array_of_assc_stock_in_hand,new AsscStockInHand("","","","","",""));


						if(!empty($assc_stock_in_hands))
						{
								foreach ($assc_stock_in_hands as $farray ) {
                                    $booking_date  = $farray->booking_date;
                                    
									$vehicle_type = strtoupper($farray->type_of_vehicle);
									$vehicle_model = strtoupper($farray->model);
									$type_of_color = strtoupper($farray->type_of_color);
									$chassis_no = strtoupper($farray->chassis_no);
									$dealer_name = strtoupper($farray->dealer_name);			

									array_push($array_of_assc_stock_in_hand,new AsscStockInHand($booking_date,$vehicle_type,$vehicle_model,$type_of_color,$chassis_no,$dealer_name));

									array_push($array_of_assc_stock_in_hand,new AsscStockInHand("","","","","",""));


								}
						}
 						
					$report_final = collect($array_of_assc_stock_in_hand);

						return $report_final;
    }

   
}