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
use Excel; 
use Auth;


class ManageVehicle extends Controller{	

	 /**
	     * Create a new controller instance.
	     *
	     * @return void
	     */
	    public function __construct()
	    {
	        $this->middleware('auth');
	    }



/*
*
*
*
Vehicle Type
*
*/

		public function vehicle_type(){

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

			$vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();
			return view('/vehicle-type',compact(['vehicle_types']));
		}

		public function new_vehicle_type(){
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
			return view('/new-vehicle-type');
		}


		public function insert_vehicle_type(){
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

				if(isset($_POST['type_of_vehicle']))$type_of_vehicle = strtolower($_POST['type_of_vehicle']);

			    $unqiue_string = Str::random(30); 

				$customer_info = DB::table('vehicle_type')->insert( ['unique_id'=>$unqiue_string,'type_of_vehicle'=>$type_of_vehicle] );
			
				return redirect('/vehicle-type')->with('success', 'Vehicle type saved!');


		}


		public function edit_vehicle_type($vehicle_type_id)
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

			$edit_vehicle_type = DB::table('vehicle_type')
							 ->select('vehicle_type.id','vehicle_type.type_of_vehicle')
							 ->where('id', '=', $vehicle_type_id)
							 ->get();

			return view('/edit-vehicle-type',compact(['edit_vehicle_type']));
		}



		public function update_vehicle_type(){	

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

			if(isset($_POST['vehicle_type_id']))$vehicle_type_id = $_POST['vehicle_type_id'];
			if(isset($_POST['type_of_vehicle']))$type_of_vehicle = strtolower($_POST['type_of_vehicle']);
			

			$update_vehicle_type = DB::table('vehicle_type')->where('id', $vehicle_type_id)->update( ['type_of_vehicle' => $type_of_vehicle]);
			
				return redirect('/vehicle-type')->with('success', 'Vehicle Type details updated!');
			
		}

		public function delete_vehicle_type($vehicle_type_id){
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



				$delete_vehicle_type = DB::table('vehicle_type')->where('id', $vehicle_type_id)->update( ['is_deleted' => '1']);
			
				return redirect('/vehicle-type')->with('success', 'Vehicle type details deleted!');
			
		}


/*
*
*
*
Vehicle Color
*
*/

		public function vehicle_color(){
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



			$colors = DB::table('colors')
						->where('is_deleted', '=', '0')
						->get();
			return view('/vehicle-color',compact(['colors']));
		}

		public function new_vehicle_color(){
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

			return view('/new-vehicle-color');
		}

		public function insert_vehicle_color(){
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



				if(isset($_POST['vehicle_color']))$vehicle_color = strtolower($_POST['vehicle_color']);

			   $unqiue_string = Str::random(30); 

				$customer_info = DB::table('colors')->insert( ['unique_id'=>$unqiue_string,'type_of_color'=>$vehicle_color] );
			
				return redirect('/vehicle-color')->with('success', 'Vehicle color saved!');
		}

		public function edit_vehicle_color($vehicle_color_id)
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


			$edit_color = DB::table('colors')
							 ->select('colors.id','colors.type_of_color')
							 ->where('id', '=', $vehicle_color_id)
							 ->get();

			return view('/edit-vehicle-color',compact(['edit_color']));
		}

		public function update_vehicle_color(){	
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



			if(isset($_POST['vehicle_color_id']))$vehicle_color_id = $_POST['vehicle_color_id'];
			if(isset($_POST['vehicle_color']))$vehicle_color = strtolower($_POST['vehicle_color']);
			

			$update_vehicle_color = DB::table('colors')->where('id', $vehicle_color_id)->update( ['type_of_color' => $vehicle_color]);
			
				return redirect('/vehicle-color')->with('success', 'Vehicle color details updated!');
			
		}

		public function delete_vehicle_color($vehicle_color_id){	
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



				$delete_vehicle_color = DB::table('colors')->where('id', $vehicle_color_id)->update( ['is_deleted' => '1']);
			
				return redirect('/vehicle-color')->with('success', 'Vehicle color details deleted!');
			
		}

