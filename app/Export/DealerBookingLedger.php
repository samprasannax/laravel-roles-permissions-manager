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
  
class DealerBookingLedger implements FromCollection
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
         
         
         
            
              $report_from_date1="";
             $report_to_date1="";

             $dealer_id1 = "";
             $report_from_date="";
             $report_to_date="";


         
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

            if(isset($_POST['dealer_id']))$dealer_id1 = $_POST['dealer_id'];
          
          	if($dealer_id1 !='')
          	{
          		$dealer_id = $dealer_id1;
          	}
          
            if($dealer_id =='')
          	{
          		$dealer_id = '0';
          	}
          	
          	





 $assc_stock_in_hands = DB::table('dealer_booking_vehicle_info')
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'dealer_booking_vehicle_info.vehicle_type_id') 
						        ->leftJoin('colors', 'colors.id', '=', 'dealer_booking_vehicle_info.color_id')
						        ->leftJoin('main_model', 'main_model.id', '=', 'dealer_booking_vehicle_info.model_id')
						         ->leftJoin('dealers', 'dealers.id', '=', 'dealer_booking_vehicle_info.dealer_id')
						        ->select('dealer_booking_vehicle_info.delivery_date','dealer_booking_vehicle_info.rto_date','dealer_booking_vehicle_info.id','dealer_booking_vehicle_info.chassis_no','dealer_booking_vehicle_info.booking_date','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','dealers.dealer_name','dealer_booking_vehicle_info.assc_customer_name','dealer_booking_vehicle_info.contact_no')
							     
							     ->where(function($query) use ($report_from_date, $report_to_date, $dealer_id) {
							         
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('dealer_booking_vehicle_info.booking_date', [$report_from_date, $report_to_date]);
							       
							       	if($dealer_id >'0')
							       		$query->where([['dealer_booking_vehicle_info.dealer_id', '=', $dealer_id],['dealer_booking_vehicle_info.is_deleted', '=', 0]]);
							       		
							       	if($dealer_id =='')
							       		$query->where([['dealer_booking_vehicle_info.is_deleted', '=', 0]]);
							       						        
							       	$query->where([['dealer_booking_vehicle_info.is_deleted', '=', 0]]);
							       	
							        })->get();
							
							


						$array_of_assc_stock_in_hand1 = array();

						$report_date = date("d-m-Y");


						array_push($array_of_assc_stock_in_hand1,new DealerBookingList("","","Report Date: ".$report_date,"","",""));


						array_push($array_of_assc_stock_in_hand1,new DealerBookingList("Booking Date","Vehicle Type","Vehicle Model","Vehicle Color","Chassis No","Dealer Name"));

						array_push($array_of_assc_stock_in_hand1,new DealerBookingList("","","","","",""));


						if(!empty($assc_stock_in_hands))
						{
								foreach ($assc_stock_in_hands as $farray ) {
                                    $booking_date  = $farray->booking_date;
                                    
									$vehicle_type = strtoupper($farray->type_of_vehicle);
									$vehicle_model = strtoupper($farray->model);
									$type_of_color = strtoupper($farray->type_of_color);
									$chassis_no = strtoupper($farray->chassis_no);
									$dealer_name = strtoupper($farray->dealer_name);			

									array_push($array_of_assc_stock_in_hand1,new DealerBookingList($booking_date,$vehicle_type,$vehicle_model,$type_of_color,$chassis_no,$dealer_name));

									array_push($array_of_assc_stock_in_hand1,new DealerBookingList("","","","","",""));


								}
						}
 						
					$report_final = collect($array_of_assc_stock_in_hand1);

						return $report_final;
    }

   
}