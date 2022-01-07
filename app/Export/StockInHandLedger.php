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
  
class StockInHandLedger implements FromCollection
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
         

        

            //   $stock_in_hands = DB::table('main_model')
            //             ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'main_model.vehicle_type_id')
            //             ->select('vehicle_type.type_of_vehicle','main_model.model','main_model.in_stock','main_model.id','main_model.vehicle_type_id')
            //             ->where('main_model.is_deleted', '=', '0')
            //             ->get();


$stock_in_hands = DB::table('vehicle_stock')
                ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type')
                ->leftjoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
                ->leftjoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
                ->select('vehicle_type.type_of_vehicle','vehicle_stock.stock_date','colors.type_of_color','main_model.model','vehicle_stock.chassis_no')
                ->where('vehicle_stock.is_deleted','=',0)
                ->where('vehicle_stock.status','=',0)
                ->orderBy('vehicle_stock.id', 'DESC')
                ->get();
                
                



						$array_of_stock_in_hand =array();

						$report_date =date("d-m-Y");


						array_push($array_of_stock_in_hand,new StockInHand("","","Report Date: ".$report_date,"",""));


						array_push($array_of_stock_in_hand,new StockInHand("Stock Date","Vehicle Type","Model","Color","Chassis No"));

						array_push($array_of_stock_in_hand,new StockInHand("","","","",""));


						if(!empty($stock_in_hands))
						{
								foreach ($stock_in_hands as $farray ) {
                                    $stock_date = strtoupper($farray->stock_date);
									$vehicle_type = strtoupper($farray->type_of_vehicle);
									$vehicle_model = strtoupper($farray->model);
									$color = $farray->type_of_color;
									$chassis_no = $farray->chassis_no;

									array_push($array_of_stock_in_hand,new StockInHand($stock_date,$vehicle_type,$vehicle_model,$color,$chassis_no));

									array_push($array_of_stock_in_hand,new StockInHand("","","","",""));


								}
						}
 						
					$report_final = collect($array_of_stock_in_hand);

						return $report_final;
    }

   
}