/*
*
*Vehicle Model
*
*
*/

	    public function model_list(){

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



			$models = DB::table('main_model')
						->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'main_model.vehicle_type_id') 
						->select('main_model.id','main_model.model','vehicle_type.type_of_vehicle','main_model.in_stock')
						->where('main_model.is_deleted', '=', '0')
						->get();
			return view('/model-list',compact(['models']));
		}


		public function new_model_list(){
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




            $vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();
			


			return view('/new-model-list',compact(['vehicle_types']));
		}

		public function insert_model_list(){

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


                if(isset($_POST['vehicle_type_id']))$vehicle_type_id = $_POST['vehicle_type_id'];
				if(isset($_POST['model']))$model = strtolower($_POST['model']);

			   $unqiue_string = Str::random(30); 

				$insert_model = DB::table('main_model')->insert( ['vehicle_type_id'=>$vehicle_type_id,'model'=>$model] );
			
				return redirect('/model-list')->with('success', 'Model saved!');
		}

		public function edit_model_list($model_unique_id)
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

			$edit_model_list = DB::table('main_model')
							->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'main_model.vehicle_type_id') 
							 ->select('main_model.id','main_model.vehicle_type_id','main_model.model','vehicle_type.type_of_vehicle')
							 ->where('main_model.id', '=', $model_unique_id)
							 ->get();

							 $vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();

			return view('/edit-model-list',compact(['edit_model_list','vehicle_types']));
		}

		public function update_model_list(){	
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



			if(isset($_POST['model_unique_id']))$model_unique_id = $_POST['model_unique_id'];
			if(isset($_POST['vehicle_type_id']))$vehicle_type_id = $_POST['vehicle_type_id'];
			if(isset($_POST['model']))$model = strtolower($_POST['model']);
			

			$update_model_list = DB::table('main_model')->where('id', $model_unique_id)->update( ['vehicle_type_id' => $vehicle_type_id,'model'=>$model]);
			
				return redirect('/model-list')->with('success', 'Model updated!');
			
		}


		public function delete_model_list($model_unique_id){	
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


				$delete_model_list = DB::table('main_model')->where('id', $model_unique_id)->update( ['is_deleted' => '1']);
			
				return redirect('/model-list')->with('success', 'Model deleted!');
			
		}




/*
*
*
* Vehicle Model Rate
*
*/
		public function vehicle_model(){
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



			$vehicle_models = DB::table('vehicle_model')
					    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_model.vehicle_type')
					     ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_model.model_name') 
				        ->select('vehicle_model.id','vehicle_model.model_name','vehicle_model.self_sale_rate','vehicle_model.dealer_sale_rate','vehicle_model.extra_fitting_charge','vehicle_type.type_of_vehicle','vehicle_model.is_deleted','main_model.model')
						->where('vehicle_model.is_deleted', '=', '0')
						->get();

			return view('/vehicle-model',compact(['vehicle_models']));

		}

		public function new_vehicle_model(){
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

			$vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();
			$models = DB::table('main_model')
						->where('is_deleted', '=', '0')
						->get();
		
			return view('/new-vehicle-model',compact(['vehicle_types','models']));

		}

		public function fetch_model()
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

            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];

            $models = DB::table('main_model')
                          ->select('main_model.id','main_model.model')
            			 ->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.is_deleted', '=', 0]])						
						->get();

						return $models;



		}


		public function insert_vehicle_model(){
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


				if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];			
				if(isset($_POST['model_name']))$model_name = $_POST['model_name'];
				if(isset($_POST['self_sale_rate']))$self_sale_rate = $_POST['self_sale_rate'];
				if(isset($_POST['dealer_sale_rate']))$dealer_sale_rate = $_POST['dealer_sale_rate'];
				if(isset($_POST['extra_fitting_charge']))$extra_fitting_charge = $_POST['extra_fitting_charge'];

			   $unqiue_string = Str::random(30); 

				$insert_vehicle_model = DB::table('vehicle_model')->insert( ['unique_id'=>$unqiue_string,'vehicle_type'=>$vehicle_type,'model_name'=>$model_name,'self_sale_rate'=>$self_sale_rate,'dealer_sale_rate'=>$dealer_sale_rate,'extra_fitting_charge'=>$extra_fitting_charge] );
			
				return redirect('/vehicle-model')->with('success', 'Vehicle model saved!');
		}


		public function edit_vehicle_model($vehicle_model_id)
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


				   $edit_vehicle_model = DB::table('vehicle_model')
					    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_model.vehicle_type')
					    ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_model.model_name')  
				        ->select('vehicle_model.id','vehicle_model.model_name','vehicle_model.vehicle_type','vehicle_model.self_sale_rate','vehicle_model.dealer_sale_rate','vehicle_model.extra_fitting_charge','vehicle_type.type_of_vehicle','vehicle_model.is_deleted')
						->where('vehicle_model.id', '=', $vehicle_model_id)
						->get();

						/* Vehicle Type Id */

						$vehicle_type_id = $edit_vehicle_model[0]->vehicle_type;


					$vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();

					$models = DB::table('main_model')
						->select('main_model.id','main_model.model')
            			 ->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.is_deleted', '=', 0]])
						->get();

			return view('/edit-vehicle-model',compact(['edit_vehicle_model','vehicle_types','models']));
		}



		public function update_vehicle_model(){	
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


			    if(isset($_POST['vehicle_model_id']))$vehicle_model_id = $_POST['vehicle_model_id'];

				if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
				if(isset($_POST['model_name']))$model_name = $_POST['model_name'];
				if(isset($_POST['self_sale_rate']))$self_sale_rate = $_POST['self_sale_rate'];
				if(isset($_POST['dealer_sale_rate']))$dealer_sale_rate = $_POST['dealer_sale_rate'];
				if(isset($_POST['extra_fitting_charge']))$extra_fitting_charge = $_POST['extra_fitting_charge'];

			$update_vehicle_model = DB::table('vehicle_model')->where('id', $vehicle_model_id)->update( ['vehicle_type' => $vehicle_type,'model_name' => $model_name,'self_sale_rate' => $self_sale_rate,'dealer_sale_rate' => $dealer_sale_rate,'extra_fitting_charge'=>$extra_fitting_charge]);
			
				return redirect('/vehicle-model')->with('success', 'Vehicle model details updated!');
			
		}

		public function delete_vehicle_model($vehicle_model_id){
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

				$delete_vehicle_model = DB::table('vehicle_model')->where('id', $vehicle_model_id)->update( ['is_deleted' => '1']);
			
				return redirect('/vehicle-model')->with('success', 'Vehicle model details deleted!');
			
		}







