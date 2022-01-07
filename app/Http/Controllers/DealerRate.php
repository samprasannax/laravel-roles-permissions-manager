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


class DealerRate extends Controller{	
		
		 /**
	     * Create a new controller instance.
	     *
	     * @return void
	     */
	    public function __construct()
	    {
	        $this->middleware('auth');
	    }


		public function index(){

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


			$dealer_rates = DB::table('dealer_rate')
						 ->leftJoin('dealers', 'dealers.id','dealer_rate.dealer_id')
						 ->leftJoin('main_model', 'main_model.id','dealer_rate.vehicle_model_id')
						 ->leftJoin('vehicle_type', 'vehicle_type.id','dealer_rate.vehicle_type_id')						
						 ->select('dealer_rate.id','dealer_rate.dealer_sale_rate','dealers.dealer_name','vehicle_type.type_of_vehicle','main_model.model')
						 ->where('dealer_rate.is_deleted', '=', '0')
						 ->orderBy('id', 'DESC')
						 ->get();

			return view('/dealer-rate-info',compact(['dealer_rates']));

		}

		public function new_dealer_rate_info()
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
			        $dealers = DB::table('dealers')
			 			->where('dealers.is_deleted' ,'=', '0')
			 			->get();
			 		$vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();
			        $models = DB::table('main_model')
						->where('is_deleted', '=', '0')
						->get();
			      
			return view('/new-dealer-rate-info',compact(['dealers','vehicle_types','models']));

		}



		public function insert_dealer_rate_info(){

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
            
                if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];
				if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];			
				
				if(isset($_POST['model_name']))$model_name = $_POST['model_name'];
				if(isset($_POST['sale_rate']))$sale_rate = $_POST['sale_rate'];

			   
				$insert_dealer_rate = DB::table('dealer_rate')->insert(['dealer_id'=>$dealer_id,'vehicle_type_id'=>$vehicle_type,'vehicle_model_id'=>$model_name,'dealer_sale_rate'=>$sale_rate]);
			
				return redirect('/dealer-rate')->with('success', 'Dealer rate info saved!');
		}



		public function edit_dealer_rate_info($dealer_rate_unique_id){

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
               			   
					$edit_dealer_rates = DB::table('dealer_rate')
						 ->leftJoin('dealers', 'dealers.id','dealer_rate.dealer_id')
						 ->leftJoin('main_model', 'main_model.id','dealer_rate.vehicle_model_id')
						 ->leftJoin('vehicle_type', 'vehicle_type.id','dealer_rate.vehicle_type_id')
						
						 ->select('dealer_rate.id','dealer_rate.dealer_sale_rate','dealers.dealer_name','vehicle_type.type_of_vehicle','main_model.model','dealer_rate.dealer_id','dealer_rate.vehicle_type_id','dealer_rate.vehicle_model_id')
						 ->where([['dealer_rate.is_deleted', '=', '0'],['dealer_rate.id', '=', $dealer_rate_unique_id]])
						 ->get();

					$dealers = DB::table('dealers')
			 			->where('dealers.is_deleted' ,'=', '0')
			 			->get();
			 		$vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();
			        $models = DB::table('main_model')
						->where('is_deleted', '=', '0')
						->get();
			       

			
				return view('/edit-dealer-rate-info',compact(['edit_dealer_rates','dealers','vehicle_types', 'models']));

			}

		

		public function update_dealer_rate_info(){	

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

			    if(isset($_POST['dealer_rate_unique_id']))$dealer_rate_unique_id = $_POST['dealer_rate_unique_id'];
				if(isset($_POST['dealer_id']))$dealer_id = $_POST['dealer_id'];
				if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
				if(isset($_POST['model_name']))$model_name = $_POST['model_name'];
				if(isset($_POST['sale_rate']))$sale_rate = $_POST['sale_rate'];
			


			$update_dealer_rate_info = DB::table('dealer_rate')->where('id', $dealer_rate_unique_id)->update( ['dealer_id' => $dealer_id,'vehicle_type_id'=>$vehicle_type,'vehicle_model_id' => $model_name,'dealer_sale_rate' => $sale_rate]);

			
				return redirect('/dealer-rate')->with('success', 'Vehicle dealer rate updated!');
			
		}

		public function delete_dealer_rate_info($dealer_rate_unique_id)
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


		    $delete_dealer_rate_info = DB::table('dealer_rate')->where('dealer_rate.id','=', $dealer_rate_unique_id)->update( ['dealer_rate.is_deleted' => '1']);
		    
		    return redirect('/dealer-rate')->with('success', 'Vehicle dealer rate deleted!!');


		}


}
?>