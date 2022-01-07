<?php
namespace App\Http\Controllers;
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


class FetchColorCount extends Controller{	
		  
        /**
	     * Create a new controller instance.
	     *
	     * @return void
	     */
	    public function __construct()
	    {
	        $this->middleware('auth');
	    }


		public function fetch_colors_count_one(){

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
            
            if(isset($_POST['primary_id']))$model_id = $_POST['primary_id'];
						 
						 
			 $fetch_color_count_one = DB::table('colors')
			        ->where("colors.is_deleted","=", 0)
			        ->select("colors.type_of_color","colors.id",
			        	
			        	DB::raw("(SELECT count(id) as total_count FROM vehicle_stock WHERE vehicle_stock.is_deleted = 0 and vehicle_stock.vehicle_color = colors.id and vehicle_stock.model_name = '$model_id' and vehicle_stock.status = 0) as total_count_color_one"))
				   
				    ->get();
				    
				    
				    // print_r($fetch_color_count_one);
				    // die();
				    
				    return $fetch_color_count_one;
						 
			
		}
		
		
		public function fetch_colors_count(){

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
            
            if(isset($_POST['primary_id']))$model_id = $_POST['primary_id'];
						 
						 
			 $fetch_color_count = DB::table('colors')
			        ->where("colors.is_deleted","=", 0)
			        ->select("colors.type_of_color","colors.id",
			        	
			        	DB::raw("(SELECT count(id) as total_count FROM vehicle_stock WHERE vehicle_stock.is_deleted = 0 and vehicle_stock.vehicle_color = colors.id and vehicle_stock.model_name = '$model_id' and vehicle_stock.status = 0) as total_count_color_one"))
				   
				    ->get();
				    
				    
				    // print_r($fetch_color_count_one);
				    // die();
				    
				    return $fetch_color_count;
						 
			
		}
		
		
		
}
?>