/* Vehicle Stock */

		public function vehicle_stock(){
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

         
            if(isset($_GET['report_from_date']))$report_from_date1 = $_GET['report_from_date'];

            if(isset($_GET['report_to_date']))$report_to_date1 = $_GET['report_to_date'];

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



			   $vehicle_stocks = DB::table('vehicle_stock')
							    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type') 
						        ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
						        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
						        ->select('vehicle_stock.id','vehicle_stock.chassis_no','vehicle_stock.stock_date','vehicle_stock.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','main_model.model','vehicle_stock.is_deleted','vehicle_stock.sale_type','vehicle_stock.status')
									 ->where(function($query) use ($report_from_date, $report_to_date) {		
							       	 if($report_from_date !='' and $report_to_date !='')
							       	 $query->whereBetween('vehicle_stock.stock_date', [$report_from_date, $report_to_date]);

							       						        
							        	$query->where([['vehicle_stock.is_deleted', '=', 0]]);

							        })->get();

			return view('/vehicle-stock',compact(['vehicle_stocks']));

		}
		
		
		public function fetch_dealer_sold_details(){
		    
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
            
            
            if(isset($_POST['unique_id']))$unique_id = $_POST['unique_id'];
            
            
            $sold_details = DB::table('vehicle_stock')
                            ->where('is_deleted','=', 0)
                            ->where('id','=', $unique_id)
                            ->get();
            
            $sale_type = $sold_details[0]->sale_type;
            $sale_type_id = $sold_details[0]->sale_type_id;
          
                
                	$sd1 = DB::table('dealers')            			 
                         ->select('dealers.dealer_name','dealers.dealer_code')
            			 ->where([['dealers.id', '=', $sale_type_id],['dealers.is_deleted', '=', 0]])						
						->get();
						
						 return $sd1;

            
            
           

        }
        
        public function fetch_customer_sold_details(){
		    
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
            
            
            if(isset($_POST['unique_id']))$unique_id = $_POST['unique_id'];
            
            
            $sold_details = DB::table('vehicle_stock')
                            ->where('is_deleted','=', 0)
                            ->where('id','=', $unique_id)
                            ->get();
            
            $sale_type = $sold_details[0]->sale_type;
            $sale_type_id = $sold_details[0]->sale_type_id;
          
                
                
                $sd = DB::table('customers')            			 
                         ->select('customers.customer_name','customers.customer_code')
            			 ->where([['customers.id', '=', $sale_type_id],['customers.is_deleted', '=', 0]])						
						->get();

                 return $sd;
        
           

        }
		
		
		
		

		public function new_vehicle_stock(){
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


			$vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();
			$models = DB::table('main_model')
						->where('is_deleted', '=', '0')
						->get();
			$colors = DB::table('colors')
						->where('is_deleted', '=', '0')
			 			->get();


			return view('/new-vehicle-stock',compact(['vehicle_types','colors','models']));

		}


		public function fetch_stock_model()
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


            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];

            $stock_models = DB::table('main_model')
                         ->select('main_model.id','main_model.model')
            			 ->where([['main_model.vehicle_type_id', '=', $vehicle_type],['main_model.is_deleted', '=', 0]])						
						->get();

						return $stock_models;



		}

		public function fetch_stock_color()
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
           
            if(isset($_POST['model_name1']))$model_name1 = $_POST['model_name1'];           
            if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];


            $stock_colors = DB::table('vehicle_model')
            			 ->leftJoin('colors', 'colors.id', '=', 'vehicle_model.vehicle_color')
                         ->select('colors.id','colors.type_of_color')
            			 ->where([['vehicle_model.vehicle_type', '=', $vehicle_type],['vehicle_model.model_name', '=', $model_name1],['vehicle_model.is_deleted', '=', 0]])						
						->get();


						return $stock_colors;



		}




		public function insert_vehicle_stock(){

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

				if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
				if(isset($_POST['stock_date']))$stock_date = date("Y-m-d", strtotime($_POST['stock_date']));
				if(isset($_POST['vehicle_color']))$vehicle_color = $_POST['vehicle_color'];
				if(isset($_POST['model_name']))$model_name = $_POST['model_name'];
				if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
				if(isset($_POST['engine_no']))$engine_no = $_POST['engine_no'];
				

			   $unqiue_string = Str::random(30); 

				$insert_vehicle_stock = DB::table('vehicle_stock')->insert( ['unique_id'=>$unqiue_string,'vehicle_type'=>$vehicle_type,'vehicle_color'=>$vehicle_color,'stock_date'=>$stock_date,'model_name'=>$model_name,'chassis_no'=>$chassis_no,'engine_no'=>$engine_no] );


				$select_in_stock = DB::table('main_model')
				                    ->select('main_model.in_stock')
				                     ->where([['main_model.id', '=', $model_name],['main_model.vehicle_type_id', '=', $vehicle_type]])
						            ->get(); 



						        $stock_qty = $select_in_stock[0]->in_stock;

						        $update_stock_qty = $stock_qty + 1;

						        $update_stock_in_model = DB::table('main_model')
						        						 ->where([['main_model.id', '=', $model_name],['main_model.vehicle_type_id', '=', $vehicle_type]])
											            ->update(['in_stock' => $update_stock_qty]);
											         

			
				return redirect('/vehicle-stock')->with('success', 'Vehicle stock saved!');
		}


		public function edit_vehicle_stock($vehicle_stock_id)
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


				   $edit_vehicle_stock = DB::table('vehicle_stock')
					    ->leftJoin('vehicle_type', 'vehicle_type.id', '=', 'vehicle_stock.vehicle_type') 
				        ->leftJoin('colors', 'colors.id', '=', 'vehicle_stock.vehicle_color')
				        ->leftJoin('main_model', 'main_model.id', '=', 'vehicle_stock.model_name')
				        ->select('vehicle_stock.id','vehicle_stock.model_name','vehicle_stock.stock_date','vehicle_stock.vehicle_type','vehicle_stock.vehicle_color','vehicle_stock.chassis_no','vehicle_stock.engine_no','vehicle_type.type_of_vehicle','colors.type_of_color','vehicle_stock.is_deleted')
						->where('vehicle_stock.id', '=', $vehicle_stock_id)
						->get();

						$vehicle_type_id = $edit_vehicle_stock[0]->vehicle_type;
						$model_name1 = $edit_vehicle_stock[0]->model_name;



					$vehicle_types = DB::table('vehicle_type')
						->where('is_deleted', '=', '0')
						->get();

			        $colors = DB::table('colors')
						->where('is_deleted', '=', '0')
						->get();

					$vehicle_models = DB::table('main_model')            			 
                         ->select('main_model.id','main_model.model')
            			 ->where([['main_model.vehicle_type_id', '=', $vehicle_type_id],['main_model.is_deleted', '=', 0]])						
						->get();


			return view('/edit-vehicle-stock',compact(['edit_vehicle_stock','vehicle_types','colors', 'vehicle_models']));
		}


		public function update_vehicle_stock(){	

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

			    if(isset($_POST['vehicle_stock_id']))$vehicle_stock_id = $_POST['vehicle_stock_id'];

				if(isset($_POST['vehicle_type']))$vehicle_type = $_POST['vehicle_type'];
				if(isset($_POST['stock_date']))$stock_date = date("Y-m-d", strtotime($_POST['stock_date']));
				if(isset($_POST['vehicle_color']))$vehicle_color = $_POST['vehicle_color'];
				if(isset($_POST['model_name']))$model_name = $_POST['model_name'];
				if(isset($_POST['chassis_no']))$chassis_no = $_POST['chassis_no'];
				if(isset($_POST['engine_no']))$engine_no = $_POST['engine_no'];


				if(isset($_POST['old_vehicle_type']))$old_vehicle_type = $_POST['old_vehicle_type'];
				if(isset($_POST['old_vehicle_color']))$old_vehicle_color = $_POST['old_vehicle_color'];
				if(isset($_POST['old_vehicle_model']))$old_vehicle_model = $_POST['old_vehicle_model'];


				


			$update_vehicle_stock = DB::table('vehicle_stock')->where('id', $vehicle_stock_id)->update( ['vehicle_type' => $vehicle_type,'stock_date'=>$stock_date,'vehicle_color' => $vehicle_color,'model_name' => $model_name,'chassis_no' => $chassis_no,'engine_no' => $engine_no]);

				if($old_vehicle_type == $vehicle_type && $old_vehicle_model == $model_name && $old_vehicle_color == $old_vehicle_color)
				{

				}
				else
				{

					$select_in_stock_old = DB::table('main_model')
				                    ->select('main_model.in_stock')
				                    ->where([['main_model.id', '=', $old_vehicle_model],['main_model.vehicle_type_id', '=', $old_vehicle_type]])
						            ->get(); 



						        $stock_qty_old = $select_in_stock_old[0]->in_stock;

						        $update_stock_qty_old = $stock_qty_old - 1;

						         $update_stock_in_model_old = DB::table('main_model')
						        						 ->where([['main_model.id', '=', $old_vehicle_model],['main_model.vehicle_type_id', '=', $old_vehicle_type]])
											            ->update(['in_stock' => $update_stock_qty_old]);



					$select_in_stock = DB::table('main_model')
				                    ->select('main_model.in_stock')
				                    ->where([['main_model.id', '=', $model_name],['main_model.vehicle_type_id', '=', $vehicle_type]])
						            ->get(); 



						        $stock_qty = $select_in_stock[0]->in_stock;

						        $update_stock_qty = $stock_qty + 1;

						        $update_stock_in_model = DB::table('main_model')
						        						 ->where([['main_model.id', '=', $model_name],['main_model.vehicle_type_id', '=', $vehicle_type]])
											            ->update(['in_stock' => $update_stock_qty]);
				}

				
			
				return redirect('/vehicle-stock')->with('success', 'Vehicle stock details updated!');
			
		}


		public function delete_vehicle_stock($vehicle_stock_id){

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


            		$select_in_stock_val = DB::table('vehicle_stock')
				                    ->select('vehicle_stock.model_name','vehicle_stock.vehicle_type','vehicle_stock.vehicle_color')
						       		->where('id', '=', $vehicle_stock_id)						            				        
						            ->get(); 

						         $model_name = $select_in_stock_val[0]->model_name;
						         $vehicle_type = $select_in_stock_val[0]->vehicle_type;
						         $vehicle_color = $select_in_stock_val[0]->vehicle_color;



            		$select_in_stock = DB::table('main_model')
				                    ->select('main_model.in_stock')
						       		->where('id', '=', $model_name)
						            ->where('vehicle_type_id', '=', $vehicle_type)						        
						            ->get(); 



						        $stock_qty = $select_in_stock[0]->in_stock;

						        $update_stock_qty = $stock_qty - 1;

						        $update_stock_in_model = DB::table('main_model')
						        						->where('id', '=', $model_name)
											            ->where('vehicle_type_id', '=', $vehicle_type)
											            ->update(['in_stock' => $update_stock_qty]);




				$delete_vehicle_stock = DB::table('vehicle_stock')->where('id', $vehicle_stock_id)->update( ['is_deleted' => '1']);
			
				return redirect('/vehicle-stock')->with('success', 'Vehicle stock details deleted!');
			
		}







		public function import_stock(){

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
            
			return view('/import-stock');
		}


		public function insert_import_stock(){

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


									$file = $_FILES['import_file']['tmp_name'];
									$handle = fopen($file, "r");
									
									
									//$count = $count1;
									
								 	while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
									{
										$stock_date1 = $filesop[0];	
										$stock_date = date('Y-m-d', strtotime($stock_date1));

										$vehicle_type = strtolower($filesop[1]);	// Convert the string lowercase									
										$vehicle_model = strtolower($filesop[2]);	// Convert the string lowercase	

										// print $vehicle_model;
										// die();

										$vehicle_color = strtolower($filesop[3]);    // Convert the string lowercase

										$chassis_no = $filesop[4];
										$engine_no = $filesop[5];

                                     if($stock_date !='' && $vehicle_type !='' && $vehicle_model !='' && $vehicle_color !='' && $chassis_no !='' && $engine_no !='')
										{

										$fetch_vehicle_type = DB::select( "SELECT id FROM vehicle_type WHERE type_of_vehicle = '$vehicle_type' and is_deleted='0'");
										
										if(empty($fetch_vehicle_type))
                                        {
                                        	 $unqiue_string = Str::random(30);
                                        	// print $vehicle_model1;

                                        	$vehicle_type1 = db::table('vehicle_type')->insertGetId( ['unique_id'=>$unqiue_string,'type_of_vehicle'=>$vehicle_type] );
                                        }
                                        else
                                        {
                                        	$vehicle_type1 = $fetch_vehicle_type[0]->id;
                                        }


										
										

                                        $fetch_vehicle_model = DB::select( "SELECT id FROM main_model WHERE model = '$vehicle_model' and is_deleted='0'");
                                        

                                         if(empty($fetch_vehicle_model))
                                        {
                                        	 $unqiue_string = Str::random(30);
                                        	// print $vehicle_model1;

                                        	$vehicle_model1 = db::table('main_model')->insertGetId( ['vehicle_type_id'=>$vehicle_type1,'model'=>$vehicle_model] );
                                        }
                                        else
                                        {
                                        	$vehicle_model1 = $fetch_vehicle_model[0]->id;
                                        }

										

                                        $fetch_vehicle_color = DB::select( "SELECT id FROM colors WHERE type_of_color = '$vehicle_color' and is_deleted='0'");
                                       

                                        if(empty($fetch_vehicle_color))
                                        {
                                        	 $unqiue_string = Str::random(30);

                                        	$vehicle_color1 = db::table('colors')->insertGetId( ['unique_id'=>$unqiue_string,'type_of_color'=>$vehicle_color] );
                                        }
                                        else
                                        {
                                        	 $vehicle_color1 = $fetch_vehicle_color[0]->id;
                                        }

                                        

                                      print "<br>Stock Date : ".$stock_date;
                                      print "<br>Vehicle Type : ".$vehicle_type1;
                                      print "<br>Vehicle Color : ".$vehicle_color1;
                                      print "<br>Model Name : ".$vehicle_model1;
                                      print "<br>Chassis No : ".$chassis_no;
                                      print "<br>Engine No : ".$engine_no;
                                      print"<br>";
                                      print"<br>";

                                        $fetch_vehicle_count = DB::select( "SELECT in_stock FROM main_model WHERE vehicle_type_id = '$vehicle_type1' and id='$vehicle_model1' and is_deleted='0'" );

                                        $vehicle_count = $fetch_vehicle_count[0]->in_stock;

                                        $update_stock_count =  $vehicle_count + 1;

                                       

                                         $update_update_stock_count = DB::table('main_model')
						        						 ->where([['main_model.id', '=', $vehicle_model1],['main_model.vehicle_type_id', '=', $vehicle_type1]])
											            ->update(['in_stock' => $update_stock_count]);


                                        $unqiue_string = Str::random(30); 

                                      $insert_import_stock = DB::table('vehicle_stock')->insert( ['unique_id'=>$unqiue_string,'stock_date' => $stock_date,'vehicle_type' => $vehicle_type1, 'vehicle_color' =>$vehicle_color1, 'model_name' => $vehicle_model1, 'chassis_no' => $chassis_no, 'engine_no' => $engine_no] );               	    
										
								  }

									}
									
						return redirect('/vehicle-stock')->with('success', 'Stock imported!!');


            
         }


}
?>