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
  
class MechanicReport implements FromCollection
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
        

        $meachanic_lists =  DB::table('sale_booking')
						->where('sale_booking.is_deleted', '=', 0)
						->leftJoin('mechanic', 'mechanic.id', '=', 'sale_booking.mechanic_id')
						->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'sale_booking.vehicle_type_id') 
				        ->leftJoin('colors', 'colors.id', '=', 'sale_booking.vehicle_color_id')
				        ->leftJoin('main_model', 'main_model.id', '=', 'sale_booking.vehicle_model_id')
				         ->leftJoin('customers', 'customers.id', '=', 'sale_booking.customer_id')
				        ->leftJoin('sales_person', 'sales_person.id','=', 'sale_booking.sales_person_id')
				        ->select('sale_booking.booking_date','mechanic.mechanic_name','mechanic.contact_no1','mechanic.mechanic_address','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','customers.customer_name','customers.contact_no1 as custno','sales_person.sales_person_name')
						->get();

				    
				   
						$array_of_mechanic_reports =array();

						$report_date =date("d-m-Y");


						array_push($array_of_mechanic_reports,new Mechanic("","","","Report Date: ".$report_date,"","","","",""));


						array_push($array_of_mechanic_reports,new Mechanic("Mechanic Name","Contact Number","Address","Vehicle Model","Vehicle Color","Booking Date","Customer Name","Contact No","Sales Executive Name"));

						array_push($array_of_mechanic_reports,new Mechanic("","","","","","","","",""));


						if(!empty($meachanic_lists))
						{
								foreach ($meachanic_lists as $meachanic_list ) {
									$mname = $meachanic_list->mechanic_name;
									$contactnumber = $meachanic_list->contact_no1;
									$maddress = $meachanic_list->mechanic_address;
									$type_of_vehicle = $meachanic_list->type_of_vehicle;
									$type_of_color = $meachanic_list->type_of_color;
									$model = $meachanic_list->model;
									$customer_name = $meachanic_list->customer_name;
									$custno = $meachanic_list->custno;
									$sales_person_name = $meachanic_list->sales_person_name;
									


															

									array_push($array_of_mechanic_reports,new Mechanic($mname,$contactnumber,$maddress,$type_of_vehicle,$type_of_color,$model,$customer_name,$custno,$sales_person_name));

									array_push($array_of_mechanic_reports,new Mechanic("","","","","","","","",""));


								}
						}

 						
					$report_final = collect($array_of_mechanic_reports);

					return $report_final;
    }

   
}