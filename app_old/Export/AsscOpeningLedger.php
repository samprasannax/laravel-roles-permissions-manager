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
  
class AsscOpeningLedger implements FromCollection
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

         
	            $dealer_opens = DB::table('dealers')
							  ->where('is_deleted', '=', 0)
								->get();
								
								
			    $negative_total = DB::table('dealers')
			                       ->where('opening_balance', '<', 0)
			                       ->where('is_deleted', '=', 0)
			                       ->sum('opening_balance');
			                       
		    	$passitive_total = DB::table('dealers')
			                       ->where('opening_balance', '>', 0)
			                       ->where('is_deleted', '=', 0)
			                       ->sum('opening_balance');
			                       

                $report_date = date("d-m-Y");
                
                $assc_opening_items=array();
                
                

						array_push($assc_opening_items,new AsscOpening("Report Date: ".$report_date,"",""));
						array_push($assc_opening_items,new AsscOpening("","",""));
						


						array_push($assc_opening_items,new AsscOpening("Dealer Name","Balance","Unclear"));
						array_push($assc_opening_items,new AsscOpening("","",""));
						



						if(!empty($dealer_opens))
						{
								foreach ($dealer_opens as $farray ) {

									$dealerName = $farray->dealer_name;
									
									$opening_balance = $farray->total_remaining;
									
									if($opening_balance < 0)
									{
									    $pending = $farray->total_remaining;
									    
									    	array_push($assc_opening_items,new AsscOpening($dealerName,$pending,'0'));

									        array_push($assc_opening_items,new AsscOpening("","",""));
									
									
									}
									else
									{
									     $unclear = $farray->total_remaining;
									    
									    	array_push($assc_opening_items,new AsscOpening($dealerName,'0',$unclear));

									        array_push($assc_opening_items,new AsscOpening("","",""));
									
									    
									}
									
									
								


								}

						}
						
							array_push($assc_opening_items,new AsscOpening("Pending / Unclear",$negative_total,$passitive_total));

							array_push($assc_opening_items,new AsscOpening("","",""));
						
 						

			

						$report_final = collect($assc_opening_items);

						return $report_final;
    }

   
}