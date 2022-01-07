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
         

        

              $stock_in_hands = DB::table('main_model')
                        ->leftjoin('vehicle_type', 'vehicle_type.id', '=', 'main_model.vehicle_type_id')
                        ->select('vehicle_type.type_of_vehicle','main_model.model','main_model.in_stock','main_model.id','main_model.vehicle_type_id')
                        ->where('main_model.is_deleted', '=', '0')
                        ->get();





						$array_of_stock_in_hand =array();

						$report_date =date("d-m-Y");


						array_push($array_of_stock_in_hand,new StockInHand("","","Report Date: ".$report_date));


						array_push($array_of_stock_in_hand,new StockInHand("Vehicle Type","Model","In Stock"));

						array_push($array_of_stock_in_hand,new StockInHand("","",""));


						if(!empty($stock_in_hands))
						{
								foreach ($stock_in_hands as $farray ) {

									$vehicle_type = strtoupper($farray->type_of_vehicle);
									$vehicle_model = strtoupper($farray->model);
									$in_stock = $farray->in_stock;						

									array_push($array_of_stock_in_hand,new StockInHand($vehicle_type,$vehicle_model,$in_stock));

									array_push($array_of_stock_in_hand,new StockInHand("","",""));


								}
						}
 						
					$report_final = collect($array_of_stock_in_hand);

						return $report_final;
    }

   
}